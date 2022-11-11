<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\StocksModel;
use App\Libraries\greetings;
use App\Libraries\OneWaySMS;
use App\Models\Admin\NotificationsModel;
use App\Libraries\OnAppNotification;

class StocksController extends BaseController
{
    private $stock_model;
    private $sms;
    private $notif_model;
    private $on_app_notif;

    function __construct()
    {
        $this->stock_model = new StocksModel();
        $this->greet = new greetings();
        $this->sms = new OneWaySMS();
        $this->notif_model = new NotificationsModel();
        $this->on_app_notif = new OnAppNotification();
    }

    public function index()
    {
        return view('admin/stocks');
    }

    /**
     Function: ADD / INSERT STOCKS
     * Description: this is to add stocks on invetory
     */
    public function add_stock()
    {
        // TODO : update to server
        $stock_data = [
            'admin_id'          => $this->session->get('admin_id'),
            'category'          => ucwords($this->request->getPost('category')),
            'sub_category'      => ucwords($this->request->getPost('sub_category')),
            'total_quantity'    => $this->request->getPost('quantity'),
            'allocated'         => $this->request->getPost('allocated'),
            'available'         => $this->request->getPost('available'),
            'description'       => $this->request->getPost('des'),
            'per_type'          => $this->request->getPost('per_type')
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

        $data = $this->stock_model->get_all_stocks();
        $subcats = array_column($data, 'sub_category');
        return json_encode($subcats); 
    }

    public function get_all_stocks()
    {

        $data['stocks'] = $this->stock_model->get_all_stocks();

        return view('components/stock_list', $data);
    }

    public function get_all_stock()
    {

        $data['stocks'] = $this->stock_model->get_all_stocks();

        return json_encode($data);
    }

    public function display_update_form($stock_id = NULL)
    {

        $data['stocks'] = $this->stock_model->get_a_stock($stock_id);
        return view('components/update-stock', $data);
    }

    public function display_claim_form($stock_id = NULL)
    {
        $data['stocks'] = $this->stock_model->get_a_stock($stock_id);
        return view('components/claimed-by', $data);
    }

    /**
     Function: UPDATE STOCK
     * Description : update the quantity of allocated and available stocks
     *               it can be add or minus
     */
    public function update_stock()
    {

        $stock_id = $this->request->getPost('stock_id');
        $stock_data = [
            'allocated'     => $this->request->getPost('allocated'),
            'available'     => $this->request->getPost('quantity'),
        ];

        $this->stock_model->update_stock($stock_id, $stock_data);
        session()->setFlashdata('success', 'Updated');
        return redirect('admin/dashboard/stock-management');
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

    public function stocks_monitor()
    {
        return view('end-user/dashboard/stocks-monitor');
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

    /**
     Fucntion: SET RELEASE DATE
     * Description: admin set release date this will insert the date into db
     *              then send sms and app notifications
     */
    public function set_release()
    {

        $stock_id = $this->request->getPost('id');
        $set_date = $this->request->getPost('r_date');

        $formated_date = date('Y-m-d', strtotime($set_date));


        if ($this->stock_model->set_release_date([
            'stock_id' => $stock_id,
            'release_date' => $formated_date
        ])) {

            $stock_data = $this->stock_model->get_a_stock_release($stock_id);
            $r_date = date('F j, Y', strtotime($stock_data->release_date));

            $message = "{$this->greet->greet()}, This is Agriculture office of Bato \n";
            $message .= "Update Stock Release for {$stock_data->category} : {$stock_data->sub_category} \n";
            $message .= "Release Date: {$r_date}, available stocks: {$stock_data->available}";
            $message .= "Given as: {$stock_data->per_type}";


            $user_data = $this->notif_model->get_user_data();

            //make array of contact numbes only selected from user data
            $numbers_only = array_column($user_data, 'contact_number');
            $user_ids = array_column($user_data, 'id');

            //TODO: enable this after 100%
            //send sms

            // $this->sms->sendBulkSMS($numbers_only, $message);

            //send on app
            $this->on_app_notif->send_bulk_notification($user_ids, $message);

            session()->setFlashdata('success', 'Release Date Set');
            return redirect()->back();
        }

        session()->setFlashdata('invalid', 'Please try again later');
        return redirect()->back();
    }

    /**
     Function UPDATE RELEASE DATE
     * description: admin can update set release date same as set release it will send 
     *              an sms and on app notification to all registered clients
     */
    public function update_release()
    {

        $stock_id = $this->request->getPost('id');
        $set_date = $this->request->getPost('r_date');

        $formated_date = date('Y-m-d', strtotime($set_date));

        if ($this->stock_model->update_release_date($formated_date, $stock_id)) {


            $stock_data = $this->stock_model->get_a_stock_release($stock_id);
            $r_date = date('F j, Y', strtotime($stock_data->release_date));

            $message = "{$this->greet->greet()}, This is Agriculture office of Bato \n";
            $message .= "Update Stock Release for {$stock_data->category} : {$stock_data->sub_category} \n";
            $message .= "Release Date: {$r_date}, available stocks: {$stock_data->available}";

            $user_data = $this->notif_model->get_user_data();

            //make array of contact numbes only selected from user data
            $numbers_only = array_column($user_data, 'contact_number');
            $user_ids = array_column($user_data, 'id');

            //TODO: enable this after 100%
            //send sms
            // $this->sms->sendBulkSMS($numbers_only, $message);

            //send on app
            $this->on_app_notif->send_bulk_notification($user_ids, $message);

            session()->setFlashdata('success', 'Release Date Updated');
            return redirect()->back();
        }

        session()->setFlashdata('invalid', 'Please try again later');
        return redirect()->back();
    }

    public function insert_availer()
    {

        $data = [
            'stock_id'   => $this->request->getPost('id'),
            'avail_by'   => $this->request->getPost('claim_by'),
            'quantity_availed' => $this->request->getPost('quantity')
        ];

        $deduct = $this->request->getPost('deduct');
        $res = $this->stock_model->claiming_stock($data, $data['stock_id'], $deduct);

        if (!$res) {
            return json_encode([
                'code' => 0,
                'msg' => 'Please try Again Later'
            ]);
        }

        return json_encode([
            'code' => 1,
            'msg' => 'Stock Claimer Inserted'
        ]);
    }
}
