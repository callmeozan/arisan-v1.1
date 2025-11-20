<?php

namespace App\Models;
use CodeIgniter\Model;

class GroupModel extends Model
{
    protected $table = 'groups';
    protected $primaryKey = 'id';
    protected $allowedFields = ['group_name', 'total_members', 'paid_members', 'next_draw', 'is_ready_to_draw'];
    protected $returnType = 'array';

    public function getGroupsWithMembers()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('groups');
        $builder->select('groups.*, COUNT(members.id) as total_members, SUM(members.has_paid) as paid_members');
        $builder->join('members', 'members.group_id = groups.id', 'left');
        $builder->groupBy('groups.id');
        return $builder->get()->getResultArray();
    }

    // ✅ Tambahkan ini:
    public function countActiveMembers()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('members');
        $builder->selectCount('id', 'total');
        return $builder->get()->getRow()->total ?? 0;
    }
}
