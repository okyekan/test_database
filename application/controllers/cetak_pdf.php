<?php

defined('BASEPATH') or exit('No direct script access allowed');

class cetak_pdf extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('orang_model');
        $this->load->library('form_validation');
        $this->load->helper('function_helper');
        $this->load->library('pdf');
    }
    public function index()
    {
        $pdf = new FPDF();
        $pdf->AddPage('L','A4');
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(190,7,'Data Orang',0,1,'L');
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0);
        $pdf->Cell(80,6,'Nama',1,0);
        $pdf->Cell(15,6,'Umur',1,0);
        $pdf->Cell(30,6,'Jenis Kelamin',1,0);
        $pdf->Cell(100,6,'Alamat',1,1);
        $pdf->SetFont('Arial','',10);
        $datapoll = $this->orang_model->TampilData(1000,0);
        $no = 1;
        foreach($datapoll as $data){
            $pdf->Cell(10,6,$no,1,0);
            $pdf->Cell(80,6,$data->nama,1,0);
            $pdf->Cell(15,6,$data->umur,1,0);
            $pdf->Cell(30,6,$data->jenis_kelamin,1,0);
            $pdf->Cell(100,6,$data->alamat,1,1);
            $no++;
        }
        $pdf->Output();
    }
}