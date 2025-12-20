@php
    $certificate = $certificate ?? null;
@endphp


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sertifikat</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            padding: 40px;
            background: #f5f5f5;
        }
        .cert {
            border: 8px solid #2c3e50;
            padding: 40px;
            background: #fff;
            text-align: center;
        }
        h1 { font-size: 42px; }
        .name {
            font-size: 32px;
            font-weight: bold;
            margin: 20px 0;
        }
        .meta {
            margin-top: 30px;
            font-size: 12px;
            color: #555;
        }
        .footer {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
        }

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

<div class="cert">
    <h1>SERTIFIKAT</h1>

    <p>Diberikan kepada</p>
    <div class="name">
        {{ $certificate->name ?? 'Nama Peserta' }}
    </div>

    <p>
        NIM: <strong>{{ $certificate->nim ?? 'NIM' }}</strong><br><br>
        Atas partisipasinya dalam kegiatan<br>
        <strong>{{ $certificate->event_name ?? 'Nama Event' }}</strong><br><br>
        Tanggal:
        {{ optional(optional($certificate)->issued_at)->format('d F Y') ?? 'DD MM YYYY' }}

    </p>

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
        Sistem CertVerify
    </div>
</div>

</body>
</html>
