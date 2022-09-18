<?php 

namespace App\Libraries;

class DeEncrypter {

    protected $encrypter;

    function __construct()
    {
        $this->encrypter = \Config\Services::encrypter();
    }

    public function encrypt_text(string $data){
        $encrpyted_data = $this->encrypter->encrypt($data);

        return $encrpyted_data;
    }

    public function decrypter(string $data){
        $decrpyted_data = $this->encrypter->decrypt($data);

        return $decrpyted_data;
    }
}