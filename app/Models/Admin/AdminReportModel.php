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
    public function get_report_data($from_date, $to_date, $social_pos, $purpose, $state, $year)
    {
        /**
         * set year to deafualt as current year
         * and if year is not null then set selected year to submitted year
         */
        if(!empty($year)){
            $selected_year = $year;
        }else{
            $selected_year = date('Y', strtotime('now'));
        }

        // return "{$selected_year}-{$from_date}";

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
        if($from_date != NULL and !empty($year)){
            
            $conditions["DATE_FORMAT(schedule, '%Y-%m') >="] = "{$selected_year}-{$from_date}";

            if($to_date != NULL){
                $conditions["DATE_FORMAT(schedule, '%Y-%m') <="] = "{$selected_year}-{$to_date}";
            }else{
                $conditions["DATE_FORMAT(schedule, '%Y-%m') <="] = "{$selected_year}-{$from_date}";
            }
        }
        elseif($from_date != NULL and empty($year)){

            $conditions["DATE_FORMAT(schedule, '%Y-%m') >="] = "{$selected_year}-{$from_date}";

            if($to_date != NULL){
                $conditions["DATE_FORMAT(schedule, '%Y-%m') <="] = "{$selected_year}-{$to_date}";
            }else{
                $conditions["DATE_FORMAT(schedule, '%Y-%m') <="] = "{$selected_year}-{$from_date}";
            }
        }
        else{
            $conditions["DATE_FORMAT(schedule, '%Y') ="] = $selected_year;
        }


       
        $all_result = $query->select("DATE_FORMAT(schedule, '%M %e, %Y %l:%i %p') as schedule, name, social_pos, purpose, state")
            ->where($conditions);

        //appointment summary
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
         //appointment state
        $state = (array) [
            "pending_canceled" => $query->where('state', 'pending canceled')->countAllResults(),
            'approved_canceled' => $query->where('state', 'approved canceled')->countAllResults(),
            'done' => $query->where('state', 'done')->countAllResults(),
            'walkin' => $query->where('state', 'walk in')->countAllResults(),
            'reject' => $query->where('state', 'rejected')->countAllResults(),
            'pass' => $query->where('state', 'passed')->countAllResults(),
        ];

        //apointment purposes
        $data['purposes'] = [
            'RSBSA' => $query->where($conditions)->like('purpose', 'RSBSA (Registry System for Basic Sector in Agriculture)')->countAllResults(),
            'RMF' => $query->where($conditions)->like('purpose', 'Registration of Municipal Fisherfolks')->countAllResults(),
            'PCIC' => $query->where($conditions)->like('purpose', 'Processing of Crop Insurance (PCIC Program)')->countAllResults(),
            'DFI' => $query->where($conditions)->like('purpose', 'Distribution of Farm Inputs')->countAllResults(),
            'BR' => $query->where($conditions)->like('purpose', 'Boat Registration')->countAllResults(),
        ];
        
        $data['states'] = $state;
        
        //data for analytics appointments per month
        $data['analytics'] = $this->get_analytics($selected_year);
        return $data;
    }

    //Function: Just simply get all appointments recieve by the system
    public function get_total_appointments(){

        $total = $this->db_conn->table('set_appointments')
            ->select('*')
            ->countAllResults();

        return $total;
    }

    public static function insert_report($data){

        $db = \Config\Database::connect();
        $db->table('report_data')
            ->insert($data);

        return true;
    }

    public function sget_report_data($from_date, $to_date, $sub_cat)
    {

        $query = $this->db_conn->table('stock_report');

        $conditions = [];

        if($sub_cat !='All'){
            $conditions['sub_category'] = $sub_cat;
        }
        if($from_date != NULL){
            $conditions["DATE_FORMAT(date, '%Y-%m') >="] = $from_date;

            if($to_date != NULL){
                $conditions["DATE_FORMAT(date, '%Y-%m') <="] = $to_date;
            }else{
                $conditions["DATE_FORMAT(date, '%Y-%m') <="] = $from_date;
            }
        }

       
        $all_result = $query->select("DATE_FORMAT(date, '%M %e, %Y %l:%i %p') as date, sub_category, per_type, avail_by, quantity_availed")
            ->where($conditions);

        
        $data['sresults'] = $all_result->get()->getResultArray();
        return $data;
    }

    public function count_stocks(){

        $data = $this->db_conn->table('stocks')
            ->select('*')
            ->get()
            ->getResultArray();

        return $data;
    }

    //get appointments per month
    public function get_analytics($year){

        $query = $this->db_conn->table('set_appointments');

        $condition["DATE_FORMAT(schedule, '%Y')"] = $year ;
        
        $data = [
            'Jan.' => $query->where($condition)->like("EXTRACT(month FROM schedule)", '01')->countAllResults(),
            'Feb.' => $query->where($condition)->like("EXTRACT(month FROM schedule)", '02')->countAllResults(),
            'Mar.' => $query->where($condition)->like("EXTRACT(month FROM schedule)", '03')->countAllResults(),
            'Apr.' => $query->where($condition)->like("EXTRACT(month FROM schedule)", '04')->countAllResults(),
            'May.' => $query->where($condition)->like("EXTRACT(month FROM schedule)", '05')->countAllResults(),
            'Jun.' => $query->where($condition)->like("EXTRACT(month FROM schedule)", '06')->countAllResults(),
            'Jul.' => $query->where($condition)->like("EXTRACT(month FROM schedule)", '07')->countAllResults(),
            'Aug.' => $query->where($condition)->like("EXTRACT(month FROM schedule)", '08')->countAllResults(),
            'Sep.' => $query->where($condition)->like("EXTRACT(month FROM schedule)", '09')->countAllResults(),
            'Oct.' => $query->where($condition)->like("EXTRACT(month FROM schedule)", '10')->countAllResults(),
            'Nov.' => $query->where($condition)->like("EXTRACT(month FROM schedule)", '11')->countAllResults(),
            'Dec.' => $query->where($condition)->like("EXTRACT(month FROM schedule)", '12')->countAllResults(),
        ];
        return $data;

    }

}
