<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PublishedBook extends Model
{
    protected $fillable = [
        'user_id',
        'published_date',
        'author_name',
        'title',
        'isbn',
        'publisher',

        // FIELD PENJUALAN E-BOOK
        'price',
        'is_for_sale',
        'ebook_path',

        // FILE BUKU
        'cover_path',
        'book_pdf_path',
        'certificate_archive_path',

        'note',
    ];

    protected function casts(): array
    {
        return [
            'published_date' => 'date',

            // HARGA
            'price' => 'decimal:2',

            // STATUS DIJUAL / TIDAK
            'is_for_sale' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI USER
    |--------------------------------------------------------------------------
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI TRANSAKSI E-BOOK
    |--------------------------------------------------------------------------
    |
    | Satu buku dapat memiliki banyak transaksi pembelian.
    |
    */
    public function ebookOrders(): HasMany
    {
        return $this->hasMany(EbookOrder::class);
    }
}