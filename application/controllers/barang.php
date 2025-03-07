<?php

defined('BASEPATH') or exit('No direct script access allowed');

class barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("barang_model");
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
        $data['all_data'] = $this->barang_model->TampilData($limit, $offset);
        $data['pagination'] = GeneratePagination($this->barang_model->CountData(), $limit, $offset);
        $this->load->view("tabel_barang", $data);
    }
    public function Ubah_Data()
    {
        $data['aksi'] = "Ubah";
        $data['row'] = $this->barang_model->AmbilData($this->input->post('id_item'));
        $this->load->view("pop_up_barang", $data);
    }
    public function Tambah_Data()
    {
        $data['aksi'] = "Tambah";
        $this->load->view("pop_up_barang", $data);
    }
    public function Hapus()
    {
        $id = $this->input->post();
        $id2 = $this->input->post('id_item');
        $oldData = (array) $this->barang_model->AmbilData($id2);
        $success = $this->barang_model->delete($id);

        if ($success) {
            $dataArray = array(
                "akun" => 'Default',
                "jenis" => 'Delete',
                "tabel" => 'Barang',
                "awal" => implode(';', $oldData),
                "akhir" => '_'
            );
            $this->log_book_model->save($dataArray);
        }
    }
    public function Edit_Data()
    {
        $id = $this->input->post('id_item');
        $oldData = (array) $this->barang_model->AmbilData($id);
        $inputdata = array(
            "id_item" => $id,
            "nama_barang" => $this->input->post('nama_barang'),
            "harga" => $this->input->post('harga'),
            "stok" => $this->input->post('stok')
        );
        $success = $this->barang_model->GantiData($inputdata, $id);
        if ($success) {
            $dataArray = array(
                "akun" => 'Default',
                "jenis" => 'Update',
                "tabel" => 'Barang',
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
            "id_item"=> $id,
            "nama_barang" => $this->input->post('nama_barang'),
            "harga" => $this->input->post('harga'),
            "stok" => $this->input->post('stok')
        );
        $success = $this->barang_model->save($inputdata);
        if ($success) {
            $dataArray = array(
                "akun" => 'Default',
                "jenis" => 'Create',
                "tabel" => 'Barang',
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
        $pdf->Cell(190, 7, 'Data Barang', 0, 1, 'L');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'No', 1, 0);
        $pdf->Cell(50, 6, 'Nama', 1, 0);
        $pdf->Cell(50, 6, 'Harga', 1, 0);
        $pdf->Cell(15, 6, 'Stok', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $datapoll = $this->barang_model->TampilData(1000, 0);
        $no = 1;
        foreach ($datapoll as $data) {
            $pdf->Cell(10, 6, $no, 1, 0);
            $pdf->Cell(50, 6, $data->nama_barang, 1, 0);
            $pdf->Cell(50, 6, $data->harga, 1, 0);
            $pdf->Cell(15, 6, $data->stok, 1, 1);
            $no++;
        }
        $pdf->Output();
    }
}