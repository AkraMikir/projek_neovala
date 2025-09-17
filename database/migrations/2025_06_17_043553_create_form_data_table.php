<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDataTable extends Migration
{
    public function up()
    {
        Schema::create('form_data', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor_wa');
            $table->string('tipe_kamar');
            $table->date('tanggal_checkin');
            $table->time('jam_kedatangan');
            $table->string('durasi');
            $table->text('pesan')->nullable();
            $table->string('apartment_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_data');
    }
}
