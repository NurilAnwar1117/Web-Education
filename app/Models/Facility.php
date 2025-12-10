<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facilities';
    protected $primaryKey = 'facility_id';
    public $timestamps = false;

    protected $fillable = [
        'facility_name',
        'category',
        'location',
        'capacity',
    ];

    // RELASI: 1 fasilitas memiliki banyak activity logs
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class, 'facility_id', 'facility_id');
    }
}
