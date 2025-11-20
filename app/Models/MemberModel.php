<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'id';
    protected $allowedFields = ['group_id', 'member_name', 'has_paid'];

    public function getPersentasePembayaran()
    {
        $total = $this->countAllResults();
        if ($total == 0) return 0;

        $tepat = $this->where('has_paid', 1)->countAllResults();
        return round(($tepat / $total) * 100, 0);
    }
}
