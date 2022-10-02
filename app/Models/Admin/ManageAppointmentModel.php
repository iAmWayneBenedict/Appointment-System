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
     Function: GET PENDING APPOINTMENTs
     * Description: get all pending appointment is database
     * @return data: array of objects
     */
    public function get_pending_appointment()
    {

        $query = $this->db_conn->table('pending_appointments')
            ->select('id, schedule, user_type, date_created')
            ->join('set_appointments', 'set_appointments.id = pending_appointments.set_appointment_id')
            ->get();

        $data = $query->getResultObject(); //object access using ->col_name

        return $data;
    }

    /**
     Function: Retrieve
     * Description: get all approved appointment is database
     * @return data: array of objects
     */
    public function get_approved_appointment()
    {

        $query = $this->db_conn->table('approved_appointments')
            ->select('id, name, social_pos, purpose, schedule, user_type')
            ->join('set_appointments', 'set_appointments.id = approved_appointments.set_appointment_id')
            ->get();

        $data = $query->getResultObject(); //object access using ->col_name

        return $data;
    }

    /**
     Function: GET APPOINTMENT INFO
     * Description: get appointment informations affected only one row
     * @return data: array of object 1 row only
     */
    public function get_appointment_info($appointment_id)
    {
        $query = $this->db_conn->table('set_appointments')
            ->select('*')
            ->where('id', $appointment_id)
            ->get();

        $data = $query->getRow(); //array object
        return $data;
    }

    /**
     Function: MOVED TO APPROVED
     * Description: Insert the approved appointmnet into Dabase and 
     *              delete it on pending table
     * @return bool
     */
    public function move_to_approve($appointment_id)
    {

        $approved_query = $this->db_conn->table('approved_appointments')
            ->insert([
                'set_appointment_id' => $appointment_id
            ]);

        if (!$approved_query) {
            return false;
        }

        $this->db_conn->table('pending_appointments')
            ->where('set_appointment_id', $appointment_id)
            ->delete();

        return true;
    }

    /**
     Function: REMOVE APPOINTMENT
     * Description: pemanent delete an appointment into Database
     *              it can be use for rejecting and mark as done appointment  
     * @return bool
     */
    public function remove_appointment($appointment_id)
    {

        $this->db_conn->table('set_appointments')
            ->where('id', $appointment_id)
            ->delete();

        return true;
    }

    /**
     Function: REMOVED APPROVED APPOINTMENTS {DELETE}
     * Description: remove the appointment into aprroved table so it can be access as approved
     *              it means that the appointment is done canceled or passed
     * @return bool
     */
    public function remove_approved_appointment($appointment_id)
    {

        $this->db_conn->table('approved_appointments')
            ->where('set_appointment_id', $appointment_id)
            ->delete();

        return true;
    }

    /**
     Function: GET ALL APPROVED APPOINTMENTS {RETRIEVE}
     * Description: retieve all the approved appointments stored in the table
     *              it is use to display and or access the data of set appointments
     * @return array:data : array of objects appointment data
     */
    public function get_all_approved_appointments()
    {

        $query = $this->db_conn->table('approved_appointments')
            ->select('*')
            ->join('set_appointments', 'set_appointments.id = approved_appointments.set_appointment_id')
            ->get();

        $data = $query->getResultObject(); //object access using ->col_name

        return $data;
    }

    /**
     Function: GET INCHARGE EMPLOYEE
     * Descriptiom : retrieve incharage employe for every purpose in appointment
     *               one purpose can have many employee
     * @return array:data : array of objects
     */
    public function get_incharge_employee($purpose)
    {

        $query = $this->db_conn->table('employee')
            ->select('*')
            ->join('emp_incharge', 'emp_incharge.emp_id = employee.id')
            ->where('incharge_to', $purpose)
            ->get();

        $data = $query->getResultObject(); //object access using ->col_name

        return $data;
    }

    /**
     Function: GET RESCHED APPOINTMENTs
     * Description: this will retrieve rescheduled appointments in the table
     * @return array:data
     */
    public function get_resched_appointments()
    {

        $query = $this->db_conn->table('approved_appointments')
            ->select('*')
            ->join('set_appointments', 'set_appointments.id = approved_appointments.set_appointment_id')
            ->where('resched_status', 1)
            ->get();

        $data = $query->getResultObject(); //object access using ->col_name

        return $data;
    }

    /**
     Function: GUEST PASSED APPOINTMENTS
     * Description: retrived passed appointments of guest since guest cannot reschedule
     *              their appointments
     */
    public function guest_passed_appointments()
    {

        $query = $this->db_conn->table('approved_appointments')
            ->select('*')
            ->join('set_appointments', 'set_appointments.id = approved_appointments.set_appointment_id')
            ->where('resched_status', 0)
            ->where('user_type', 'Guest')
            ->get();

        $data = $query->getResultObject(); //object access using ->col_name

        return $data;
    }

    /**
     Function: GET UPCOMING APPOINTMENTS
     * Descreption: get appointments that already approved and eqals
     *              to 2 hoours advance date, it is to limit the data incoming to
     *              controller insteads of fetching all data
     * @param string $advanceDate date format
     * @return array object contains appointment data
     */
    public function get_upcoming_appointments($advanceDate)
    {

        $query = $this->db_conn->table('approved_appointments')
            ->select('*')
            ->join('set_appointments', 'set_appointments.id = approved_appointments.set_appointment_id')
            ->where("DATE_FORMAT(schedule, '%Y-%m-%d %H')", $advanceDate)
            ->get();

        return $query->getResultObject();
    }

    /**
     Function: GET PASSED APPOINTMENTS
     * Description: retried passed appointments, diffent from reschedule since passed
     *              appointments are appointmnets that unattended by clients after 5 hours
     *              it only gets or read appointments that are passed 5 hours after the schedule
     * @return array:data objects
     */
    public function get_passed_appointment()
    {

        $time =  date('Y-m-d H', strtotime('-5 hours'));     //current time -5 hours
        $time2 =  date('Y-m-d H', strtotime('-6 hours'));   //current time -6 hours

        $query = $this->db_conn->table('approved_appointments')
            ->select('*')
            ->join('set_appointments', 'set_appointments.id = approved_appointments.set_appointment_id')
            ->where("DATE_FORMAT(schedule, '%Y-%m-%d %H') <=", $time)
            ->where("DATE_FORMAT(schedule, '%Y-%m-%d %H') >", $time2)
            ->where('user_type', 'Registered')
            ->get();

        return $query->getResultObject();
    }

    /**
     Function: SET PASSED
     */
    public function set_passed($appointment_id)
    {
        $this->db_conn->table('approved_appointments')
            ->where('set_appointment_id', $appointment_id)
            ->update([
                'is_passed' => 'true'
            ]);
    }
}
