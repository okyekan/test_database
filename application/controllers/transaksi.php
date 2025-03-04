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
        $this->load->library("fpdf_gen");
        $this->load->helper('function_helper');
    }
    public function index()
    {
        $this->load->view("skin");
    }
    public function ViewPage()
    {
        $data['all_data'] = $this->transaksi_model->TampilData();
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
    public function Test()
    {
        $id = NoTransaksiGen($this->transaksi_model->OldID());
        var_dump($id) ;
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
}