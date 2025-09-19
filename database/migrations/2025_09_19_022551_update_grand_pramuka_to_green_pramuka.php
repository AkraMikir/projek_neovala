<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update room sections
        DB::table('rooms')
            ->where('section', 'room_grand_pramuka_city')
            ->update(['section' => 'room_green_pramuka_city']);

        // Update form data apartment types
        DB::table('form_data')
            ->where('apartment_type', 'Grand Pramuka City by Neovala')
            ->update(['apartment_type' => 'Green Pramuka City by Neovala']);

        // Update carousel sections
        DB::table('carousels')
            ->where('section', 'GPC')
            ->update(['section' => 'GPC']); // GPC tetap sama, hanya nama yang berubah
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert room sections
        DB::table('rooms')
            ->where('section', 'room_green_pramuka_city')
            ->update(['section' => 'room_grand_pramuka_city']);

        // Revert form data apartment types
        DB::table('form_data')
            ->where('apartment_type', 'Green Pramuka City by Neovala')
            ->update(['apartment_type' => 'Grand Pramuka City by Neovala']);
    }
};