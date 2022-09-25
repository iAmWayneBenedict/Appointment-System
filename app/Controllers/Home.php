<?php

namespace App\Controllers;

use App\Libraries\Twilio;

class Home extends BaseController
{
    protected $twilio_sms;

    public function __construct()
    {
        //instanciate the library
        // $this->twilio_sms = new Twilio();
    }


    public function index()
    {
        return view('components/reportPdf');
    }

    public function home()
    {
        return view('home');
    }
    /**
     * function for testing the sms 
     * print te result on the browser for checkup
     */
    public function test_sms()
    {
        $to_number = $this->request->getPost('to_number');
        $message = $this->request->getPost('message');

        // print_r($this->request->getPost());
        // print_r($this->request->getPost());
        // print_r(gettype($this->twilio_sms));
        // echo $to_number . $message;

        $twilio_sms_response = $this->twilio_sms->sendSMS($to_number, $message);
        //experiment what would be the return value of twilio
        print_r($twilio_sms_response);
    }
}
