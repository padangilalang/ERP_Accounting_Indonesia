<?php

class journalVoucherList2 extends fpdf
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
				'Report Code: journalVoucherList2',0,0,'C');
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

		$w=array(7,18,14,33,18,18,70,15);
		//Header
		$this->SetFont('Arial','',8);
		$this->Cell($w[0],8,'No.',1,0,'R');
		$this->Cell($w[1],8,'Date',1);
		$this->Cell($w[2],8,'Period',1);
		$this->Cell($w[3],8,'No. Ref',1);
		$this->Cell($w[4],8,'Debit',1);
		$this->Cell($w[5],8,'Credit',1);
		$this->Cell($w[6],8,'User Remark',1);
		$this->Cell($w[7],8,'Status',1);
		$this->Ln();

		$this->Cell(array_sum($w),1,'','TB');
		$this->Ln(1);

	}

	function report($acc_id, $begin_date,$end_date,$post_id)
	{
		$this->myHeader($acc_id, $begin_date,$end_date,$post_id);

		$_count = 0;
		$_total = 0;
		$_counter = 1;
		$_countert = 1;


		$criteria= new CDbCriteria;
		$criteria->with=array('journalDetail');
		$criteria->compare('journalDetail.account_no_id',$acc_id);
		$criteria->order='t.input_date';

		if ($post_id !=0)  $criteria->compare('state_id',$post_id);

		$criteria->addBetweenCondition('input_date',Yii::app()->dateFormatter->format('yyyy-MM-dd',$begin_date),Yii::app()->dateFormatter->format('yyyy-MM-dd',$end_date));

		$models=uJournal::model()->findAll($criteria);

		$_mdate="";
		$_tdebet=0;
		$_tcredit=0;

		//Color and font restoration
		$this->SetFillColor(224,224,224);
		$this->SetTextColor(0);
		$this->SetFont('');
		//Data
		$fill=false;

		$w=array(7,18,14,33,18,18,70,15);

		foreach($models as $mod)
		{
			foreach($mod->journalDetail as $mm) {
				$this->SetFont('Arial','',8);
				$this->Cell($w[0],6,number_format($_countert,0,',','.'),'L',0,'R',$fill);
				if ($_mdate != $mod->input_date) {
					$this->Cell($w[1],6,$mod->input_date,'LT',0,'L',$fill);
				} else
					$this->Cell($w[1],6,'','L');
					
				$_mdate = $mod->input_date;
					
				$this->Cell($w[2],6,$mod->yearmonth_periode,'L',0,'L',$fill);
				$this->Cell($w[3],6,$mod->system_ref,'L',0,'L',$fill);
				$this->Cell($w[4],6,number_format($mm->debit,0,',','.'),'L',0,'R',$fill);
				$this->Cell($w[5],6,number_format($mm->credit,0,',','.'),'L',0,'R',$fill);
				$this->Cell($w[6],6,(strlen($mod->remark) >= 40 ) ? substr($mod->remark,0,38). " ... " : $mod->remark,'L',0,'L',$fill);
				$this->Cell($w[7],6,$mod->status->name,'LR',0,'L',$fill);
					
				$this->Ln();

				$_tdebet=$_tdebet+$mm->debit;
				$_tcredit=$_tcredit+$mm->credit;

				$_counter++;
				$_countert++;

				if ($_counter==34) {
					$this->Cell(array_sum($w),0,'','T');
					$this->AddPage();

					$this->myHeader($acc_id, $begin_date,$end_date,$post_id);

					$_counter = 1;

				}
				$fill=!$fill;
			}
		}

		//Closure line
		$this->Cell(array_sum($w),0,'','T');
		$this->Ln(1);

		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],8,'','TLB');
		$this->Cell($w[1],8,'T O T A L','TLB',0,'C');
		$this->Cell($w[2],8,'','TLB');
		$this->Cell($w[3],8,'','TLB');
		$this->Cell($w[4],8,number_format($_tdebet,0,',','.'),'TLB',0,'R');
		$this->Cell($w[5],8,number_format($_tcredit,0,',','.'),'TLB',0,'R');
		$this->Cell($w[6],8,'','TLB');
		$this->Cell($w[7],8,'','TLBR',0,'R');
		$this->Ln();



	}

}

?>