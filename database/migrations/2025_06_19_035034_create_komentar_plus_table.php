<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('komentar_plus', function (Blueprint $table) {
            $table->id();
            $table->string('instagram');
            $table->text('message');
            $table->tinyInteger('rating');
            $table->boolean('hide_identity')->default(false);
            $table->string('section');
            $table->enum('status', ['pending', 'accepted'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar_plus');
    }
};