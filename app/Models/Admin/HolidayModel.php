<?php

namespace App\Models\Admin;

use App\Models;
use CodeIgniter\Model;

class HolidayModel extends Model
{

    private $db_connect;

    public function __construct()
    {
        //instantiate
        $this->db_connect = \Config\Database::connect();
    }
    
    public function set_holidays($admin_id, $holiday_from, $holiday_to, $description)
    {

        $builder = $this->db_connect->table('holidays');

        $response = $builder->insert([
            'admin_id' => $admin_id,
            'holiday_from' => $holiday_from,
            'holiday_to' => $holiday_to,
            'description' => $description
        ]);

        return $response;
    }

    public function get_holidays()
    {

        $admin_query = $this->db_connect->table('holidays')
            ->select('*')
            ->get();

        $data = $admin_query->getResultObject(); //object

        return $data;
    }

    public function remove_holidays($id)
    {
        $remove_query = $this->db_connect->table('holidays')->delete(["id" => $id]);
        return $remove_query;
    }
}
