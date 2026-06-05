<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manuscript extends Model
{
    protected $fillable = [
        'user_id',
        'author_name',
        'title',
        'journal',
        'docs_link',
        'status',
        'description',
        'photo',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}