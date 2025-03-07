<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('fpdf186/fpdf.php');

class pdf extends FPDF
{
	var $angle = 0;
	var $extgstates = array();
	var $pcp = 1;

	function __construct($orientation = 'L', $unit = 'mm', $size = 'A4'){
		parent::__construct($orientation, $unit, $size);
	}

	function Header(){
		global $title;
		global $nama_aplikasi;
		global $glplus;
		global $jenis_header;
		global $header_1;
		global $header_bawah_garis;

		global $bawah_garis_1;
		global $bawah_garis_2;
		global $bawah_garis_3;
		global $bawah_garis_4;
		global $bawah_garis_5;
		global $bawah_garis_6;
		global $bawah_garis_7;

		global $width_header;
		global $set_align;
		global $table_head;
		global $bord_h;

		global $filtering;
		global $filtering2;
		global $filtering3;

		global $width_header2;
		global $set_align2;
		global $table_head2;
		global $tb2_line;

		global $width_header3;
		global $set_align3;
		global $table_head3;

		global $width_header4;
		global $set_align4;
		global $table_head4;

		global $akun;
		global $akun2;
		global $akun3;
		global $akun4;
		global $pertama;

		global $keterangan_atas;
		global $copyright;
		global $jenis_kertas;

		global $fcolorakun3;
		global $fcolorakun4;

		global $multicell;

		$lebar = $this->w;
		$this->SetFont('Arial', 'B', 13);
		$this->SetTextColor(0, 0, 0);
		$w = $this->GetStringWidth($title);

		$keterangan_atas = isset($keterangan_atas) ? $keterangan_atas : true;
		if ($keterangan_atas === true) {
			if ($nama_aplikasi != '') {
				$this->SetFont('Arial', 'B', 9);
				$this->Cell($w, 9, $nama_aplikasi, 0, 0, 'L');
				$this->Ln(5);
			}
			if ($title != '') {
				$this->SetFont('Arial', 'B', 13);
				$this->Cell($w, 9, $title, 0, 0, 'L');
				$this->Ln(5);
			}
			if ($filtering != '') {
				$this->SetTextColor(0, 0, 0);
				$this->SetFont('Arial', 'B', 8);
				$this->Cell($w, 9, $filtering, 0, 0, 'L');
				$this->Ln(5);
			}
			if ($filtering2 != '') {
				$this->SetTextColor(0, 0, 0);
				$this->SetFont('Arial', 'B', 8);
				$this->Cell($w, 9, $filtering2, 0, 0, 'L');
				$this->Ln(5);
			}
			if ($filtering3 != '') {
				$this->SetTextColor(0, 0, 0);
				$this->SetFont('Arial', 'B', 8);
				$this->Cell($w, 9, $filtering3, 0, 0, 'L');
				$this->Ln(5);
			}
			if ($akun != '') {
				$this->SetTextColor(128, 4, 0);
				$this->SetFont('Arial', 'B', 8);
				$this->Cell($w, 9, $akun, 0, 0, 'L');
				$this->Ln(4);
			}
			if ($akun2 != '') {
				$this->SetTextColor(128, 4, 0);
				$this->SetFont('Arial', 'B', 8);
				if ($multicell) {
					$this->Ln(3);
					$this->MultiCell(200, 3, $akun2, 0, 'L', false);
					// $this->Ln(1);
				} else {
					$this->Cell($w, 9, $akun2, 0, 0, 'L');
					$this->Ln(5);
				}
			}
			if ($akun3 != '') {
				$this->SetFont('Arial', 'B', 8);
				if ($fcolorakun4 != '') {
					$this->SetTextColor($fcolorakun3[0], $fcolorakun3[1], $fcolorakun3[2]);
				} else {
					$this->SetTextColor(128, 4, 0);
				}
				if ($multicell) {
					$this->Ln(3);
					$this->MultiCell(200, 3, $akun3, 0, 'L', false);
					// $this->Ln(1);
				} else {
					$this->Cell($w, 9, $akun3, 0, 0, 'L');
					$this->Ln(5);
				}
			}
			if ($akun4 != '') {
				$this->SetFont('Arial', 'B', 8);
				if ($fcolorakun4 != '') {
					$this->SetTextColor($fcolorakun4[0], $fcolorakun4[1], $fcolorakun4[2]);
				} else {
					$this->SetTextColor(128, 4, 0);
				}
				if ($multicell) {
					$this->Ln(3);
					$this->MultiCell(200, 3, $akun4, 0, 'L', false);
					// $this->Ln(1);
				} else {
					$this->Cell($w, 9, $akun4, 0, 0, 'L');
					$this->Ln(5);
				}
			}
			$this->Ln(5);
			$this->line($this->GetX(), $this->GetY(), $this->GetX() + $lebar - 17, $this->GetY());
		}

		$header_1 = isset($header_1) ? $header_1 : true;
		if ($header_1 === true) {
			if ($pertama === true) {
				$this->Ln(-1);

				$this->SetFont('Arial', 'B', 9);

				$this->SetTextColor(128, 4, 0);
				// $this->Cell(43,9,$bawah_garis_1,0,0,'L');
				$this->Ln(3);
				$this->MultiCell(200, 4, $bawah_garis_1, 0, 'L', false);
				if (isset($bawah_garis_2)) {
					$this->Ln(8);
				} else if (!isset($bawah_garis_3)) {
					$this->Ln(1);
					$this->line($this->GetX(), $this->GetY(), $this->GetX() + $lebar - 18, $this->GetY());
					$this->Ln(-1);
				}

				$this->SetFont('Arial', 'B', 8);

				$this->SetTextColor(0, 0, 0);
				$this->Cell(43, 9, $bawah_garis_2, 0, 0, 'L');

				if (isset($bawah_garis_3)) {
					$this->Ln(5);
					$this->SetFont('Arial', 'B', 9);
					$this->SetTextColor(128, 4, 0);
					$this->Cell(43, 9, $bawah_garis_3, 0, 0, 'L');
					$this->Ln(8);
					$this->line($this->GetX(), $this->GetY(), $this->GetX() + $lebar - 17, $this->GetY());
				}

				if (isset($bawah_garis_4)) {
					$this->Ln(0);
					$this->SetFont('Arial', 'B', 9);
					$this->SetTextColor(128, 4, 0);
					$this->Cell(43, 9, $bawah_garis_4, 0, 0, 'L');
					$this->Ln(8);
					$this->line($this->GetX(), $this->GetY(), $this->GetX() + $lebar - 17, $this->GetY());
				}
			}
			if (isset($bawah_garis_2)) {
				$this->Ln(10);
			} else {
				$this->Ln(3);
			}
			if (isset($bawah_garis_3)) {
				$this->Ln(7);
			} else {
				$this->Ln(0);
			}
			if (isset($bawah_garis_4)) {
				$this->Ln(4);
			} else {
				$this->Ln(0);
			}

			$this->SetFont('Arial', 'B', 9);
			$this->SetWidths($width_header);
			$this->SetAligns($set_align);
			$no = 1;
			$this->SetFillColor(255);
			for ($i = 1; $i <= 1; $i++) {
				$this->SetTextColor(0, 0, 128);
				$this->Row_Header($table_head, $bord_h);
			}
		}

		if ($jenis_header == 2) {
			$this->SetFont('Arial', 'B', 9);
			$this->SetWidths($width_header2);
			$this->SetAligns($set_align2);
			$no = 1;
			$this->SetFillColor(255);
			if ($tb2_line) {
				$this->Ln(3);
			}
			for ($i = 1; $i <= 1; $i++) {
				$this->SetTextColor(0, 0, 128);
				$this->Row_Header($table_head2);
			}
			if ($tb2_line) {
				$this->line($this->GetX(), $this->GetY(), $this->GetX() + $lebar - 17, $this->GetY());
			}
		}

		if ($jenis_header == 3) {
			$this->SetFont('Arial', 'B', 9);
			$this->SetWidths($width_header3);
			$this->SetAligns($set_align3);
			$no = 1;
			$this->SetFillColor(255);
			if ($tb2_line) {
				$this->Ln(3);
			}
			for ($i = 1; $i <= 1; $i++) {
				$this->SetTextColor(0, 0, 128);
				$this->Row_Header($table_head3);
			}
			if ($tb2_line) {
				$this->line($this->GetX(), $this->GetY(), $this->GetX() + $lebar - 17, $this->GetY());
			}
		}

		if ($copyright) {
			$this->SetFont('Arial', 'B', 50);
			$this->SetTextColor(255, 222, 233);
			if ($jenis_kertas) {
				$this->RotatedText(90, 95, 'COPY', 45);
			} else {
				$this->RotatedText(90, 140, 'COPY', 45);
			}
		}
	}

