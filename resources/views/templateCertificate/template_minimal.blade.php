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
    <div class="name">{{ $certificate->name }}</div>

    <p>
        NIM: <strong>{{ $certificate->nim }}</strong><br><br>
        Kegiatan: <strong>{{ $certificate->event_name }}</strong><br>
        Tanggal: {{ $certificate->issued_at->format('d F Y') }}
    </p>

    <div class="footer">
        <div>Ketua Panitia<br><br>(__________)</div>
        <div>Penanggung Jawab<br><br>(__________)</div>
    </div>

    <div class="meta">
        Certificate ID: {{ $certificate->certificate_id }}<br>
        CertVerify Blockchain Verification System
    </div>
</div>

</body>
</html>
