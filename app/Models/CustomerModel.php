<?php

namespace App\Models;
use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'tr_user_session';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'category',
        'session',
        'expiration',
        'is_active'
    ];

    public function getActiveCustomer()
    {
        return $this->db->table('tr_user_session')
            ->select('
                ms_user.id,
                ms_user.name,
                ms_user.email,
                ms_user.phone,
                ms_user.date_of_birth,
                ms_user.role,
                MAX(CASE WHEN tr_user_session.category = "group" THEN tr_user_session.session END) AS group_session,
                MAX(CASE WHEN tr_user_session.category = "private" THEN tr_user_session.session END) AS private_session,
                MAX(tr_user_session.expiration) AS expiration
            ')
            ->join('ms_user', 'ms_user.id = tr_user_session.user_id')
            ->where('ms_user.is_active', 1)
            ->where('ms_user.role', 'customer')
            ->where('tr_user_session.is_active', 1)
            ->groupBy('ms_user.id')
            ->get()
            ->getResult();
    }

    public function getCustomerById($id)
    {
        return $this->db->table('ms_user')
            ->select('
                ms_user.*,
                MAX(CASE WHEN tus.category = "group" THEN tus.session END) AS group_session,
                MAX(CASE WHEN tus.category = "private" THEN tus.session END) AS private_session,
                MAX(tus.expiration) AS expiration
            ')
            ->join('tr_user_session tus', 'tus.user_id = ms_user.id', 'left')
            ->where('ms_user.id', $id)
            ->where('ms_user.is_active', 1)
            ->where('ms_user.role', 'customer')
            ->groupBy('ms_user.id')
            ->get()
            ->getRow(); // use getRow() for single result object
    }

    public function getCustomerByIdFront($id)
    {
        return $this->db->table('ms_user')
            ->select('
                ms_user.id,
                ms_user.name,
                ms_user.email,
                ms_user.role,
                MAX(CASE WHEN tus.category = "group" THEN tus.session END) AS group_session,
                MAX(CASE WHEN tus.category = "private" THEN tus.session END) AS private_session,
                MAX(tus.expiration) AS expiration
            ')
            ->join('tr_user_session tus', 'tus.user_id = ms_user.id', 'left')
            ->where('ms_user.id', $id)
            ->where('ms_user.is_active', 1)
            ->where('ms_user.role', 'customer')
            ->groupBy('ms_user.id')
            ->get()
            ->getRow();
    }
}
