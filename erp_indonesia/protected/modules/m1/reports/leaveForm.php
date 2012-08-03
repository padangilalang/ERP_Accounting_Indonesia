<?php

class leaveForm extends fpdf
{

	function report($model)
	{
		$this->y0=$this->GetY();
		$this->Cell(0,5,'','T',0,'C');
		$this->Image('images/FA-logo-APL-2.jpg',15,12,30);
		$this->SetY($this->y0);
		$this->SetFont('Arial','B',14);
		$this->Cell(0,5,'','LR');
		$this->Ln();
		$this->Cell(30,5,'','L');
		$this->Cell(0,5,'FORMULIR PERMOHONAN CUTI KARYAWAN','R',0,'C');
		$this->Ln();
		$this->Cell(0,5,'','LBR');
		$this->Ln(1);

		$this->SetFont('Arial','',10);
		$this->Cell(0,6,'','B',0,'C');
		$this->Ln();
		$this->Cell(35,8,'Nama','L');
		$this->SetFont('Arial','B',10);
		$this->Cell(80,8,':  '.$model->person->vc_psnama);
		$this->SetFont('Arial','',10);
		$this->Cell(50,8,'NRK');
		$this->Cell(60,8,'');
		$this->Cell(0,8,'','R');
		$this->Ln();
		$this->Cell(35,6,'Departemen','L');
		$this->Cell(80,6,':  '.$model->person->position->department->name);
		$this->Cell(40,6,'Tanggal Masuk Kerja');
		$this->Cell(40,6,':  '.$model->d_h_masuk);
		$this->Cell(0,6,'','R');
		$this->Ln();
		$this->Cell(35,6,'Jabatan','L');
		$this->Cell(80,6,':  '.$model->person->position->position->name);
		$this->Cell(0,6,'','R');
		$this->Ln(6);
		$this->Cell(0,6,'','T');
		$this->Ln(1);

		$this->SetFillColor(230,230,230);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,6,'CUTI TAHUNAN','LTR',0,'C',true);
		$this->Ln();
		$this->SetFont('Arial','',10);
		//$this->Cell(0,6,'CUTI TAHUNAN','LR');
		//$this->Ln();
		$this->Cell(60,6,'Akan Mengambil Cuti dari','L');
		$this->Cell(10,6,': Tgl ');
		$this->Cell(30,6,$model->d_dari);
		$this->Cell(10,6,'s/d');
		$this->Cell(30,6,$model->d_sampai);
		$this->Cell(0,6,'','R');
		$this->Ln();
		$this->Cell(60,6,'Jumlah Hari Kerja','L');
		$this->Cell(10,6,': '.$model->n_jmlhari.'  Hari');
		$this->Cell(0,6,'','R');
		$this->Ln();
		$this->Cell(60,6,'Masuk Bekerja Kembali','L');
		$this->Cell(40,6,': Hari  '.Yii::app()->dateFormatter->format("EEEE",strtotime($model->d_h_masuk)));
		//$this->Cell(20,6,Yii::app()->dateFormatter->format("EEEE",strtotime($model->d_h_masuk)));
		$this->Cell(10,6,' Tgl ');
		$this->Cell(30,6,$model->d_h_masuk);
		$this->Cell(0,6,'','R');
		$this->Ln();
		$this->Cell(60,6,'Alasan Cuti','L');
		$this->Cell(0,6,': '.$model->r_cuti,'R');
		$this->Ln();
		$this->Cell(60,6,'Pengganti selama cuti','L');
		$this->Cell(0,6,': '.$model->c_ganti,'R');
		$this->Cell(0,6,'','T');
		$this->Ln();

