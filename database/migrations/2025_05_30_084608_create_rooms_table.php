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
    Schema::create('rooms', function (Blueprint $table) {
        $table->id();
        $table->string('section'); // contoh: J3118, A1021, dll
        $table->string('main_photo')->nullable();
        $table->string('popup1')->nullable();
        $table->string('popup2')->nullable();
        $table->string('popup3')->nullable();
        $table->string('popup4')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
