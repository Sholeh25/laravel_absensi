<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Penggajian; // Pastikan ini ada
use App\Employee;    // Pastikan ini ada

class PenggajianController extends Controller
{
    /**
     * Menampilkan halaman daftar penggajian.
     */
    public function index()
    {
        // Ambil SEMUA data penggajian, muat relasi 'employee'
        // Asumsi relasi di model Penggajian Anda bernama 'employee'
        $penggajian = Penggajian::with('employee')->latest()->get();

        // Kirim data $penggajian ke view
        return view('admin.penggajian.index', compact('penggajian'));
    }

    /**
     * Menampilkan form untuk menambah data gaji baru.
     */
    public function create()
    {
        // Ambil data karyawan untuk ditampilkan di dropdown
        // UBAH DI SINI: orderBy 'first_name', bukan 'name' atau 'nama'
        $karyawan = Employee::orderBy('first_name')->get(); 
        
        return view('admin.penggajian.create', compact('karyawan'));
    }

    /**
     * Menyimpan data gaji baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'employee_id' => 'required|exists:employees,id', // Pastikan 'exists' merujuk ke tabel 'employees'
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
        ]);

        // 2. Simpan data ke database menggunakan Model
        Penggajian::create([
            'employee_id' => $request->employee_id,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan,
        ]);

        // 3. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.penggajian.index')
                         ->with('success', 'Data gaji berhasil ditambahkan.');
    }
}