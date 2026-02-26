<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah kolom likes_count di table reviews (counter cache)
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedInteger('likes_count')->default(0)->after('content');
        });

        // 2. Buat table review_likes untuk tracking siapa yang sudah like
        Schema::create('review_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_id')->constrained('reviews')->cascadeOnDelete();
            $table->string('visitor_id', 64);
            $table->string('ip_address', 45)->nullable();
            $table->string('session_id', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->unique(['review_id', 'visitor_id'], 'review_likes_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('review_likes');

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('likes_count');
        });
    }
};
