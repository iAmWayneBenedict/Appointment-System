<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;

class EmployeeScanner extends BaseController
{
    /**
     * class: this is for testing qr code scanner
     */

    public function index(){
        // $data['test'] = $this->get_employee();
        return view('scanner');
    }

    public function get_employee(){
        $model = new EmployeeModel();

        $data['employees'] = $model->get_all_employees();
        // return json_encode($data);
        return view('components/employee-list', $data);
    }

    public function track_employee(){
        $model = new EmployeeModel();

        $employee_id = $this->request->getPost('emp_ID');

        if(!empty($employee_id)){
            $reponse = $model->update_attendance_status($employee_id);

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
    }
}