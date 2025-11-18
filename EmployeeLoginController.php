<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:employee')->except('logout');
    }

    /**
     * Tampilkan form login karyawan
     */
    public function showLoginForm()
    {
        return view('auth.employee-login');
    }

    /**
     * Proses login karyawan
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Ambil kredensial
        $credentials = $request->only('email', 'password');

        // Coba login dengan guard employee
        if (Auth::guard('employee')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->route('employee.index');
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password tidak sesuai.',
        ])->withInput($request->only('email'));
    }

    /**
     * Logout karyawan
     */
    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('employee.login');
    }
}
    