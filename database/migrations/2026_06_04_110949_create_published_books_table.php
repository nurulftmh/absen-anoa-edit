<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('published_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('published_date');
            $table->string('author_name');
            $table->text('title');
            $table->string('isbn')->nullable();
            $table->string('publisher')->nullable();
            $table->string('cover_path')->nullable();
            $table->string('book_pdf_path');
            $table->string('certificate_archive_path')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('published_books');
    }
};