<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('published_books', function (Blueprint $table) {
            $table->string('book_pdf_path')
                ->nullable()
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('published_books', function (Blueprint $table) {
            $table->string('book_pdf_path')
                ->nullable(false)
                ->change();
        });
    }
};