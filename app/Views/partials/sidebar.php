<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="brand-logo">
      <img src="<?= base_url('images/Logo.png') ?>" alt="Logo ArisanKuyy" class="brand-icon" />
      <span class="brand-text">Arisan<span class="brand-highlight">Kuyy</span></span>
    </a>
  </div>
  <div class="sidebar-user-panel">
    <!-- <div class="user-avatar-sidebar">B</div> -->
    <div class="user-info">
      <p><?= esc(session()->get('member_name') ?? 'Pengguna') ?></p>
    </div>
  </div>
  <div class="sidebar-search-form">
    <input type="text" placeholder="Cari menu..." />
    <button aria-label="Search">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"></circle>
        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
      </svg>
    </button>
  </div>
  <ul class="sidebar-menu">
    <li><a href="#" class="nav-item active"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
          <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
        </svg><span>Beranda</span></a></li>
    <li class="has-submenu">
      <a href="#" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
        </svg>
        <span>Grup</span><span class="menu-arrow"></span>
      </a>
      <ul class="submenu">
        <li><a href="#">Buat Grup Baru</a></li>
        <li><a href="#">Lihat Undangan</a></li>
        <li><a href="#">Arsip Grup</a></li>
      </ul>
    </li>
    <li><a href="#" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z" />
        </svg><span>Notifikasi</span></a></li>
    <li><a href="#" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
        </svg><span>Profil</span></a></li>
    <li><a href="<?= base_url('/logout') ?>" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1">
        <ion-icon name="log-out-outline"></ion-icon>
        Logout
      </a></li>
  </ul>
</nav>