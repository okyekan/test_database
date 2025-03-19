<?php
defined('BASEPATH') or exit('No direct script access allowed');

class transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("transaksi_model");
        $this->load->model("log_book_model");
        $this->load->model("barang_model");
        $this->load->model("orang_model");
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
        (null != $this->input->post('offset')) ? $offset = $this->input->post('offset') : $offset = 0;
        (null != $this->input->post('limit')) ? $limit = $this->input->post('limit') : $limit = 5;
        $data['limit'] = $limit;
        $getdata = $this->transaksi_model->TampilData($limit, $offset);
        $data['all_data'] = array();
        $tempid = ''; $span = 0; $total = 0;
        foreach ($getdata as $x){
            $span--;
            if ($tempid != $x->kode) {
                $total = 0;
                $span = $this->transaksi_model->CountTrans($x->kode, $limit, $offset)->kode;
                $trans = $this->transaksi_model->AmbilData($x->kode);
                $tempid = $x->kode;
                foreach ($trans as $i)
                {
                    $total += ($this->barang_model->AmbilData($i->id_barang,'harga')->harga * $i->jumlah);
                }
            }
            $temp = array(
                'pembelian'=> ($span),
                'kode_transaksi'=> $x->kode,
                'waktu'=> $x->waktu,
                'nama_customer'=> $this->orang_model->AmbilData($x->id_customer,'nama')->nama,
                'nama_barang'=> $this->barang_model->AmbilData($x->id_barang,'nama')->nama,
                'qty'=> $x->jumlah,
                'harga'=> $this->barang_model->AmbilData($x->id_barang,'harga')->harga,
                'total'=> $total
            );
            array_push($data['all_data'],$temp);
        }
        $data['pagination'] = GeneratePagination($this->transaksi_model->CountData(), $limit, $offset);
        $this->load->view("tabel_transaksi", $data);
    }
    public function Ubah_Data()
    {
        $data['aksi'] = "Ubah";
        $data['row'] = $this->transaksi_model->AmbilData($this->input->post('id_transaksi'));
        foreach ($data['row'] as $r){
            $r->harga = $this->barang_model->AmbilData($r->id_barang, 'harga')->harga;
            $r->stok = $this->barang_model->AmbilData($r->id_barang, 'stok')->stok;
        }
        $this->load->view("pop_up_transaksi", $data);
    }
    public function Tambah_Data()
    {
        $data['aksi'] = "Tambah";
        $this->load->view("pop_up_transaksi", $data);
    }
    public function Cetak_Data()
    {
        $data['aksi'] = "Cetak";
        $this->load->view("pop_up_cetak_transaksi", $data);
    }
    public function Hapus()
    {
        $id = $this->input->post();
        $get = $this->transaksi_model->AmbilData($id['kode']);
        foreach ($get as $g){
            $this->barang_model->Update(['id' => $g->id_barang], array('stok' => 'stok + ' . (int)$g->jumlah));
        }
        $this->transaksi_model->delete($id);
    }
    public function Simpan_Data()
    {
        $id = KodeGen($this->transaksi_model->OldID());
        $post = $this->input->post('str');
        $no = 0;
        $success = 0;
        foreach (explode('; ',$post) as $arr){
            $val = explode('/',$arr);
            $data = array(
                'kode' => $id,
                'id_customer' => $val[0],
                'id_barang' => $val[1],
                'jumlah' => $val[2]
            );
            $scs = $this->transaksi_model->save($data);
            $this->barang_model->Update(['id'=>$val[1]],array('stok' => 'stok - '.(int)$val[2]));
            if ($scs){$success++;}
            $no++;
        }
        // $inputdata = $this->transaksi_model->AmbilData($id);
        // if ($scs == $no){
        //     $dataArray = array(
        //         "akun" => 'Default',
        //         "jenis" => 'Create',
        //         "tabel" => 'Transaksi',
        //         "awal" => '_',
        //         "akhir" => implode(';', $inputdata)
        //     );
        //     $this->log_book_model->save($dataArray);
        // }
    }
    public function Edit_Data()
    {
        $post = $this->input->post('str');
        $no = 0;
        $success = 0;
        $datapool = explode('; ', $post);
        $id = array_shift($datapool);
        $waktu = $this->transaksi_model->AmbilData($id)[0]->waktu;
        //update stok
        $get = $this->transaksi_model->AmbilData($id);
        foreach ($get as $g) {
            $this->barang_model->Update(['id' => $g->id_barang], array('stok' => 'stok + ' . (int)$g->jumlah));
        }
        //
        $this->transaksi_model->delete(['kode' => $id]);
        var_dump($waktu);
        foreach ($datapool as $arr) {
            $val = explode('/', $arr);
            $data = array(
                'kode' => $id,
                'id_customer' => $val[0],
                'id_barang' => $val[1],
                'jumlah' => $val[2],
                'waktu' => $waktu
            );
            var_dump($data);
            $scs = $this->transaksi_model->save($data);
            //update stok
            $this->barang_model->Update(['id' => $val[1]], array('stok' => 'stok - ' . (int)$val[2]));
            //
            if ($scs) {
                $success++;
            }
            $no++;
        }
    }
    public function CetakPDF($tgl1 = '',$tgl2 = '',$nomor = '')
    {
        $filter = array(
            "tgl1" => $tgl1,
            "tgl2" => $tgl2,
            "nomor" => $nomor
        );
        $pdf = new FPDF();
        $pdf->AddPage('L', 'A4');
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 7, 'Data Transaksi', 0, 1, 'L');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'No', 1, 0);
        $pdf->Cell(30, 6, 'No. Transaksi',1,0);
        $pdf->Cell(40, 6, 'Waktu', 1, 0);
        $pdf->Cell(50, 6, 'Akun', 1, 0);
        $pdf->Cell(50, 6, 'Jumlah', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $datapoll = $this->transaksi_model->TampilData(1000,0,$filter);
        $no = 1;
        foreach ($datapoll as $data) {
            $pdf->Cell(10, 6, $no, 1, 0);
            $pdf->Cell(30, 6, $data->id_transaksi, 1, 0);
            $pdf->Cell(40, 6, $data->waktu, 1, 0);
            $pdf->Cell(50, 6, $data->akun, 1, 0);
            $pdf->Cell(50, 6, $data->jumlah, 1, 1);
            $no++;
        }
        $pdf->Output();
    }
    public function CetakExcel($tgl1 = '', $tgl2 = '', $nomor = '')
    {
        $filter = array(
            "tgl1" => $tgl1,
            "tgl2" => $tgl2,
            "nomor" => $nomor
        );
        $exl = new PHPExcel();
        $exl->setActiveSheetIndex(0)->mergeCells('A1:E1');
        $exl->setActiveSheetIndex(0)
            ->setCellValue('A1','Data Transaksi')
            ->setCellValue('A2','No')
            ->setCellValue('B2','No. Transaksi')
            ->setCellValue('C2','Waktu')
            ->setCellValue('D2','Akun')
            ->setCellValue('E2','Jumlah')
            ->getStyle('A2:E2')->getFont()->setBold(true);
        $datapoll = $this->transaksi_model->TampilData(1000, 0, $filter);
        $no = 1;
        foreach ($datapoll as $data) {
            $exl->setActiveSheetIndex(0)
                ->setCellValue('A'.($no+2),$no)
                ->setCellValue('B'.($no+2),$data->id_transaksi)
                ->setCellValue('C'.($no+2),$data->waktu)
                ->setCellValue('D'.($no+2),$data->akun)
                ->setCellValue('E'.($no+2),$data->jumlah);
            $no++;
        }
        for ($col = 'A'; $col !== 'F'; $col++) {
            $exl->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
        }
        $file = PHPExcel_IOFactory::createWriter($exl, 'Excel2007');
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Data Transaksi.xlsx"');
        $file->save('php://output');
    }
}