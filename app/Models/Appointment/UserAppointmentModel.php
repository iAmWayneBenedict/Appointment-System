<?php
/**
 * File: User Appoitnment Model
 * Description: This is to hold all the process CRUD of user's appointment
 *              it is connected to ClientAppointment controller
 */
namespace App\Models\Appointment;

use CodeIgniter\Model;

class UserAppointmentModel extends Model {

    protected $database;

    function __construct()
    {
        $this->database = \Config\Database::connect();
    }

    /**
     * Function: Insert appointment
     * Description: insert set appointment and get the its id and 
     *              insert it to pending appointment table
     * @param array $data: orgnized dta from user input processed in controller
     * @return bool : true for success and false if something error happen 
     */
    public static function insert_appointment(array $data){
        
        $db_conn = \Config\Database::connect();//static cant use instance variable

        $insert_query = $db_conn->table('set_appointments')
            ->insert($data);
        
        if(!$insert_query){
            return false;
        }

        //get last inserted id
        $last_id = $db_conn->insertID();

        //insert the last inserted id in pending_appointment table
        $pending = $db_conn->table('pending_appointments')
            ->insert([
                'set_appointment_id' => $last_id
            ]);
        
        if(!$pending){
            return false;
        }

        return true;
    }

    

}