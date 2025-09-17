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
        Schema::create('komentar_gpcs', function (Blueprint $table) {
            $table->id();
            $table->string('instagram', 30)->nullable(); // bisa kosong jika hide
            $table->text('message');
            $table->tinyInteger('rating'); // 1–5
            $table->boolean('hide_identity')->default(false);
            $table->string('section')->default('gpc');
            $table->enum('status', ['pending', 'accepted'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar_gpcs');
    }
};
