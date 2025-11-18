<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id',
        'entry_ip',
        'entry_time',
        'entry_location',
        'entry_latitude',
        'entry_longitude',
        'entry_photo',
        'exit_ip',
        'exit_time',
        'exit_location',
        'exit_latitude',
        'exit_longitude',
        'exit_photo',
        'registered',
        'time'
    ];

    /**
     * Agar kolom waktu otomatis diparse Carbon
     */
    protected $casts = [
        'entry_time' => 'datetime',
        'exit_time' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function employee() {
        return $this->belongsTo('App\Employee');
    }
}
