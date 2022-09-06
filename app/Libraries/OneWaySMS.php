<?php

namespace App\Libraries;

class OneWaySMS
{
    protected $api_username;
    protected $api_password;
    protected $sms_from;
    protected $url;
    protected $_config;

    function __construct()
    {
        //instantiate
        $this->_config = new \Config\SMS();

        $this->api_username = $this->_config->api_username;
        $this->api_password = $this->_config->api_password;
        $this->sms_from = $this->_config->sms_from;
        $this->url = $this->_config->gw_url;
    }

    private function gw_send_sms($user, $pass, $from, $sms_to, $message){

        $query_string = "apiusername=".$user."&apipassword=".$pass;
        $query_string .= "&senderid=".rawurlencode($from)."&mobileno=".rawurlencode($sms_to);
        $query_string .= "&message=".rawurlencode(stripslashes($message)) . "&languagetype=1"; 

        //concat url and the query string
        $url = "{$this->url}{$query_string}";       
        $fd = @implode ('', file ($url));

        if (!$fd) {                       
            return [
                'message' => 'no contact with gateway',
                'code'    => 0
            ];
        }

        if (!$fd > 0) {
            return [
                'message' => "Please refer to API on Error : {$fd}",
                'code'    => 0
            ];
        }        
        
        return [
            'message' => "Success with MT ID : {$fd}",
            'code'    => 1
        ];
    }

    /**
     * function: this is the one to use in controllers
     * @return array contain response code and message from api
     */
    public function sendSMS($contact_number, $message){

        $send = $this->gw_send_sms(
            $this->api_username,
            $this->api_password,
            $this->sms_from,
            $contact_number,
            $message
        );

        return $send;
    }


}