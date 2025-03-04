<?php

defined('BASEPATH') or exit('No direct script access allowed');

class log_book extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("log_book_model");
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->load->view("skin");
    }
    public function ViewPage()
    {
        $data['all_data'] = $this->log_book_model->TampilData();
        $this->load->view("tabel_log_book", $data);
    }
    public function Hapus()
    {
        $id = $this->input->post();
        $this->log_book_model->delete($id);
    }
}