<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register — CertVerify</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #cfe9ff, #87cefa);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-card {
            background: white;
            border: 8px solid #0d6efd;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            padding: 40px;
            width: 100%;
            max-width: 460px;
        }

        .title {
            font-weight: 700;
            color: #0d6efd;
        }

        .cert-badge {
            width: 70px;
            height: 70px;
            background: #e7f1ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: auto;
            margin-bottom: 15px;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 .2rem rgba(13,110,253,.15);
        }

        .btn-primary {
            background: #0d6efd;
            border: none;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: #0b5ed7;
        }

        .footer-text {
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>

<body>

<div class="register-card text-center">

    <div class="cert-badge">
        🏅
    </div>

    <h4 class="title mb-3">Daftar Akun CertVerify</h4>
    <p class="text-muted mb-4">
        Sistem Verifikasi Sertifikat Blockchain
    </p>

    @if ($errors->any())
        <div class="alert alert-danger text-start">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/register" class="text-start">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">
            Register
        </button>
    </form>

    <p class="mt-3 footer-text">
        Sudah punya akun?
        <a href="/login" class="text-primary fw-semibold">Login</a>
    </p>

</div>

</body>
</html>
