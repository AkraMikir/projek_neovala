<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Remove review likes feature: drop review_likes table and likes column from reviews.
     */
    public function up(): void
    {
        Schema::dropIfExists('review_likes');

        if (Schema::hasTable('reviews') && Schema::hasColumn('reviews', 'likes')) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->dropColumn('likes');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('reviews') && !Schema::hasColumn('reviews', 'likes')) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->unsignedInteger('likes')->nullable()->default(0)->after('is_featured');
            });
        }

        Schema::create('review_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_id')->constrained('reviews')->cascadeOnDelete();
            $table->string('visitor_id', 64)->index();
            $table->timestamps();
            $table->unique(['review_id', 'visitor_id']);
        });
    }
};
