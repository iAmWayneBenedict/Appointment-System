<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\StocksModel;

class StocksController extends BaseController
{
    private $stock_model;

    function __construct()
    {
        $this->stock_model = new StocksModel();
    }
    public function index(){
        return view('admin/stocks');
    }

    public function add_stock(){

        $stock_data = [
            'category'          => $this->request->getPost('category'),
            'sub_category'      => $this->request->getPost('sub_category'),
            'total_quantity'    => $this->request->getPost('quantity'),
            'allocated'         => $this->request->getPost('allocated'),
            'available'         => $this->request->getPost('available'),
            'description'       => $this->request->getPost('des')
        ];
        
        if(!$this->stock_model->insert_stock($stock_data)){
            return json_encode([
                'msg' => 'stocks cannot insert'
            ]);
        }

        return json_encode($stock_data);

    }

    public function display_stocks(){

        $data['stocks'] = $this->stock_model->get_all_stocks();

        return view('components/stock_list', $data);
    }

    public function display_update_form($stock_id = NULL){

        $data['stocks'] = $this->stock_model->get_a_stock($stock_id);
        return view('components/update-stock', $data);
    }

    public function update_stock(){

        $stock_id = $this->request->getPost('stock_id');
        $stock_data = [
            'allocated'     => $this->request->getPost('allocated'),
            'available'     => $this->request->getPost('quantity'),
        ];

        $this->stock_model->update_stock($stock_id, $stock_data);
        session()->setFlashdata('success', 'Updated');
        return redirect()->back();
    }

    public function delete_stock($stock_id = NULL){
        
        $this->stock_model->delete_stock($stock_id);
        session()->setFlashdata('success', 'Deleted');
        return redirect()->back();
    }
}