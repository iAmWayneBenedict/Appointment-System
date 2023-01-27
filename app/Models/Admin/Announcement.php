<?php

namespace App\Models\Admin;

use App\Models;
use CodeIgniter\Model;

class Announcement extends Model
{

    private $db_connect;

    public function __construct()
    {
        //instantiate
        $this->db_connect = \Config\Database::connect();
    }

    public function  get_announcement()
    {

        $admin_query = $this->db_connect->table('announcements')
            ->select('*')
            ->get();

        $data = $admin_query->getResultObject(); //object

        return $data;
    }
    public function  set_announcement($message, $stock_id)
    {
        $this->db_conn->table('announcements')
            ->insert([
                "message" => "test",
                "stock_id" => $stock_id
            ]);

        return true;
    }
}
