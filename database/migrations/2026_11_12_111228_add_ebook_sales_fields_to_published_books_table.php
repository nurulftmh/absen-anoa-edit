<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('published_books', function (Blueprint $table) {
            $table->decimal('price', 12, 2)
                ->nullable()
                ->after('publisher');

            $table->boolean('is_for_sale')
                ->default(false)
                ->after('price');

            $table->string('ebook_path')
                ->nullable()
                ->after('is_for_sale');
        });
    }

    public function down(): void
    {
        Schema::table('published_books', function (Blueprint $table) {
            $table->dropColumn([
                'price',
                'is_for_sale',
                'ebook_path',
            ]);
        });
    }
};