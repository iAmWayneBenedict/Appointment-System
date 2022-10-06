<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ManageAppointmentModel;
use App\Libraries\OneWaySMS;
use App\Libraries\greetings;
use CodeIgniter\I18n\Time;
use App\Libraries\OnAppNotification;
use App\Models\Admin\AdminReportModel;

use function PHPUnit\Framework\isFalse;

class ManageAppointment extends BaseController
{
    protected $manage_appointment;
    protected $send_sms;
    protected $greet;
    protected $time;
    protected $appNotif;

    function __construct()
    {
        $this->manage_appointment = new ManageAppointmentModel();
        $this->send_sms = new OneWaySMS();
        $this->greet = new greetings();
        $this->time = new Time();
        $this->appNotif = new OnAppNotification();
    }

    /**
     Function: PENDING APPOINTMENTS DISPLAY
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
     Function: APPROVED APPOINTMENTS DISPLAY
     * Description: Display all the pending appointments into views
     * @return view with data 
     */
    public function approved_appointments()
    {
        return view('admin/approved-appointments');
    }

    /**
     Function: GET ALL APPROVED APPOINTMENTS
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
                'code' => 0,
                'msg' => "Cannot retrieve data",
            ]);
        }
    }

    /**
     * Function: Get Events Data
     * Description: Display all the pending appointments into views
     * @return JSON with data 
     */

    public function get_all_events()
    {
        $data['pending'] = $this->manage_appointment->get_pending_appointment();
        $data['approved'] = $this->manage_appointment->get_approved_appointment();

        // echo '<pre>';
        // print_r($data);
        // echo '<pre>';
        if ($data['pending']) {
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

    public function get_set_appointments()
    {
        $data = $this->manage_appointment->get_set_appointments();

        if ($data) {
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
     Function: REVIEW APPOINTMENT
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
     Function: GET APPOINTMENT DETAILS
     * Description: Display spesific data of appointments base what admin choose
     *              to review
     * @param appointment_id : 
     * @return view : with data
     */
    public function get_appointment_details($appointment_id = NULL)
    {
        if ($appointment_id != NULL) {
            $data['appointment'] = $this->manage_appointment->get_appointment_info($appointment_id);
            $data['incharge'] = $this->manage_appointment->get_incharge_employee($data['appointment']->purpose);
            return view('components/view-appointment-details', $data);
        }
    }

    /**
     Function: APPROVED APPOINTMENT 
     * Desciption: approve reviewed appointment then send the clinet a SMS
     * @return json : code 1 for success and 0 for not
     */
    public function approve_appointment()
    {
        //prevent inserting more than one
        $validate = $this->validate([
            'id' => [
                'rules' => 'is_unique[approved_appointments.set_appointment_id]'
            ]
        ]);

        if (!$validate) {
            return;
        }

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

        //on app notification
        if($appointment_data->user_id != NULL){
            $this->appNotif->sent_app_notification($appointment_data->user_id, $message);
        }


        //TODO: enable this sms later ⬇⬇⬇⬇⬇⬇
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
            'msg' => 'Appointment Approved',
        ]);
    }

    /**
     Function: REJECT APPOINTMENT
     * Description: admin reject the appoinment and send a sms notification
     *              the appointment will be deleted on database
     * @return json : : code 1 for success and 0 for not
     */
    public function reject_appointment()
    {

        $appointment_id = $this->request->getPost('id');
        $remarks = $this->request->getPost('remark');
        $appointment_data = $this->manage_appointment->get_appointment_info($appointment_id);

        $data = [
            'appointment_id'  => $appointment_id,
            'state'           => 'rejected'
        ];

        if(!AdminReportModel::insert_report($data)){
            return json_encode([
                'code' => 0,
                'msg' => 'System can\'t process right now'
            ]);
        }

        //removed the appointment from pending table
        $this->manage_appointment->removed_pending_appointment($appointment_id);
            
        $message = "{$this->greet->greet()} {$appointment_data->name} Your Appointment had been rejected \n";
        $message .= "Reason : {$remarks}";

        //on app notification
        if ($appointment_data->user_id != NULL) {
            $this->appNotif->sent_app_notification($appointment_data->user_id, $message);
        }
        
        //TODO: enable this sms later ⬇⬇⬇⬇⬇⬇

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
            'msg' => 'Appointment Rejected'
        ]);
    }

    /**
     FUNCTION: MARK DONE APPOINTMENT
     * use when appointment is done manaually by admin after mark it done
     * the information of appointment will store to database for report purposes
     * @param required appointment ID
     */
    public function mark_as_done($appointment_id = NULL)
    {

        $data = [
            'appointment_id'  => $appointment_id,
            'state'           => 'done'
        ];

        AdminReportModel::insert_report($data);

        $this->manage_appointment->remove_approved_appointment($appointment_id);
        session()->setFlashdata('done', 'Appointment Is Done');
        return redirect()->back();
    }


