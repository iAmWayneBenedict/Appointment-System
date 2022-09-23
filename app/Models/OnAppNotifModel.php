<?php 

namespace App\Models;

use CodeIgniter\Model;

class OnAppNotifModel extends Model
{
    protected $db_conn;
    protected $table = 'app_notification';

    function __construct()
    {
        $this->db_conn = \Config\Database::connect();
    }

    /**
     * Function: Insert message(send)
     * Description: This is use to insert messages to database table
     * @param array_data : this is the message body to been by clients
     * @return boolean true or false
     */
    public function insert_message(array $data){

        $this->db_conn->table($this->table)
            ->insert($data);
        return true;
    }

    /**
     * Function: Update
     * Description: Update the status of message this will indicate the if the message
     *              is already read or not
     * @param nootification_id : unique number per message
     */
    public function update_status($notification_id){

        $this->db_conn->table($this->table)
            ->where('id', $notification_id)
            ->update([
                'status' => 1
            ]);
        return true;
    }

    /**
     * Function: Delete
     * description: This is to permanently delete app notification
     * @param nootification_id : unique number per message
     */
    public function delete_notification($notification_id){

        $this->db_conn->table($this->table)
            ->where('id', $notification_id)
            ->delete();
        return true;
    }

    public function get_notifications($client_id){

        $query = $this->db_conn->table($this->table)
            ->select('*')
            ->where('user_id', $client_id)
            ->get();
        
        $data = $query->getResultObject();
        return $data;
    }
}