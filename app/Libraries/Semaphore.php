<?php

namespace App\Libraries;
use Semaphore\SemaphoreClient;


class Semaphore{

    protected $semaphore_api;
    protected $_ci;

    function __construct()
    {
        $this->_ci = new \Config\SMS();
        $this->semaphore_api = $this->_ci->semaphore_api;
    }

    public function sendSMS(string $number, $message){

        $ch = curl_init();
        $parameters = array(
            'apikey' => $this->semaphore_api, //Your API KEY
            'number' => $number,
            'message' => $message,
            'sendername' => 'SEMAPHORE'
        );
        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
        curl_setopt( $ch, CURLOPT_POST, 1 );

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);

        //Show the server response
        return $output;
    }
}