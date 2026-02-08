<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login — CertVerify</title>

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

        .login-card {
            background: white;
            border: 8px solid #0d6efd;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            padding: 40px;
            width: 100%;
            max-width: 420px;
            position: relative;
        }

        .login-title {
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

<div class="login-card text-center">

    <!-- Icon Sertifikat -->
    <div class="cert-badge">
        📜
    </div>

    <h4 class="login-title mb-3">
        CertVerify Login
    </h4>

    <p class="text-muted mb-4">
        Sistem Verifikasi Sertifikat Blockchain
    </p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/login" class="text-start">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">
            Login
        </button>
    </form>

    <p class="mt-3 footer-text">
        Belum punya akun?
        <a href="/register" class="text-primary fw-semibold">Register</a>
    </p>

</div>

</body>
</html>
