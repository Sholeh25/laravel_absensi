<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Notifications\ResetPassword;

class User extends Authenticatable implements CanResetPassword
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** 
     * Cek role (admin / employee)
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Relasi One To One ke tabel Employee (opsional)
     */
    public function employee()
    {
        return $this->hasOne('App\Employee');
    }

    /**
     * Reset password
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
