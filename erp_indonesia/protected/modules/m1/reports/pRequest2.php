<?php

class pRequest2 extends fpdf
{

	public $w;
	//$w=array(8,35,60,30,40,40,60);

	//Page footer
	function Footer()
	{
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',6);
		//Page number
		$this->Cell(0,4,'Print Date: '. Yii::app()->dateFormatter->format("dd-MM-yyyy",time()) . '                        ' .
				'Page: '.$this->PageNo().'/{nb}'                                         . '                        ' .
				'Report Code: pRequest2/R2',0,0,'C');
		$this->Ln();
		$this->Cell(0,4,'Office Management Information System',0,0,'C');
	}



	function myheader4($id)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('parent_id',$id);
		$criteria->compare('tcredit>',0);
		$model=aBudgetDetail::model()->find($criteria);

		$this->SetFont('Arial','B',12);
		$this->Cell(0,6,'PT. AGUNG PODOMORO LAND, Tbk');
		$this->Ln(3);
		$this->SetFont('Arial','B',10);
		//$this->Cell(0,6,'Central Park');
		$this->Cell(0,7,aOrganization::model()->findByPk(aPorder::model()->findByPk($model->parent_id)->costcenter_id)->name);
		$this->Ln(10);
		$this->Cell(30,6,'Tahun:');
		$this->Cell(0,6,aBudget::model()->findByPk($model->parent_id)->year);
		$this->Ln(4);
		$this->Cell(30,6,'Budget:');
		$this->Cell(0,6,aBudget::model()->findByPk($model->parent_id)->name);
		$this->Ln(4);
		$this->Cell(30,6,'Total Budget:');
		$this->Cell(0,6,number_format(aBudget::model()->findByPk($model->parent_id)->sum_af),0,',','.');
		$this->Ln(10);

