<?php
defined('BASEPATH') or exit('No direct script access allowed');

class barang_model extends CI_Model
{
    public function AmbilData($filter,$column='')
    {
        if ($column != ''){
            $this->db->select($column);
        }
        return $this->db->get_where('barang', $filter)->row();
    }
    public function CountData()
    {
        return $this->db->count_all('barang');
    }
    public function OldID()
    {
        $this->db->select('kode');
        return $this->db->get('barang')->result();
    }
    public function TampilData($limit = 5, $offset = 0, $filter = array("nama" => '', "harga1" => '', "harga2" => '', "stok1" => '', "stok2" => ''))
    {
        if (!empty($filter['nama'])) {
            $nama = $filter['nama'];
            $this->db->like('nama', $nama);
        }
        if (!empty($filter['harga1'])) {
            $harga1 = $filter['harga1'];
            if (!empty($filter['harga2'])) {
                $harga2 = $filter['harga2'];
                if ($harga2 < $harga1) {
                    $t = $harga1;
                    $harga1 = $harga2;
                    $harga2 = $t;
                }
                $this->db->where('harga >=', $harga1);
                $this->db->where('harga <=', $harga2);
            } else {
                $this->db->where('harga =', $harga1);
            }
        }
        if (!empty($filter['stok1'])) {
            $stok1 = $filter['stok1'];
            if (!empty($filter['stok2'])) {
                $stok2 = $filter['stok2'];
                if ($stok2 < $stok1) {
                    $t = $stok1;
                    $stok1 = $stok2;
                    $stok2 = $t;
                }
                $this->db->where('stok >=', $stok1);
                $this->db->where('stok <=', $stok2);
            } else {
                $this->db->where('stok =', $stok1);
            }
        }
        return $this->db->order_by("id", "desc")->limit($limit, $offset)->get('barang')->result();
    }
    public function UnionSearch($kw){
        $this->db->like('kode',$kw)->where('stok >',0)->get('barang');
        $q1 = $this->db->last_query();
        $this->db->like('nama', $kw)->where('stok >', 0)->get('barang');
        $q2 = $this->db->last_query();
        $this->db->like('harga', $kw)->where('stok >', 0)->get('barang');
        $q3 = $this->db->last_query();
        $this->db->like('stok', $kw)->where('stok >', 0)->get('barang');
        $q4 = $this->db->last_query();
        $query = $this->db->query($q1 . " UNION " . $q2 . " UNION " . $q3 . " UNION " . $q4 . " ORDER BY id DESC");
        return $query->result();
    }
    public function delete($id)
    {
        return $this->db->delete('barang', $id);
    }
    public function Update($filter, $data, $esc = FALSE)
    {
        $this->db->where($filter);
        $this->db->set($data,'',$esc);
        $this->db->update('barang');
        return $this->db->last_query();
    }
    // public function save($ambilData)
    // {
    //     $querySimpan = $this->db->query("INSERT INTO barang (nama_barang,harga,stok) VALUES ('" . $ambilData['nama_barang'] . "'," . $ambilData['harga'] . ",'" . $ambilData['stok'] . "');");
    //     return $querySimpan;
    // }
    public function save($inputdata)
    {
        return $this->db->insert('barang', $inputdata);
    }
}
