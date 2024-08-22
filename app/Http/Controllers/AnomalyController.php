<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnomalyController extends Controller
{
    public function report(Request $request)
    {
        // Proses data anomali yang diterima
        $anomalies = $request->all();
        
        // Contoh: Simpan data ke database atau log
        \Log::info('Anomalies reported:', $anomalies);

        return response()->json(['message' => 'Anomalies received successfully'], 200);
    }
}

