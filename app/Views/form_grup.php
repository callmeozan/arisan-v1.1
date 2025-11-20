<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="panel arisan-list-panel">
  <h2 class="panel-title mb-3">Tambah Grup Baru</h2>

  <form action="<?= base_url('grup/store') ?>" method="post" class="p-4 bg-white rounded shadow-sm">
    <div class="mb-3">
      <label class="form-label">Nama Grup</label>
      <input type="text" name="group_name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Jumlah Anggota</label>
      <input type="number" name="total_members" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Sudah Membayar</label>
      <input type="number" name="paid_members" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Kocokan Berikutnya</label>
      <input type="text" name="next_draw" class="form-control">
    </div>
    <div class="form-check mb-3">
      <input type="checkbox" name="is_ready_to_draw" value="1" class="form-check-input" id="readyCheck">
      <label for="readyCheck" class="form-check-label">Siap dikocok</label>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= base_url('/') ?>" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?= $this->endSection() ?>
