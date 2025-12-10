<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'log_id';
    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'facility_id',
        'activity_type',
        'timestamp_in',
        'timestamp_out',
    ];

    // RELASI: log milik 1 mahasiswa
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    // RELASI: log milik 1 fasilitas
    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'facility_id');
    }
}
