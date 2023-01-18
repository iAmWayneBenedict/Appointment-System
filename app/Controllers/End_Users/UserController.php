<?php

namespace App\Controllers\End_Users;

use App\Libraries\NumberFormater;
use App\Libraries\OneWaySMS;

use App\Controllers\BaseController;
use App\Controllers\End_Users\ClientAppointment;
use App\Models\Appointment\UserAppointmentModel;
use App\Models\OnAppNotifModel;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $user_model;
    protected $validation;
    protected $number_formater;
    protected $send_sms;
    protected $session;

    function __construct()
    {
        $this->user_model = new UserModel();
        $this->validation = \Config\Services::validation();
        $this->send_sms = new OneWaySMS();
        $this->client_appointment = new ClientAppointment();
        $this->userAppointment = new UserAppointmentModel();
        $this->notifications = new OnAppNotifModel();
        $this->session = \Config\Services::session();
        // $this->number_formater = new NumberFormater();
    }

    public function index()
    {
        return view('end-user/register');
    }

    public function display_reminder_information($user_id = false)
    {
        //add filter for this controller 
        //do not continue if current_url is not in register page

        $data['user_informations'] = $this->user_model->get_user_info($user_id);

        return view('end-user/reminder', $data);
    }

    public function notifications()
    {
        $user_id = $this->session->get('id');

        $data['notifications'] = $this->notifications->get_notifications($user_id);

        return view('end-user/dashboard/notifications', $data);
    }
    public function get_notifications()
    {
        $user_id = $this->session->get('id');

        $data['notifications'] = $this->notifications->get_notifications($user_id);

        return json_encode($data);
    }

    public function already_read($id)
    {
        $this->notifications->update_status($id);
    }

    /**
     * Function: Generate
     * Description: make unique user_id for users when registering
     * @return int : 6 digit number.
     */
    public function generate_user_id()
    {
        return $this->user_model->generated_unique_id();
    }

    /**
     * Function: Inserting and Validating
     * Description: Validate Incoming data from user, send sms next is
     *              insert the data in database
     * @return array validation_errors
     * @return json with error codes and messages
     */
    public function register_user()
    {

        $validate = $this->validate([
            'user_id' => [
                'label' => 'User Id',
                'rules' => 'required',
                'errors' => [
                    'required' => 'This is important'
                ]
            ],
            'fname' => [
                'rules' => 'required|alpha_space'
            ],
            'mname' => [
                'rules' => 'required|alpha_space'
            ],
            'lname' => [
                'rules' => 'required|alpha_space'
            ],
            'email' => [
                'rules' => 'permit_empty|valid_email|is_unique[users.email]'
            ],
            'municipality' => [
                'rules' => 'required'
            ],
            'barangay' => [
                'rules' => 'required'
            ],
            'zone' => [
                'rules' => 'required'
            ],
            'number' => [
                'rules' => 'required|regex_match[/^(09)\d{9}$/]|is_unique[users.contact_number]',
                'errors' => [
                    'is_unique' => 'This number has been already registered, please use other number to continue'
                ]
            ],
            'social_pos' => [
                'rules' => 'required'
            ],
            'password' => [
                'rules' => 'required|regex_match[^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$]',
                'errors' => [
                    'regex_match' => 'Password must atleast 6 characters, include uppercase, lowercase and number'
                ]
            ]
        ]);

        if (!$validate) {
            // return array of errors to ajax
            return json_encode([
                'code' => 0,
                'errors' => $this->validation->getErrors()
            ]);
        }


        $generated_code = $this->request->getPost('user_id');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);


        // number formater if need to start +63
        // $formated_number = $this->number_formater
        //     ->format_number($this->request->getPost('number'));

        // get the inputed data from the register form page 
        // arranged to an array for inserting to database
        $c_number = $this->request->getPost('number');
        $fname = $this->request->getPost('fname');
        $mname = $this->request->getPost('mname');
        $lname = $this->request->getPost('lname');
        $social_pos = $this->request->getPost('social_pos');

        $user_data = [
            'code_id'           => $this->request->getPost('user_id'),
            'fname'             => ucwords($fname),
            'mname'             => ucwords($mname),
            'lname'             => ucwords($lname),
            'municipality'      => ucwords(strtolower($this->request->getPost('municipality'))),
            'barangay'          => ucwords(strtolower($this->request->getPost('barangay'))),
            'zone_street'       => ucwords(strtolower($this->request->getPost('zone'))),
            'contact_number'    => $c_number,
            'email'             => $this->request->getPost('email'),
            'social_pos'        => $social_pos,
            'password'          => $password
        ];

        $message = "Pangalan: {$fname} {$mname} {$lname}\n";
        $message .= "Ang iyong userid: {$generated_code} \n";
        $message .= "Gamitin ang user id sa paglogin";

        // //TODO: enable this later
        // $sms_response = $this->send_sms->sendSMS($c_number, $message);

        // // if sms is not sent execute this code

        // if ($sms_response['code'] == 0) {
        //     return json_encode([
        //         'code' => 3,
        //         'msg' => 'You cant Register right now, please try again later',
        //         'sms_res' => $sms_response['message']
        //     ]);
        // }

        //insert user data into Database
        $this->user_model->insert($user_data);

        return json_encode([
            'code' => 1,
            'msg' => "We sent a message to your number: {$c_number} \n {$message}",
            // 'sms_res' => $sms_response['message']
        ]);
    }

    public function dashboard()
    {
        $data['approved'] = $this->client_appointment->get_approved_appointment();
        $data['pending'] = $this->client_appointment->get_pending_appointment();

        $user_id = $this->session->get('id');
        // $user_id = isset($_GET["id"]) ? $_GET["id"] : 1;
        $data['myAppointment'] = $this->userAppointment->get_passed_appointment($user_id);
        $data['user'] = $this->user_model->get_user_info($user_id);
        return view("end-user/dashboard/dashboard", $data);
    }

    /**
        TITLE: Get overall users and active users and online realtime
     *  description: this fucntion get all this at once from the model
     *               so it can be called using ajax to update in realtime in
     *               the admin display
     */
    public function get_realtime_users(){
        $total_active = $this->user_model->count_active_users();
        $total_reg_users = $this->user_model->count_all_users();
        $total_online_users = $this->user_model->count_online_users();

        return json_encode([
            'active' => $total_active,
            'registered' => $total_reg_users,
            'online' => $total_online_users
        ]);
    }


    ///
    public function employee_status()
    {
        return view('end-user/dashboard/employee-status');
    }
}
