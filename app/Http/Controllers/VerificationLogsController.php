<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerificationLogsController extends Controller
{
    public function index(){
        return view('verificator.verification');
    }

     public function verify(Request $request)
    {
        // 1️⃣ Validasi file
        $request->validate([
            'certificate_file' => 'required|file|mimes:pdf|max:5120',
        ]);

        // 2️⃣ Ambil file
        $file = $request->file('certificate_file');

        // 3️⃣ Simpan sementara
        $path = $file->store('verification_pdfs');

        // (DEBUG) cek berhasil
        return response()->json([
            'message' => 'File berhasil diterima',
            'file_name' => $file->getClientOriginalName(),
            'stored_path' => $path,
        ]);
    }
}
