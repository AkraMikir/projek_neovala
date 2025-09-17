<?php

namespace App\Http\Controllers;

use App\Models\FormData;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class FormDataController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string',
                'nomor_wa' => 'required|string',
                'tipe_kamar' => 'required|string',
                'tanggal_checkin' => 'required|date',
                'jam_kedatangan' => 'required',
                'durasi' => 'required|string',
                'pesan' => 'nullable|string',
                'apartment_type' => 'required|string'
            ]);

            $formData = FormData::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $formData
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function getDataByApartment($apartment_type)
{
    $decoded = urldecode($apartment_type);
    $data = FormData::where('apartment_type', $decoded)->orderBy('created_at', 'desc')->get();

    return response()->json($data);
}

    public function show($id)
{
    $formData = FormData::findOrFail($id);
    return response()->json($formData);
}

public function destroy($id)
{
    try {
        $formData = FormData::findOrFail($id);
        $formData->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus data: ' . $e->getMessage()
        ], 500);
    }
}


}
