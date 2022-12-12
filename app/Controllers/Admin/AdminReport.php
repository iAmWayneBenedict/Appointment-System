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
        $this->option = new \Dompdf\Options();
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
        $year = $this->request->getPost('year');

        $results = $this->report_model->get_report_data(
            $from_date,
            $to_date,
            $social_pos,
            $purpose,
            $state,
            $year
        );
        
        // return json_encode($from_date);

        // return $results;
        $data['results'] = $results['results'];
        $data['state'] = $results['states'];
        $data['total_appointment'] = $this->report_model->get_total_appointments();
        $data['from_result'] = $results['count'];
        $data['report'] = $results['analytics'];
        $data['purpose'] = $results['purposes'];
        $data['date_today'] = date('F d, Y g:i A', strtotime('now'));
        // $data['test'] = $results['test'];

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
        $year = $this->request->getPost('year');

        $results = $this->report_model->get_report_data(
            $from_date,
            $to_date,
            $social_pos,
            $purpose,
            $state,
            $year
        );

        
        $data = [
            'results'     => $results['results'],
            'state'       => array($results['states']),
            'from_result' => array($results['count']),
            'total_appointment' => $this->report_model->get_total_appointments(),
            'date_today'  => date('F d, Y g:i A', strtotime('now'))
        ];

        $date_now = date('m-d-Y', strtotime('now'));

        //html with data
        // $html = view('components/reportPdf', $data);

        $html2 = $this->parser->setData($data)->render('components/reportPdf');

        //parse or process the html to pdf
        $option = $this->pdf->getOptions();
        $option->isRemoteEnabled(TRUE);
       
        
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->loadHtml($html2);
        $this->pdf->setOptions($option);
        //paper size
        $this->pdf->render();
         //FIXME : set to one to auto download
        $this->pdf->stream("appointmentReport{$date_now}.pdf", ["Attachment" => 1]);
    }

    public function sdisplay_preview(){

        $from_date =  $this->request->getPost('sfrom');
        $to_date  =  $this->request->getPost('sto');
        $sub_cat = $this->request->getPost('sub_cats');

        $results = $this->report_model->sget_report_data(
            $from_date,
            $to_date,
            $sub_cat
        );

        $data['sresults'] = $results['sresults'];
        $data['stocks'] = $this->report_model->count_stocks();
        // $data['test'] = $results['test'];

        return view('components/sresults', $data);
    }

    public function screate_pdf(){

        $from_date =  $this->request->getPost('sfrom');
        $to_date  =  $this->request->getPost('sto');
        $sub_cat = $this->request->getPost('sub_cats');

        $results = $this->report_model->sget_report_data(
            $from_date,
            $to_date,
            $sub_cat
        );

        $data = [
            'sresults'     => $results['sresults'],
            'stocks' => $this->report_model->count_stocks(),
            'date_today'  => date('F d, Y g:i A', strtotime('now'))
        ];

        $date_now = date('m-d-Y', strtotime('now'));

        //html with data
        $html = view('components/sreportPdf', $data);

        //parse or process the html to pdf
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->loadHtml($html);
        //paper size
        $this->pdf->render();
        //FIXME : set to one to auto download
        $this->pdf->stream("stocksReport_{$date_now}.pdf", ["Attachment" => 1]);
    }

     
}