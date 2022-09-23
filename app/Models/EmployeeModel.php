<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{

    private $db_connect;

    public function __construct()
    {
        //instantiate
        $this->db_connect = \Config\Database::connect();
    }
    /**
     * func: get all the list of employee in the database
     * @return $employee_data : array or list of employee 
     */
    public function get_all_employees()
    {

        $query = $this->db_connect->table('employee')
            ->select('*')
            ->get();

        $employee_data = $query->getResultArray();
        return $employee_data;
    }

    /**
     * func: update the status of the employee in the database
     * @param $employee_id : int or string (all number) extract from qr code 
     * @return int 1 = active, 0 = logout, 
     * @return null  
     */
    public function update_attendance_status($employee_id)
    {

        $query = $this->db_connect->table('employee')
            ->select('status')
            ->where('id', $employee_id)
            ->get()
            ->getRowArray();

        if (!empty($query)) {
            if ($query['status'] == 0) {
                $this->db_connect->table('employee')
                    ->where('id', $employee_id)
                    ->update([
                        'status' => 1
                    ]);

                return 1;
            } else {
                $this->db_connect->table('employee')
                    ->where('id', $employee_id)
                    ->update([
                        'status' => 0
                    ]);

                return 0;
            }
        }

        return;
    }

    public function add_employee($name, $role, $incharge_to)
    {
        $builder = $this->db_connect->table('employee');

        $response = $builder->insert([
            'name' => $name,
            'designation' => $role
        ]);

        $last_id = $this->db_connect->insertID();

        foreach ($incharge_to as $incharge) {
            $this->db_connect->table('emp_incharge')
                ->insert([
                    'emp_id' => $last_id,
                    'incharge_to' => $incharge
                ]);
        }

        return true;
    }

    public function update_employee($id, $name, $role, $incharge_to)
    {
        $builder = $this->db_connect->table('employee');

        $response = $builder->where('id', $id)->update([
            'name' => $name,
            'designation' => $role
        ]);

        $this->delete_employee_incharge($id);

        foreach ($incharge_to as $incharge) {
            $this->db_connect->table('emp_incharge')
                ->insert([
                    'emp_id' => $id,
                    'incharge_to' => $incharge
                ]);
        }

        return true;
    }

    public function delete_employee($id)
    {
        $builder = $this->db_connect->table('employee');

        $response = $builder->where('id', $id)->delete();
        $this->delete_employee_incharge($id);


        return $response;
    }

    private function delete_employee_incharge($id)
    {
        $this->db_connect->table('emp_incharge')
            ->where('emp_id', $id)
            ->delete();
    }

    public function get_employee($id)
    {
        $builder = $this->db_connect->table('employee')->join('emp_incharge', 'emp_incharge.emp_id = employee.id', 'left');
        $query   = $builder->select('id, name, designation, incharge_to')->getWhere(['id' => $id]);
        $response = $query->getResultArray();

        return $response;
    }

    public function get_all_incharge_to()
    {
        $query = $this->db_connect->table('emp_incharge')
            ->select('incharge_to')
            ->get();

        $incharge_data = $query->getResultArray();
        return $incharge_data;
    }
}
