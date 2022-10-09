<?php

namespace App\Models\Admin;

use App\Models;
use CodeIgniter\Model;

class HolidayModel  extends Model
{

    private $db_connect;

    public function __construct()
    {
        //instantiate
        $this->db_connect = \Config\Database::connect();
    }

    public function  get_holidays()
    {

        $admin_query = $this->db_connect->table('holidays')
            ->select('*')
            ->get();

        $data = $admin_query->getResultObject(); //object

        return $data;
    }

    public function  set_holidays($holiday_from, $holiday_to, $description)
    {

        $builder = $this->db_connect->table('holidays');

        $response = $builder->insert([
            'holiday_from' => $holiday_from,
            'holiday_to' => $holiday_to,
            'description' => $description
        ]);

        return $response;
    }
}
