<?php

namespace App\Models\Admin;

use App\Models;
use CodeIgniter\Model;

class AdminModel  extends Model
{

    private $db_connect;

    public function __construct()
    {
        //instantiate
        $this->db_connect = \Config\Database::connect();
    }

    public function  get_admin()
    {

        $admin_query = $this->db_connect->table('admin')
            ->select('*')
            ->get();

        $data = $admin_query->getResultObject(); //object

        return $data;
    }
}
