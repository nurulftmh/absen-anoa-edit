<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkFile extends Model
{
    protected $table = 'work_files';

    protected $fillable = [
        'work_progress_id',
        'file_path',
        'file_name',
    ];

    public function progress()
    {
        return $this->belongsTo(WorkProgress::class, 'work_progress_id');
    }
}