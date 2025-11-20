<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= esc($title ?? 'Login Arisan Kuyy') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <style>
        body {
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%);
            font-family: 'Poppins', sans-serif;
        }

        .login-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 5rem auto;
            padding: 2rem 2.5rem;
        }

        .login-card h2 {
            font-weight: 600;
            text-align: center;
            color: #0ea5e9;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-login {
            background-color: #0ea5e9;
            border: none;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-login:hover {
            background-color: #0284c7;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h2>Arisan Kuyy</h2>
        <p class="text-center text-muted mb-4">Masuk ke akun Anda</p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger py-2"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('auth/attemptLogin') ?>" method="post">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-login w-100 py-2 mt-3">Masuk</button>
            <button type="button" class="btn btn-register w-100 py-2 mt-3"
                onclick="window.location.href='<?= base_url('/#') ?>'">
                Buat Akun
            </button>

        </form>

        <div class="text-center mt-4">
            <small class="text-muted">© <?= date('Y') ?> Arisan Kuyy</small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>