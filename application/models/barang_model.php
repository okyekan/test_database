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
    public function TampilData($limit = 5, $offset = 0)
    {
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
