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
        $this->number_formatter = new NumberFormater();

        $this->validation = \Config\Services::validation();
        $this->notification_model = new NotificationsModel();
    }

    /**
     Function: this is for one by one manual sending sms
     * @return json 
     */
    public function send_sms()
    {

        $validate = $this->validate([
            'number' => [
                'label' => 'Contact Number ',
                'rules' => 'required|regex_match[/^(09)\d{9}$/]',
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

        $response = $this->send_sms->sendSMS($contact_number, $message);
        return json_encode($response);
    }

    /**
     * Function: use to send sms to all registered users
     * @return json response from the api
     */
    public function send_bulk_sms()
    {

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

        $message = $this->request->getGet('message');

        //get user data
        $user_data = $this->notification_model->get_user_data();

        //make array of contact numbes only selected from user data
        $numbers_only = array_column($user_data, 'contact_number');

        $responses = $this->send_sms->sendBulkSMSv_2($numbers_only, $message);


        return json_encode($responses);
    }

    /**
     * Function: Send Email
     * @return json
     */
    public function send_email()
    {

        $validate = $this->validate([
            'email' => [
                'label' => 'Email ',
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

        if (!$validate) {
            return json_encode([
                'code' => 0,
                'error' => $this->validation->getErrors()
            ]);
        }

        $email  = $this->request->getPost('email');
        $message = $this->request->getPost('message');
        $subject = $this->request->getPost('subject');

        $response = $this->send_email->send_email($email, $message, $subject);

        if (!$response) {
            return json_encode([
                'code' => 0,
                'error' => ['msg' => 'Email not Sent']
            ]);
        }

        return json_encode([
            'code' => 1,
            'msg' => 'Email sent'
        ]);
    }
}