    /**
       Function: SMS INCOMING APPOINTMENTS
     * Description: send a sms reminder 1 hour before the appointment schedule
     *              it takes all approved appointments and checks all schedule 
     *              that will match to current time plus hour. 
                    This function will call via Cron job every hour 
     */
    public function sms_incoming_appointment()
    {

        $auth = $this->request->getGet('auth');
        $authKey = 'agriculturist_2022';

        if (empty($auth) || $auth != $authKey) {
            return 'Someone accessing the url';
        }

        //get current date
        $now = $this->time->now();

        //parse cur date to CI time
        $parseTime = $this->time->parse($now);

        // add 2 hour(s) to current time
        $addTime = $parseTime->addHours(2);
        $newTime = $addTime->toDateTimeString();

        //format date and time with hour only
        $advanceCurrentTime = date('Y-m-d H', strtotime($newTime));


        $res = [];

        $resuls = $this->manage_appointment->get_upcoming_appointments($advanceCurrentTime);

        if (empty($resuls)) {
            return;
        }

        foreach ($resuls as $result) {

            //format the date in SMS for better readability
            $date = date_create($result->schedule);
            $sched = date_format($date, 'F d, Y g:i A');

            $message = "{$this->greet->greet()} {$result->name} You have incoming appointment \n";
            $message .= "Schedule: {$sched}, Make Sure to see employee availabilty status before you go.";
            $message .= "reminder from Agriculture Office of Bato \n";
            $message .= "Appointment ID: {$result->id}";

            //on app notification
            if ($result->user_id != NULL) {
                $this->appNotif->sent_app_notification($result->user_id, $message);
            }

            //TODO: enable this sms later ⬇⬇⬇⬇⬇⬇

            //$sms_response = $this->send_sms->sendSMS($result->contact_number, $message);

            //if sms is not sent execute this code
            // if($sms_response['code'] == 0 ){
            //     array_push($res, $sms_response['message'])
            // }

        }

        return json_encode($res); //array of results
    }

    /**
        Function: CHECKED RESCHED APPOINTMENT
     * Description: This is to notify client of thier passed appointments after 5 hours
     *              that thier appointment is not being done.
     *              the system will send sms to them that they need to reschedule
                    this function will call every hour in cron job
     */
    public function check_resched_appointment()
    {

        $auth = $this->request->getGet('auth');
        $authKey = 'agriculturist_2022';

        if (empty($auth) || $auth != $authKey) {
            return 'Someone accessing the url';
        }

        $passed_appointments = $this->manage_appointment->get_passed_appointment();

        $res = [];
        foreach ($passed_appointments as $approved) {

            $date = date_create($approved->schedule);
            $sched = date_format($date, 'F d, Y g:i A');

            $message = "{$this->greet->greet()} {$approved->name} Your appointment has passed.\n";
            $message .= "Scheduled: {$sched}, Check it on your account page\n";
            $message .= "reminder from Agriculture Office of Bato \n";
            $message .= "Appointment ID: {$approved->id}";

            //on app notification
            if ($approved->user_id != NULL) {
                $this->appNotif->sent_app_notification($approved->user_id, $message);
            }

            //TODO: enable this sms later ⬇⬇⬇⬇⬇⬇

            //$sms_response = $this->send_sms->sendSMS($approved->contact_number, $message);

            //if sms is not sent execute this code
            // if($sms_response['code'] == 0 ){
            //     array_push($res, $sms_response['message'])
            // }

            $this->manage_appointment->set_passed($approved->id);
            return $message;
        }
        // return json_encode($res); 

    }

    /**
       Function: REMOVED PASSED APPOINTMENTS
     * Description: removed appointment if it schedule is passed already after a day,
     *              it will automatic remove approved appointments only 
     *              for example if the schedule is sept 09 and it not marked as done
     *              it will compare to current time or if it is passed  = > one day
                    This function will call via Cron job every day at 12am
     */
    public function removed_passed_appointments()
    {

        $auth = $this->request->getGet('auth');
        $authKey = 'agriculturist_2022';

        if (empty($auth) || $auth != $authKey) {
            return 'Someone accessing the url';
        }

        $all_approved_appointments = $this->manage_appointment->get_resched_appointments();
        $guest_passed_appointments = $this->manage_appointment->guest_passed_appointments();

        foreach ($all_approved_appointments as $approved) {
            if (strtotime($approved->schedule) < strtotime('-3 day')) {

                $data = [
                    'appointment_id'  => $approved->id,
                    'state'           => 'passed'
                ];

                AdminReportModel::insert_report($data);
                $this->manage_appointment->remove_approved_appointment($approved->id);
            }
        }

        foreach ($guest_passed_appointments as $guest) {
            if (strtotime($guest->schedule) < strtotime('-3 day')) {

                $data = [
                    'appointment_id'  => $guest->id,
                    'state'           => 'passed'
                ];

                AdminReportModel::insert_report($data);
                $this->manage_appointment->remove_approved_appointment($guest->id);
            }
        }
    }
}
