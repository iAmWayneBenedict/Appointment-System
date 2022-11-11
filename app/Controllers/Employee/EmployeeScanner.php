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
    private $session;

    //Instantiate
    public function __construct()
    {
        $this->employee_model = new EmployeeModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        // $data['test'] = $this->get_employee();
        return view('scanner');
    }

    // TODO : Update to server 

    public function add_employee()
    {
        $current_admin = $this->session->get('admin_id');

        $name = $this->request->getPost('name');
        $role = $this->request->getPost('role');

        $incharge_to = $this->request->getPost('incharge_to');

        $response = $this->employee_model->add_employee($current_admin, $name, $incharge_to);                   

        if ($response == 1) {
            return json_encode([
                'success' => true,
                'error' => false,
                'message' => "Employee successfully added!",
                "response_code" => 201,
            ]);
        } else {
            return json_encode([
                'success' => false,
                'error' => true,
                'message' => "Adding Employee Unsuccessful!",
                "response_code" => 304,
            ]);
        }
    }

    public function update_employee()
    {
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $role = $this->request->getPost('role');

        $incharge_to = $this->request->getPost('incharge_to');

        $response = $this->employee_model->update_employee($id, $name, $role, $incharge_to);

        if ($response == 1) {
            return json_encode([
                'success' => true,
                'error' => false,
                'message' => "Employee successfully added!",
                "response_code" => 201,
            ]);
        } else {
            return json_encode([
                'success' => false,
                'error' => true,
                'message' => "Adding Employee Unsuccessful!",
                "response_code" => 304,
            ]);
        }
    }
    public function delete_employee($id)
    {
        $response = $this->employee_model->delete_employee($id);

        return $response;
    }

    public function get_employee_status()
    {
        $data['employees'] = $this->employee_model->get_all_incharge();
        // return json_encode($data);
        return view('components/employee-list-status', $data);
    }

    public function get_employee_status_user()
    {
        $data['employees'] = $this->employee_model->get_all_incharge();
        // return json_encode($data);
        return view('components/employee-list-status-user', $data);
    }

    public function get_employee()
    {
        $data['employees'] = $this->employee_model->get_all_employees();
        // return json_encode($data);
        return view('components/employee-list', $data);
    }

    /**
     * func: the proces where the data is from QR code
     * @return string message(msg) to the user 
     */
    public function track_employee()
    {

        $employee_id = $this->request->getPost('emp_ID');

        if (!empty($employee_id)) {
            $reponse = $this->employee_model->update_attendance_status($employee_id);
            if ($reponse == 1) {
                return json_encode([
                    'msg' => 'Logged in',
                    'id' => $employee_id
                ]);
            } elseif ($reponse == 0) {
                return json_encode([
                    'msg' => 'Logged out',
                    'id' => $employee_id
                ]);
            } else {
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
