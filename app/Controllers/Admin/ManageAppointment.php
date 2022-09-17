<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ManageAppointmentModel;
use App\Libraries\OneWaySMS;
use App\Libraries\greetings;
use CodeIgniter\I18n\Time;


class ManageAppointment extends BaseController
{
    protected $manage_appointment;
    protected $send_sms;
    protected $greet;
    protected $time;

    function __construct()
    {
        $this->manage_appointment = new ManageAppointmentModel();
        $this->send_sms = new OneWaySMS();
        $this->greet = new greetings();
        $this->time = new Time();
    }

    /**
     * Function: Display
     * Description: Display all the pending appointments into views
     * @return view with data 
     */
    public function pending_appointments(){

        $data['pending'] = $this->manage_appointment->get_pending_appointment();

        // echo '<pre>';
        // print_r($data);
        // echo '<pre>';
        return view('admin/appointments', $data);
    }

    /**
     * Function: Display
     * Description: Display spesific data of appointments base what admin choose
     *              to review
     * @param appointment_id : 
     * @return view : with data
     */
    public function review_appointment($appointment_id = NULL){
        
        if($appointment_id != NULL){
            $data['appointment'] = $this->manage_appointment->get_appointment_info($appointment_id);
            return view('components/review', $data);
        }
    }

    /**
     * Function: Approve Appointment
     * Desciption: approve reviewed appointment then send the clinet a SMS
     * @return json : code 1 for success and 0 for not
     */
    public function approve_appointment(){

        $appointment_id = $this->request->getPost('id');
        $appointment_data = $this->manage_appointment->get_appointment_info($appointment_id);

        if(!$this->manage_appointment->move_to_approve($appointment_id)){           
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
    public function reject_appointment(){

        $appointment_id = $this->request->getPost('id');
        $appointment_data = $this->manage_appointment->get_appointment_info($appointment_id);

        if(!$this->manage_appointment->remove_appointment($appointment_id)){           
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

    //depends on js
    public function display_approved_appointments(){
        
       $data['approved'] = $this->manage_appointment->get_approved_appointments();

       //return $data;
       //or
       //return view('');

       echo '<pre>';
       print_r($data);
       echo '<pre>';
    }

    public function mark_as_done($appointment_id = NULL){
        
    }

    /**
       Function: Remove appointments
     * Description: removed appointment if it schedule is passed already after a day,
     *              it will automatic remove approved appointments only 
     *              for example if the schedule is sept 09 and it not marked as done
     *              it will compare to current time or if it is passed  = > one day
                    This function will call via Cron job every day 
     */
    public function check_passed_appointments(){

        $all_approved_appointments = $this->manage_appointment->get_approved_appointments();

        foreach($all_approved_appointments as $approved){
            if(strtotime($approved->schedule) < strtotime('-1 day')){
                $this->manage_appointment->remove_appointment($approved->id);
            }
            continue; //do nothing
        }

    }

    /**
       Function: reminder auto send SMS
     * Description: send a sms reminder 1 hour before the appointment schedule
     *              it takes all approved appointments and checks all schedule 
     *              that will match to current time plus hour. 
                    This function will call via Cron job every hour 
     */
    public function sms_incoming_appointment(){

        $auth = $this->request->getGet('auth');
        $authKey = 'agriculturist_2022';

        if(empty($auth) || $auth != $authKey){
           return 'Someone accessing the url';
        }

        //get current date
        $now = $this->time->now();

        //parse cur date to CI time
        $parseTime = $this->time->parse('2022-09-14 7:50:01');

        // add 2 hour to current time
        $addTime = $parseTime->addHours(2);
        $newTime = $addTime->toDateTimeString();

        //format date and time with hour only
        $advanceCurrentTime = date('Y-m-d H', strtotime($newTime)); 


        $res = [];

        $approved_appointments = $this->manage_appointment->get_approved_appointments();
        
        foreach($approved_appointments as $appointment){

            $dbparseTime = $this->time->parse($appointment->schedule);
            $appointmentTime = date('Y-m-d H', strtotime($dbparseTime));

            if($advanceCurrentTime == $appointmentTime){
                $appointment_data = $this->manage_appointment->get_appointment_info($appointment->id);

                  //format the date in SMS for better readability
                $date = date_create($appointment_data->schedule);
                $sched = date_format($date, 'F d, Y g:i A');

                $message = "{$this->greet->greet()} {$appointment_data->name} You have incoming appointment \n";
                $message .= "Schedule: {$sched}, Make Sure to see employee availabilty status before you go.";
                $message .= "reminder from Agriculture Office of Bato";
        
                //enable this sms later ⬇⬇⬇⬇⬇⬇
        
                //$sms_response = $this->send_sms->sendSMS($appointment_data->contact_number, $message);
        
                //if sms is not sent execute this code
                // if($sms_response['code'] == 0 ){
                //     array_push($res, $sms_response['message'])
                // }

            }
            continue;
        }

        //return that can be save in cron job, for future review and debugging
        return json_encode($res);
        

    }


}