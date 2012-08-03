<?php

class leaveFormSum extends fpdf
{

	function report($models)
	{
		$this->y0=$this->GetY();
		$this->Cell(0,5,'','T',0,'C');
		$this->Image('images/FA-logo-APL-2.jpg',15,12,30);
		$this->SetY($this->y0);
		$this->SetFont('Arial','B',14);
		$this->Cell(0,5,'','LR');
		$this->Ln();
		$this->Cell(30,5,'','L');
		$this->Cell(0,5,'PERHITUNGAN CUTI TAHUNAN KARYAWAN','R',0,'C');
		$this->Ln();
		$this->Cell(0,5,'','LBR');
		$this->Ln(1);

		$this->SetFont('Arial','',10);
		$this->Cell(0,6,'','B',0,'C');
		$this->Ln();
		$this->Cell(35,8,'Nama','L');
		$this->SetFont('Arial','B',10);
		$this->Cell(80,8,':  '.$models->vc_psnama);
		$this->SetFont('Arial','',10);
		$this->Cell(50,8,'NRK');
		$this->Cell(60,8,'');
		$this->Cell(0,8,'','R');
		$this->Ln();
		$this->Cell(35,6,'Departemen','L');
		$this->Cell(80,6,':  '.$models->position->c_departkr);
		$this->Cell(40,6,'Tanggal Bergabung');
		$this->Cell(40,6,':  '.$models->d_joinunit);
		$this->Cell(0,6,'','R');
		$this->Ln();
		$this->Cell(35,6,'Jabatan','L');
		$this->Cell(80,6,':  '.$models->position->position->name);
		$this->Cell(0,6,'','R');
		$this->Ln(6);
		$this->Cell(0,6,'','T');
		$this->Ln(1);

		$this->SetFillColor(230,230,230);
		$w=array(23,20,23,23,23,23,55);

		$this->Cell(0,1,'','B');
		$this->Ln();
		$this->SetFont('Arial','B',9);
		$this->Cell($w[0],4,'Tgl Keluar','LTR',0,'C');
		$this->Cell($w[1],4,'Hak','LTR',0,'C');
		$this->Cell($w[2]+$w[3],4,'Tgl Cuti','LTR',0,'C');
		$this->Cell($w[4],4,'Cuti','LTR',0,'C');
		$this->Cell($w[5],4,'Sisa','LTR',0,'C');
		$this->Cell($w[6],4,'Keterangan','LTR',0,'C');
		$this->Ln();
		$this->Cell($w[0],4,'Hak Cuti','LR',0,'C'	);
		$this->Cell($w[1],4,'Cuti','LR',0,'C');
		$this->Cell($w[2]+$w[3],4,'','LR',0,'C');
		$this->Cell($w[4],4,'diambil','LR',0,'C');
		$this->Cell($w[5],4,'Cuti','LR',0,'C');
		$this->Cell($w[6],4,'','LR',0,'C');
		$this->Ln();
		$this->SetFont('Arial','',9);
		foreach ($models->leaveAll as $model) {
			if ($model->approved_id ==9) {
				$this->Cell($w[0],7,$model->d_dari,'LTR',0,'L',true);
				$this->Cell($w[1],7,$model->n_cutiii,'LT',0,'C',true);
				$this->Cell($w[2],7,'','LT',0,'L',true);
				$this->Cell($w[3],7,'','T',0,'L',true);
				$this->Cell($w[4],7,'','T',0,'L',true);
				$this->Cell($w[5],7,$model->n_sisacuti,'TLR',0,'C',true);
				$this->Cell($w[6],7,'','TLR',0,'L',true);
				$this->Ln();
			} else {
				$this->Cell($w[0],5,'','L');
				$this->Cell($w[1],5,'','R');
				$this->Cell($w[2],5,$model->d_dari,'LR',0,'C');
				$this->Cell($w[3],5,$model->d_sampai,'LR',0,'C');
				$this->Cell($w[4],5,$model->n_jmlhari,'LR',0,'C');
				$this->Cell($w[5],5,$model->n_sisacuti,'LR',0,'C');
				$this->Cell($w[6],5,substr($model->r_cuti,0,35),'LR');
				$this->Ln();
			}
		}
		$this->Cell(0,5,'','T');

	}


}

?>