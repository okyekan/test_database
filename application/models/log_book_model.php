<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class log_book_model extends CI_Model
{
    public function AmbilData($id)
    {
        return $this->db->get_where('log', ["waktu" => $id])->row();
    }
    public function CountData()
    {
        return $this->db->count_all('log');
    }
    public function TampilData($limit = 5, $offset = 0, $filter = array("tgl1" => '', "tgl2" => ''))
    {
        if (!empty($filter['tgl1'])) {
            $first_date = $filter['tgl1'];
            if (!empty($filter['tgl2'])) {
                $second_date = $filter['tgl2'];
                $this->db->where('DATE_FORMAT(waktu,"%Y-%m-%d")>=', $first_date);
                $this->db->where('DATE_FORMAT(waktu,"%Y-%m-%d")<=', $second_date);
            } else {
                $this->db->where('DATE_FORMAT(waktu,"%Y-%m-%d")=', $first_date);
            }
        }
        $query = $this->db->order_by("waktu", "desc")->limit($limit, $offset)->get('log')->result();
        return $query;
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