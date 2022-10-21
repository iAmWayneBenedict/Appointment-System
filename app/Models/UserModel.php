<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'code_id',
        'fname',
        'mname',
        'lname',
        'address',
        'contact_number',
        'email',
        'social_pos',
        'password'
    ];

    protected $db_conn;

    function __construct()
    {
        $this->db_conn = \Config\Database::connect();
    }

    /**
        Function: Get all User in Database
     * Description: Use to retrieve all registered user in the database this is for 
     *              admin only to monitor or view all office clients that are registered
     *              to the system
     * @return array : clients data
     */
    public function get_all_users()
    {
        $query = $this->db_conn->table($this->table)
            ->get();


        return $query->getResultArray();
    }

    /**
       Function : GENERATE UNIQUE ID
     * Description: auto generate unique id using 4 digit number concatinate to prev id from
     *              data 
     * @return int:genrated_id
     */
    public function generated_unique_id()
    {
        /**
         * func: generate unique id(serve as user name) base on previous id in database
         * @return int 4 to up digits number
         */

        $generated_id = null;

        $query = $this->db_conn->table($this->table)
            ->select('id')
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get()
            ->getRowArray();

        $id = $query['id'];
        $add_one = $id + 1;

        if (empty($query)) {
            $generated_id = mt_rand(1000, 9999) . 1;
        } else {
            $generated_id = mt_rand(1000, 9999) . $add_one;
        }

        return $generated_id;
    }

    /**
        Function: GET USER INFO
     * Description : Get users information from database and return to controller
     *               get user info base from user'd id
     */
    public function get_user_info($user_id)
    {

        $query = $this->db_conn->table($this->table)
            ->select('*')
            ->where('id', $user_id)
            ->get();

        $data = $query->getRow(); //object

        return $data;
    }

    /**
     * Function: Update Data
     * Description: Udate user's data in database 
     * @param array $data: collection of uuser information
     * @return bool : indicates if update is success or not
     */
    public function update_user_info(array $data, $user_id)
    {

        $this->db_conn->table($this->table)
            ->where('id', $user_id)
            ->update($data);

        return true;
    }

    public function delete_user($user_code_id)
    {

        $this->db_conn->table($this->table)
            ->where('code_id', $user_code_id)
            ->delete();

        return true;
    }

    /**
        Function: LOGIN USERS
     * get the user information for login process
     * return 1 single row(array) data of user
     */
    public function login_users($data_arr)
    {

        $query = $this->db_conn->table($this->table)
            ->select('id, code_id, password')
            ->where('code_id', $data_arr['code_id'])
            ->where('account_stats', 1)
            ->get();
        $data = $query->getRow(); //object
        return $data;
    }

    public function deactivate($user_id)
    {

        $this->db_conn->table($this->table)
            ->where('id', $user_id)
            ->update([
                'account_stats' => 0
            ]);

        return true;
    }

    public function deactivate_admin_side($user_code_id)
    {

        $this->db_conn->table($this->table)
            ->where('code_id', $user_code_id)
            ->update([
                'account_stats' => 0
            ]);

        return true;
    }
}
