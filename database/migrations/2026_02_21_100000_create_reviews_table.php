<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('location')->index();
            $table->enum('user_source', ['user', 'admin'])->default('user');
            $table->string('instagram')->nullable();
            $table->text('content');
            $table->tinyInteger('rating'); // 1-5
            $table->boolean('hide_identity')->default(false);
            $table->enum('status', ['pending', 'accepted'])->default('accepted');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
