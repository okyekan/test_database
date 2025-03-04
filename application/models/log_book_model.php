<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class log_book_model extends CI_Model
{
    public function AmbilData($id)
    {
        return $this->db->get_where('log', ["waktu" => $id])->row();
    }
    public function TampilData()
    {
        return $this->db->get('log')->result();
    }
    public function delete($id)
    {
        return $this->db->delete('log', $id);
    }
    public function save($data)
    {
        date_default_timezone_set("Asia/Jakarta");
        $data['waktu'] = date('YmdHis');
        return $this->db->insert('log',$data);
    }
}