<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'code_id',
        'name',
        'address',
        'contact_number',
        'email',
        'identity',
        'password' 
    ];

    
    public static function generated_unique_id(){
        /**
         * func: generate unique id(serve as user name) base on previous id in database
         * return: int 7 digits number
         */
        $db = \Config\Database::connect();

        $generated_id = null;

        $query = $db->table('users')
            ->select('id')
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get()
            ->getRowArray();
        
        if(empty($query)){
            $generated_id = mt_rand(1000, 9999) . 1;
        }
        else{
            $generated_id = mt_rand(1000, 9999) . $query['id'] + 1;
        }

        return $generated_id;
    }

    public function get_user_info($code_id){
        //this is for the reminder page 
        $db = \Config\Database::connect();

        $query = $db->table('users')
            ->select('*')
            ->where('code_id', $code_id)
            ->get();

        $data = $query->getRowArray(); //array

        return $data;
    }

    /**
     * get the user information for login process
     * return 1 single row(array) data of user
     */
    public function login_users($data_arr){
        $db = \Config\Database::connect();

        $query = $db->table('users')
            ->select('id, code_id, password')
            ->where('code_id', $data_arr['code_id'])
            ->get();
        $data = $query->getRow();//object
        return $data;
    }
}