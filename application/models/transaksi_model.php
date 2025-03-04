<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transaksi_model extends CI_Model
{
    public function AmbilData($id)
    {
        return $this->db->get_where('transaksi', ["id_transaksi" => $id])->row();
    }
    public function TampilData()
    {
        return $this->db->get('transaksi')->result();
    }
    public function GantiData($data, $id)
    {
        $this->db->where('id_transaksi', $id);
        return $this->db->update('transaksi', $data);
    }
    public function OldID()
    {
        $this->db->select('id_transaksi');
        return $this->db->get('transaksi')->result();
    }
    public function delete($id)
    {
        return $this->db->delete('transaksi', $id);
    }
    public function save($data)
    {
        date_default_timezone_set("Asia/Jakarta");
        $data['waktu'] = date('YmdHis');
        return $this->db->insert('transaksi',$data);
    }
}