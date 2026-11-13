<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ebook_orders', function (Blueprint $table) {
            $table->id();

            $table->string('order_number')
                ->unique();

            $table->foreignId('published_book_id')
                ->constrained('published_books')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('buyer_name');

            $table->string('buyer_email');

            $table->string('buyer_phone')
                ->nullable();

            $table->decimal('amount', 12, 2);

            $table->string('payment_status')
                ->default('pending');

            $table->string('payment_type')
                ->nullable();

            $table->string('midtrans_transaction_id')
                ->nullable();

            $table->timestamp('paid_at')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ebook_orders');
    }
};