<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Middleware untuk memastikan user guest kecuali logout.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle redirect setelah login berhasil.
     */
    protected function redirectTo()
    {
        $user = auth()->user();

        if (!$user) {
            return '/login';
        }

        if ($user->role === 'admin') {
            return '/admin';
        }

        if ($user->role === 'employee') {
            return '/employee';
        }

        return '/home';
    }

    /**
     * Validasi form login.
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);
    }

    /**
     * Pesan error bila login gagal.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput($request->only('email'));
    }
}
