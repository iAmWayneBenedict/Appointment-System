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
}