	function Footer(){
		global $glplus;
		global $footer;
		global $bol_footer;
		global $dat_footer;
		global $set_y;

		$footer     = isset($footer) ? $footer : true;
		$bol_footer = isset($bol_footer) ? $bol_footer : false;

		if ($footer === true) {
			$lebar      = $this->w;
			$hal        = $glplus . '    #  ' . $this->PageNo() . '/{nb}';
			$datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";
			$tanggal    = 'Printed : ' . date('d-m-Y  h:i a') . ' ';
			$website    = element('http_gl');
			$set_y      = ($set_y > 1) ? 1 : 0;
			$def_y      = ($bol_footer) ? (-20) - ($set_y * 5) : -15;

			date_default_timezone_set("Asia/Jakarta");

			if ($bol_footer) {
				$this->SetY($def_y);
				$count_arr = count($dat_footer);
				$this->SetFont('Arial', 'B', 9);
				$this->line($this->GetX(), $this->GetY(), $this->GetX() + $lebar - 20, $this->GetY());
				$this->Footer_table($dat_footer);
			} else {
				$this->SetY(-15);
			}
			$this->SetTextColor(0, 0, 0);
			$this->SetFont('Arial', 'I', 8);
			$this->line($this->GetX(), $this->GetY(), $this->GetX() + $lebar - 20, $this->GetY());
			$this->Cell(0, 10, $tanggal, 0, 0, 'L');
			$this->SetX($this->lMargin);
			$this->Cell(0, 10, $website, 0, 0, 'C');
			$this->SetX($this->lMargin);
			$this->Cell(0, 10, $hal, 0, 0, 'R');
		}
	}

