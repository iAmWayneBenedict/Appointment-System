<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminReportModel;
class AdminReport extends BaseController
{

    protected $parser;
    protected $pdf;
    protected $report_model;
    protected $pdf_model;

    function __construct()
    {
        $this->report_model = new AdminReportModel();
        $this->parser = \Config\Services::parser();
        $this->pdf = new \Dompdf\Dompdf(); 
    }

    public function report_template(){
        return view('admin/report');
    }

    public function display_preview(){

        $from_date =  $this->request->getPost('from_date');
        $to_date  =  $this->request->getPost('to_date');
        $social_pos  =  $this->request->getPost('social_pos');
        $purpose =  $this->request->getPost('purpose');
        $state  =  $this->request->getPost('state');

        $results = $this->report_model->get_report_data(
            $from_date,
            $to_date,
            $social_pos,
            $purpose,
            $state
        );

        $data['results'] = $results['results'];
        $data['total_appointment'] = $this->report_model->get_total_appointments();
        $data['from_result'] = $results['count'];

        return view('components/results', $data);
    }

    public function create_pdf(){

        $from_date =  $this->request->getPost('from_date');
        $to_date  =  $this->request->getPost('to_date');
        $social_pos  =  $this->request->getPost('social_pos');
        $purpose =  $this->request->getPost('purpose');
        $state  =  $this->request->getPost('state');

        $results = $this->report_model->get_report_data(
            $from_date,
            $to_date,
            $social_pos,
            $purpose,
            $state
        );

        $data = [
            'results'     => $results['results'],
            'total_appointment' => $this->report_model->get_total_appointments(),
            'from_result' => $results['count'],
            'date_today'  => date('F d, Y g:i A', strtotime('now'))
        ];


        $html = view('components/reportPdf', $data);

        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream('test.pdf', ["Attachment" => 0]);
    }

     
}