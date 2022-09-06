<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
// use App\Libraries\ItextMo;
use App\Libraries\OneWaySMS;
use App\Libraries\Email;

class SendNotifications extends BaseController

{
    protected $send_email;
    protected $send_sms;
    protected $validation;

    function __construct()
    {
        // Instantiate class from library
        $this->send_email = new Email();
        // $this->send_sms = new ItextMo();
        $this->send_sms = new OneWaySMS();
        $this->validation = \Config\Services::validation();
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
                'rules' =>  'required'
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

        // $response = $this->send_sms->sendSMS($contact_number, $message);
        $response = $this->send_sms->sendSMS($contact_number, $message);

        print_r($response);
    }
}
