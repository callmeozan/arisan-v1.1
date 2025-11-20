<?php

namespace App\Controllers;

use App\Models\GroupModel;
use App\Models\MemberModel;
use App\Models\DanaModel;

class Dashboard extends BaseController
{
    protected $groupModel;
    protected $memberModel;
    protected $danaModel;
    protected $db;

    public function __construct()
    {
        $this->groupModel = new GroupModel();
        $this->memberModel = new MemberModel();
        $this->danaModel = new DanaModel();
        $this->db = \Config\Database::connect();
    }

    // halaman utama dashboard
    public function index()
    {
        $groupModel = new GroupModel();
        $danaModel   = new DanaModel();

        // Ambil jumlah anggota aktif
        $activeMembers = $groupModel->countActiveMembers();

        // Data grup (kalau mau juga)
        $groups = $groupModel->getGroupsWithMembers();

        // persentase pembayaran tepat waktu
        $paymentOnTime = $danaModel->getPaymentOnTimePercentage();

        // jumlah dana terkumpul
        $totalDana = $danaModel->selectSum('jumlah')->get()->getRow()->jumlah ?? 0;

        $latestWinner = $this->db->table('winner_name')
            ->select('members.member_name')
            ->join('members', 'members.id = winner_name.member_id')
            ->orderBy('winner_name.id', 'DESC')
            ->limit(1)
            ->get()
            ->getRow();

        return view('dashboard', [
            'title' => 'Dashboard Arisan',
            'activeMembers' => $activeMembers,
            'groups' => $groups,
            'dana_terkumpul' => $totalDana,
            'paymentOnTime' => $paymentOnTime,
            'winnerName' => $latestWinner->member_name ?? '-',
        ]);
    }

    // endpoint API untuk data grup arisan
    public function apiGroups()
    {
        $groups = $this->groupModel->findAll();
        $db = \Config\Database::connect();

        foreach ($groups as &$g) {
            // Ambil anggota grup
            $g['members'] = $this->memberModel
                ->where('group_id', $g['id'])
                ->findAll();

            // Ambil member_id yang sudah menang di grup ini
            $winners = $db->table('winner_name')
                ->select('member_id')
                ->where('group_id', $g['id'])
                ->get()
                ->getResultArray();

            $g['winners'] = array_column($winners, 'member_id');
        }

        return $this->response->setJSON($groups);
    }

    public function setWinner()
    {
        $data = $this->request->getJSON(true);
        $groupId = $data['group_id'] ?? null;
        $memberId = $data['member_id'] ?? null;

        if (!$groupId || !$memberId) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Data tidak lengkap']);
        }

        $db = \Config\Database::connect();

        // Cek apakah member sudah pernah menang di grup ini
        $alreadyWon = $db->table('winner_name')
            ->where(['group_id' => $groupId, 'member_id' => $memberId])
            ->countAllResults();

        if ($alreadyWon > 0) {
            return $this->response->setJSON([
                'error' => 'Member ini sudah pernah menang di grup ini.'
            ]);
        }

        // ✅ Simpan hasil baru ke tabel winner_name
        $db->table('winner_name')->insert([
            'group_id' => $groupId,
            'member_id' => $memberId,
            'tanggal_kocok' => date('Y-m-d'),
            'bulan_kocok' => date('F Y'),
        ]);

        // Ambil nama pemenang dari tabel members
        $member = $this->memberModel->find($memberId);

        return $this->response->setJSON([
            'success' => true,
            'winner' => $member['member_name'],
        ]);
    }
}