		$this->SetFont('Arial','B',10);
		$this->Cell(0,6,'Hak Cuti','LRT',0,'C',true);
		$this->Ln();
		$this->SetFont('Arial','',10);
		$this->Cell(140,6,'I.   Total Hak Cuti Tahunan periode tahun','L');
		$this->Cell(5,6,': ');
		$this->Cell(10,6,$model->person->leaveInitial->n_cutiii,'',0,'R');
		$this->Cell(0,6,'Hari','R');
		$this->Ln();
		$this->Cell(140,5,'II.  Cuti yang telah diambil','L');
		$this->Cell(5,5,': ');
		$this->Cell(10,5,$model->person->leaveInitial->n_cutiii-$model->person->leaveBalance->n_sisacuti,'',0,'R');
		$this->Cell(0,5,'Hari','R');
		$this->Ln();
		$this->SetFont('Arial','',9);
		$this->Cell(110,4,'        1. Cuti Masal','L');
		$this->Cell(5,4,': ');
		$this->Cell(10,4,$model->person->leaveBalance->c_masal,'',0,'R');
		$this->Cell(0,4,'Hari','R');
		$this->Ln();
		$this->Cell(110,4,'        2. Cuti Pribadi','L');
		$this->Cell(5,4,': ');
		$this->Cell(10,4,$model->person->leaveBalance->c_pribadi,'',0,'R');
		$this->Cell(0,4,'Hari','R');
		$this->Ln();
		$this->SetFont('Arial','',10);
		$this->Cell(5,5,'','L');
		$this->Cell(135,5,' Sisa Cuti yang bisa diambil','B');
		$this->Cell(5,5,': ','B');
		$this->Cell(10,5,$model->person->leaveBalance->n_sisacuti,'B',0,'R');
		$this->Cell(10,5,'Hari','B');
		$this->Cell(0,5,'','R');
		$this->Ln();
		$this->Cell(140,6,'III.  Pengajuan Cuti yang akan diambil','L');
		$this->Cell(5,6,': ');
		$this->Cell(10,6,$model->n_jmlhari,'',0,'R');
		$this->Cell(0,6,'Hari','R');
		$this->Ln();
		$this->SetFont('Arial','B',10);
		$this->Cell(140,6,'IV.  Sisa Cuti','LB');
		$this->Cell(5,6,': ','B');
		$this->Cell(10,6,$model->person->leaveBalance->n_sisacuti-$model->n_jmlhari,'B',0,'R');
		$this->Cell(0,6,'Hari','BR');
		$this->Ln();

		$this->Cell(0,5,'Catatan: ','LR');
		$this->Ln();
		$this->SetFont('Arial','',9);
		$this->Cell(0,4,'  1. Menyerahkan kewajiban pekerjaan kepada pengganti sementara','LR');
		$this->Ln();
		$this->Cell(0,4,'  2. Cuti diluar tanggungan atau cuti yang melebihi hak cuti akan diperhitungkan dalam upah bulan berikutnya','LR');
		$this->Ln();
		$this->Cell(0,2,'','LBR');
		$this->Ln();

		$w=array(63,63,64);

		$this->Cell(0,1,'','B');
		$this->Ln();
		$this->SetFont('Arial','',9);
		$this->Cell($w[0],5,'Diajukan oleh:','LTR',0,'C',true);
		$this->Cell($w[1],5,'Disetujui oleh:','LTR',0,'C',true);
		$this->Cell($w[2],5,'Diketahui oleh:','LTR',0,'C',true);
		$this->Ln();
		$this->Cell($w[0],25,'','LR');
		$this->Cell($w[1],25,'','LR');
		$this->Cell($w[2],25,'','LR');
		$this->Ln();
		$this->SetFont('Arial','',8);
		$this->Cell($w[0],8,'Nama:  '.$model->person->vc_psnama,1);
		$this->Cell($w[1],8,'Nama:',1);
		$this->Cell($w[2],8,'Nama:',1);
		$this->Ln();
		$this->Cell($w[0],6,'Tanggal:  '.$model->d_cuti,'LTR');
		$this->Cell($w[1],6,'Tanggal:','LTR');
		$this->Cell($w[2],6,'Tanggal:','LTR');
		$this->Ln();
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],4,'Karyawan','LBR',0,'C',true);
		$this->Cell($w[1],4,'Atasan Terkait','LBR',0,'C',true);
		$this->Cell($w[2],4,'Pihak HR','LBR',0,'C',true);

	}


}

?>