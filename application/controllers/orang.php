<?php

defined('BASEPATH') or exit('No direct script access allowed');

class orang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("orang_model");
        $this->load->model("log_book_model");
        $this->load->library('form_validation');
        $this->load->library('pdf');
        $this->load->library('excel');
        $this->load->helper('function_helper');
    }
    public function index()
    {
        $this->load->view("skin");
    }
    public function ViewPage()
    {
        (null != $this->input->post('offset'))? $offset = $this->input->post('offset'):$offset = 0;
        (null != $this->input->post('limit'))? $limit = $this->input->post('limit'):$limit = 5;
        $data['limit'] = $limit;
        $data['all_data'] = $this->orang_model->TampilData($limit,$offset);
        $data['pagination'] = GeneratePagination($this->orang_model->CountData(),$limit,$offset);
        $this->load->view("tabel_orang", $data);
    }
    public function Table()
    {
        header('Content-type: application/json');
        echo json_encode($this->orang_model->TampilData(1000, 0));
    }
    public function Ubah_Data()
    {
        $data['aksi'] = "Ubah";
        $data['row'] = $this->orang_model->AmbilData($this->input->post('id'));
        $this->load->view("pop_up_orang", $data);
    }
    public function Tambah_Data()
    {
        $data['aksi'] = "Tambah";
        $this->load->view("pop_up_orang", $data);
    }
    public function Hapus()
    {
        $id = $this->input->post();
        $id2 = $this->input->post('id');
        $oldData = (array) $this->orang_model->AmbilData($id2);
        $success = $this->orang_model->delete($id);

        if ($success) {
            $dataArray = array(
                "akun" => 'Default',
                "jenis" => 'Delete',
                "tabel" => 'Orang',
                "awal" => implode(';', $oldData),
                "akhir" => '_'
            );
            $this->log_book_model->save($dataArray);
        }
    }
    public function Edit_Data()
    {
        $id = $this->input->post('id');
        $oldData = (array) $this->orang_model->AmbilData($id);
        $inputdata = array(
            "id" => $id,
            "nama" => $this->input->post('nama'),
            "umur" => $this->input->post('umur'),
            "jenis_kelamin" => $this->input->post('jenis_kelamin'),
            "alamat" => $this->input->post('alamat')
        );
        $success = $this->orang_model->Update(['id'=>$id],$inputdata);

        if ($success) {
            $dataArray = array(
                "akun" => 'Default',
                "jenis" => 'Update',
                "tabel" => 'Orang',
                "awal" => implode(';', $oldData),
                "akhir" => implode(';', $inputdata)
            );
            $this->log_book_model->save($dataArray);
        }
    }
    public function Simpan_Data()
    {
        $id = KodeGen($this->orang_model->OldID());
        $inputdata = array(
            "kode" => $id,
            "nama" => $this->input->post('nama'),
            "umur" => $this->input->post('umur'),
            "jenis_kelamin" => $this->input->post('jenis_kelamin'),
            "alamat" => $this->input->post('alamat')
        );
        $success = $this->orang_model->save($inputdata);

        if ($success) {
            $dataArray = array(
                "akun" => 'Default',
                "jenis" => 'Create',
                "tabel" => 'Orang',
                "awal" => '_',
                "akhir" => implode(';', $inputdata)
            );
            $this->log_book_model->save($dataArray);
        }
    }
    public function Cetak_Data()
    {
        $data['aksi'] = "Cetak";
        $this->load->view("pop_up_cetak_orang", $data);
    }
    public function CetakPDF($nama='',$umur1='', $umur2 = '',$jenis_kelamin='',$alamat='')
    {
        $filter = array(
            "nama" => $nama,
            "umur1" => $umur1,
            "umur2" => $umur2,
            "jenis_kelamin" => $jenis_kelamin,
            "alamat" => $alamat
        );
        foreach ($filter as $x){
            if ($x == 0){
                $x = '';
            }
        }
        $pdf = new FPDF();
        $pdf->AddPage('L', 'A4');
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 7, 'Data Orang', 0, 1, 'L');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'No', 1, 0);
        $pdf->Cell(30, 6, 'Kode', 1, 0);
        $pdf->Cell(50, 6, 'Nama', 1, 0);
        $pdf->Cell(15, 6, 'Umur', 1, 0);
        $pdf->Cell(30, 6, 'Jenis Kelamin', 1, 0);
        $pdf->Cell(100, 6, 'Alamat', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $datapoll = $this->orang_model->TampilData(1000,0, $filter);
        $no = 1;
        foreach ($datapoll as $data) {
            $pdf->Cell(10, 6, $no, 1, 0);
            $pdf->Cell(30, 6, $data->kode, 1, 0);
            $pdf->Cell(50, 6, $data->nama, 1, 0);
            $pdf->Cell(15, 6, $data->umur, 1, 0);
            $pdf->Cell(30, 6, $data->jenis_kelamin, 1, 0);
            $pdf->Cell(100, 6, $data->alamat, 1, 1);
            $no++;
        }
        $pdf->Output();
    }
    public function CetakExcel($nama = '', $umur1 = '', $umur2 = '', $jenis_kelamin = '', $alamat = '')
    {
        $filter = array(
            "nama" => $nama,
            "umur1" => $umur1,
            "umur2" => $umur2,
            "jenis_kelamin" => $jenis_kelamin,
            "alamat" => $alamat
        );
        foreach ($filter as $x) {
            if ($x == 0) {
                $x = '';
            }
        }
        $exl = new PHPExcel();
        $exl->setActiveSheetIndex(0)->mergeCells('A1:E1');
        $exl->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Data Orang')
            ->setCellValue('A2', 'No')
            ->setCellValue('B2', 'Kode')
            ->setCellValue('C2', 'Nama')
            ->setCellValue('D2', 'Umur')
            ->setCellValue('E2', 'Jenis Kelamin')
            ->setCellValue('F2', 'Alamat')
            ->getStyle('A2:F2')->getFont()->setBold(true);
        $datapoll = $this->orang_model->TampilData(1000, 0, $filter);
        $no = 1;
        foreach ($datapoll as $data) {
            $exl->setActiveSheetIndex(0)
                ->setCellValue('A'.($no+2),$no)
                ->setCellValue('B'.($no+2),$data->kode)
                ->setCellValue('C'.($no+2),$data->nama)
                ->setCellValue('D'.($no+2),$data->umur)
                ->setCellValue('E'.($no+2),$data->jenis_kelamin)
                ->setCellValue('F'.($no+2),$data->alamat);
            $no++;
        }
        for ($col = 'A'; $col !== 'G'; $col++) {
            $exl->getActiveSheet()
            ->getColumnDimension($col)
            ->setAutoSize(true);
        }
        $file = PHPExcel_IOFactory::createWriter($exl, 'Excel2007');
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Data Orang.xlsx"');
        $file->save('php://output');
    }
}
