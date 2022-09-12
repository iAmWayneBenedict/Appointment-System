<?php

namespace App\Controllers\End_Users;

use App\Controllers\BaseController;
use App\Models\Appointment\UserAppointmentModel;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class ClientAppointment extends BaseController {

    protected $userModel;
    protected $userAppointment;
    protected $session;
    protected $validation;
    protected $time;

    function __construct()
    {
        //instantiate
        $this->userModel = new UserModel();
        $this->userAppointment = new UserAppointmentModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->time = new Time();

    }

    public function registered_client(){
        $user_id = $this->session->get('id');
        $basic_data['userData'] = $this->userModel->get_user_info($user_id);

        return view('end-user/appointment/registered', $basic_data);
    }

    public function guest_client(){
        return view('end-user/appointment/guest');
    }

    public function create_appointment($user_type = false){
        
        $validate = $this->validate([
            'name' => [
                'label' => 'Name',
                'rules' => 'required'
            ],
            'address' => [
                'label' => 'Complete Address',
                'rules' => 'required'
            ],
            'c_number' => [
                'label' => 'Contact Number',
                'rules' => 'required|regex_match[/^(09)\d{9}$/]',
            ],
            'social_pos' => [
                'label' => 'Social Position',
                'rules' => 'required'
            ],
            'purpose' => [
                'label' => 'Your Purpose',
                'rules' => 'required'
            ],
            'sched' => [
                'label' => 'Appointment Schedule',
                'rules' => 'required|'
            ],
        ]);

        if(!$validate){
            return json_encode([
                'errors' => $this->validation->getErrors(),
                'code' => 0
            ]);
        }

        //get form data
        $name = $this->request->getPost('name');
        $address = $this->request->getPost('address');
        $contact_number = $this->request->getPost('c_number');
        $social_pos = $this->request->getPost('social_pos');
        $purpose = $this->request->getPost('purpose');
        $schedule = $this->request->getPost('schedule');

        //format date before inserting to database
        $formated_sched = date('Y-m-d H:i:s'); 

        //identify if guest or registered
        $user_id = NULL;
        $_user = 'Guest'; //default, 000
        if($user_type == 001){
            $user_id = $this->session->get('id');
            $_user = 'Registered';
        }

        //organize data for easy inserting to database
        $data = [
            'user_id' => $user_id,
            'name' => $name,
            'address' => $address,
            'contact_number' => $contact_number,
            'social_pos' => $social_pos,
            'purpose' => $purpose,
            'schedule' => $formated_sched,
            'user_type' => $_user
        ];
        
        if(!$this->userAppointment->insert_appointment($data)){
            return json_encode([
                'code' => 0,
                'errors' => 'Sorry!, Please make a try later, Something went worng in our server'
            ]);
        }

        return json_encode([
            'code' => 1,
            'msg' => "Appointment Sent\nPlease wait for a Text message for an update on your appointment"
        ]);




    }


}