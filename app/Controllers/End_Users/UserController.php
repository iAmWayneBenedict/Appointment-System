<?php

namespace App\Controllers\End_Users;

use App\Models\UserModel;
use App\Libraries\NumberFormater;
use App\Libraries\OneWaySMS;

use App\Controllers\BaseController;
use App\Controllers\End_Users\ClientAppointment;

class UserController extends BaseController
{
    protected $user_model;
    protected $validation;
    protected $number_formater;
    protected $send_sms;

    function __construct()
    {
        $this->user_model = new UserModel();
        $this->validation = \Config\Services::validation();
        $this->send_sms = new OneWaySMS();
        $this->client_appointment = new ClientAppointment();
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
            'email' => [
                'rules' => 'permit_empty|valid_email|is_unique[users.email]'
            ],
            'name' => [
                'rules' => 'required|alpha_space'
            ],
            'address' => [
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
        $name = $this->request->getPost('name');
        $social_pos = $this->request->getPost('social_pos');

        $user_data = [
            'code_id'           => $this->request->getPost('user_id'),
            'name'              => $name,
            'address'           => $this->request->getPost('address'),
            'contact_number'    => $c_number,
            'email'             => $this->request->getPost('email'),
            'social_pos'          => $social_pos,
            'password'          => $password
        ];

        $message = "Pangalan: {$name}\n";
        $message .= "Ang iyong userid: {$generated_code} \n";
        $message .= "ito ay importante dahil kailangan ito sa pag login sa inyong account";

        // $sms_response = $this->send_sms->sendSMS($c_number, $message);

        //if sms is not sent execute this code
        // if($sms_response['code'] == 0 ){
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
            'msg' => "We sent a message to your number: {$c_number}",
            // 'sms_res' => $sms_response['message']
        ]);
    }

    public function dashboard()
    {
        $data['approved'] = $this->client_appointment->get_approved_appointment();
        $data['pending'] = $this->client_appointment->get_pending_appointment();
        return view('end-user/dashboard/dashboard', $data);
    }
    public function employee_status()
    {
        return view('end-user/dashboard/employee-status');
    }
}
