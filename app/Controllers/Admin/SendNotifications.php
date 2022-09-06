<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
// use App\Libraries\ItextMo;
use App\Libraries\OneWaySMS;
use App\Libraries\Email;
use App\Models\Admin\NotificationsModel;
use App\Libraries\NumberFormater;

class SendNotifications extends BaseController

{
    protected $send_email;
    protected $send_sms;
    protected $validation;
    protected $notification_model;
    protected $number_formatter;

    function __construct()
    {
        // Instantiate class from library
        $this->send_email = new Email();
        // $this->send_sms = new ItextMo();
        $this->send_sms = new OneWaySMS();
        $this->validation = \Config\Services::validation();
        $this->notification_model = new NotificationsModel();
        $this->number_formatter = new NumberFormater();
    }

    /**
     * function: this is for one by one manual sending sms
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

        $contact_number  = $this->number_formatter->format_number($this->request->getPost('number'));
        $message = $this->request->getPost('message');

        $response = $this->send_sms->sendSMS($contact_number, $message); 
        return json_encode([
            'code' => 1,
            'msg' => $response
        ]);

    }

    /**
     * func: use to send sms to all registered users
     * @return json response from the api
     */
    public function send_bulk_sms(){

        $validate = $this->validate([
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

        $message = $this->request->getPost('message');

        //get user data
        $user_data = $this->notification_model->get_user_data();

        //make array of contact numbes only selected from user data
        $numbers_only = array_column($user_data, 'contact_number');

        //chunk or devide numbers_only array into 10 elements every index
        $all_contacts = array_chunk($numbers_only, 10);

        //convert chunk array into string separated with comma
        // send bulk messages
        $responses = [];
        foreach($all_contacts as $contacts){

            $str_numbers = implode(',', $contacts);
            //ouput example: "0912345678, 0912353458" 

            $response = $this->send_sms->sendSMS($str_numbers, $message);
            array_push($responses, $response);
            sleep(5);
        }

        return json_encode($responses);

        
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

    }
}
