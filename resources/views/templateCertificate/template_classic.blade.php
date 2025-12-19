<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sertifikat</title>
    <style>
        body { font-family: "Times New Roman", serif; padding: 40px; background: #f5f5f5; }
        .cert { border: 8px solid #2c3e50; padding: 40px; background: #fff; text-align: center; }
        h1 { font-size: 42px; }
        .name { font-size: 32px; font-weight: bold; margin: 20px 0; }
        .meta { margin-top: 30px; font-size: 12px; color: #555; }
        .footer { margin-top: 60px; display: flex; justify-content: space-between; }
    </style>
</head>
<body>
<div class="cert">
    <h1>SERTIFIKAT</h1>
    <p>Diberikan kepada</p>
    <div class="name">{{ $certificate->name }}</div>

    <p>
        NIM: <strong>{{ $certificate->nim }}</strong><br><br>
        Atas partisipasinya dalam kegiatan<br>
        <strong>{{ $certificate->event_name }}</strong><br><br>
        Tanggal: {{ $certificate->issued_at->format('d F Y') }}
    </p>

    <div class="footer">
        <div>Ketua Panitia<br><br>(__________)</div>
        <div>Penanggung Jawab<br><br>(__________)</div>
    </div>

    <div class="meta">
        Certificate ID: {{ $certificate->certificate_id }}<br>
        Sistem CertVerify
    </div>
</div>
</body>
</html>
