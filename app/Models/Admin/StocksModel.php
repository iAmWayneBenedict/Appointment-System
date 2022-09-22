<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class StocksModel extends Model
{

    protected $db_conn;

    function __construct()
    {
        $this->db_conn = \Config\Database::connect();
    }

    public function insert_stock(array $stocks_data){
        $this->db_conn->table('stocks')
            ->insert($stocks_data);

        return true;
    }

    public function get_all_stocks(){
        $query = $this->db_conn->table('stocks')
            ->select('*')
            ->get();

        $data = $query->getResultObject();
        return $data;
    }

    public function get_a_stock($stock_id){
        $query = $this->db_conn->table('stocks')
            ->select('*')
            ->join('stock_releaseDate', 'stock_releaseDate.stock_id = stocks.id', 'right')
            ->where('id', $stock_id)
            ->get();

        $data = $query->getRow();
        return $data;
    }

    public function update_stock($stock_id, $stock_data){
        $this->db_conn->table('stocks')
            ->where('id', $stock_id)
            ->update($stock_data);

        return true;
    }

    public function delete_stock($stock_id){
        $this->db_conn->table('stocks')
            ->where('id', $stock_id)
            ->delete();

        return true;
    }


    public function set_release_date(array $data){

        $this->db_conn->table('stock_releaseDate')
            ->insert($data);

        return true;
    }

    public function update_release_date($data, $id){

        $this->db_conn->table('stock_releaseDate')
            ->where('stock_id', $id)
            ->update([
                'release_date' => $data
            ]);

        return true;
    }
}