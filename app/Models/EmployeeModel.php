<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model{

    private $db_connect;

    public function __construct(){
        //instantiate
        $this->db_connect = \Config\Database::connect();
    }
    /**
     * func: get all the list of employee in the database
     * @return $employee_data : array or list of employee 
     */
    public function get_all_employees(){

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
    public function update_attendance_status($employee_id){

        $query = $this->db_connect->table('employee')
            ->select('status')
            ->where('id', $employee_id)
            ->get()
            ->getRowArray();

        if(!empty($query)){
            if($query['status'] == 0){
                $this->db_connect->table('employee')
                    ->where('id', $employee_id)
                    ->update([
                        'status' => 1
                    ]);
                
                return 1;
            }
            else {
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
}