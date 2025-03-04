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
        $this->load->helper('function_helper');
    }
    public function index()
    {
        $this->load->view("skin");
    }
    public function ViewPage()
    {
        $data['all_data'] = $this->orang_model->TampilData();
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
}
