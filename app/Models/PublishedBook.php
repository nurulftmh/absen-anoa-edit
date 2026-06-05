<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublishedBook extends Model
{
    protected $fillable = [
        'user_id',
        'published_date',
        'author_name',
        'title',
        'isbn',
        'publisher',
        'cover_path',
        'book_pdf_path',
        'certificate_archive_path',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'published_date' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}