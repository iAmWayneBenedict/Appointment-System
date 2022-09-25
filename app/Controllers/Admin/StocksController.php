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
    public function index()
    {
        return view('admin/stocks');
    }

    public function add_stock()
    {

        $stock_data = [
            'category'          => $this->request->getPost('category'),
            'sub_category'      => $this->request->getPost('sub_category'),
            'total_quantity'    => $this->request->getPost('quantity'),
            'allocated'         => $this->request->getPost('allocated'),
            'available'         => $this->request->getPost('available'),
            'description'       => $this->request->getPost('des')
        ];

        if (!$this->stock_model->insert_stock($stock_data)) {
            return json_encode([
                'msg' => 'stocks cannot insert'
            ]);
        }

        return json_encode($stock_data);
    }

    public function display_stocks()
    {

        $data['stocks'] = $this->stock_model->get_all_stocks();

        return $data;
    }

    public function get_all_stocks()
    {

        $data['stocks'] = $this->stock_model->get_all_stocks();

        return view('components/stock_list', $data);
    }

    public function display_update_form($stock_id = NULL)
    {

        $data['stocks'] = $this->stock_model->get_a_stock($stock_id);
        return view('components/update-stock', $data);
    }

    public function update_stock()
    {

        $stock_id = $this->request->getPost('stock_id');
        $stock_data = [
            'allocated'     => $this->request->getPost('allocated'),
            'available'     => $this->request->getPost('quantity'),
        ];

        $this->stock_model->update_stock($stock_id, $stock_data);
        session()->setFlashdata('success', 'Updated');
        return redirect()->back();
    }

    public function delete_stock($stock_id = NULL)
    {

        $this->stock_model->delete_stock($stock_id);
        session()->setFlashdata('success', 'Deleted');
        return redirect()->back();
    }

    public function get_all_release_dates()
    {

        $data['data'] = $this->stock_model->get_all_stocks_release();
        return json_encode($data);
    }

    public function display_release($stock_id = NULL)
    {

        $data['stocks'] = $this->stock_model->get_a_stock_release($stock_id);
        if ($data['stocks']) {
            return view('components/release-form', $data);
        }
        $data['stocks'] = $this->stock_model->get_a_stock($stock_id);
        return view('components/release-form', $data);
    }

    public function set_release()
    {

        $stock_id = $this->request->getPost('id');
        $set_date = $this->request->getPost('r_date');

        $formated_date = date('Y-m-d', strtotime($set_date));

        if ($this->stock_model->set_release_date([
            'stock_id' => $stock_id,
            'release_date' => $formated_date
        ])) {
            session()->setFlashdata('success', 'Release date set');
            return redirect()->back();
        }

        session()->setFlashdata('invalid', 'Please try again later');
        return redirect()->back();
    }

    public function update_release()
    {

        $stock_id = $this->request->getPost('id');
        $set_date = $this->request->getPost('r_date');

        $formated_date = date('Y-m-d', strtotime($set_date));

        if ($this->stock_model->update_release_date($formated_date, $stock_id)) {
            session()->setFlashdata('success', 'Release Date updated');
            return redirect()->back();
        }

        session()->setFlashdata('invalid', 'Please try again later');
        return redirect()->back();
    }
}
