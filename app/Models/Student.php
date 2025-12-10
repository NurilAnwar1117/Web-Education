<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    public $timestamps = false;

    protected $fillable = [
        'nim',
        'name',
        'program_study',
        'faculty',
        'year_entry',
    ];

    // RELASI: 1 mahasiswa memiliki banyak activity logs
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class, 'student_id', 'student_id');
    }
}
