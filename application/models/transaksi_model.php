<?php
defined('BASEPATH') or exit('No direct script access allowed');

class transaksi_model extends CI_Model
{
    public function AmbilData($id)
    {
        return $this->db->get_where('transaksi', ["kode" => $id])->result();
    }
    public function CountData()
    {
        return $this->db->count_all('transaksi');
    }
    public function CountTrans($id,$limit = 10000,$offset = 0)
    {
        $this->db->order_by("waktu", "desc")->limit($limit, $offset)->get('transaksi');
        $query1 = $this->db->last_query();
        $this->db->where("kode", $id)->get('transaksi');
        $query2 = $this->db->last_query();
        $join = $this->db->query("SELECT COUNT('id') as 'kode' FROM (".$query1.") AS q1 ,(".$query2.") AS q2 WHERE q1.id = q2.id");
        return $join->result()[0];
    }
    public function TampilData($limit = 5, $offset = 0, $filter = array("tgl1"=>'',"tgl2"=>'',"nomor"=>''))
    {
        if (!empty($filter['tgl1'])) {
            $first_date = $filter['tgl1'];
            if (!empty($filter['tgl2'])) {
                $second_date = $filter['tgl2'];
                $this->db->where('DATE_FORMAT(waktu,"%Y-%m-%d")>=',$first_date);
                $this->db->where('DATE_FORMAT(waktu,"%Y-%m-%d")<=',$second_date);
            }
            else{
                $this->db->where('DATE_FORMAT(waktu,"%Y-%m-%d")=',$first_date);
            }
        }
        if (!empty($filter['nomor']))
        {
            $nomor = $filter['nomor'];
            $this->db->like('kode', $nomor);
        }
        $query = $this->db->order_by("waktu", "desc")->limit($limit, $offset)->get('transaksi')->result();
        return $query;
    }
    public function GantiData($data, $id)
    {
        $this->db->where('kode', $id);
        return $this->db->update('transaksi', $data);
    }
    public function OldID()
    {
        $this->db->select('kode');
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
        return $this->db->insert('transaksi', $data);
    }
}
