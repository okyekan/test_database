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
        $this->load->library('pagination');
        $this->load->helper('function_helper');
    }
    public function index($func = '', $offset = 0)
    {
        $config['base_url'] = base_url() . "barang/index/ViewPage";
        $config['total_rows'] = $this->barang_model->CountData();
        $config['per_page'] = 5;
        $this->pagination->initialize($config);
        $data['offset'] = $offset;
        $this->load->view("skin",$data);
    }
    public function ViewPage()
    {
        $offset = $this->input->post('offset');
        $data['all_data'] = $this->barang_model->TampilData(5, $offset);
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
}