<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ManageAppointmentModel;
use App\Libraries\OneWaySMS;
use App\Libraries\greetings;


class ManageAppointment extends BaseController
{
    protected $manage_appointment;
    protected $send_sms;
    protected $greet;

    function __construct()
    {
        $this->manage_appointment = new ManageAppointmentModel();
        $this->send_sms = new OneWaySMS();
        $this->greet = new greetings();
    }

    /**
     * Function: Display
     * Description: Display all the pending appointments into views
     * @return view with data 
     */
    public function pending_appointments()
    {

        $data['pending'] = $this->manage_appointment->get_pending_appointment();

        // echo '<pre>';
        // print_r($data);
        // echo '<pre>';
        return view('admin/appointments', $data);
    }

    /**
     * Function: Display
     * Description: Display all the pending appointments into views
     * @return view with data 
     */
    public function approved_appointments()
    {
        return view('admin/approved-appointments');
    }

    /**
     * Function: Get Approved Data
     * Description: Display all the pending appointments into views
     * @return JSON with data 
     */

    public function get_all_approved_appointments()
    {

        $data['approved'] = $this->manage_appointment->get_approved_appointment();

        // echo '<pre>';
        // print_r($data);
        // echo '<pre>';
        if ($data['approved']) {
            return json_encode([
                'code' => 1,
                'data' => $data,
                'msg' => "Successfully retrieved data"
            ]);
        } else {
            return json_encode([
                'code' => 1,
                'msg' => "Cannot retrieve data",
            ]);
        }
    }

    /**
     * Function: Display
     * Description: Display spesific data of appointments base what admin choose
     *              to review
     * @param appointment_id : 
     * @return view : with data
     */
    public function review_appointment($appointment_id = NULL)
    {

        if ($appointment_id != NULL) {
            $data['appointment'] = $this->manage_appointment->get_appointment_info($appointment_id);
            return view('components/review', $data);
        }
    }

    /**
     * Function: Approve Appointment
     * Desciption: approve reviewed appointment then send the clinet a SMS
     * @return json : code 1 for success and 0 for not
     */
    public function approve_appointment()
    {

        $appointment_id = $this->request->getPost('id');
        $appointment_data = $this->manage_appointment->get_appointment_info($appointment_id);

        if (!$this->manage_appointment->move_to_approve($appointment_id)) {
            return json_encode([
                'code' => 0,
                'msg' => 'System can\'t process right now'
            ]);
        }

        //format the date in SMS for better readability
        $date = date_create($appointment_data->schedule);
        $sched = date_format($date, 'F d, Y g:i A');

        $message = "{$this->greet->greet()} {$appointment_data->name} Your Appointment had been approved \n";
        $message .= "With Appointment id : {$appointment_id} \n";
        $message .= "Scheduled on : {$sched} \n";
        $message .= "Purpose : {$appointment_data->purpose}";

        //enable this sms later ⬇⬇⬇⬇⬇⬇

        //$sms_response = $this->send_sms->sendSMS($appointment_data->contact_number, $message);

        //if sms is not sent execute this code
        // if($sms_response['code'] == 0 ){
        //     return json_encode([
        //         'code' => 0,
        //         'msg' => 'SMS Not sent',
        //         'sms_res' => $sms_response['message']
        //     ]); 
        // }

        return json_encode([
            'code' => 1,
            'msg' => $message,
        ]);
    }

    /**
     * Function: remove
     * Description: admin reject the appoinment and send a sms notification
     *              the appointment will be deleted on database
     * @return json : : code 1 for success and 0 for not
     */
    public function reject_appointment()
    {

        $appointment_id = $this->request->getPost('id');
        $appointment_data = $this->manage_appointment->get_appointment_info($appointment_id);

        if (!$this->manage_appointment->remove_appointment($appointment_id)) {
            return json_encode([
                'code' => 0,
                'msg' => 'System can\'t process right now'
            ]);
        }

        $message = "{$this->greet->greet()} {$appointment_data->name} Your Appointment had been rejected \n";
        $message .= "Please Select another date and time schedule for your appointment";

        //enable this sms later ⬇⬇⬇⬇⬇⬇

        //$sms_response = $this->send_sms->sendSMS($appointment_data->contact_number, $message);

        //if sms is not sent execute this code
        // if($sms_response['code'] == 0 ){
        //     return json_encode([
        //         'code' => 0,
        //         'msg' => 'SMS Not sent',
        //         'sms_res' => $sms_response['message']
        //     ]); 
        // }

        return json_encode([
            'code' => 1,
            'msg' => $message
        ]);
    }
}
