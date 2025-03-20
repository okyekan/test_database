<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class orang_model extends CI_Model
{
    public function AmbilData($filter, $column = '')
    {
        if ($column != '') {
            $this->db->select($column);
        }
        return $this->db->get_where('orang', $filter)->row();
    }
    public function CountData()
    {
        return $this->db->count_all('orang');
    }
    public function OldID()
    {
        $this->db->select('kode');
        return $this->db->get('orang')->result();
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
    public function UnionSearch($kw)
    {
        $this->db->like('kode', $kw)->get('orang');
        $q1 = $this->db->last_query();
        $this->db->like('nama', $kw)->get('orang');
        $q2 = $this->db->last_query();
        $this->db->where('umur', $kw)->get('orang');
        $q3 = $this->db->last_query();
        $this->db->where('jenis_kelamin', $kw)->get('orang');
        $q4 = $this->db->last_query();
        $this->db->like('alamat', $kw)->get('orang');
        $q5 = $this->db->last_query();
        $query = $this->db->query($q1 . " UNION " . $q2 . " UNION " . $q3 . " UNION " . $q4 . " UNION " . $q5 . " ORDER BY id DESC");
        return $query->result();
    }
    public function delete($id)
    {
        return $this->db->delete('orang',$id);
    }
    public function Update($filter,$data)
    {
        $this->db->where($filter);
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