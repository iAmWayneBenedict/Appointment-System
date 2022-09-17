<?php

namespace App\Libraries;

use CodeIgniter\I18n\Time;

class greetings {

    protected $time;

    function __construct(){
        $this->time = new Time();
    }

    /**
     * Function: make greeting
     * Description: Return a greeting base from current time it will be used
     * @return string : greetings
     */
    public function greet(){
        $time_now = $this->time::now('Asia/Manila');
        $time_parse = $this->time::parse($time_now);
        $Hour = $time_parse->getHour();


        if ( $Hour >= 5 && $Hour <= 11 ) {
            return "Good Morning, ";
        } else if ( $Hour >= 12 && $Hour <= 18 ) {
            return "Good Afternoon, ";
        } else if ( $Hour >= 19 || $Hour <= 4 ) {
            return "Good Evening, ";
        }
    }
}