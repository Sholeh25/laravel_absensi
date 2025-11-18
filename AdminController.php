<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Employee;
use App\Department;
use App\User;
// Hapus atau Nonaktifkan: use Intervention\Image\ImageManagerStatic as Image; 
// Kita tidak lagi menggunakannya untuk menghindari Class Not Found Error

class AdminController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Halaman Reset Password
     */
    public function reset_password()
    {
        return view('auth.reset-password');
    }

    /**
     * Update Password Admin
     */
    public function update_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password'     => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Password lama salah.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    /**
     * Tampilkan profil admin yang sedang login
     */
    public function adminProfile()
    {
        $user = Auth::user();

        // Cari data employee yang terhubung dengan user
        // Menggunakan findOrFail jika admin pasti punya entri di tabel employee
        $admin = Employee::where('user_id', $user->id)->first(); 

        if (!$admin) {
            return redirect()->route('admin.index')
                ->with('error', 'Data profil karyawan tidak ditemukan.');
        }

        return view('admin.profile', compact('admin'));
    }

    /**
     * Form Edit Profil Admin
     */
    public function profile_edit()
    {
        $user = Auth::user();
        $admin = Employee::where('user_id', $user->id)->firstOrFail();

        $data = [
            'admin' => $admin,
            'departments' => Department::all(),
            'desgs' => ['Manajer', 'Asisten Manajer', 'Projek Manajer', 'Staff'],
        ];

        return view('admin.profile-edit', $data);
    }

    /**
     * Update Profil Admin
     * (Logika upload foto diubah untuk bypass Intervention Image)
     */
    public function profile_update(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'dob'           => 'nullable|date',
            'gender'        => 'nullable|string|max:10',
            'join_date'     => 'nullable|date',
            'desg'          => 'nullable|string|max:100',
            'department_id' => 'nullable|integer|exists:departments,id',
            'photo'         => 'nullable|image|max:2048', // Validasi tetap ada
        ]);

        $user = Auth::user();
        $admin = Employee::where('user_id', $user->id)->firstOrFail();

        // Update data user dan employee non-foto
        $user->name = "{$request->first_name} {$request->last_name}";
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->dob = $request->dob;
        $admin->sex = $request->gender;
        $admin->join_date = $request->join_date;
        $admin->desg = $request->desg;
        $admin->department_id = $request->department_id;


        // =======================================================
        // REVISI LOGIKA UPLOAD FOTO (BYPASS INTERVENTION IMAGE)
        // =======================================================
        if ($request->hasFile('photo')) {
            
            $image = $request->file('photo');
            $extension = $image->getClientOriginalExtension();
            $filename_store = time() . '.' . $extension; // Nama unik berdasarkan timestamp

            // 1. Hapus foto lama jika bukan default
            if ($admin->photo && $admin->photo !== 'user.png') {
                Storage::disk('public')->delete('employee_photos/' . $admin->photo);
            }

            // 2. Simpan foto ke storage/app/public/employee_photos
            // Menggunakan method storeAs, yang tidak memerlukan Intervention Image
            $image->storeAs('employee_photos', $filename_store, 'public');

            // 3. Simpan nama file ke database di KEDUA TEMPAT
            $admin->photo = $filename_store; // Tabel employees
            $user->photo = $filename_store;  // Tabel users
        }

        // Simpan Model
        $user->save();
        $admin->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}