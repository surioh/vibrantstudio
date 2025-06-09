<?php

namespace App\Models;
use CodeIgniter\Model;

class ScheduleModel extends Model
{
    protected $table = 'tr_schedule';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'class_id',
        'coach_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'kuota',
        'hari',
        'is_active'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_date';
    protected $updatedField = 'modified_date';

    public function getActiveSchedule()
    {
        return $this->db->table('tr_schedule as t')
            ->select('t.id, m.name as class_name, t.hari, t.jam_mulai, t.jam_selesai, t.kuota')
            ->join('ms_kelas as m', 'm.id = t.class_id', 'left')
            ->where('t.is_active', 1)
            ->get()
            ->getResultArray();
    }

    public function getScheduleById($id)
    {
        // return $this->db->table('tr_schedule as t')
        //     ->select('t.id, m.name as class_name, t.hari, t.jam_mulai, t.jam_selesai, t.kuota')
        //     ->join('ms_kelas as m', 'm.id = t.class_id', 'left')
        //     ->where('t.id', $id)
        //     ->where('t.is_active', 1)
        //     ->first();

        return $this->db->table('tr_schedule as t')
        ->select('t.id, m.name as class_name, t.hari, t.jam_mulai, t.jam_selesai, t.kuota')
        ->join('ms_kelas as m', 'm.id = t.class_id', 'left')
        ->where('t.id', $id)
        ->where('t.is_active', 1)
        ->get()
        ->getRowArray();
    }
}
