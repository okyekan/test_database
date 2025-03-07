<?php
defined('BASEPATH') or exit('No direct script access allowed');

class transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("transaksi_model");
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
        $data['all_data'] = $this->transaksi_model->TampilData($limit, $offset);
        $data['pagination'] = GeneratePagination($this->transaksi_model->CountData(), $limit, $offset);
        $this->load->view("tabel_transaksi", $data);
    }
    public function Ubah_Data()
    {
        $data['aksi'] = "Ubah";
        $data['row'] = $this->transaksi_model->AmbilData($this->input->post('id_transaksi'));
        $this->load->view("pop_up_transaksi", $data);
    }
    public function Tambah_Data()
    {
        $data['aksi'] = "Tambah";
        $this->load->view("pop_up_transaksi", $data);
    }
    public function Cetak_Data()
    {
        $data['aksi'] = "Cetak";
        $this->load->view("pop_up_cetak_transaksi", $data);
    }
    public function Hapus()
    {
        $id = $this->input->post();
        $id2 = $this->input->post('id_transaksi');
        $oldData = (array) $this->transaksi_model->AmbilData($id2);
        $success = $this->transaksi_model->delete($id);

        if ($success) {
            $dataArray = array(
                "akun" => 'Default',
                "jenis" => 'Delete',
                "tabel" => 'Transaksi',
                "awal" => implode(';', $oldData),
                "akhir" => '_'
            );
            $this->log_book_model->save($dataArray);
        }
    }
    public function Simpan_Data()
    {
        $id = NoTransaksiGen($this->transaksi_model->OldID());
        $inputdata = array(
            "id_transaksi" => $id,
            "waktu" => $this->input->post('waktu'),
            "akun" => $this->input->post('akun'),
            "jumlah" => $this->input->post('jumlah')
        );
        $success = $this->transaksi_model->save($inputdata);
        $inputdata = (array) $this->transaksi_model->AmbilData($id);
        if ($success) {
            $dataArray = array(
                "akun" => 'Default',
                "jenis" => 'Create',
                "tabel" => 'Transaksi',
                "awal" => '_',
                "akhir" => implode(';', $inputdata)
            );
            $this->log_book_model->save($dataArray);
        }
    }
    public function Edit_Data()
    {
        $id = $this->input->post('id_transaksi');
        $oldData = (array) $this->transaksi_model->AmbilData($id);
        $inputdata = array(
            "id_transaksi" => $id,
            "waktu" => $this->input->post('waktu'),
            "akun" => $this->input->post('akun'),
            "jumlah" => $this->input->post('jumlah')
        );
        $success = $this->transaksi_model->GantiData($inputdata, $id);

        if ($success) {
            $dataArray = array(
                "akun" => 'Default',
                "jenis" => 'Update',
                "tabel" => 'Transaksi',
                "awal" => implode(';', $oldData),
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
        $pdf->Cell(190, 7, 'Data Transaksi', 0, 1, 'L');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'No', 1, 0);
        $pdf->Cell(40, 6, 'Waktu', 1, 0);
        $pdf->Cell(50, 6, 'Akun', 1, 0);
        $pdf->Cell(50, 6, 'Jumlah', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $datapoll = $this->transaksi_model->TampilData();
        $no = 1;
        foreach ($datapoll as $data) {
            $pdf->Cell(10, 6, $no, 1, 0);
            $pdf->Cell(40, 6, $data->waktu, 1, 0);
            $pdf->Cell(50, 6, $data->akun, 1, 0);
            $pdf->Cell(50, 6, $data->jumlah, 1, 1);
            $no++;
        }
        $pdf->Output();
    }
}