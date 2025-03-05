<?php

defined('BASEPATH') or exit('No direct script access allowed');

class log_book extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("log_book_model");
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }
    public function index($func = '', $offset = 0)
    {
        $config['base_url'] = base_url() . "log_book/index/ViewPage";
        $config['total_rows'] = $this->log_book_model->CountData();
        $config['per_page'] = 5;
        $this->pagination->initialize($config);
        $data['offset'] = $offset;
        $this->load->view("skin", $data);
    }
    public function ViewPage()
    {
        $offset = $this->input->post('offset');
        $data['all_data'] = $this->log_book_model->TampilData(5, $offset);
        $this->load->view("tabel_log_book", $data);
    }
    public function Hapus()
    {
        $id = $this->input->post();
        $this->log_book_model->delete($id);
    }
}