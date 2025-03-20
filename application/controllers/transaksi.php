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
                $span = $this->transaksi_model->CountTrans($x->kode, $limit, $offset)->jumlah;
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
        $pdf->Cell(50, 6, 'Customer', 1, 0);
        $pdf->Cell(40, 6, 'Item', 1, 0);
        $pdf->Cell(10, 6, 'Qty', 1, 0);
        $pdf->Cell(30, 6, 'Harga Satuan', 1, 0);
        $pdf->Cell(30, 6, 'Total Harga', 1, 0);
        $pdf->Cell(30, 6, 'Total Transaksi', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $datapoll = $this->transaksi_model->TampilData(10000,0,$filter);
        $no = 1;$limit = 26;
        $tempid = '';$span = 0;$total = 0;
        foreach ($datapoll as $x) {
            ($limit == 0)?$limit = 29:'';
            $span--;
            if ($tempid != $x->kode) {
                $total = 0;
                $span = $this->transaksi_model->CountTrans($x->kode)->jumlah;
                ($limit > 1)?$border = 'LTR':$border = 1;
                $trans = $this->transaksi_model->AmbilData($x->kode);
                $tempid = $x->kode;
                foreach ($trans as $i) {
                    $total += ($this->barang_model->AmbilData($i->id_barang, 'harga')->harga * $i->jumlah);
                }
            }
            else {
                ($span > 1)? $border = 'LR': $border = 'LBR';
            }
            $data = [
                'kode_transaksi'=> $x->kode,
                'waktu'=> $x->waktu,
                'customer'=> $this->orang_model->AmbilData($x->id_customer,'nama')->nama,
                'item'=> $this->barang_model->AmbilData($x->id_barang,'nama')->nama,
                'qty'=> $x->jumlah,
                'harga'=> $this->barang_model->AmbilData($x->id_barang,'harga')->harga,
                'total'=> $total
            ];
            if ($span > $limit)
            {
                $pdf->AddPage('L', 'A4');
                $limit = 29;
            }
            $pdf->Cell(10, 6, ($border == 'LTR'||$border == 1)?$no:'', $border, 0);
            $pdf->Cell(30, 6, ($border == 'LTR'||$border == 1)?$data['kode_transaksi']:'', $border, 0);
            $pdf->Cell(40, 6, ($border == 'LTR'||$border == 1)?$data['waktu']:'', $border, 0);
            $pdf->Cell(50, 6, ($border == 'LTR'||$border == 1)?$data['customer']:'', $border, 0);
            $pdf->Cell(40, 6, $data['item'], 1, 0);
            $pdf->Cell(10, 6, $data['qty'], 1, 0);
            $pdf->Cell(30, 6, $data['harga'], 1, 0);
            $pdf->Cell(30, 6, ($data['harga']*$data['qty']), 1, 0);
            $pdf->Cell(30, 6, ($border == 'LTR'||$border == 1)?$data['total']:'', $border, 1);
            ($border == 'LTR'||$border == 1)?$no++:'';
            $limit--;
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
        $ex = new PHPExcel();
        $ex->setActiveSheetIndex(0);
        $exl = $ex->getActiveSheet();
        $exl->mergeCells('A1:I1');
        $exl->setCellValue('A1','Data Transaksi')
            ->setCellValue('A2','No')
            ->setCellValue('B2','No. Transaksi')
            ->setCellValue('C2','Waktu')
            ->setCellValue('D2','Customer')
            ->setCellValue('E2','Item')
            ->setCellValue('F2', 'Qty')
            ->setCellValue('G2', 'Harga Satuan')
            ->setCellValue('H2', 'Total Harga')
            ->setCellValue('I2', 'Total Transaksi')
            ->getStyle('A2:I2')->getFont()->setBold(true);
        $datapoll = $this->transaksi_model->TampilData(1000, 0, $filter);
        $exl->getStyle('A3:I'.(count($datapoll)+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $no = 3; $num = 0;
        $tempid = '';
        $total = 0;
        $skip = [];
        foreach ($datapoll as $x) {
            if ($tempid != $x->kode) {
                $num++;
                $span = $this->transaksi_model->CountTrans($x->kode)->jumlah;
                array_push($skip,$span);
                $trans = $this->transaksi_model->AmbilData($x->kode);
                $tempid = $x->kode;
                foreach ($trans as $i) {
                    $total += ($this->barang_model->AmbilData($i->id_barang, 'harga')->harga * $i->jumlah);
                }
            }
            $data = [
                'kode_transaksi' => $x->kode,
                'waktu' => $x->waktu,
                'customer' => $this->orang_model->AmbilData($x->id_customer, 'nama')->nama,
                'item' => $this->barang_model->AmbilData($x->id_barang, 'nama')->nama,
                'qty' => $x->jumlah,
                'harga' => $this->barang_model->AmbilData($x->id_barang, 'harga')->harga,
                'total' => $total
            ];
            $exl->setCellValue('A'.$no,($total != 0)?$num:'')
                ->setCellValue('B'.$no,($total != 0)?$data['kode_transaksi']:'')
                ->setCellValue('C'.$no,($total != 0)?$data['waktu']:'')
                ->setCellValue('D'.$no,($total != 0)?$data['customer']:'')
                ->setCellValue('E'.$no,$data['item'])
                ->setCellValue('F'.$no,$data['qty'])
                ->setCellValue('G'.$no,$data['harga'])
                ->setCellValue('H'.$no,($data['qty']*$data['harga']))
                ->setCellValue('I'.$no,($total != 0)?$data['total']:'');
            $no++;
            $total = 0;
        }
        for ($col = 'A'; $col !== 'J'; $col++) {
            $exl->getColumnDimension($col)
                ->setAutoSize(true);
        }
        $exl->calculateColumnWidths(true);
        for ($col = 'A'; $col !== 'J'; $col++) {
            $exl->getColumnDimension($col)
                ->setAutoSize(false);
        }
        $no = 3;
        foreach ($skip as $skp)
        {
            if ($skp > 1) {
                $exl->mergeCells('A' . $no . ':A' . ($no + ($skp - 1)))
                    ->mergeCells('B' . $no . ':B' . ($no + ($skp - 1)))
                    ->mergeCells('C' . $no . ':C' . ($no + ($skp - 1)))
                    ->mergeCells('D' . $no . ':D' . ($no + ($skp - 1)))
                    ->mergeCells('I' . $no . ':I' . ($no + ($skp - 1)));
            }
            $no += $skp;
        }
        $file = PHPExcel_IOFactory::createWriter($ex, 'Excel2007');
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Data Transaksi.xlsx"');
        $file->save('php://output');
    }
}