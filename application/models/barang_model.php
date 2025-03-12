<?php
defined('BASEPATH') or exit('No direct script access allowed');

class barang_model extends CI_Model
{
    public function rules()
    {
        return [
            [
                'field' => 'id_item',
                'label' => 'Id',
                'rules' => 'required'
            ],
            [
                'field' => 'nama_barang',
                'label' => 'Nama Barang',
                'rules' => 'numeric'
            ],
        ];
    }
    public function AmbilData($id)
    {
        return $this->db->get_where('barang', ["id_item" => $id])->row();
    }
    public function CountData()
    {
        return $this->db->count_all('barang');
    }
    public function TampilData($limit = 5, $offset = 0, $filter = array("nama" => '', "harga1" => '', "harga2" => '', "stok1" => '', "stok2" => ''))
    {
        if (!empty($filter['nama'])) {
            $nama = $filter['nama'];
            $this->db->like('nama_barang', $nama);
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
        return $this->db->order_by("id_item", "desc")->limit($limit, $offset)->get('barang')->result();
    }
    public function delete($id)
    {
        return $this->db->delete('barang', $id);
    }
    public function GantiData($data, $id)
    {
        $this->db->where('id_item', $id);
        return $this->db->update('barang', $data);
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
