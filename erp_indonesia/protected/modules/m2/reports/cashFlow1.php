<?php

class cashFlow1 extends fpdf
{
	//Page footer
	function Footer()
	{
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',8);
		//Page number
		$this->Cell(0,10,'Print Date: '. Yii::app()->dateFormatter->format("dd-MM-yyyy",time()) . '                        ' .
				'Page: '.$this->PageNo().'/{nb}'                                         . '                        ' .
				'Report Code: cashFlow1',0,0,'C');
	}

	function myheader($periode_date,$report_id)
	{
		//Header

		$this->y0=$this->GetY();
		//$this->Image('css/Logo_GBI.jpg',14,9,12);
		$this->SetY($this->y0);
		$this->SetFont('Arial','B',10);
		$this->Cell(20);
		$this->Cell(100,5,Yii::app()->name);
		$this->Ln();
		$this->Cell(20);
		$this->SetFont('Arial','',10);
		$this->Cell(100,5,Yii::app()->params['subTitle']);
		$this->Ln(7);
		$this->Cell(0,2,'','T');
		$this->Ln();

		$this->SetFont('Arial','B',12);
		$this->Cell(0,5,'CASH FLOW (STANDARD)',0,0,'C');
		$this->Ln();
		$this->SetFont('Arial','B',8);
		$this->Cell(0,4,'Periode: '.$periode_date,0,0,'C');

		$this->Ln(6);

		$w=array(120,20);
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],5,'DESCRIPTION','B');
		$this->x0=$this->GetX();
		$this->Cell($w[1],5,'BALANCE','B',0,'R');
		$this->Ln(6);

	}

	/*	function penerimaan() {
		$rawData=Yii::app()->db->createCommand(
				'SELECT b.account_no_id, Sum(b.debit) AS T_debit, Sum(b.credit) AS T_credit
				FROM u_journal a
				INNER JOIN u_journal_detail b ON a.id = b.parent_id
				WHERE a.id IN (
						SELECT c.id FROM u_journal c INNER JOIN u_journal_detail d ON c.id = d.parent_id
						WHERE d.account_no_id = 8 AND c.state_id = 4 and c.yearmonth_periode = 201202)
				AND b.account_no_id <> 8
				GROUP BY b.account_no_id
				HAVING T_credit <>0'
		);

	return new CArrayDataProvider($rawData, array(
			//'pagination'=>false,
			//),
	);


	}
	*/


	function report($periode_date,$report_id)
	{
		$this->myheader($periode_date,$report_id);

		$w=array(100,20);
		$_s=5;

		$_subtotal=0;

		$criteria=new CDbCriteria;
		$criteria->with=array('cashbank','entity');

		$criteria->order='account_no';

		$models=tAccount::model()->findAll($criteria);

		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],4,'Account Cash Bank, Beginning Balance');
		$this->SetX($this->x0);
		$this->Ln();

		foreach($models as $model) {
			$this->SetFont('Arial','',8);
			$this->Cell($_s,4,'');
			$this->Cell($w[0],4,$model->account_concat());
			$this->SetX($this->x0);

			$_model=$model->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
			if (isset($_model->end_balance)){
				$_balance=number_format($_model->end_balance,0,',','.');
				$_subtotal=$_subtotal+$_model->end_balance;
			} else
				$_balance=0;

			$this->Cell($w[1],4,$_balance,0,0,'R');
			$this->Ln();

		}

		$this->SetFont('Arial','B',8);
		//$this->Cell($_s,4,'');
		$this->Cell($w[0],4,'TOTAL '.$model->account_name);
		$this->SetX($this->x0);
		$this->Cell($w[1],4,number_format($_subtotal,0,',','.'),'T',0,'R');
		$this->Ln(5);

		$model=$this->penerimaan();




	}
}
?>