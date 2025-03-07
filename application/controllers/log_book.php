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
}