<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('admin')) {
			redirect('admin');
		}
	}
	public function index()
	{
		$this->load->view('skin');
	}
	public function ViewPage()
	{
		$this->load->view('home');
	}
	public function about()
	{
		// fungsi untuk me-load view about.php
		$this->load->view('about');
	}

	public function contact()
	{
		// fungsi untuk me-load view contact.php
		$this->load->view('contact');
	}
}