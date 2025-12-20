@php
    $certificate = $certificate ?? null;
@endphp


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { font-family: "Times New Roman", serif; padding: 40px; background: #f5f5f5; }

        .certificate {
            text-align: center;
            background: #ffffff;
            margin: auto;
            padding: 40px;
            font-family: Arial, sans-serif;
            border-left: 12px solid #2980b9;
        }

        h1 {
            color: #2980b9;
            font-size: 36px;
        }

        .name {
            font-size: 30px;
            font-weight: bold;
            margin: 15px 0;
        }

        .info {
            margin-top: 30px;
            font-size: 16px;
        }

        .meta {
            margin-top: 60px;
            font-size: 12px;
            color: #777;
        }
        .footer { margin-top: 60px; display: flex; justify-content: space-between; }

        .sign-left {
            text-align: left;
        }

        .sign-right {
            text-align: right;
        }

        .sign-table {
            width: 100%;
            margin-top: auto; /* dorong ke bawah */
            border-collapse: collapse;
            font-size: 14px;
        }

        .sign-table td {
            width: 50%;
            vertical-align: top;
        }
    </style>
</head>
<body>

<div class="certificate">
    <h1>SERTIFIKAT PARTISIPASI</h1>

    <div class="info">
        Sertifikat ini diberikan kepada:<br>
        <div class="name">{{ $certificate->name ?? 'Nama Peserta' }}</div>

        NIM: <strong>{{ $certificate->nim ?? 'NIM' }}</strong><br><br>
        Telah mengikuti kegiatan:<br>
        <strong>{{ $certificate->event_name ?? 'Nama Event' }}</strong><br><br>
        Tanggal Pelaksanaan: {{ optional(optional($certificate)->issued_at)->format('d F Y') ?? 'DD MM YYYY' }}

    </div>
     <!-- TANDA TANGAN -->
    <table class="sign-table">
        <tr>
            <td class="sign-left">
                Ketua Panitia<br><br><br>
                (__________)
            </td>
            <td class="sign-right">
                Penanggung Jawab<br><br><br>
                (__________)
            </td>
        </tr>
    </table>

    <div class="meta">
        Certificate ID: {{ $certificate->certificate_id ?? 'ID Sertifikat' }}<br>
        Diterbitkan oleh CertVerify
    </div>
</div>

</body>
</html>
