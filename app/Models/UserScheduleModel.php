<?php

namespace App\Models;
use CodeIgniter\Model;

class UserScheduleModel extends Model
{
    protected $table = 'tr_user_schedule';
    protected $primaryKey = 'id';
    protected $allowedFields = ['customer_id', 'actual_schedule_id', 'is_active'];

    public function getBookedSession($userId)
    {
        return $this->db->table('tr_user_schedule a')
            ->select('
                a.id AS user_schedule_id,
                b.tanggal,
                c.jam_mulai,
                c.jam_selesai,
                d.name AS class_name,
                b.coach_id,
                a.class_name_override,
                e.name as coach_name
            ')
            ->join('actual_schedule b', 'b.id = a.actual_schedule_id')
            ->join('tr_schedule c', 'c.id = b.schedule_id')
            ->join('ms_kelas d', 'd.id = c.class_id')
            ->join('ms_user e', 'e.id = b.coach_id', 'left')
            ->where('a.customer_id', $userId)
            ->where('b.tanggal >=', date('Y-m-d')) // upcoming sessions
            ->where('a.is_active', 1)
            ->where('b.is_active', 1)
            ->where('c.is_active', 1)
            ->orderBy('b.tanggal', 'ASC')
            ->get()
            ->getResultArray();
    }

}
