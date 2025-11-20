// =================================================================
// Arisan Kuyy — Versi CodeIgniter 4 (tanpa Firebase)
// =================================================================

document.addEventListener('DOMContentLoaded', () => {
  // =================================================================
  // SIDEBAR DAN SUBMENU
  // =================================================================
  const toggleBtn = document.getElementById('toggle-sidebar-btn');
  const body = document.body;
  if (toggleBtn) {
    toggleBtn.addEventListener('click', () => body.classList.toggle('sidebar-minimized'));
  }

  document.querySelectorAll('.has-submenu > a').forEach(a =>
    a.addEventListener('click', e => {
      e.preventDefault();
      a.parentElement.classList.toggle('menu-item-open');
    })
  );

  // =================================================================
  // MODAL PEMBAYARAN
  // =================================================================
  const paymentModalEl = document.getElementById('paymentModal');
  const payButton = document.querySelector('.pay-button');
  const copyBtn = document.getElementById('copy-btn');

  if (paymentModalEl && payButton) {
    const paymentModal = new bootstrap.Modal(paymentModalEl);

    payButton.addEventListener('click', e => {
      e.preventDefault();
      paymentModal.show();
    });

    if (copyBtn) {
      copyBtn.addEventListener('click', () => {
        const accountNumber = document.getElementById('account-number').innerText.trim();
        navigator.clipboard.writeText(accountNumber).then(() => {
          copyBtn.innerText = 'Disalin!';
          setTimeout(() => (copyBtn.innerText = 'Salin'), 2000);
        });
      });
    }
  } else {
    console.warn('Modal pembayaran atau tombol bayar tidak ditemukan di halaman.');
  }

  // =================================================================
  // FETCH DATA DARI BACKEND CODEIGNITER
  // =================================================================
  const listContainer = document.getElementById('arisan-list');

  async function fetchAndDisplayGroups() {
    try {
      const response = await fetch(`${window.location.origin}/api/groups`);
      const data = await response.json();

      if (!Array.isArray(data)) throw new Error('Format data tidak sesuai');
      renderArisanGroups(data);
    } catch (error) {
      console.error('Gagal mengambil data dari server:', error);
      if (listContainer) {
        listContainer.innerHTML = `<p class="col-span-full text-center text-danger">Gagal memuat data dari server.</p>`;
      }
    }
  }

  fetchAndDisplayGroups();

  // =================================================================
  // LOGIKA KOCOKAN
  // =================================================================
  const kocokanModalEl = document.getElementById('kocokan-modal');
  const winnerNameEl = document.getElementById('winner-name');
  const userRole = document.body.dataset.role || 'member';

  function renderArisanGroups(groups) {
    if (!listContainer) return;
    listContainer.innerHTML = '';

    if (groups.length === 0) {
      listContainer.innerHTML = `<p class="col-span-full text-center text-slate-500">Belum ada grup arisan di database.</p>`;
      return;
    }

    groups.forEach(group => {
      const paidMembers = parseInt(group.paid_members ?? 0);
      const totalMembers = parseInt(group.total_members ?? 1);
      const percentage = (paidMembers / totalMembers) * 100;

      const card = document.createElement('div');
      card.className = 'arisan-card';
      card.innerHTML = `
        <div class="arisan-card-header">
          <h3>${group.group_name}</h3>
          ${
            parseInt(group.is_ready_to_draw) === 1
              ? '<span class="status-done">SIAP KOCOK</span>'
              : '<span class="status-notready">BELUM SIAP KOCOK</span>'
          }
        </div>
        <div class="progress-bar-container">
          <div class="progress-bar" style="width: ${percentage}%;"></div>
        </div>
        <div class="arisan-card-footer">
          <span>${paidMembers}/${totalMembers} sudah bayar</span>
          <span>Kocokan: <strong>${group.next_draw || 'N/A'}</strong></span>
        </div>
      `;

      // hanya admin bisa klik untuk kocok
      if (
        userRole === 'admin' &&
        parseInt(group.is_ready_to_draw) === 1 &&
        group.members &&
        group.members.length > 0
      ) {
        card.addEventListener('click', () => {
          const kocokanModal = new bootstrap.Modal(kocokanModalEl);
          startKocokan(group, kocokanModal);
        });
      }

      listContainer.appendChild(card);
    });
  }

  // fungsi kocokan
  function startKocokan(group, modal) {
  if (!modal || !winnerNameEl) return;
  modal.show();
  winnerNameEl.textContent = "Mengocok...";

  setTimeout(async () => {
    // filter anggota yang belum pernah menang
    const winners = group.winners?.map(Number) || [];
    const availableMembers = group.members.filter(
      (m) => !winners.includes(m.id)
    );

    if (availableMembers.length === 0) {
      winnerNameEl.textContent = "Semua anggota sudah pernah menang 🎉";
      return;
    }

    // pilih acak dari yang belum menang
    const randomIndex = Math.floor(Math.random() * availableMembers.length);
    const winner = availableMembers[randomIndex];
    winnerNameEl.textContent = winner.member_name;

    // simpan ke database
    try {
      const response = await fetch(`${window.location.origin}/api/set-winner`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          group_id: group.id,
          member_id: winner.id,
        }),
      });

      const result = await response.json();
      if (result.success) {
        console.log("✅ Pemenang disimpan:", result.winner);
      } else {
        alert(result.error || "Gagal menyimpan pemenang!");
      }
    } catch (err) {
      console.error("Gagal menyimpan hasil kocokan:", err);
    }
  }, 3000);
}


  // ===========================================================
  // Hitung tanggal jatuh tempo otomatis setiap tanggal 28
  // ===========================================================
  function hitungHariJatuhTempo() {
    const today = new Date();
    const year = today.getFullYear();
    const month = today.getMonth();

    // tanggal jatuh tempo = 28 setiap bulan
    let dueDate = new Date(year, month, 28);
    if (today > dueDate) {
      dueDate = new Date(year, month + 1, 28);
    }

    const selisihHari = Math.ceil((dueDate - today) / (1000 * 60 * 60 * 24));
    const dueDateEl = document.querySelector('.due-date');
    if (dueDateEl) {
      dueDateEl.textContent = `Jatuh tempo dalam ${selisihHari} hari lagi`;
      dueDateEl.style.color = selisihHari <= 3 ? '#d9534f' : '#28a745'; // merah kalau <3 hari, hijau default
      dueDateEl.style.fontWeight = '600';
    }
  }

  hitungHariJatuhTempo();
});
