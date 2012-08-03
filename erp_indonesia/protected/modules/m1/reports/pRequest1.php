<?php

class Prequest1 extends fpdf
{

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
				'Report Code: pRequest1/R1',0,0,'C');
		$this->Ln();
		$this->Cell(0,4,'Office Management Information System',0,0,'C');
	}



	function myheader4($id)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('parent_id',$id);
		$model=aPorderDetail::model()->find($criteria);

		$this->SetFont('Arial','B',12);
		$this->Cell(0,6,'PT. AGUNG PODOMORO LAND, Tbk');
		$this->Ln(3);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,6,'*********************');
		//$this->Cell(0,7,aOrganization::model()->findByPk(aPorder::model()->findByPk($model->parent_id)->costcenter_id)->name);
		$this->Ln(10);
		$this->Cell(20,6,'Department');
		$this->Cell(20,6,'');
		//$this->Cell(60,4,aOrganization::model()->findByPk(aPorder::model()->findByPk($model->parent_id)->costcenter_id)->name,'B',0,'C');
		$this->Cell(60,4,'Office Management','B',0,'C');
		$this->Cell(60,6,'');
		$this->Cell(20,6,'NO:');
		$this->Cell(40,6,'');
		$this->Ln(4);
		$this->Cell(20,6,'Date of Request');
		$this->Cell(20,6,'');
		$this->Cell(60,4,sParameter::cDateDisplay(strtotime(aPorder::model()->findByPk($model->parent_id)->input_date)),'B',0,'C');
		$this->Ln();

		$this->SetFont('Arial','B',12);
		$this->Cell(0,12,'PURCHASE REQUISITION',0,0,'C');
		$this->Ln();

		$w=array(6,65,40,10,10,20,20,25,15,10,10,10,10,20);
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6],6,'FILLED BY REQUESTER',1,0,'C');
		$this->Cell($w[7],6,'FILLED BY HRD',1,0,'C');
		$this->Cell($w[8]+$w[9]+$w[10]+$w[11]+$w[12]+$w[13],6,'FILLED BY FINANCE',1,0,'C');
		$this->Ln();
		$this->Cell($w[0],6,'No','LBT');
		$this->Cell($w[1],6,'DETAIL DESCRIPTION','LBT',0,'C');
		$this->Cell($w[2],6,'USER NAME','LBT',0,'C');
		$this->Cell($w[3],6,'UOM','LBT',0,'C');
		$this->Cell($w[4],6,'QTY','LBT',0,'C');
		$this->Cell($w[5],6,'ESTIMATED ','LBT',0,'C');
		$this->Cell($w[6],6,'NEED BY','LBT',0,'C');
		$this->Cell($w[7],6,'SUPPLIER','LBT',0,'C');
		$this->Cell($w[8],6,'ACC CODE','LBTR',0,'C');
		$this->Cell($w[9],6,'DATE','LBTR',0,'C');
		$this->Cell($w[10],6,'NO','LBTR',0,'C');
		$this->Cell($w[11],6,'DATE','LBTR',0,'C');
		$this->Cell($w[12],6,'NO','LBTR',0,'C');
		$this->Cell($w[13],6,'AMOUNT','LBTR',0,'C');
		$this->Ln();
	}

	function pRequestR1($id)
	{
		$this->myheader4($id);

		$criteria=new CDbCriteria;
		$criteria->compare('parent_id',$id);
		$models=aPorderDetail::model()->findAll($criteria);

		$_counter = 1;
		$_countert = 1;
		$_totalc = 0;
		$_totals = 0;
		$w=array(6,65,40,10,10,20,20,25,15,10,10,10,10,20);
		$x = $this->GetX();
		$y = $this->GetY();

		foreach($models as $mod)
		{
			$this->SetFont('Arial','',8);
			$x0 = $this->GetX();
			$y0 = $this->GetY();
			$this->Cell($w[0],4,number_format($_countert,0,',','.'),'L',0,'R');

			$y1 = $this->GetY();
			$this->MultiCell($w[1],4,aBudget::model()->findByPk($mod->budget_id)->code . " " .$mod->description,'LB');
			$y2 = $this->GetY();
			$yH = $y2 - $y1;

			$yC=$this->GetY();

			$this->SetXY($x0, $y0);
			$this->Cell($w[0],$yH,'','LB');  //Garis samping

			$this->SetXY($x + $w[0]+$w[1], $yC - $yH);

			$this->Cell($w[2],$yH,$mod->user,'LB');

			$this->Cell($w[3],$yH,$mod->uom,'LB');
			$this->Cell($w[4],$yH,$mod->qty,'LB',0,'R');
			$this->Cell($w[5],$yH,'','LB',0,'R');
			$this->Cell($w[6],$yH,sParameter::cDateDisplay(strtotime($mod->need_date)),'LB',0,'R');
			$this->Cell($w[7],$yH,'','LB',0,'R');
			$this->Cell($w[8],$yH,'','LB',0,'R');
			$this->Cell($w[9],$yH,'','LB',0,'R');
			$this->Cell($w[10],$yH,'','LB',0,'R');
			$this->Cell($w[11],$yH,'','LB',0,'R');
			$this->Cell($w[12],$yH,'','LB',0,'R');
			$this->Cell($w[13],$yH,'','LBR',0,'R');
			$this->Ln();


			$_totalc = $_totalc + $mod->qty  ;
			$_totals = $_totals + aBudget::model()->findByPk($mod->budget_id)->amount  ;

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

		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],5,'','TLB');
		$this->Cell($w[1],5,'T O T A L','TLB',0,'C');
		$this->Cell($w[2],5,'','TLB');
		$this->Cell($w[3],5,'','TLB');
		$this->Cell($w[4],5,number_format($_totalc,0,',','.'),'TLBR',0,'R');
		$this->Cell($w[5],5,'','TLBR',0,'R');
		$this->Cell($w[6],5,'','TLB');
		$this->Cell($w[7],5,'','TLB');
		$this->Cell($w[8],5,'','TLB');
		$this->Cell($w[9],5,'','TLB');
		$this->Cell($w[10],5,'','TLB');
		$this->Cell($w[11],5,'','TLB');
		$this->Cell($w[12],5,'','TLB');
		$this->Cell($w[13],5,'',1);
		$this->Ln(10);

		$this->SetFont('Arial','',8);
		$this->Cell(30,6,'Keterangan:');
		$this->Ln(4);
		$this->Cell(0,6,aPorder::model()->findByPk($mod->parent_id)->remark);
		$this->Ln(14);

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
		$this->Cell(0,6,aPorder::model()->findByPk($mod->parent_id)->no_ref . "         ",0,0,'R');
		$this->Ln();


	}


}

?>