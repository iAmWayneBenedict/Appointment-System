<?php

namespace App\Libraries;

class ItextMo {

    protected $api_code;
    protected $itextMo_password;
    protected $itextMo_url;

    function __construct()
    {
        //load config
        $this->_ci = new \Config\SMS();

        $this->api_code = $this->_ci->api_code;
        $this->itextMo_password = $this->_ci->itextMo_password;
        $this->itextMo_url = $this->_ci->itextMo_url;
    }

    //itext mo sample code for sending sms
    private function itexmo($number, $message, $apicode, $passwd)
    {
        $url = $this->itextMo_url;
        $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
        $param = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($itexmo),
            ),
        );
        $context  = stream_context_create($param);

        return file_get_contents($url, false, $context);
    }

    /**
     * function to use in controllers
     */
    public function sendSMS($contact_number, $message){

        return $this->itexmo(
            $contact_number, 
            $message, 
            $this->api_code, 
            $this->itextMo_password
        );
    }
    
    
    
}