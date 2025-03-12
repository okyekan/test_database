<?php

defined('BASEPATH') or exit('No direct script access allowed');

class log_book extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("log_book_model");
        $this->load->library('form_validation');
        $this->load->library('pdf');
        $this->load->library('excel');
        $this->load->helper('function_helper');
    }
    public function index()
    {
        $this->load->view("skin");
    }
    public function ViewPage()
    {
        (null != $this->input->post('offset')) ? $offset = $this->input->post('offset') : $offset = 0;
        (null != $this->input->post('limit')) ? $limit = $this->input->post('limit') : $limit = 5;
        $data['limit'] = $limit;
        $data['all_data'] = $this->log_book_model->TampilData($limit, $offset);
        $data['pagination'] = GeneratePagination($this->log_book_model->CountData(), $limit, $offset);
        $this->load->view("tabel_log_book", $data);
    }
    public function Hapus()
    {
        $id = $this->input->post();
        $this->log_book_model->delete($id);
    }
    public function Cetak_Data()
    {
        $data['aksi'] = "Cetak";
        $this->load->view("pop_up_cetak_log_book", $data);
    }
    public function CetakPDF($tgl1 = '', $tgl2 = '')
    {
        $filter = array(
            "tgl1" => $tgl1,
            "tgl2" => $tgl2
        );
        $pdf = new FPDF();
        $pdf->AddPage('L', 'A4');
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 7, 'Data Log Book', 0, 1, 'L');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'No', 1, 0);
        $pdf->Cell(40, 6, 'Waktu', 1, 0);
        $pdf->Cell(50, 6, 'Akun', 1, 0);
        $pdf->Cell(100, 6, 'Log', 1, 0);
        $pdf->Cell(30, 6, 'Jenis Perubahan', 1, 0);
        $pdf->Cell(30, 6, 'Tabel Perubahan', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $datapoll = $this->log_book_model->TampilData(10000, 0, $filter);
        $no = 1;
        foreach ($datapoll as $data) {
            $pdf->Cell(10, 6, $no, 1, 0);
            $pdf->Cell(40, 6, $data->waktu, 1, 0);
            $pdf->Cell(50, 6, $data->akun, 1, 0);
            $pdf->Cell(100, 6, CetakDesc($data->tabel,$data->jenis,explode(';',$data->awal),explode(';',$data->akhir)), 1, 0);
            $pdf->Cell(30, 6, $data->jenis, 1, 0);
            $pdf->Cell(30, 6, $data->tabel, 1, 1);
            $no++;
        }
        $pdf->Output();
    }
    public function CetakExcel($tgl1 = '', $tgl2 = '')
    {
        $filter = array(
            "tgl1" => $tgl1,
            "tgl2" => $tgl2
        );
        $exl = new PHPExcel();
        $exl->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Data Log Book')
            ->setCellValue('A2', 'No')
            ->setCellValue('B2', 'Waktu')
            ->setCellValue('C2', 'Akun')
            ->setCellValue('D2', 'Log')
            ->setCellValue('E2', 'Jenis Perubahan')
            ->setCellValue('F2', 'Tabel Perubahan');
        $datapoll = $this->log_book_model->TampilData(10000, 0, $filter);
        $no = 1;
        foreach ($datapoll as $data) {
            $exl->setActiveSheetIndex(0)
                ->setCellValue('A'.($no+1),$no)
                ->setCellValue('B'.($no+1),$data->waktu)
                ->setCellValue('C'.($no+1),$data->akun)
                ->setCellValue('D'.($no+1),CetakDesc($data->tabel,$data->jenis,explode(';',$data->awal),explode(';',$data->akhir)))
                ->setCellValue('E'.($no+1),$data->jenis)
                ->setCellValue('F'.($no+1),$data->tabel);
            $no++;
        }
        $file = PHPExcel_IOFactory::createWriter($exl, 'Excel2007');
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Data Log Book.xlsx"');
        $file->save('php://output');
    }
}
