<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= esc($title ?? 'Dashboard Arisan') ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body data-role="<?= session()->get('role') ?>">
  <?= $this->include('partials/sidebar') ?>
  <div class="content-wrapper">
    <header class="dashboard-header">
      <div class="header-left">
        <button class="toggle-sidebar-btn" id="toggle-sidebar-btn">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
          </svg>
        </button>
      </div>
      <div class="header-right">
        <div class="user-profile">
          <span>Halo, <?= esc(session()->get('member_name') ?? 'Pengguna') ?>!</span>
          <!-- <div class="user-avatar">B</div> -->
        </div>
      </div>
    </header>
    <main class="main-content">
      <?= $this->renderSection('content') ?>
    </main>
  </div>

  <nav class="bottom-nav-mobile">
    <a href="#" class="nav-item active"><ion-icon name="stats-chart"></ion-icon><span>Dasbor</span></a>
    <a href="#" class="nav-item"><ion-icon name="people-outline"></ion-icon><span>Grup</span></a>
    <a href="#" class="nav-item"><ion-icon name="notifications-outline"></ion-icon><span>Notifikasi</span></a>
    <a href="#" class="nav-item"><ion-icon name="person-outline"></ion-icon><span>Profil</span></a>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('js/script.js') ?>" type="module"></script>

</body>

</html>