<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'ms_user';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'phone',
        'date_of_birth',
        'role',
        'created_by',
        'created_date',
        'is_active'
    ];

    public function getActiveUser()
    {
        return $this->where('is_active', 1)->findAll();
    }

    public function getUserById($id)
    {
        return $this->where('id', $id)
                    ->where('is_active', 1)
                    ->first();
    }

    public function getUserByIdFront($id)
    {
        return $this->select([
                    'id',
                    'name',
                    'email',
                    'phone',
                    'date_of_birth',
                    'role',
                ])
                ->where('id', $id)
                ->where('is_active', 1)
                ->first();
    }

    // Save user with custom logic (e.g., hashing password)
    public function save_user($data)
    {
        return $this->save($data);
    }

    // Check if user exists by email or username
    public function check_user($email)
    {
        return $this->where('email', $email)
                    ->first();
    }
}
