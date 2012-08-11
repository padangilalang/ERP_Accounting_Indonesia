<?php

class aApprovalForm2 extends fpdf
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
				'Report Code: appForm2/R2',0,0,'C');
	}


	function approvalFormR2($id)
	{
		$criteria=new CDbCriteria;
		$model=aPorder::model()->findByPk((int)$id);

		/**/
		$_amount=$model->budgetcomp->amount;
		$_actual=$model->budgetcomp->sum_budget;
		$_currentbalance=$_amount-$_actual;
		$_newbalance=$_currentbalance-$model->sum_po;

		$this->SetFont('Arial','B',6);
		$this->Cell(50,4,'PT. AGUNG PODOMORO LAND, Tbk');
		$this->Ln(3);
		$this->Cell(50,4,'Budget Position');
		$this->Cell(100);
		$this->Ln(5);

		$_paid=aBudget::model()->allComponentPaid($model->budgetcomp_id,2012,1);
		$_unpaid=$_actual-$_paid;
		$_paidP= ($_actual !=0) ? ($_paid/$_actual)*100 : 0;
		$_unpaidP= ($_actual !=0) ? ($_unpaid/$_actual)*100 : 0;


		//Header
		$this->SetFont('Arial','',6);
		$this->Cell(30,3,'Project:');
		$this->SetFont('Arial','B',6);
		$this->Cell(40,3,$model->organization->getTopLevel());
		$this->SetFont('Arial','',6);
		$this->Cell(30,3,'Budget: '.$model->budgetcomp->name,0,0,'R');
		$this->SetFont('Arial','B',6);
		$this->Cell(30,3,number_format($_amount,0,',','.'),0,0,'R');
		$this->SetFont('Arial','',6);
		$this->Cell(30,3,'Paid',0,0,'R');
		$this->SetFont('Arial','B',6);
		$this->Cell(20,3,number_format($_paid,0,',','.'),0,0,'R');
		$this->Cell(10,3,round($_paidP,2)."%",0,0,'R');
		$this->Ln(3);

		$this->SetFont('Arial','',6);
		$this->Cell(30,3,'Department:');
		$this->SetFont('Arial','B',6);
		$this->Cell(40,3,$model->organization->name);
		$this->SetFont('Arial','',6);
		$this->Cell(30,3,'Realization','B',0,'R');
		$this->SetFont('Arial','B',6);
		$this->Cell(30,3,number_format($_actual,0,',','.'),'B',0,'R');
		$this->SetFont('Arial','',6);
		$this->Cell(30,3,'UnPaid',0,0,'R');
		$this->SetFont('Arial','B',6);
		$this->Cell(20,3,number_format($_unpaid,0,',','.'),'B',0,'R');
		$this->Cell(10,3,round($_unpaidP,2)."%",'B',0,'R');
		$this->Ln(3);

		$this->SetFont('Arial','',6);
		$this->Cell(30,3,'Budget Category:');
		$this->SetFont('Arial','B',6);
		$this->Cell(40,3,$model->budgetcomp->name);
		$this->SetFont('Arial','',6);
		$this->Cell(30,3,'Current Budget Position',0,0,'R');
		$this->SetFont('Arial','B',6);
		$this->Cell(30,3,number_format($_currentbalance,0,',','.'),0,0,'R');
		$this->SetFont('Arial','',6);
		$this->Cell(30,3,'TOTAL',0,0,'R');
		$this->SetFont('Arial','B',6);
		$this->Cell(20,3,number_format($_paid+$_unpaid,0,',','.'),0,0,'R');
		$this->Cell(10,3,round($_paidP+$_unpaidP,2)."%",0,0,'R');
		$this->Ln(3);

		$this->SetFont('Arial','',6);
		$this->Cell(30,3,'Date');
		$this->SetFont('Arial','B',6);
		$this->Cell(50,3,$model->input_date);
		$this->Ln(6);
			
		$w=array(15,85,22,22,22,22);


		$this->SetFont('Arial','B',8);
		$this->Cell($w[0]+$w[1]+$w[2],6,'Description','TLR');
		$this->Cell($w[3],6,'Budget Comp.',1,0,'C');
		$this->Cell($w[4],6,'Payment Status',1,0,'C');
		$this->Cell($w[5],6,'Payment Date',1,0,'C');
		$this->Ln();


		$this->Cell($w[0],1,'','T');
		$this->Cell($w[1],1,'','T');
		$this->Cell($w[2],1,'','T');
		$this->Cell($w[3],1,'','T');
		$this->Cell($w[4],1,'','T');
		$this->Cell($w[5],1,'','T');
		$this->Ln();

		//$modelp=aPorder::model()->with('po_detail')->findAll(array('condition'=>'length(approved_date) <> 0 AND budgetcomp_id = ' .$model->budgetcomp_id,'order'=>'t.id'));
		$modelp=aPorder::model()->with('po_detail')->findAll(array('condition'=>'length(approved_date) <> 0 AND t.id <> '.$id .' AND budgetcomp_id = ' .$model->budgetcomp_id,'order'=>'t.id'));


		$this->SetFont('Arial','',8);
		foreach($modelp as $modp)
		{
			$this->SetFont('Arial','B',8);
			$this->Cell($w[0]+$w[1],6,$modp->no_ref,'LT');
			$this->Cell($w[2],6,'','T');
			$this->Cell($w[3],6,number_format($modp->sum_po,0,',','.'),'TLR',0,'R');
			$this->Cell($w[4],6,'','T');
			$this->Cell($w[5],6,'','LRT');
			$this->Ln();

			//Detail
			$_total = 0;
			$_total1 = 0;
			$_counter = 1;
			$_countert = 1;

			$this->SetFont('Arial','',8);
			$w=array(15,85,22,22,22,22);
			$x = $this->GetX();
			$y = $this->GetY();
			$_dept=0;

			foreach($modp->po_detail as $mod)
			{

				$_desc=strlen($mod->description) < 80 ? $mod->description : substr($mod->description,0,80).'...';
				$this->SetFont('Arial','',6);
				$this->Cell($w[0]+$w[1]+$w[2],4,'     '.$mod->budget->code.'. '.$mod->budget->name.'. '.
						$_desc ,'LR');
				$this->Cell($w[3],4,number_format($mod->qty*$mod->amount,0,',','.'),'LR',0,'R');
				$this->Cell($w[4],4,(isset($mod->payment)) ? $mod->payment->name : '','LR',0,'R');
				$this->Cell($w[5],4,'','LR',0,'R');
				$this->Ln();

				$_total =$_total+$mod->qty*$mod->amount;
				$_counter++;
				$_countert++;
			}
			$this->Cell(array_sum($w),4,'','T');
			$this->Ln(2);

		}

	}

}

?>