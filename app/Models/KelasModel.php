<?php

namespace App\Models;
use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'ms_kelas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 
        'description', 
        'created_by', 
        'created_date', 
        'modified_by', 
        'modified_date', 
        'is_active'];
    public $timestamps = false;

    // Custom method to get only active classes
    public function getActiveKelas()
    {
        return $this->where('is_active', 1)->findAll();
    }

    public function getKelasById($id)
    {
        return $this->where('id', $id)
                    ->where('is_active', 1)
                    ->first();
    }
}
