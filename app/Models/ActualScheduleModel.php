<?php

namespace App\Models;
use CodeIgniter\Model;

class ActualScheduleModel extends Model
{
    protected $table = 'actual_schedule';
    protected $primaryKey = 'id';
    protected $allowedFields = ['schedule_id', 'coach_id', 'tanggal', 'is_active'];

    public function getActiveSchedule($classFilter = null, $timeFilter = null, $sortColumn = 'tanggal', $sortDirection = 'ASC', $dateFilter = null)
    {
        $query = $this->db->table('actual_schedule as a')
            ->select('
                a.id,
                m.name as class_name,
                u.name as coach_name,
                t.hari,
                t.kuota,
                t.jam_mulai,
                t.jam_selesai,
                a.tanggal,
                COUNT(s.id) as jumlah_peserta,
                (t.kuota - COUNT(s.id)) as sisa_kuota
            ')
            ->join('tr_schedule as t', 't.id = a.schedule_id', 'left')
            ->join('ms_kelas as m', 'm.id = t.class_id', 'left')
            ->join('ms_user as u', 'u.id = a.coach_id', 'left')
            ->join('tr_user_schedule as s', 's.actual_schedule_id = a.id', 'left')
            ->where('a.is_active', 1)
            ->where('t.is_active', 1);

        // Add class filter if provided
        if ($classFilter) {
            $query->where('m.name', $classFilter);
        }

        // Add time filter if provided
        if ($timeFilter) {
            $query->where('t.jam_mulai', $timeFilter);
        }

        // Add date filter if provided
        if ($dateFilter) {
            $query->where('a.tanggal', $dateFilter);
        }

        // Group by all non-aggregated columns
        $query->groupBy([
            'a.id',
            'm.name',
            'u.name',
            't.hari',
            't.kuota',
            't.jam_mulai',
            't.jam_selesai',
            'a.tanggal'
        ]);

        // Sorting logic
        if ($sortColumn == 'tanggal') {
            $query->orderBy('a.tanggal', $sortDirection);
            $query->orderBy('t.jam_mulai', 'ASC');
        } else {
            $query->orderBy('t.jam_mulai', $sortDirection);
        }

        return $query->get()->getResultArray();
    }


    public function getDistinctTimes()
    {
        return $this->db->table('tr_schedule')
            ->select('jam_mulai')
            ->distinct()
            ->where('is_active', 1)
            ->orderBy('jam_mulai', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getScheduleById($id)
    {
        return $this->db->table('actual_schedule as a')
        ->select('
            a.id,
            m.name as class_name,
            u.name as coach_name,
            t.hari,
            t.kuota,
            t.jam_mulai,
            t.jam_selesai,
            a.tanggal,
            a.coach_id,
            COUNT(s.id) as jumlah_peserta,
            (t.kuota - COUNT(s.id)) as sisa_kuota
        ')
        ->join('tr_schedule as t', 't.id = a.schedule_id', 'left')
        ->join('ms_kelas as m', 'm.id = t.class_id', 'left')
        ->join('ms_user as u', 'u.id = a.coach_id', 'left')
        ->join('tr_user_schedule as s', 's.actual_schedule_id = a.id', 'left')
        ->where('a.id', $id)
        ->where('a.is_active', 1)
        ->groupBy([
            'a.id',
            'm.name',
            'u.name',
            't.hari',
            't.kuota',
            't.jam_mulai',
            't.jam_selesai',
            'a.tanggal',
            'a.coach_id'
        ])
        ->get()
        ->getRowArray();

    }
}