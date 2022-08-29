<?php

/**
 * This is a class for employee scanner process 
 */

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;

class EmployeeScanner extends BaseController
{

    
    private $employee_model;

    //Instantiate
    public function __construct()
    {
        $this->employee_model = new EmployeeModel();
    }

    public function index(){
        // $data['test'] = $this->get_employee();
        return view('scanner');
    }

    /**
     * func: get and display all employee inside the database
     * @return view with data (employees data)
     */
    public function get_employee(){

        $data['employees'] = $this->employee_model->get_all_employees();
        // return json_encode($data);
        return view('components/employee-list', $data);
    }

    /**
     * func: the proces where the data is from QR code
     * @return string message(msg) to the user 
     */
    public function track_employee(){

        $employee_id = $this->request->getPost('emp_ID');

        if(!empty($employee_id)){
            $reponse = $this->employee_model->update_attendance_status($employee_id);

            if($reponse == 1){
                return json_encode([
                    'msg' => 'login'
                ]);
            }
            elseif($reponse == 0){ 
                return json_encode([
                    'msg' => 'logout'
                ]);
            }
            else{
                return json_encode([
                    'msg' => 'try again'
                ]);
            }
        }

        return json_encode([
            'msg' => 'Cannot Process'
        ]);
    }
}