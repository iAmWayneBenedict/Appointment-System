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

    /**
     Function: DISPLAY PREVIEW FROM FILTERS
     * Description: this function display the data base from what the admin choose
     *              in the filter page as prview of what will be the content of the 
     *              pdf.
     * @return view
     */
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

    /**
     Function : CREATE PDF
     * Description: This is the process of making the pdf just like the display preview 
     *              it just return a pdf file using dompdf from html, admin can download the 
     *              file.
     * @return pdf
     */
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

        //html with data
        $html = view('components/reportPdf', $data);

        //parse or process the html to pdf
        $this->pdf->loadHtml($html);
        //paper size
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream('test.pdf', ["Attachment" => 0]);
    }

     
}