		$w=array(8,25,50,30,30,30,40,50);
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],6,'NO',1);
		$this->Cell($w[1],6,'INPUT DATE',1,0,'C');
		$this->Cell($w[2],6,'NO REF',1,0,'C');
		$this->Cell($w[3],6,'PERIODE DATE',1,0,'C');
		$this->Cell($w[4],6,'TOTAL PR',1,0,'C');
		$this->Cell($w[5],6,'BALANCE',1,0,'C');
		$this->Cell($w[6],6,'ISSUER VIA ',1,0,'C');
		$this->Cell($w[7],6,'REMARK ',1,0,'C');
		$this->Ln();
	}

	function pRequestR2($id)
	{
		$this->myheader4($id);

		$criteria=new CDbCriteria;
		$criteria->compare('parent_id',$id);
		$criteria->compare('tcredit>',0);
		$criteria->order='periode_date, id';
		$models=aBudgetDetail::model()->findAll($criteria);


		$_counter = 1;
		$_countert = 1;
		$_totalc = 0;
		$_totals = 0;
		$w=array(8,25,50,30,30,30,40,50);

		//Saldo Awal
		$criteria1=new CDbCriteria;
		$criteria1->compare('parent_id',$id);
		$criteria1->compare('tdebt>',0);
		$criteria1->order='periode_date, id';
		$modelt=aBudgetDetail::model()->find($criteria1);
		$this->SetFont('Arial','',8);
		$this->Cell($w[0],6,$_counter,'LB',0,'R');
		$this->Cell($w[1],6,$modelt->input_date,'LB');
		$this->Cell($w[2],6,$modelt->no_ref,'LB');
		$this->Cell($w[3],6,$modelt->periode_date,'LB');
		$this->Cell($w[4],6,'','LB',0,'R');
		$this->SetFont('Arial','B',8);
		$this->Cell($w[5],6,number_format($modelt->tdebt,0,',','.'),'LB',0,'R');
		$this->Cell($w[6],6,'','LB');
		$this->SetFont('Arial','',8);
		$this->Cell($w[7],6,$modelt->remark,'LBR');
		$this->Ln();
		//End of Saldo Awal

		$_counter++;

		foreach($models as $mod)
		{
			$this->SetFont('Arial','',8);
			$this->Cell($w[0],6,$_counter,'LB',0,'R');
			$this->Cell($w[1],6,$mod->input_date,'LB');
			$this->Cell($w[2],6,$mod->no_ref,'LB');
			$this->Cell($w[3],6,sParameter::BulanTahun1($mod->periode_date),'LB');
			$this->Cell($w[4],6,number_format($mod->tcredit,0,',','.'),'LB',0,'R');
			$this->Cell($w[4],6,number_format($mod->balance,0,',','.'),'LB',0,'R');
			$this->Cell($w[6],6,aPorder::model()->issuerBy((int)$mod->prequest_id),'LB');
			$this->Cell($w[7],6,$mod->remark,'LBR');
			$this->Ln();

			$_totalc = $_totalc + $mod->tcredit  ;

			$_counter++;
			$_countert++;

			//if ($_counter==34) {
			//	$this->AddPage();

			//	$this->myheader4($id);

			//	$_counter = 1;
			//}
		}

		//Closure line
		$this->Cell(array_sum($w),0,'','T');
		$this->Ln(2);

		$w=array(8,25,50,30,30,30,40,50);
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],6,'',1);
		$this->Cell($w[1],6,'',1,0,'C');
		$this->Cell($w[2],6,'',1,0,'C');
		$this->Cell($w[3],6,'',1,0,'C');
		$this->Cell($w[4],6,number_format($_totalc,0,',','.'),1,0,'R');
		$this->Cell($w[5],6,number_format($mod->balance,0,',','.'),1,0,'R');
		$this->Cell($w[6],6,'',1,0,'C');
		$this->Cell($w[7],6,'',1,0,'C');
		$this->Ln();

		/*		$this->SetFont('Arial','',8);
		 $this->Cell(30,6,'Keterangan');
		$this->Ln();
		$this->Cell(0,6,aBudgetDetail::model()->findByPk($mod->parent_id)->remark);
		$this->Ln(10);

		$this->SetFont('Arial','',10);
		$this->Cell($w[0],6,'','LT');
		$this->Cell($w[1],6,'Requested By','TR',0,'C');
		$this->Cell($w[2],6,'','T',0,'C');
		$this->Cell($w[3],6,'','T',0,'C');
		$this->Cell($w[4],6,'','T',0,'C');
		$this->Cell($w[5],6,'','T',0,'C');
		$this->Cell($w[6],6,'','T',0,'C');
		$this->Cell($w[7],6,'Acknowledge By:','T',0,'C');
		$this->Cell($w[8],6,'','T',0,'C');
		$this->Cell($w[9],6,'','T',0,'C');
		$this->Cell($w[10],6,'','T',0,'C');
		$this->Cell($w[11],6,'','T',0,'C');
		$this->Cell($w[12],6,'','T',0,'C');
		$this->Cell($w[13],6,'','TR',0,'C');
		$this->Ln();
		$this->Cell($w[0],18,'','L');
		$this->Cell($w[1],18,'','R');
		$this->Cell($w[2],18);
		$this->Cell($w[3],18);
		$this->Cell($w[4],18);
		$this->Cell($w[5],18);
		$this->Cell($w[6],18);
		$this->Cell($w[7],18);
		$this->Cell($w[8],18);
		$this->Cell($w[9],18);
		$this->Cell($w[10],18);
		$this->Cell($w[11],18);
		$this->Cell($w[12],18);
		$this->Cell($w[13],18,'','R');
		$this->Ln();
		$this->Cell($w[0],6,'','L');
		$this->Cell($w[1],6,'Silvia Theresia','R',0,'C');
		$this->Cell($w[2],6,'',0,0,'C');
		$this->Cell($w[3],6,'',0,0,'C');
		$this->Cell($w[4]+$w[5],6,'Hadi Sutanto',0,0,'C');
		$this->Cell($w[6],6,'',0,0,'C');
		$this->Cell($w[7],6,'',0,0,'C');
		$this->Cell($w[8],6,'',0,0,'C');
		$this->Cell($w[9]+$w[10]+$w[11],6,'Indra W. Antono',0,0,'C');
		$this->Cell($w[12],6,'',0,0,'C');
		$this->Cell($w[13],6,'','R','C');
		$this->Ln(3);
		$this->SetFont('Arial','',8);
		$this->Cell($w[0],6,'','LB');
		$this->Cell($w[1],6,'Office Support Manager','BR',0,'C');
		$this->Cell($w[2],6,'','B',0,'C');
		$this->Cell($w[3],6,'','B',0,'C');
		$this->Cell($w[4]+$w[5],6,'Fin & Acc Deputy Director','B',0,'C');
		$this->Cell($w[6],6,'','B',0,'C');
		$this->Cell($w[7],6,'','B',0,'C');
		$this->Cell($w[8],6,'','B',0,'C');
		$this->Cell($w[9]+$w[10]+$w[11],6,'Marketing Director','B',0,'C');
		$this->Cell($w[12],6,'','B',0,'C');
		$this->Cell($w[13],6,'','BR','C');
		$this->Ln();
		$this->SetFont('Arial','BI',8);
		$this->Cell(0,6,aBudgetDetail::model()->findByPk($mod->parent_id)->no_ref . "         ",0,0,'R');
		$this->Ln();
		*/

	}


}

?>