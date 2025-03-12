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
    public function CountData()
    {
        return $this->db->count_all('orang');
    }
    public function TampilData($limit = 5,$offset = 0, $filter = array("nama" => '', "umur1" => '', "umur2" => '', "jenis_kelamin" =>'', "alamat" => ''))
    {
        if (!empty($filter['nama'])) {
            $nama = $filter['nama'];
            $this->db->like('nama', $nama);
        }
        if (!empty($filter['umur1'])) {
            $umur1 = $filter['umur1'];
            if (!empty($filter['umur2'])) {
                $umur2 = $filter['umur2'];
                if ($umur2 < $umur1){
                    $t = $umur1;
                    $umur1 = $umur2;
                    $umur2 = $t;
                }
                $this->db->where('umur >=', $umur1);
                $this->db->where('umur <=', $umur2);
            }
            else{
                $this->db->where('umur =', $umur1);
            }
        }
        if (!empty($filter['jenis_kelamin'])) {
            $jenis_kelamin = $filter['jenis_kelamin'];
            $this->db->where('jenis_kelamin=', $jenis_kelamin);
        }
        if (!empty($filter['alamat'])) {
            $alamat = $filter['alamat'];
            $this->db->like('alamat', $alamat);
        }
        return $this->db->order_by("id", "desc")->limit($limit,$offset)->get('orang')->result();
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