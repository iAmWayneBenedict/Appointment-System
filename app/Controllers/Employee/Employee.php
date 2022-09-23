<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;

class Employee extends BaseController
{
    private $employee_model;

    //Instantiate
    public function __construct()
    {
        $this->employee_model = new EmployeeModel();
    }

    public function index()
    {
        return view('employee/index');
    }

    public function qr_generator()
    {
        return view('employee/qr-generator');
    }

    public function get_employee($id)
    {
        $response = $this->employee_model->get_employee($id);

        return json_encode([
            "data" => $response
        ]);
        // print_r($response);
        // return view('employee/qr-generator');
    }

    public function get_all_incharge_to()
    {
        $result['incharge_data'] = $this->employee_model->get_all_incharge_to();

        return view('components/incharge-list', $result);
    }
}
