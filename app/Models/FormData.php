<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    protected $fillable = [
        'nama',
        'nomor_wa',
        'tipe_kamar',
        'tanggal_checkin',
        'jam_kedatangan',
        'durasi',
        'pesan',
        'apartment_type'
    ];
}
