<?php

namespace App\Http\Controllers;
use App\Models\Certificate;
use App\Services\BlockchainService;
use App\Models\BlockchainRecord;
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
        // ⛔ Jangan kirim ulang jika sudah pernah ke blockchain
        if (!$certificate->hash_value) {

            // 1️⃣ Generate hash
            $hashValue = hash(
                'sha256',
                $certificate->certificate_id . '|' . $certificate->nim
            );

            // 2️⃣ Kirim ke blockchain
            $result = BlockchainService::storeHash($hashValue);

            if (!$result['tx_hash']) {
                throw new \Exception('Gagal mengirim hash ke blockchain');
            }

            // 3️⃣ Simpan hash ke certificates
            $certificate->update([
                'hash_value' => $hashValue
            ]);

            // 4️⃣ Simpan tx_hash ke blockchain_records
            BlockchainRecord::create([
                'certificate_id' => $certificate->id,
                'tx_hash'        => $result['tx_hash'],
                'block_number'   => $result['block_number'] ?? null,
                'network'        => 'local'
            ]);
        }

        // 5️⃣ Generate PDF
        $pdf = Pdf::loadView(
            'templateCertificate.' . $certificate->template_name,
            compact('certificate')
        )->setPaper('A4', 'landscape');

        return $pdf->stream(
            $certificate->certificate_id . '.pdf'
        );
    }

}
