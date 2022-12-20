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
        $this->url = $this->_config->gw_url2;
    }

    /**
     * func : sample code given by the api provider
     * @return json message and code [0 = fail, 1 = success]
     */
    private function gw_send_sms($user, $pass, $from, $sms_to, $message)
    {

        $query_string = "apiusername=" . $user . "&apipassword=" . $pass;
        $query_string .= "&senderid=" . rawurlencode($from) . "&mobileno=" . rawurlencode($sms_to);
        $query_string .= "&message=" . rawurlencode(stripslashes($message)) . "&languagetype=1";

        //concatinate url and the query string
        $url = "{$this->url}{$query_string}";
        $fd = @implode('', file($url));

        if (!$fd) {
            return [
                'message' => 'no contact with gateway',
                'code'    => 0
            ];
        }

        if ($fd < 0) {
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
     * @Function: Send SMS
     * Description: this is the one to use in controllers to accept input data
     * and send sms
     * @return array contain response code and message from api
     */
    public function sendSMS($contact_number, $message)
    {

        $send = $this->gw_send_sms(
            $this->api_username,
            $this->api_password,
            $this->sms_from,
            $contact_number,
            $message
        );

        return $send;
    }

    /**
     TITLE: bulksms plan A
     * 
     * */
    public function sendBulkSMS(array $contact_numbers, $message){

        $responses = []; //this will hold all response from api
        $array_string_numbers = [];

        // chunk or devide numbers_only array into 10 elements every index 2d array
        $all_contact_numbers = array_chunk($contact_numbers, 10);

        // convert the array contact_numbers group in 10 into 
        // string then store it in new array
        foreach($all_contact_numbers as $contact_number){

            //convert the array into string
            $str_number_by_10 = implode(',', $contact_number);

            array_push($array_string_numbers, $str_number_by_10);
        }

        //loop the array_string_numbers and send sms
        foreach($array_string_numbers as $string_numbers){

            $response = $this->sendSMS($string_numbers, $message);
            array_push($responses, $response);
        }

        return $responses;
    }

    /**
     TITLE: bulksms plan B
     * 
     * */
    public function sendBulkSMSv_2(array $contact_numbers, $message){
        
        //holder for numbers that dont send message
        $unsend_numbers = [];

        //loop all 
        foreach($contact_numbers as $contact_number){
            $response = $this->sendSMS($contact_number, $message);

            //if message not sent to this number then retrieve it
            if($response === 0 ){
                array_push($unsend_numbers, $contact_number);
            }
        }

        //call the function again by itself
        if (!empty($unsend_numbers)){
            $this->sendBulkSMSv_2($unsend_numbers, $message);
        }

        return;

    }
}
