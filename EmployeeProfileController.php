<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeeProfileController extends Controller
{
    /**
     * Tampilkan halaman profil karyawan
     */
    public function index()
    {
        $employee = Auth::user();
        return view('employee.profile', compact('employee'));
    }

    /**
     * Update profil karyawan
     */
    public function update(Request $request)
    {
        $employee = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update data dasar
        $employee->name = $request->name;
        $employee->email = $request->email;

        // Jika upload foto baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($employee->photo && Storage::exists('public/profile/' . $employee->photo)) {
                Storage::delete('public/profile/' . $employee->photo);
            }

            // Simpan foto baru
            $filename = time() . '_' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public/profile', $filename);
            $employee->photo = $filename;
        }

        $employee->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
