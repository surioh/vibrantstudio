<?php
namespace App\Models;
use CodeIgniter\Model;

class UserSessionModel extends Model
{
    protected $table = 'tr_user_session';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'category', 'session', 'expiration', 'is_active'];
    protected $useTimestamps = false; // Disable timestamps since your table doesn't have created_at/updated_at
}