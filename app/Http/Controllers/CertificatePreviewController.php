<?php

namespace App\Http\Controllers;
use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class CertificatePreviewController extends Controller
{
    public function preview(Certificate $certificate)
    {
        
        return view(
            'templateCertificate.' . $certificate->template_name,
            compact('certificate')
        );
    }

    public function generatePdf(Certificate $certificate)
    {
        // 1️⃣ Generate hash identitas sertifikat (PANITIA)
        $hashValue = hash(
            'sha256',
            $certificate->certificate_id . '|' . $certificate->nim
        );

        // 2️⃣ Simpan hash ke database (jika belum ada)
        if (!$certificate->hash_value) {
            $certificate->update([
                'hash_value' => $hashValue
            ]);
        }

        // 3️⃣ Generate PDF
        $pdf = Pdf::loadView(
            'templateCertificate.' . $certificate->template_name,
            compact('certificate')
        )->setPaper('A4', 'landscape');

        return $pdf->stream(
            $certificate->certificate_id . '.pdf'
        );
    }

}
