<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('komentars', function (Blueprint $table) {
        $table->id();
        $table->string('apartmen');
        $table->string('instagram')->nullable();
        $table->text('isi');
        $table->tinyInteger('bintang'); // dari 1-5
        $table->boolean('published')->default(true);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentars');
    }
};
