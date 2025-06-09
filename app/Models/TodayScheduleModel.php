<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tr_schedule'; // Not strictly needed for custom queries
    protected $primaryKey = 'id';
    protected $allowedFields = []; // Adjust if needed for other operations

    public function getTodaySessions()
    {
        $today = date('Y-m-d'); // Gets current date, e.g., '2025-05-28'
        return $this->db->table('tr_schedule ts')
            ->select([
                'mk.name AS class_name',
                'ts.hari',
                'ts.jam_mulai',
                'ts.jam_selesai',
                'a.tanggal',
                'a.coach_id',
                'GROUP_CONCAT(mu.name SEPARATOR ", ") AS customer_names',
                'u.user_session_category AS login_status'
            ])
            ->join('ms_kelas mk', 'ts.class_id = mk.id', 'left')
            ->join('actual_schedule a', 'ts.id = a.schedule_id', 'inner')
            ->join('tr_user_schedule u', 'a.id = u.actual_schedule_id', 'inner')
            ->join('ms_user mu', 'u.customer_id = mu.id AND mu.role = \'customer\'', 'left')
            ->where('a.tanggal', $today) // Use dynamic date
            ->where('a.is_active', 1)
            ->where('u.is_active', 1)
            ->groupBy([
                'mk.name',
                'ts.hari',
                'ts.jam_mulai',
                'ts.jam_selesai',
                'a.tanggal',
                'a.coach_id',
                'u.user_session_category'
            ])
            ->get()
            ->getResultArray();
    }
}