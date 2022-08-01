<?php

namespace App\Controllers;

use App\Libraries\Twilio;

class Home extends BaseController
{
    protected $twilio_sms;

    public function __construct()
    {
        //instanciate the library
        $this->twilio_sms = new Twilio();
    }

    
    public function index()
    {
        return view('home');
    }

    public function test_sms() {
        $to_number = $this->request->getPost('to_number');
        $message = $this->request->getPost('message');
        
        $twilio_sms_response = $this->twilio_sms->sendSMS($to_number, $message);
        //experiment what would be the return value of twilio
        print_r($twilio_sms_response);
    }
}
