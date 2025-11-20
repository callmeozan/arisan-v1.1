<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="stat-cards-container">
  <div class="stat-card">
    <div class="stat-icon-wrapper bg-blue"><ion-icon name="people"></ion-icon></div>
    <!-- <div class="stat-info"><span class="stat-title">Anggota Aktif</span><span class="stat-value">3</span></div> -->
    <div class="stat-info"><span class="stat-title">Anggota Aktif</span><span class="stat-value"><?= esc($activeMembers) ?> Orang</span></div>

  </div>
  <div class="stat-card">
    <div class="stat-icon-wrapper bg-green"><ion-icon name="checkmark-circle"></ion-icon></div>
    <!-- <div class="stat-info"><span class="stat-title">Pembayaran Tepat Waktu</span><span class="stat-value">98%</span></div> -->
    <div class="stat-info"><span class="stat-title">Pembayaran On Time</span><span class="stat-value"><?= esc($paymentOnTime) ?> %</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon-wrapper bg-yellow"><ion-icon name="cash"></ion-icon></div>
    <!-- <div class="stat-info"><span class="stat-title">Dana Terkumpul</span><span class="stat-value">Rp 16.5Jt</span></div> -->
    <div class="stat-info"><span class="stat-title">Dana Terkumpul</span><span class="stat-value">Rp <?= number_format($dana_terkumpul, 0, ',', '.') ?></span></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon-wrapper bg-red"><ion-icon name="trophy"></ion-icon></div>
    <div class="stat-info"><span class="stat-title">Pemenang Bulan Ini</span><span class="stat-value"><?= esc($winnerName) ?></span></div>
  </div>
</div>

<div class="panel priority-payment-panel">
  <h2 class="panel-title">Pembayaran Selanjutnya</h2>
  <div class="priority-content">
    <div class="amount">Rp 100.000 -org.</div>
    <div class="group-name">Arisan Bulanan</div>
    <div class="due-date">Jatuh tempo dalam 3 hari lagi</div>
    <!-- <button class="pay-button">BAYAR SEKARANG</button> -->
    <button class="btn btn-primary pay-button">Bayar Sekarang</button>
  </div>
</div>

<div class="panel arisan-list-panel">
  <h2 class="panel-title">Semua Grup Arisan Anda</h2>
  <div class="arisan-group-list" id="arisan-list"></div>
</div>

<!-- ==================== MODAL PEMBAYARAN ==================== -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModalLabel">Detail Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="qris-section text-center">
          <h6>Scan QRIS</h6>
          <p class="text-muted">Gunakan aplikasi e-wallet atau m-banking Anda.</p>
          <img
            src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=ContohDataQRIS"
            alt="QRIS Code"
            id="qris-image" />
        </div>
        <hr />
        <div class="bank-transfer-section text-start">
          <h6>Atau Transfer Bank</h6>
          <div class="account-details">
            <span>Bank</span>
            <strong>JAGO</strong>
          </div>
          <div class="account-details d-flex align-items-center justify-content-between">
            <div>
              <span>No. Rekening</span><br>
              <strong id="account-number">505813536421</strong>
            </div>
            <button class="copy-btn btn btn-outline-secondary btn-sm" id="copy-btn">Salin</button>
          </div>
          <div class="account-details">
            <span>Atas Nama</span>
            <strong>Dwiki Chandra Setya Nugraha</strong>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- ==================== MODAL KOCOKAN ==================== -->
<div class="modal fade" id="kocokan-modal" tabindex="-1" aria-labelledby="kocokanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-6 md:p-8 text-center">
        <h2 class="text-2xl fw-bold text-slate-800 mb-2">🎉 Pemenang Arisan 🎉</h2>
        <p class="text-slate-500">Selamat Kepada:</p>
        <div class="my-4 p-4 bg-slate-100 rounded text-4xl fw-bold text-primary" id="winner-name">
          Mengocok...
        </div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>