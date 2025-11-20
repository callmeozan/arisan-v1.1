<?php

namespace App\Models;

use CodeIgniter\Model;

class DanaModel extends Model
{
    protected $table = 'dana_terkumpul';
    protected $allowedFields = ['member_id', 'group_id', 'jumlah', 'tanggal_bayar', 'status_bayar'];

    // Hitung persentase pembayaran tepat waktu
    public function getPaymentOnTimePercentage()
    {
        $total = $this->countAllResults(); // total semua transaksi

        if ($total == 0) {
            return 0;
        }

        $tepatWaktu = $this->where('status_bayar', 1)->countAllResults(false);

        // hitung persen
        $persentase = ($tepatWaktu / $total) * 100;

        // biar hasilnya 100% pas kalau semuanya sudah bayar
        if ($persentase > 99.9) {
            $persentase = 100;
        }

        return round($persentase, 0);
    }
}
