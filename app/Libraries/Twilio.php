<?php

namespace App\Libraries;
use Twilio\Rest\Client;

class Twilio {

    protected $_ci;
    protected $_twilioClient;
    protected $mode;
    protected $account_sid;
    protected $auth_token;
    protected $api_version;
    protected $number;


    public function __construct()
    {
        //load config
        $this->_ci = new \Config\SMS();

        //retrieve the values from the config
        $this->account_sid = $this->_ci->account_sid;
        $this->auth_token  = $this->_ci->auth_token;
        $this->number      = $this->_ci->number;
        $this->_twilioClient     = new Client($this->account_sid, $this->auth_token);
    }


    /**
     * func: send message using twilio
     * return: undefine / bool /json or array
     */
    public function sendSMS($to_number, $text_message){

        return $this->_twilioClient->messages->create(
            $to_number,
            [
                'from' => $this->number,
                'body' => $text_message
            ]
        );

        // try{
            // $this->_twilioClient->messages->create(
            //     $to_number,
            //     [
            //         'from' => $this->number,
            //         'body' => $text_message
            //     ];
         
        //     //sent successfully
        //     return "return code or message here";
        //   }catch(Exception $e){
        //     echo $e->getCode() . ' : ' . $e->getMessage()."<br>";
        //   }
    }


}