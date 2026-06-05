<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'user_id',
        'entry_date',
        'author_name',
        'title',
        'docs_link',
        'status',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}