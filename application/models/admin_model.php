<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin_model extends CI_Model
{
    function validate()
    {
        $arr['username'] = $this->input->post('username');
        $arr['password'] = md5($this->input->post('password'));
        return $this->db->get_where('admins',$arr)->row();
    }
}