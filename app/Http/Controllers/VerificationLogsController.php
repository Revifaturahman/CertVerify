<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use App\Models\VerificationLogs;
use App\Services\BlockchainService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class VerificationLogsController extends Controller
{
    public function index()
    {
        return view('verificator.verification');
    }

    public function verify(Request $request)
    {
        // 1️⃣ Validasi file
        $request->validate([
            'certificate_file' => 'required|file|mimes:pdf|max:5120',
        ]);

        // 2️⃣ Simpan PDF sementara
        $file = $request->file('certificate_file');
        $path = $file->store('verification_pdfs');

        // 3️⃣ Ekstrak teks PDF
        $parser = new Parser();
        $filePath = Storage::path($path);
        $pdf = $parser->parseFile($filePath);
        $text = $pdf->getText();

        // 4️⃣ Ambil NIM & Certificate ID
        preg_match('/NIM\s*:\s*(\d+)/i', $text, $nimMatch);
        preg_match('/Certificate ID\s*:\s*([A-Z0-9\-]+)/i', $text, $certMatch);

        $nim = $nimMatch[1] ?? null;
        $certificateId = $certMatch[1] ?? null;

        // ❌ Jika data tidak lengkap
        if (!$nim || !$certificateId) {
            return back()->with('error', 'Data sertifikat tidak terbaca.');
        }

        // 5️⃣ Generate hash ulang
        $hashToVerify = hash('sha256', $certificateId . '|' . $nim);

        // 6️⃣ Verifikasi ke BLOCKCHAIN
        $isValid = BlockchainService::verifyHash($hashToVerify);

        // 7️⃣ Cari sertifikat (jika ada)
        $certificate = Certificate::where('certificate_id', $certificateId)
            ->where('nim', $nim)
            ->first();

        // 8️⃣ SIMPAN AUDIT TRAIL 🔥
        VerificationLogs::create([
            'certificate_id' => $certificate?->id,
            'input_certificate_id' => $certificateId,
            'input_nim' => $nim,
            'verified_by' => auth::id(),
            'result' => $isValid ? 'VALID' : 'INVALID',
            'verified_at' => now(),
            'ip_address' => $request->ip(),
        ]);

        // 9️⃣ TAMPILKAN HASIL
        $logs = VerificationLogs::where('input_certificate_id', $certificateId)
                ->orderBy('verified_at', 'desc')
                ->get();

        return back()->with([
            'verification_result' => $isValid ? 'VALID' : 'INVALID',
            'certificate_id' => $certificateId,
            'nim' => $nim,
            'logs' => $logs
        ]);


    }

}
