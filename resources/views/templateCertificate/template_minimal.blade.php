@php
    $certificate = $certificate ?? null;
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sertifikat</title>

<style>
body {
    padding: 40px;
    background: #f5f5f5;
}

.certificate {
    width: 100%;
    height: 100%;
    background: #ffffff;
    padding: 60px;
    box-sizing: border-box;
    text-align: center;
    font-family: Arial, sans-serif;
}

h1 { font-size: 38px; }
.name { font-size: 32px; font-weight: bold; margin: 20px 0; }
.meta { margin-top: 50px; font-size: 12px; color: #444; }
.footer { margin-top: 60px; display: flex; justify-content: space-between; }
</style>
</head>
<body>

<div class="certificate">
    <h1>SERTIFIKAT</h1>
    <p>Diberikan kepada</p>
    <div class="name">{{ $certificate->name ?? 'Nama Peserta' }}</div>

    <p>
        NIM: <strong>{{ $certificate->nim ?? 'NIM' }}</strong><br><br>
        Kegiatan: <strong>{{ $certificate->event_name ?? 'Nama Event' }}</strong><br>
        Tanggal: {{ optional(optional($certificate)->issued_at)->format('d F Y') ?? 'DD MM YYYY' }}

    </p>

    <div class="footer">
        <div>Ketua Panitia<br><br>(__________)</div>
        <div>Penanggung Jawab<br><br>(__________)</div>
    </div>

    <div class="meta">
        Certificate ID: {{ $certificate->certificate_id ?? 'ID Sertifikat' }}<br>
        CertVerify Blockchain Verification System
    </div>
</div>

</body>
</html>
