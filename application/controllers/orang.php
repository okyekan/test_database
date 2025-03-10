<?php

defined('BASEPATH') or exit('No direct script access allowed');

class orang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("orang_model");
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
        (null != $this->input->post('offset'))? $offset = $this->input->post('offset'):$offset = 0;
        (null != $this->input->post('limit'))? $limit = $this->input->post('limit'):$limit = 5;
        $data['limit'] = $limit;
        $data['all_data'] = $this->orang_model->TampilData($limit,$offset);
        $data['pagination'] = GeneratePagination($this->orang_model->CountData(),$limit,$offset);
        $this->load->view("tabel_orang", $data);
    }
    public function Ubah_Data()
    {
        $data['aksi'] = "Ubah";
        $data['row'] = $this->orang_model->AmbilData($this->input->post('id'));
        $this->load->view("pop_up_orang", $data);
    }
    public function Tambah_Data()
    {
        $data['aksi'] = "Tambah";
        $this->load->view("pop_up_orang", $data);
    }
    public function Hapus()
    {
        $id = $this->input->post();
        $id2 = $this->input->post('id');
        $oldData = (array) $this->orang_model->AmbilData($id2);
        $success = $this->orang_model->delete($id);

        if ($success) {
            $dataArray = array(
                "akun" => 'Default',
                "jenis" => 'Delete',
                "tabel" => 'Orang',
                "awal" => implode(';', $oldData),
                "akhir" => '_'
            );
            $this->log_book_model->save($dataArray);
        }
    }
    public function Edit_Data()
    {
        $id = $this->input->post('id');
        $oldData = (array) $this->orang_model->AmbilData($id);
        $inputdata = array(
            "id" => $id,
            "nama" => $this->input->post('nama'),
            "umur" => $this->input->post('umur'),
            "jenis_kelamin" => $this->input->post('jenis_kelamin'),
            "alamat" => $this->input->post('alamat')
        );
        $success = $this->orang_model->GantiData($inputdata, $id);

        if ($success) {
            $dataArray = array(
                "akun" => 'Default',
                "jenis" => 'Update',
                "tabel" => 'Orang',
                "awal" => implode(';', $oldData),
                "akhir" => implode(';', $inputdata)
            );
            $this->log_book_model->save($dataArray);
        }
    }
    public function Simpan_Data()
    {
        $id = IdGen();
        $inputdata = array(
            "id" => $id,
            "nama" => $this->input->post('nama'),
            "umur" => $this->input->post('umur'),
            "jenis_kelamin" => $this->input->post('jenis_kelamin'),
            "alamat" => $this->input->post('alamat')
        );
        $success = $this->orang_model->save($inputdata);

        if ($success) {
            echo 'test';
            $dataArray = array(
                "akun" => 'Default',
                "jenis" => 'Create',
                "tabel" => 'Orang',
                "awal" => '_',
                "akhir" => implode(';', $inputdata)
            );
            $this->log_book_model->save($dataArray);
        }
    }
    public function CetakPDF()
    {
        $pdf = new FPDF();
        $pdf->AddPage('L', 'A4');
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 7, 'Data Orang', 0, 1, 'L');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'No', 1, 0);
        $pdf->Cell(80, 6, 'Nama', 1, 0);
        $pdf->Cell(15, 6, 'Umur', 1, 0);
        $pdf->Cell(30, 6, 'Jenis Kelamin', 1, 0);
        $pdf->Cell(100, 6, 'Alamat', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $datapoll = $this->orang_model->TampilData(1000, 0);
        $no = 1;
        foreach ($datapoll as $data) {
            $pdf->Cell(10, 6, $no, 1, 0);
            $pdf->Cell(80, 6, $data->nama, 1, 0);
            $pdf->Cell(15, 6, $data->umur, 1, 0);
            $pdf->Cell(30, 6, $data->jenis_kelamin, 1, 0);
            $pdf->Cell(100, 6, $data->alamat, 1, 1);
            $no++;
        }
        $pdf->Output();
    }
}
