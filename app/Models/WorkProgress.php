<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkProgress extends Model
{
    protected $table = 'work_progresses';

    protected $fillable = [
        'attendance_id',
        'description',
    ];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }

    public function files()
    {
        return $this->hasMany(WorkFile::class);
    }
}