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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->index(); // Identitas user unik (disimpan di browser/local storage)
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            
            // Jenis aktivitas: 'visit', 'click_book_now', 'click_download_promo', 'submit_form', 'submit_comment'
            $table->string('activity_type')->index();
            
            // Lokasi kejadian
            $table->string('page_url');
            $table->string('page_path')->index(); // /discover-tpj, /book-now
            
            // Metadata spesifik (untuk filter cepat)
            $table->string('apartment_type')->nullable(); // TPJ, GKL, dll (jika relevan)
            $table->string('target_name')->nullable(); // Nama promo atau room yang diklik
            
            // Data tambahan (fleksibel)
            $table->json('metadata')->nullable();
            
            $table->timestamps();
            
            // Indexing tambahan untuk performa report
            $table->index(['activity_type', 'created_at']); // Cepat hitung total per tipe per periode
            $table->index(['page_path', 'created_at']); // Cepat hitung visit per halaman per periode
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
};
