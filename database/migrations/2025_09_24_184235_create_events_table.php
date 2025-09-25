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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name'); // visit, download_promo, book_now, form_submit
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->text('url')->nullable(); // halaman asal saat event terjadi
            $table->string('referrer')->nullable(); // halaman referrer
            $table->json('metadata')->nullable(); // data tambahan jika diperlukan
            $table->timestamps();
            
            // Index untuk performa query
            $table->index('event_name');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};