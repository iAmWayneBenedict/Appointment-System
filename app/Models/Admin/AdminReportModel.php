<?php

namespace App\Models\Admin;

use CodeIgniter\Model;


class AdminReportModel extends Model
{
    protected $db_conn;
    function __construct()
    {
        $this->db_conn = \Config\Database::connect();
    }

    /**
     Function: GET REPORT DATA
     * Description: retrieve report data from database according to what admin want to produced
     *              it it select data using different conditions using where if the param have null of All value
     *              the condition will set to default as select
     *              And simply count the results
     * @param from_date  : starting date or the only month to produced result
     *                     ex: report for Month of July 2022 and or Start from July 2022 to ...
     * @param to_date    : partner of from_date it is the end of range of month
     * @param social_pos : the social positions of clients
     * @param purpose    : appointment purpose or type
     * @param state      : what the outcome of the appointment canceled or done
     * @return array:data: data retrive from database  
     */
    public function get_report_data($from_date, $to_date, $social_pos, $purpose, $state)
    {

        $query = $this->db_conn->table('appointment_report');

        $conditions = [];

        if($social_pos !='All'){
            $conditions['social_pos'] = $social_pos;
        }
        if($purpose != 'All'){
            $conditions['purpose'] = $purpose;
        }
        if($state != 'All'){
            $conditions['state'] = $state;
        }
        if($from_date != NULL){
            $conditions["DATE_FORMAT(schedule, '%Y-%m') >="] = $from_date;

            if($to_date != NULL){
                $conditions["DATE_FORMAT(schedule, '%Y-%m') <="] = $to_date;
            }else{
                $conditions["DATE_FORMAT(schedule, '%Y-%m') <="] = $from_date;
            }
        }

       
        $all_result = $query->select("DATE_FORMAT(schedule, '%M %e, %Y %l:%i %p') as schedule, name, social_pos, purpose, state")
            ->where($conditions);

        
        $data['results'] = $all_result->get()->getResultArray();

        $data['count'] = [
            'all' => $query->where($conditions)->countAllResults(),
            'pending_canceled' => $query->where($conditions)->like('state', 'pending canceled')->countAllResults(),
            'approved_canceled' => $query->where($conditions)->like('state', 'approved canceled')->countAllResults(),
            'done' => $query->where($conditions)->like('state', 'done')->countAllResults(),
            'walkin' => $query->where($conditions)->like('state', 'walk in')->countAllResults(),
            'reject' => $query->where($conditions)->like('state', 'rejected')->countAllResults(),
            'pass' => $query->where($conditions)->like('state', 'passed')->countAllResults(),
        ];

        $state = [
            'pending_canceled' => $query->where('state', 'pending canceled')->countAllResults(),
            'approved_canceled' => $query->where('state', 'approved canceled')->countAllResults(),
            'done' => $query->where('state', 'done')->countAllResults(),
            'walkin' => $query->where('state', 'walk in')->countAllResults(),
            'reject' => $query->where('state', 'rejected')->countAllResults(),
            'pass' => $query->where('state', 'passed')->countAllResults(),
        ];
        
        $data['states'] = $state;
        return $data;
    }



    //Function: Just simply get all appointments recieve by the system
    public function get_total_appointments(){

        $total = $this->db_conn->table('total_appointment_made')
            ->select('*')
            ->get()
            ->getRow();

        return $total->total;
    }

    public static function increment_appointment_made(){
        $db = \Config\Database::connect();
        $db->table('total_appointment_made')
            ->set('total', 'total+1', FAlSE)
            ->update();
        return true;
    }


    public static function insert_report($data){

        $db = \Config\Database::connect();
        $db->table('report_data')
            ->insert($data);

        return true;
    }

}
