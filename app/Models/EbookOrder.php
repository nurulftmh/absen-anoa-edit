<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EbookOrder extends Model
{
    protected $fillable = [
        'order_number',
        'public_token',
        'published_book_id',
        'buyer_name',
        'buyer_email',
        'buyer_phone',
        'amount',
        'payment_status',
        'snap_token',
        'payment_type',
        'midtrans_transaction_id',
        'paid_at',
        'download_count',
        'last_downloaded_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'paid_at' => 'datetime',
            'download_count' => 'integer',
            'last_downloaded_at' => 'datetime',
        ];
    }

    public function publishedBook(): BelongsTo
    {
        return $this->belongsTo(PublishedBook::class);
    }
}