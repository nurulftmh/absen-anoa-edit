<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('manuscripts', function (Blueprint $table) {
            $table->text('docs_link')->nullable()->after('journal');
        });
    }

    public function down(): void
    {
        Schema::table('manuscripts', function (Blueprint $table) {
            $table->dropColumn('docs_link');
        });
    }
};