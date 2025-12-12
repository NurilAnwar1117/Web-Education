<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // penting kalau mau dipakai untuk login nanti
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'students';
    protected $primaryKey = 'student_id';
    // MATIKAN TIMESTAMPS
    public $timestamps = false;

    protected $fillable = [
        'nim',
        'name',
        'program_study',
        'faculty',
        'year_entry',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // RELASI: 1 mahasiswa memiliki banyak activity logs
    // public function activityLogs()
    // {
    //     return $this->hasMany(ActivityLog::class, 'student_id', 'student_id');
    // }
}
