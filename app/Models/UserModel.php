<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'name',
        'email',
        'number',
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

    public function get_user_info($user_id){
        //this is for the reminder page 
        $db = \Config\Database::connect();

        $query = $db->table('users')
            ->select('user_id, name, identity')
            ->where('user_id', $user_id)
            ->get();

        $data = $query->getRowArray();

        return $data;
    }

    public function login_users($data_arr){
        $db = \Config\Database::connect();

        $query = $db->table('users')
            ->select('user_id, password')
            ->where('user_id', $data_arr['user_id'])
            ->get();
        $data = $query->getRow();
        return $data;
    }
}