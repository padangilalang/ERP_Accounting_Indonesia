<?php

class journalVoucherList1 extends fpdf
{
	//Page footer
	function Footer()
	{
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',8);
		//Page number
		$this->Cell(0,10,'Print Date: '. Yii::app()->dateFormatter->format('dd-MM-yyyy',time()) . '                        ' .
				'Page: '.$this->PageNo().'/{nb}'                                         . '                        ' .
				'Report Code: journalVoucherList1',0,0,'C');
	}

	//Page header
	function myHeader($acc_id, $begin_date,$end_date,$post_id)
	{
		$this->y0=$this->GetY();
		//$this->Image('css/LOGO.jpg',15,7,30);
		$this->SetY($this->y0);
		$this->SetFont('Arial','B',12);
		$this->Cell(0,5,Yii::app()->name,0,0,'R');
		$this->Ln();
		$this->Cell(190,0,'','B');
		$this->Ln();

		$this->SetFont('Arial','B',12);
		$this->Cell(0,8,'JOURNAL VOUCHER LIST','',0,'C');
		$this->Ln();

		$this->Cell(190,0,'','B');
		$this->Ln();
		$this->SetFont('Arial','',10);
		$this->Cell(25,4,'Account No','L');
		$this->SetFont('Arial','B',10);
		$this->Cell(0,4,': '. tAccount::model()->findByPk($acc_id)->account_concat(),'R');
		$this->Ln();
		$this->SetFont('Arial','',10);
		$this->Cell(25,4,'Periode: ','L');
		$this->SetFont('Arial','B',10);
		$this->Cell(0,4,': '. $begin_date." to ".$end_date,'R');
		$this->Ln();
		$this->Cell(190,0,'','B');

		$this->Ln(8);

	}

	function report($acc_id, $begin_date,$end_date,$post_id)
	{
		$this->myHeader($acc_id, $begin_date,$end_date,$post_id);

		$criteria= new CDbCriteria;
		$criteria->with=array('journalDetail');
		$criteria->group='t.id, module_id, input_date, yearmonth_periode, system_ref, state_id';
		$criteria->join='INNER JOIN u_journal_detail tt ON t.id = tt.parent_id';
		$criteria->compare('tt.account_no_id',$acc_id);
		$criteria->order='t.input_date';

		if ($post_id !=0)  $criteria->compare('state_id',$post_id);

		$criteria->addBetweenCondition('input_date',Yii::app()->dateFormatter->format('yyyy-MM-dd',$begin_date),Yii::app()->dateFormatter->format('yyyy-MM-dd',$end_date));

		$models=uJournal::model()->findAll($criteria);

		foreach ($models as $model) {
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

			$modeld=uJournalDetail::model()->findAll('parent_id = '.$model->id);
			foreach ($modeld as $mod) {
				$this->SetFont('Arial','',10);
				$this->Cell($w[0],5,$mod->account->account_concat(),'LR');
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
			$this->Cell(array_sum($w),6,'','T');
			$this->Ln(8);

			if ($this->GetY() >=215) {
				$this->AddPage();
				$this->myHeader($acc_id, $begin_date,$end_date,$post_id);
			}
		}

	}

}

?>