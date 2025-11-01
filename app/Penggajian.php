<?php

namespace App; // <-- Perhatikan, namespace-nya 'App', bukan 'App\Models'

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Employee; // <-- Kita juga panggil Employee dari 'App'

class Penggajian extends Model
{
    use HasFactory;

    // Nama tabel (jika nama model dan tabel beda)
    protected $table = 'penggajian'; // <-- Tambahkan ini untuk memastikan

    protected $fillable = [
        'employee_id',
        'gaji_pokok',
        'tunjangan',
    ];

    // Relasi ke Karyawan
    public function employee()
    {
        // Asumsi model Karyawan Anda namanya 'Employee' dan ada di app/Employee.php
        return $this->belongsTo(Employee::class); 
    }
}