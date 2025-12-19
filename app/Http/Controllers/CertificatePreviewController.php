<?php

namespace App\Http\Controllers;
use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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
        $pdf = Pdf::loadView(
            'templateCertificate.' . $certificate->template_name,
            compact('certificate')
        )->setPaper('A4', 'landscape');

        return $pdf->stream(
            $certificate->certificate_id . '.pdf'
        );
    }

}
