<?php

namespace App\Libraries;

class Email {

    protected $email_sender;
    private $html_parser;

    function __construct()
    {
        $this->email_sender = \Config\Services::email();
        $this->html_parser = \Config\Services::parser();
    }

    public function send_email($receiver, $message, $subject){

        /**
         * incase we need to use format or designed email body 
            remove the slash to use or uncomment
            the $email_body
               | |
               | |
               V V
        */
        // $email_body = $this->html_parser->setData(['message' => $message])
        //     ->render('components/filename');

        $this->email_sender->setFrom('jccd0724@gmail.com', 'Agriculture Office of Bato');
        $this->email_sender->setTo($receiver);
        $this->email_sender->setSubject($subject);
        
        //plain text message
        $this->email_sender->setMessage($message);

        /**
         * or use this if you uncomment the $email_body
         * it render designed html email message
               | |
               | |
               V V
         */
        //$this->email_sender->setMessage($email_body);

        if(!$this->email_sender->send()){
            log_message('debug', $this->email_sender->printDebugger(['headers']));
            return false;
        }

        return true;
    }
}