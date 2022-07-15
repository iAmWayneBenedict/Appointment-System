<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model{

    public function get_all_employees(){
        /**
         * return:array data
         * func: get all the list of employee in the database
         */

         $db = \Config\Database::connect();
         $query = $db->table('employee')
            ->select('*')
            ->get();
        
        $employee_data = $query->getResultArray();
        return $employee_data;
    }

    public function update_attendance_status($employee_id){
        $db = \Config\Database::connect();
        $query = $db->table('employee')
            ->select('status')
            ->where('id', $employee_id)
            ->get()
            ->getRowArray();
        
        if($query['status'] == 0){
            $update_query = $db->table('employee')
                ->where('id', $employee_id)
                ->update([
                    'status' => 1
                ]);
            
            return 1;
        }
        else {
            $update_query = $db->table('employee')
                ->where('id', $employee_id)
                ->update([
                    'status' => 0
                ]);
            
            return 0;
        }
    }
}