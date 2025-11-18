<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * Kolom yang otomatis diparsing sebagai tanggal.
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'dob',
        'join_date',
    ];

    /**
     * Kolom yang dapat diisi mass-assignment.
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'sex',
        'dob',
        'join_date',
        'desg',
        'department_id',
        'salary',
        'photo',
    ];

    /**
     * Relasi ke User (setiap employee punya satu user).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Department.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Relasi ke Attendance.
     */
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Relasi ke Leave.
     */
    public function leave()
    {
        return $this->hasMany(Leave::class);
    }

    /**
     * Relasi ke Expense.
     */
    public function expense()
    {
        return $this->hasMany(Expense::class);
    }
}
