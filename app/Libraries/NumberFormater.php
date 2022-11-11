<?php

namespace App\Libraries;

class NumberFormater
{

    public function format_number($number){
        $number = str_split($number);
        $format = '+63';

        $number[0] = $format;

        $formated_number = implode('', $number);

        return $formated_number;  
    }

}

