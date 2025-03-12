<?php

defined('BASEPATH') or exit('No direct script access allowed');

class login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('admin')){
            redirect('home');
        }
        $this->load->model('admin_model');
    }
    public function index()
    {
        $this->load->view('admin/login');
    }
    public function verify()
    {
        $check = $this->admin_model->validate();
        if($check)
        {
            $this->session->set_userdata('admin','1');
            redirect('home');
        }
        else
        {
            redirect('admin');
        }
    }
}