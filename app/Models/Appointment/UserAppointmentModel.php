<?php

/**
 * File: User Appoitnment Model
 * Description: This is to hold all the process CRUD of user's appointment
 *              it is connected to ClientAppointment controller
 */

namespace App\Models\Appointment;

use CodeIgniter\Model;

class UserAppointmentModel extends Model
{

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
    public static function insert_appointment(array $data)
    {

        $db_conn = \Config\Database::connect(); //static cant use instance variable

        $insert_query = $db_conn->table('set_appointments')
            ->insert($data);

        if (!$insert_query) {
            return false;
        }

        //get last inserted id
        $last_id = $db_conn->insertID();

        //insert the last inserted id in pending_appointment table
        $pending = $db_conn->table('pending_appointments')
            ->insert([
                'set_appointment_id' => $last_id
            ]);

        if (!$pending) {
            return false;
        }

        return true;
    }

    public function update_appointment($user_id, array $data)
    {

        $this->database->table('set_appointments')
            ->where('user_id', $user_id)
            ->update($data);

        return true;
    }

    //retrieve client's pending appointment
    public function get_pending($user_id)
    {

        $query = $this->database->table('pending_appointments')
            ->select('*')
            ->join('set_appointments', 'set_appointments.id = pending_appointments.set_appointment_id')
            ->where('user_id', $user_id)
            ->get();

        return $query->getResultObject();
    }

    //retrieve client's approved appointment
    public function get_approved($user_id)
    {

        $query = $this->database->table('approved_appointments')
            ->select('*')
            ->join('set_appointments', 'set_appointments.id = approved_appointments.set_appointment_id')
            ->where('user_id', $user_id)
            ->where('is_passed', 'false')
            ->get();

        return $query->getResultObject();
    }

    //retrieve client's pending appointment
    public function get_pending_appointment($id)
    {

        $query = $this->database->table('pending_appointments')
            ->select('*')
            ->join('set_appointments', 'set_appointments.id = pending_appointments.set_appointment_id')
            ->where('id', $id)
            ->get();

        return $query->getResultObject();
    }

    //retrieve client's approved appointment
    public function get_approved_appointment($id)
    {

        $query = $this->database->table('approved_appointments')
            ->select('*')
            ->join('set_appointments', 'set_appointments.id = approved_appointments.set_appointment_id')
            ->where('id', $id)
            ->get();

        return $query->getResultObject();
    }

    //retrieve passed approved appointment
    public function get_passed_appointment($user_id)
    {

        $query = $this->database->table('approved_appointments')
            ->select('*')
            ->join('set_appointments', 'set_appointments.id = approved_appointments.set_appointment_id')
            ->where('user_id', $user_id)
            ->where('is_passed', 'true')
            ->where('resched_status', 0)
            ->get();

        return $query->getResultObject();
    }

    //update status on approved appointments
    private function reschedule_status($appointment_id)
    {

        $this->database->table('approved_appointments')
            ->where('set_appointment_id', $appointment_id)
            ->update([
                'resched_status' => 1
            ]);
    }

    //set new schedule on set schedule table
    public function reschedule_appointment($appointment_id, $new_schedule)
    {

        $this->database->table('set_appointments')
            ->where('id', $appointment_id)
            ->update([
                'schedule' => $new_schedule
            ]);

        $this->reschedule_status($appointment_id);

        return true;
    }

    //remove appointments permarnently
    public function delete_appointment($appointment_id)
    {

        $this->database->table('set_appointments')
            ->where('id', $appointment_id)
            ->delete();
    }
}
