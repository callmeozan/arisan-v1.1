<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'Daftar Akun') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>

<body class="d-flex align-items-center justify-content-center vh-100" style="background-color:#f8fafc;">
  <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
    <h3 class="text-center mb-3">Daftar Akun Baru</h3>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('/register/attemptRegister') ?>" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="role" class="form-label">Peran</label>
        <select name="role" id="role" class="form-select">
          <option value="member">Member</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
      <div class="text-center mt-3">
        <a href="<?= base_url('/login') ?>">Sudah punya akun? Login di sini</a>
      </div>
    </form>
  </div>
</body>

</html>