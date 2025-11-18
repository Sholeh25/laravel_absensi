<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Gate::allows('employee-access')) {
            return redirect()->route('employee.index');
        }

        if (Gate::allows('admin-access')) {
            return redirect()->route('admin.index');
        }

        // Fallback bila belum punya role yang valid
        return redirect()->route('login')->with('error', 'Akun belum memiliki role yang valid.');
    }
}
