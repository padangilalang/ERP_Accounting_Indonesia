<?php

class aApprovalForm1 extends fpdf
{
	//Page footer
	function Footer()
	{
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',6);
		//Page number
		$this->Cell(0,10,'Print Date: '. Yii::app()->dateFormatter->format("dd-MM-yyyy",time()) . '                        ' .
				'Page: '.$this->PageNo().'/{nb}'                                         . '                        ' .
				'Report Code: appForm1/R2',0,0,'C');
	}

	function myHeader($model) {

		$this->SetFont('Arial','B',6);
		$this->Cell(50,4,'PT. AGUNG PODOMORO LAND, Tbk');
		$this->Ln(3);
		$this->Cell(50,4,'Budget Information vs Actual');
		$this->Cell(100);
		$this->SetFont('Arial','',6);
		$this->Cell(20,4,'Control Form No.# ');
		$this->SetFont('Arial','B',6);
		$this->Cell(15,4,$model->no_ref);
		$this->Ln(5);

		//Header
		$this->SetFont('Arial','',6);
		$this->Cell(30,5,'Project:');
		$this->SetFont('Arial','B',6);
		$this->Cell(50,5,$model->organization->getTopLevel());
		$this->Ln(3);
		$this->SetFont('Arial','',6);
		$this->Cell(30,5,'Department:');
		$this->SetFont('Arial','B',6);
		$this->Cell(50,5,$model->organization->name);
		$this->Ln(3);
		$this->SetFont('Arial','',6);
		$this->Cell(30,5,'Budget Category:');
		$this->SetFont('Arial','B',6);
		$this->Cell(50,5,$model->budgetcomp->name);
		$this->Ln(3);
		$this->SetFont('Arial','',6);
		$this->Cell(30,5,'Date');
		$this->SetFont('Arial','B',6);
		$this->Cell(50,5,$model->input_date);
		$this->Ln(10);
			
		$w=array(13,93,20,20,22,22);


		$this->SetFont('Arial','B',8);
		$this->SetFont('Arial','',8);
		$this->Cell($w[0]+$w[1],4,'','TLR');
		$this->Cell($w[2]+$w[3],4,'Budget 2012',1,0,'C');
		$this->Cell($w[4]+$w[5],4,'Requisition',1,0,'C');
		$this->Ln();
		$this->Cell($w[0]+$w[1],4,'DESCRIPTION','LR',0,'C');
		$this->Cell($w[2],4,'Actual YTD','TLR',0,'C');
		$this->Cell($w[3],4,'Balance YTD','TLR',0,'C');
		$this->Cell($w[4],4,'Amount','TLR',0,'C');
		$this->Cell($w[5],4,'Balance after','TLR',0,'C');
		$this->Ln();
		$this->Cell($w[0]+$w[1],4,'','LR',0,'C');
		$this->Cell($w[2],4,'','LR',0,'C');
		$this->Cell($w[3],4,'','LR',0,'C');
		$this->Cell($w[4],4,'','LR',0,'C');
		$this->Cell($w[5],4,'Requisition YTD','LR',0,'C');
		$this->Ln();

		/**/
		$_amount=$model->budgetcomp->amount;
		$_actual=$model->budgetcomp->sum_budget;
		$_currentbalance=$_amount-$_actual;
		$_newbalance=$_currentbalance-$model->sum_po;

		/**/

		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],6,'Beginning Balance (Jan - Dec 2012)','LTB');
		$this->Cell($w[1],6,number_format($_amount,0,',','.'),'TBR',0,'R');
		$this->Cell($w[2],6,number_format($_actual,0,',','.'),1,0,'R');
		$this->Cell($w[3],6,number_format($_currentbalance,0,',','.'),1,0,'R');
		$this->Cell($w[4],6,number_format($model->sum_po,0,',','.'),1,0,'R');
		$this->Cell($w[5],6,number_format($_newbalance,0,',','.'),1,0,'R');
		$this->Ln();

		$this->Cell($w[0],1,'','T');
		$this->Cell($w[1],1,'','T');
		$this->Cell($w[2],1,'','T');
		$this->Cell($w[3],1,'','T');
		$this->Cell($w[4],1,'','T');
		$this->Cell($w[5],1,'','T');
		$this->Ln();

	}

	function approvalFormR1($id)
	{

		$criteria=new CDbCriteria;
		$model=aPorder::model()->with('po_detail')->findByPk((int)$id);

		$this->myHeader($model);

		$w=array(13,93,20,20,22,22);

		$this->SetFont('Arial','',8);
		$this->Cell($w[0],4,'Previous Approval Form:','B');
		$this->Cell($w[1],4,'','B');
		$this->Cell($w[2],4,'','B');
		$this->Cell($w[3],4,'','B');
		$this->Cell($w[4],4,'','B');
		$this->Cell($w[5],4,'','B');
		$this->Ln();

		$modelp=aPorder::model()->with('po_detail')->findAll(array('condition'=>'length(approved_date) <> 0 AND t.id <> '.$id .' AND budgetcomp_id = ' .$model->budgetcomp_id,'order'=>'t.id'));

		$this->SetFont('Arial','',8);
		foreach($modelp as $modp)
		{
			$this->Cell($w[0],6,'','LR');
			$this->SetFont('Arial','B',8);
			$this->Cell($w[1],6,$modp->input_date.'     '.$modp->no_ref ,'LR');
			$this->SetFont('Arial','',8);
			$this->Cell($w[2],6,number_format($modp->sum_po,0,',','.'),'LR',0,'R');
			$this->Cell($w[3],6,'','LR');
			$this->Cell($w[4],6,'','LR');
			$this->Cell($w[5],6,'','LR');
			$this->Ln();

		}

		$this->Cell($w[0],1,'','T');
		$this->Cell($w[1],1,'','T');
		$this->Cell($w[2],1,'','T');
		$this->Cell($w[3],1,'','T');
		$this->Cell($w[4],1,'','T');
		$this->Cell($w[5],1,'','T');
		$this->Ln();

		$this->SetFont('Arial','',8);
		$this->Cell($w[0],4,'Current Requisition:','B');
		$this->Cell($w[1],4,'','B');
		$this->Cell($w[2],4,'','B');
		$this->Cell($w[3],4,'','B');
		$this->Cell($w[4],4,'','B');
		$this->Cell($w[5],4,'','B');
		$this->Ln();

		//Detail
		$_total = 0;
		$_total1 = 0;
		$_counter = 1;
		$_countert = 1;

		$this->SetFont('Arial','',8);
		$w=array(13,93,20,20,22,22);
		$x = $this->GetX();
		$y = $this->GetY();
		$_dept=0;

		foreach($model->po_detail as $mod)
		{
			if ($mod->department_id != $_dept) {
				$this->SetFont('Arial','B',8);
				$this->Cell($w[0],4,'','LR');
				$this->Cell($w[1],4,$mod->po->organization->name,'LR');
				$this->Cell($w[2],4,'','LR',0,'R');
				$this->Cell($w[3],4,'','LR',0,'R');
				$this->Cell($w[4],4,'','LR');
				$this->Cell($w[5],4,'','LR');
				$this->Ln();
				$_dept=$mod->department_id;
			}

			$this->SetFont('Arial','',6);
			$this->Cell($w[0],4,$mod->budget->code,'LR');
			$this->SetFont('Arial','',8);
			$this->Cell($w[1],4,$mod->budget->name,'LR');
			$this->Cell($w[2],4,'','LR',0,'R');
			$this->Cell($w[3],4,'','LR',0,'R');
			$this->Cell($w[4],4,number_format($mod->qty*$mod->amount,0,',','.'),'LR',0,'R');
			$this->Cell($w[5],4,'','LR',0,'R');
			$this->Ln();


			$this->SetFont('Arial','',6);
			$y8 = $this->GetY();
			$this->Cell($w[0],4,'','LR');
			$y9 = $this->GetY();
			$yZ = $y9 - $y8;

			$y1 = $this->GetY();
			$this->MultiCell($w[1],3,$mod->description,'LBR');
			$y2 = $this->GetY();
			$yH = $y2 - $y1;

			$this->SetXY($x, $this->GetY() - $yZ);
			$this->Cell($w[0],$yZ,'','LB');  //Garis samping

			$this->SetXY($x + $w[0], $this->GetY() - $yH);

			$this->Cell($w[1],$yH,'',0);
			$this->Cell($w[2],$yH,'','BR');
			$this->Cell($w[3],$yH,'','BR');
			$this->Cell($w[4],$yH,'','BR');
			$this->Cell($w[5],$yH,'','BR');
			$this->Ln();

			$_total =$_total+$mod->qty*$mod->amount;
			$_counter++;
			$_countert++;

			$y1 = $this->GetY();
			if ($y1 >235) {
				$this->Cell($w[0],1,'','B');
				$this->Cell($w[1],1,'','B');
				$this->Cell($w[2],1,'','B');
				$this->Cell($w[3],1,'','B');
				$this->Cell($w[4],1,'','B');
				$this->Cell($w[5],1,'','BR');
				$this->Ln();

				$this->AddPage();
				$this->myHeader($model);

				$this->Cell($w[0],0,'','B');
				$this->Cell($w[1],0,'','B');
				$this->Cell($w[2],0,'','B');
				$this->Cell($w[3],0,'','B');
				$this->Cell($w[4],0,'','B');
				$this->Cell($w[5],0,'','B');
				$this->Ln();
			}

		}


		$y1 = $this->GetY();
		$y = 235 - $y1;

		$this->Cell($w[0],$y,'','LR');
		$this->Cell($w[1],$y,'','LR',0,'R');
		$this->Cell($w[2],$y,'','LR',0,'R');
		$this->Cell($w[3],$y,'','LR');
		$this->Cell($w[4],$y,'','LR');
		$this->Cell($w[5],$y,'','LR');
		$this->Ln();

		$this->Cell($w[0],1,'','TB');
		$this->Cell($w[1],1,'','TB');
		$this->Cell($w[2],1,'','TB');
		$this->Cell($w[3],1,'','TB');
		$this->Cell($w[4],1,'','TB');
		$this->Cell($w[5],1,'','TB');
		$this->Ln();

		$w=array(47,47,48,48);

		$this->Cell($w[0],4,'Date','LTR');
		$this->Cell($w[1],4,'Date','LTR');
		$this->Cell($w[2],4,'Approved By','LTR');
		$this->Cell($w[3],4,'Approved By','LTR');
		$this->Ln();
		$this->Cell($w[0],4,'Proposed By','LR');
		$this->Cell($w[1],4,'','LR');
		$this->Cell($w[2],4,'','LR');
		$this->Cell($w[3],4,'','LR');
		$this->Ln();
		$this->Cell($w[0],20,'','LR');
		$this->Cell($w[1],20,'','LR');
		$this->Cell($w[2],20,'','LR');
		$this->Cell($w[3],20,'','LR');
		$this->Ln();
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],4,'Peter J. Kambey','LR',0,'C');
		$this->Cell($w[1],4,'Silvia Theresia','LR',0,'C');
		$this->Cell($w[2],4,'Irhan Suwito','LR',0,'C');
		$this->Cell($w[3],4,'Indra W. Antono','LR',0,'C');
		$this->Ln();
		$this->SetFont('Arial','',8);
		$this->Cell($w[0],4,'Supervisor','LBR',0,'C');
		$this->Cell($w[1],4,'Cost Controller Dept','LBR',0,'C');
		$this->Cell($w[2],4,'(Accounting Manager)','LBR',0,'C');
		$this->Cell($w[3],4,'(Marketing Director)','LBR',0,'C');
	}

}

?>