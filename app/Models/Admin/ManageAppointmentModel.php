<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ManageAppointmentModel extends Model
{
    protected $db_conn;

    function __construct()
    {
        $this->db_conn = \Config\Database::connect();
    }

    /**
     * Function: Retrieve
     * Description: get all pending appointment is database
     * @return data: array of objects
     */
    public function get_pending_appointment(){

        $query = $this->db_conn->table('pending_appointments')
            ->select('id, schedule, user_type, date_created')
            ->join('set_appointments', 'set_appointments.id = pending_appointments.set_appointment_id')
            ->get();

        $data = $query->getResultObject();//object access using ->col_name

        return $data;
    }

    /**
     * Function: Retrieve
     * Description: get appointment informations affected only one row
     * @return data: array of object 1 row only
     */
    public function get_appointment_info($appointment_id){
        $query = $this->db_conn->table('set_appointments')
            ->select('*')
            ->where('id', $appointment_id)
            ->get();

        $data = $query->getRow(); //array object
        return $data;
    }

    /**
     * Function: Insert, Delete
     * Description: Insert the approved appointmnet into Dabase and 
     *              delete it on pending table
     * @return bool
     */
    public function move_to_approve($appointment_id){

        $approved_query = $this->db_conn->table('approved_appointments')
            ->insert([
                'set_appointment_id' => $appointment_id
            ]);
        
        if(!$approved_query){
            return false;
        }

        $this->db_conn->table('pending_appointments')
            ->where('set_appointment_id', $appointment_id)
            ->delete();
        
        return true;
    }

    /**
     * Function: Delete appointment
     * Description: pemanent delete an appointment into Database
     *              it can be use for rejecting and mark as done appointment  
     * @return bool
     */
    public function remove_appointment($appointment_id){
        
        $this->db_conn->table('set_appointments')
            ->where('id', $appointment_id)
            ->delete();

        return true;
    }
}