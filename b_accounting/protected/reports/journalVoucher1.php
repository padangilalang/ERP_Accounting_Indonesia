<?php

class journalVoucher1 extends fpdf
{
	//Page header
	function Header()
	{
		$this->y0=$this->GetY();
		//$this->Image('css/LOGO.jpg',15,7,30);
		$this->SetY($this->y0);
		$this->SetFont('Arial','B',12);
		$this->Cell(20);
		$this->Cell(0,5,Yii::app()->name,0,0,'R');
		$this->Ln();
		$this->Cell(190,0,'','B');
		$this->Ln();
	}

	function report($id)
	{
		$this->SetFont('Arial','B',12);
		$this->Cell(0,8,'JOURNAL VOUCHER','',0,'C');
		$this->Ln(8);

		$model=uJournal::model()->findByPk((int)$id);

		//Header
		$this->SetFont('Arial','',10);
		$this->Cell(25,4,'Voucher No.');
		$this->SetFont('Arial','B',10);
		$this->Cell(50,4,': '. $model->system_ref);
		$this->Ln();
		$this->SetFont('Arial','',10);
		$this->Cell(25,4,'Date');
		$this->SetFont('Arial','B',10);
		$this->Cell(60,4,': '. $model->input_date);
		$this->Ln();
		$this->SetFont('Arial','',10);
		$this->Cell(25,4,'Periode');
		$this->SetFont('Arial','B',10);
		$this->Cell(60,4,': '. $model->yearmonth_periode);
		$this->Ln(4);
		$this->SetFont('Arial','',10);
		$this->Cell(25,4,'Description');
		$this->Cell(60,4,': '. $model->remark);
		$this->Ln(6);

		$w=array(70,25,25,70);
		//Header
		$this->SetFont('Arial','B',10);
		$this->Cell($w[0],9,'Account Name','LTBR',0,'C');
		$this->Cell($w[1],9,'Debit','TBR',0,'C');
		$this->Cell($w[2],9,'Credit','TBR',0,'C');
		$this->Cell($w[3],9,'Remark','TBR',0,'C');
		$this->Ln();

		$modelD=uJournalDetail::model()->findAll('parent_id = '.(int)$id);
		//Detail
		foreach ($modelD as $mod) {
			$this->SetFont('Arial','',10);
			$this->Cell($w[0],5,$mod->account->account_no.". ".$mod->account->account_name,'LR');
			$this->Cell($w[1],5,number_format($mod->debit,0,',','.'),'LR',0,'R');
			$this->Cell($w[2],5,number_format($mod->credit,0,',','.'),'R',0,'R');
			$this->Cell($w[3],5,$mod->user_remark ,'R');
			$this->Ln();
		}

		$this->SetFont('Arial','B',10);
		$this->Cell($w[0],6,'TOTAL','TLR',0,'R');
		$this->Cell($w[1],6,number_format($model->journalSum,0,',','.'),'TLR',0,'R');
		$this->Cell($w[2],6,number_format($model->journalSum,0,',','.'),'TR',0,'R');
		$this->Cell($w[3],6,'','TR');
		$this->Ln();
			
		//Closure line
		$this->Cell(array_sum($w),0,'','T');
		$this->Ln(2);
		$bilangan= new terbilang;
		$this->SetFont('Arial','B',10);
		$this->Cell(0,4,'Say: '. $bilangan->eja($model->journalSum)."Rupiah");
		$this->Ln(10);

		$w=array(63,63,63);
		$this->SetFont('Arial','',10);
		$this->Cell($w[0],6,'Created By','LTR',0,'C');
		$this->Cell($w[1],6,'Approved By','TR',0,'C');
		$this->Cell($w[2],6,'Receiver','TR',0,'C');
		$this->Ln();
		$this->Cell($w[0],18,'','LR');
		$this->Cell($w[1],18,'','R');
		$this->Cell($w[2],18,'','R');
		$this->Ln();
		$this->Cell($w[1],6,'','LBR',0,'C');
		$this->Cell($w[1],6,'','BR',0,'C');
		$this->Cell($w[2],6,$model->user_ref,'RB',0,'C');
		$this->Ln(5);
		$this->SetFont('Arial','',10);
		$this->Cell($w[0],6,'','LBR');
		$this->Cell($w[1],6,'','BR',0,'C');
		$this->Cell($w[2],6,'','BR',0,'C');
		$this->Ln();


	}

}

?>