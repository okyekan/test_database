<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class orang_model extends CI_Model
{
    public function rules()
    {
        return[
            [
                'field' => 'id',
                'label' => 'Id',
                'rules' => 'required'
            ],
            [
                'field' => 'umur',
                'label' => 'Umur',
                'rules' => 'numeric'
            ],
            [
                'field' => 'jenis_kelamin',
                'label' => 'Jenis_Kelamin',
                'rules' => 'required'
            ]
            ];
    }
    public function AmbilData($id)
    {
        return $this->db->get_where('orang', array('id'=>$id))->row();
    }
    public function TampilData()
    {
        return $this->db->get('orang')->result();
    }
    public function delete($id)
    {
        return $this->db->delete('orang',$id);
    }
    public function GantiData($data,$id)
    {
        $this->db->where('id', $id);
        return $this->db->update('orang', $data);
    }
    // public function save($ambilData)
    // {
    //     $querySimpan = $this->db->query("INSERT INTO orang (nama,umur,jenis_kelamin,alamat) VALUES ('".$ambilData['nama']."',".$ambilData['umur'].",'".$ambilData['jenis_kelamin']."','".$ambilData['alamat']."');");
    //     return $querySimpan;
    // }
    public function save($inputdata)
    {
        return $this->db->insert('orang',$inputdata);
    }
}