<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class NotificationsModel extends Model
{
    private $db_connect;

    public function __construct()
    {
        //instantiate
        $this->db_connect = \Config\Database::connect();
    }

    /**
     * func: retrieve the user data from database
     * @return array $users_data
     */
    public function get_user_data()
    {
        $query = $this->db_connect->table('users')
            ->select('id, fname, lname, contact_number, email')
            ->where('account_stats', 1)
            ->get();

        $users_data = $query->getResultArray();

        return $users_data;
    }
}
