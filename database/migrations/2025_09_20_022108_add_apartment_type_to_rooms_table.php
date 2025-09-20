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
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('apartment_type')->nullable()->after('id');
            $table->renameColumn('main_photo', 'main_image');
            $table->renameColumn('popup1', 'room_image_1');
            $table->renameColumn('popup2', 'room_image_2');
            $table->renameColumn('popup3', 'room_image_3');
            $table->renameColumn('popup4', 'room_image_4');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('apartment_type');
            $table->renameColumn('main_image', 'main_photo');
            $table->renameColumn('room_image_1', 'popup1');
            $table->renameColumn('room_image_2', 'popup2');
            $table->renameColumn('room_image_3', 'popup3');
            $table->renameColumn('room_image_4', 'popup4');
        });
    }
};
