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
    public function CetakPDF()
    {
        function CetakDesc($tabel, $jenis, $awal, $akhir)
        {
            $str = '';
            if ($jenis == "Create") {
                if ($tabel == "Transaksi") {
                    $str = "Menambah data " . $akhir[2];
                } else {
                    $str = "Menambah data " . $akhir[1];
                }
            } else if ($jenis == "Delete") {
                $str = "Menghapus data " . $awal[1];
            } else {
                $first = true;
                for ($i = 0; $i < sizeof($awal); $i++) {
                    if ($awal[$i] != $akhir[$i]) {
                        if (!$first) {
                            $str = $str . " - ";
                        }
                        $str = $str . "Mengubah dari " . $awal[$i] . " menjadi " . $akhir[$i];
                        $first = false;
                    }
                }
            }
            return $str;
        }
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
        $datapoll = $this->log_book_model->TampilData(10000, 0);
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
}
