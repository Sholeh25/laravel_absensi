<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Daftar policy (kosong untuk saat ini).
     *
     * @var array
     */
    protected $policies = [
        // Tidak menggunakan policy untuk sekarang
    ];

    /**
     * Register authentication dan authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        // Akses untuk Admin
        Gate::define('admin-access', function ($user) {
            return $user !== null && $user->role === 'admin';
        });

        // Akses untuk Employee
        Gate::define('employee-access', function ($user) {
            return $user !== null && $user->role === 'employee';
        });
    }
}
