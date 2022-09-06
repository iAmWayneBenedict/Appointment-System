<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
// use App\Libraries\ItextMo;
use App\Libraries\OneWaySMS;
use App\Libraries\Email;
use App\Models\Admin\NotificationsModel;

class SendNotifications extends BaseController

{
    protected $send_email;
    protected $send_sms;
    protected $validation;
    protected $notification_model;

    function __construct()
    {
        // Instantiate class from library
        $this->send_email = new Email();
        // $this->send_sms = new ItextMo();
        $this->send_sms = new OneWaySMS();
        $this->validation = \Config\Services::validation();
        $this->notification_model = new NotificationsModel();
    }

    /**
     * function: this is for one by one manual sending sms
     * @param string $number
     * @param string $message
     * @return boolean  
     */
    public function send_sms()
    {

        $validate = $this->validate([
            'number' => [
                'label' => 'Contact Number ',
                'rules' =>  'required|regex_match[/^(09)\d{9}$/]'
            ],
            'message' => [
                'label' => 'Message Body',
                'rules' => 'required'
            ]
        ]);

        if (!$validate) {
            return json_encode([
                'code' => 0,
                'errors' => $this->validation->getErrors()
            ]);
        }

        $contact_number  = $this->request->getPost('number');
        $message = $this->request->getPost('message');
        $message_type = $this->request->getPost('type');

        //single send sms
        if($message_type != 'Send to all'){
           // $response = $this->send_sms->sendSMS($contact_number, $message);
            $response = $this->send_sms->sendSMS($contact_number, $message); 
            print_r($response);
        }

<<<<<<< HEAD
        print_r($response);
=======
        $user_data = $this->notification_model->get_user_data();
        $response_array = []; 
        foreach($user_data as $data){

            sleep(5);//send sms every 5 seconds interval
            $res = $this->send_sms->sendSMS($data['contact_number'], $message);
            array_push($response_array, $res);

        } 
        
        print_r($response_array);

    }

    public function send_email(){

        $validate = $this->validate([
            'email' => [
                'label' => 'Contact Number ',
                'rules' =>  'required|valid_email'
            ],
            'message' => [
                'label' => 'Message Body',
                'rules' => 'required'
            ],
            'subject' => [
                'label' => 'Subject',
                'rules' => 'permit_empty'
            ]
        ]);

        if(!$validate){
            return json_encode([
                'code' => 0,
                'errors' => $this->validation->getErrors()
            ]);
        }

        $email  = $this->request->getPost('email');
        $message = $this->request->getPost('message');
        $subject = $this->request->getPost('subject');
        $message_type = $this->request->getPost('type');

>>>>>>> 2d0e8da (fix sms fucntions)
    }
}