	function SetWidths($w){
		$this->widths = $w;
	}

	function SetAligns($a){
		$this->aligns = $a;
	}

	function Row_Header($data, $borders = false){
		//Calculate the height of the row
		$nb = 0;
		for ($i = 0; $i < count($data); $i++)
			$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h = 5 * $nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for ($i = 0; $i < count($data); $i++) {
			$w = $this->widths[$i];
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x = $this->GetX();
			$y = $this->GetY();
			if ($borders) {
				$this->Rect($x, $y, $w, $h);
			}
			//Draw the border
			//$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w, 5, $data[$i], 0, $a);
			//Put the position to the right of the cell
			$this->SetXY($x + $w, $y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function Highlighted_RowHeader($data, $colnumber){
		//Calculate the height of the row
		$nb = 0;
		for ($i = 0; $i < count($data); $i++)
			$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h = 5 * $nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for ($i = 0; $i < count($data); $i++) {
			$w = $this->widths[$i];
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x = $this->GetX();
			$y = $this->GetY();
			//Draw the border
			//$this->Rect($x,$y,$w,$h);
			//Print the text
			if (in_array($i, $colnumber)) {
				$fill = true;
				$this->SetFillColor(230, 230, 230);
				$this->MultiCell($w, 5, $data[$i], 1, $a, $fill);
			} else {
				$fill = false;
				$this->MultiCell($w, 5, $data[$i], 0, $a, $fill);
			}

			//Put the position to the right of the cell
			$this->SetXY($x + $w, $y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function Row($data, $fill = false, $add_padd = 0, $u_line = false, $u_arr = '', $borders = false, $padd_inner = false, $padd_size = 0, $list_padd = '', $b_line = false, $b_arr = '', $font_size = 9, $two_color = false, $Line_height = 5){
		//Calculate the height of the row
		$nb = 0;
		for ($i = 0; $i < count($data); $i++)
			$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h = 5 * $nb;
		$this->CheckPageBreak($h);
		for ($i = 0; $i < count($data); $i++) {
			$w = $this->widths[$i];
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x = $this->GetX();
			$y = $this->GetY() + $add_padd;
			if ($padd_inner) {
				$add_width = (in_array($i, $list_padd) && $padd_inner) ? $padd_size : 0;
				$w         = $w - $add_width;
				$this->Cell($padd_size);
			}
			if ($borders) {
				$this->Rect($x, $y, $w, $h);
			}
			if ($u_line && $b_line) {
				if ($u_line && in_array($i, $u_arr)) {
					if ($b_line && in_array($i, $b_arr)) {
						$this->SetFont('Arial', 'BU', $font_size);
					}
				}
			} else {
				if ($u_line && in_array($i, $u_arr)) {
					$this->SetFont('Arial', 'U', $font_size);
				}
				if ($b_line && in_array($i, $b_arr)) {
					$this->SetFont('Arial', 'B', $font_size);
				}
			}
			$wm = ($padd_inner) ? $w - $add_width : $w;
			if ($two_color) {
				if ($two_color['row'] == $i) {
					if ($two_color['color'] == "red") {
						$this->SetTextColor(255, 0, 0);
					} elseif ($two_color['color'] == "purple") {
						$this->SetTextColor(150, 43, 233);
					} else {
						$this->SetTextColor(0, 0, 0);
					}
					$this->MultiCell($wm, 5, $data[$i], 0, $a, $fill);
				} else {
					$this->SetTextColor(0, 0, 0);
					$this->MultiCell($wm, 5, $data[$i], 0, $a, $fill);
				}
			} else {
				$this->MultiCell($wm, $Line_height, $data[$i], 0, $a, $fill);
			}
			if ($b_line && in_array($i, $b_arr) || $u_line && in_array($i, $u_arr)) {
				$this->SetFont('Arial', '', $font_size);
			}
			$this->SetXY($x + $w, $y);
		}
		$this->Ln($h);
	}

	function Row_table($data, $high = 5, $add_padd = 0, $u_line = false, $u_arr = '', $borders = 0, $padd_inner = false, $padd_size = 0, $list_padd = '', $b_line = false, $b_arr = ''){
		$nb = 0;
		for ($i = 0; $i < count($data); $i++) {
			$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		}
		$h = 5 * $nb;
		$this->CheckPageBreak($h);
		for ($i = 0; $i < count($data); $i++) {
			$w = $this->widths[$i];
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			$x = $this->GetX();
			$y = $this->GetY() + $add_padd;
			if ($padd_inner) {
				$add_width = (in_array($i, $list_padd) && $padd_inner) ? $padd_size : 0;
				$w         = $w - $add_width;
				$this->Cell($padd_size);
			}
			if ($u_line && in_array($i, $u_arr)) {
				$this->SetFont('Arial', 'U', 9);
			}
			if ($b_line && in_array($i, $b_arr)) {
				$this->SetFont('Arial', 'B', 9);
			}
			$wm = ($padd_inner) ? $w - $add_width : $w;
			$this->MultiCell($wm, $high, $data[$i], $borders, $a);
			if ($b_line && in_array($i, $b_arr) || $u_line && in_array($i, $u_arr)) {
				$this->SetFont('Arial', '', 9);
			}
			$this->SetXY($x + $w, $y);
		}
		$this->Ln($h);
	}

	function Footer_table($data, $high = 5, $add_padd = 0, $u_line = false, $u_arr = '', $borders = 0, $padd_inner = false, $padd_size = 0, $list_padd = '', $b_line = false, $b_arr = ''){
		$nb = 0;
		for ($i = 0; $i < count($data); $i++) {
			$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		}
		$h = 5 * $nb;
		// $this->CheckPageBreak($h);
		for ($i = 0; $i < count($data); $i++) {
			$w = $this->widths[$i];
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			$x = $this->GetX();
			$y = $this->GetY() + $add_padd;
			if ($padd_inner) {
				$add_width = (in_array($i, $list_padd) && $padd_inner) ? $padd_size : 0;
				$w         = $w - $add_width;
				$this->Cell($padd_size);
			}
			if ($u_line && in_array($i, $u_arr)) {
				$this->SetFont('Arial', 'U', 9);
			}
			if ($b_line && in_array($i, $b_arr)) {
				$this->SetFont('Arial', 'B', 9);
			}
			$wm = ($padd_inner) ? $w - $add_width : $w;
			$this->MultiCell($wm, $high, $data[$i], $borders, $a);
			if ($b_line && in_array($i, $b_arr) || $u_line && in_array($i, $u_arr)) {
				$this->SetFont('Arial', '', 9);
			}
			$this->SetXY($x + $w, $y);
		}
		$this->Ln($h);
	}

	function Row_table_jml($data, $high = 5, $add_padd = 0, $u_line = false, $u_arr = '', $borders = 0, $padd_inner = false, $padd_size = 0, $list_padd = '', $b_line = false, $b_arr = ''){
		$nb = 0;
		for ($i = 0; $i < count($data); $i++) {
			$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		}
		$h = 5 * $nb;
		$this->CheckPageBreak($h);
		for ($i = 0; $i < count($data); $i++) {
			$w = $this->widths[$i];
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			$x = $this->GetX();
			$y = $this->GetY() + $add_padd;
			if ($padd_inner) {
				$add_width = (in_array($i, $list_padd) && $padd_inner) ? $padd_size : 0;
				$w         = $w - $add_width;
				$this->Cell($padd_size);
			}
			if ($u_line && in_array($i, $u_arr)) {
				$this->SetFont('Arial', 'U', 9);
			}
			if ($b_line && in_array($i, $b_arr)) {
				$this->SetFont('Arial', 'B', 9);
			}
			$wm = ($padd_inner) ? $w - $add_width : $w;
			if ($i == 5) {
				$this->MultiCell($wm, $high, $data[$i], $borders, $a);
			} else {
				$this->MultiCell($wm, $h, $data[$i], $borders, $a);
			}

			if ($b_line && in_array($i, $b_arr) || $u_line && in_array($i, $u_arr)) {
				$this->SetFont('Arial', '', 9);
			}
			$this->SetXY($x + $w, $y);
		}
		$this->Ln($h);
	}

	function HighlightSpecificRow($data, $colnumber, $fill = false, $add_padding = 0){
		//Calculate the height of the row
		$nb = 0;
		for ($i = 0; $i < count($data); $i++)
			$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h = 5 * $nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for ($i = 0; $i < count($data); $i++) {
			$w = $this->widths[$i];
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x = $this->GetX();
			$y = $this->GetY() + $add_padding;
			//Draw the border
			//$this->Rect($x,$y,$w,$h);
			//Print the text
			if (in_array($i, $colnumber)) {
				$fill = true;
				$this->SetFillColor(230, 230, 230);
			} else {
				$fill = false;
			}
			$this->MultiCell($w, 5, $data[$i], 0, $a, $fill);
			//$this->line($this->GetX(), $this->GetY(), $this->GetX()+$this->w-18, $this->GetY());
			//Put the position to the right of the cell
			$this->SetXY($x + $w, $y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h){
		//If the height h would cause an overflow, add a new page immediately
		if ($this->GetY() + $h > $this->PageBreakTrigger) {
			$this->AddPage($this->CurOrientation);
			$this->pcp++;
		}
	}

	function GetPcp()
	{
		return $this->pcp;
	}

	function NbLines($w, $txt){
		//Computes the number of lines a MultiCell of width w will take
		$cw = &$this->CurrentFont['cw'];
		if ($w == 0)
			$w = $this->w - $this->rMargin - $this->x;
		$wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
		$s = str_replace("\r", '', $txt);
		$nb = strlen($s);
		if ($nb > 0 and $s[$nb - 1] == "\n")
			$nb--;
		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$nl = 1;
		while ($i < $nb) {
			$c = $s[$i];
			if ($c == "\n") {
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
				continue;
			}
			if ($c == ' ')
				$sep = $i;
			$l += $cw[$c];
			if ($l > $wmax) {
				if ($sep == -1) {
					if ($i == $j)
						$i++;
				} else
					$i = $sep + 1;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
			} else
				$i++;
		}
		return $nl;
	}

	function AddCol($field = -1, $width = -1, $caption = '', $align = 'L'){
		//Add a column to the table
		if ($field == -1)
			$field = count($this->aCols);
		$this->aCols[] = array('f' => $field, 'c' => $caption, 'w' => $width, 'a' => $align);
	}

	function RotatedText($x, $y, $txt, $angle){
		//Text rotated around its origin
		$this->Rotate($angle, $x, $y);
		$this->Text($x, $y, $txt);
		$this->Rotate(0);
	}

	function Rotate($angle, $x = -1, $y = -1){
		if ($x == -1)
			$x = $this->x;
		if ($y == -1)
			$y = $this->y;
		if ($this->angle != 0)
			$this->_out('Q');
		$this->angle = $angle;
		if ($angle != 0) {
			$angle *= M_PI / 180;
			$c = cos($angle);
			$s = sin($angle);
			$cx = $x * $this->k;
			$cy = ($this->h - $y) * $this->k;
			$this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
		}
	}

	function _endpage(){
		if ($this->angle != 0) {
			$this->angle = 0;
			$this->_out('Q');
		}
		parent::_endpage();
	}

	function SetAlpha($alpha, $bm = 'Normal'){
		// set alpha for stroking (CA) and non-stroking (ca) operations
		$gs = $this->AddExtGState(array('ca' => $alpha, 'CA' => $alpha, 'BM' => '/' . $bm));
		$this->SetExtGState($gs);
	}

	function AddExtGState($parms){
		$n = count($this->extgstates) + 1;
		$this->extgstates[$n]['parms'] = $parms;
		return $n;
	}

	function SetExtGState($gs){
		$this->_out(sprintf('/GS%d gs', $gs));
	}

	function _enddoc(){
		if (!empty($this->extgstates) && $this->PDFVersion < '1.4')
			$this->PDFVersion = '1.4';
		parent::_enddoc();
	}

	function _putextgstates(){
		for ($i = 1; $i <= count($this->extgstates); $i++) {
			$this->_newobj();
			$this->extgstates[$i]['n'] = $this->n;
			$this->_out('<</Type /ExtGState');
			$parms = $this->extgstates[$i]['parms'];
			$this->_out(sprintf('/ca %.3F', $parms['ca']));
			$this->_out(sprintf('/CA %.3F', $parms['CA']));
			$this->_out('/BM ' . $parms['BM']);
			$this->_out('>>');
			$this->_out('endobj');
		}
	}

	function _putresourcedict(){
		parent::_putresourcedict();
		$this->_out('/ExtGState <<');
		foreach ($this->extgstates as $k => $extgstate)
			$this->_out('/GS' . $k . ' ' . $extgstate['n'] . ' 0 R');
		$this->_out('>>');
	}

	function _putresources(){
		$this->_putextgstates();
		parent::_putresources();
	}

	function SetDash($black = null, $white = null){
		if ($black !== null)
			$s = sprintf('[%.3F %.3F] 0 d', $black * $this->k, $white * $this->k);
		else
			$s = '[] 0 d';
		$this->_out($s);
	}

	function WordWrap(&$text, $maxwidth){
		$text = trim($text);
		if ($text === '')
			return 0;
		$space = $this->GetStringWidth(' ');
		$lines = explode("\n", $text);
		$text = '';
		$count = 0;

		foreach ($lines as $line) {
			$words = preg_split('/ +/', $line);
			$width = 0;

			foreach ($words as $word) {
				$wordwidth = $this->GetStringWidth($word);
				if ($wordwidth > $maxwidth) {
					// Word is too long, we cut it
					for ($i = 0; $i < strlen($word); $i++) {
						$wordwidth = $this->GetStringWidth(substr($word, $i, 1));
						if ($width + $wordwidth <= $maxwidth) {
							$width += $wordwidth;
							$text .= substr($word, $i, 1);
						} else {
							$width = $wordwidth;
							$text = rtrim($text) . "\n" . substr($word, $i, 1);
							$count++;
						}
					}
				} elseif ($width + $wordwidth <= $maxwidth) {
					$width += $wordwidth + $space;
					$text .= $word . ' ';
				} else {
					$width = $wordwidth + $space;
					$text = rtrim($text) . "\n" . $word . ' ';
					$count++;
				}
			}
			$text = rtrim($text) . "\n";
			$count++;
		}
		$text = rtrim($text);
		return $count;
	}

	function InlineImage($file, $x = null, $y = null, $w = 0, $h = 0, $type = '', $link = ''){
		// ----- Code from FPDF->Image() -----
		// Put an image on the page
		if ($file == '')
			$this->Error('Image file name is empty');
		if (!isset($this->images[$file])) {
			// First use of this image, get info
			if ($type == '') {
				$pos = strrpos($file, '.');
				if (!$pos)
					$this->Error('Image file has no extension and no type was specified: ' . $file);
				$type = substr($file, $pos + 1);
			}
			$type = strtolower($type);
			if ($type == 'jpeg')
				$type = 'jpg';
			$mtd = '_parse' . $type;
			if (!method_exists($this, $mtd))
				$this->Error('Unsupported image type: ' . $type);
			$info = $this->$mtd($file);
			$info['i'] = count($this->images) + 1;
			$this->images[$file] = $info;
		} else
			$info = $this->images[$file];

		// Automatic width and height calculation if needed
		if ($w == 0 && $h == 0) {
			// Put image at 96 dpi
			$w = -96;
			$h = -96;
		}
		if ($w < 0)
			$w = -$info['w'] * 72 / $w / $this->k;
		if ($h < 0)
			$h = -$info['h'] * 72 / $h / $this->k;
		if ($w == 0)
			$w = $h * $info['w'] / $info['h'];
		if ($h == 0)
			$h = $w * $info['h'] / $info['w'];

		// Flowing mode
		if ($y === null) {
			if ($this->y + $h > $this->PageBreakTrigger && !$this->InHeader && !$this->InFooter && $this->AcceptPageBreak()) {
				// Automatic page break
				$x2 = $this->x;
				$this->AddPage($this->CurOrientation, $this->CurPageSize, $this->CurRotation);
				$this->x = $x2;
			}
			$y = $this->y;
			$this->y += $h;
		}

		if ($x === null)
			$x = $this->x;
		$this->_out(sprintf('q %.2F 0 0 %.2F %.2F %.2F cm /I%d Do Q', $w * $this->k, $h * $this->k, $x * $this->k, ($this->h - ($y + $h)) * $this->k, $info['i']));
		if ($link)
			$this->Link($x, $y, $w, $h, $link);
		# -----------------------

		// Update Y
		$this->y += $h;
	}
}
