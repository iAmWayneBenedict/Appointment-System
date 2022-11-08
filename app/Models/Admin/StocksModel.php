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

    public function insert_stock(array $stocks_data)
    {
        $this->db_conn->table('stocks')
            ->insert($stocks_data);

        return true;
    }

    public function get_all_stocks()
    {
        $query = $this->db_conn->table('stocks')
            ->select('*')
            ->get();

        $data = $query->getResultObject();
        return $data;
    }

    public function get_a_stock_release($stock_id)
    {
        $query = $this->db_conn->table('stocks')
            ->select('*')
            ->join('stock_releaseDate', 'stock_releaseDate.stock_id = stocks.id', 'right')
            ->where('id', $stock_id)
            ->get();

        $data = $query->getRow();
        return $data;
    }

    public function get_a_stock($stock_id)
    {
        $query = $this->db_conn->table('stocks')
            ->select('*')
            ->where('id', $stock_id)
            ->get();

        $data = $query->getRow();
        return $data;
    }

    public function get_all_stocks_release()
    {
        $query = $this->db_conn->table('stocks')
            ->select('*')
            ->join('stock_releaseDate', 'stock_releaseDate.stock_id = stocks.id', 'right')
            ->get();

        $data = $query->getResultObject();
        return $data;
    }

    public function update_stock($stock_id, $stock_data)
    {
        $this->db_conn->table('stocks')
            ->where('id', $stock_id)
            ->update($stock_data);

        $stock_info = $this->get_a_stock($stock_id);

        $this->db_conn->table('stocks')
            ->set('total_quantity', $stock_info->available + $stock_info->allocated)
            ->where('id', $stock_id)
            ->update();

        return true;
    }

    public function delete_stock($stock_id)
    {
        $this->db_conn->table('stocks')
            ->where('id', $stock_id)
            ->delete();

        return true;
    }


    public function set_release_date(array $data)
    {

        $this->db_conn->table('stock_releaseDate')
            ->insert($data);

        return true;
    }

    public function update_release_date($data, $id)
    {

        $this->db_conn->table('stock_releaseDate')
            ->where('stock_id', $id)
            ->update([
                'release_date' => $data
            ]);

        return true;
    }

    public function claiming_stock(array $data, $stock_id, $deduct){

        $query1 = $this->db_conn->table('stocks_availed')
            ->insert($data);

        $quantity = $data['quantity_availed'];

        if($query1){
            if($deduct == 'allocated') {
                $this->db_conn->table('stocks')
                    ->set('allocated', 'allocated-'.$quantity, false)
                    ->set('total_quantity', 'total_quantity-'.$quantity, false)
                    ->where('id', $stock_id)
                    ->update();
                return true;
            }

            $this->db_conn->table('stocks')
                ->set('available', 'available-'.$quantity, false)
                ->set('total_quantity', 'total_quantity-'.$quantity, false)
                ->where('id', $stock_id)
                ->update();
            
            return true;
        }

        return false;
        
    }
}
