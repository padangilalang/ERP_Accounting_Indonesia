<?php

class aBudgetPosition1 extends fpdf
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
				'Report Code: budgetPosition1/R1',0,0,'C');
	}

	function myheader($id, $pro_id) {
		$this->SetFont('Arial','B',6);
		$this->Cell(50,4,'PT. AGUNG PODOMORO LAND, Tbk');
		$this->Ln(3);
		$this->Cell(50,4,'Budget Position');
		$this->Cell(100);
		$this->Ln(3);
		$this->Cell(50,4,($pro_id ==1) ? 'Project: CP' : 'Project: RMG/MGR');
		$this->Ln(5);

		//$w=array(15,40,23,23,23,23,23,23);
		$w=array(15,60,23,23,23,23,23,23);


		$this->SetFont('Arial','B',8);
		$this->Cell($w[0]+$w[1]+$w[2],6,'Name','TLR');
		$this->Cell($w[3],6,'Amount',1,0,'C');
		$this->Cell($w[4],6,'Realization',1,0,'C');
		//$this->Cell($w[5],6,'Paid',1,0,'C');
		//$this->Cell($w[6],6,'unPaid',1,0,'C');
		$this->Cell($w[7],6,'Balance',1,0,'C');
		$this->Ln();


		$this->Cell($w[0],1,'','T');
		$this->Cell($w[1],1,'','T');
		$this->Cell($w[2],1,'','T');
		$this->Cell($w[3],1,'','T');
		$this->Cell($w[4],1,'','T');
		//$this->Cell($w[5],1,'','T');
		//$this->Cell($w[6],1,'','T');
		$this->Cell($w[7],1,'','T');
		$this->Ln();

	}

	function report($id,$pro_id)
	{
		$criteria=new CDbCriteria;
		$criteria->order='code';
		$criteria->compare('department_id',$pro_id);
		$criteria->compare('parent_id',$id);
		//$criteria->compare('amount!',0);
		$criteria->addNotInCondition('id',array(193,119,164,198));
		$models=aBudget::model()->findAll($criteria);

		$this->myheader($id, $pro_id);

		//$w=array(15,40,23,23,23,23,23,23);
		$w=array(15,60,23,23,23,23,23,23);

		$this->SetFont('Arial','',8);
		foreach($models as $model)
		{
			$_amount=$model->amount;
			$_real=aBudget::model()->allComponent($model->id,2012,1);
			$_paid=aBudget::model()->allComponentPaid($model->id,2012,1);
			$_unpaid=$_real-$_paid;
			$_endBalance= isset($model->end_balance) ? $model->end_balance->balance : $_amount;

			$this->SetFont('Arial','B',8);
			$this->Cell($w[0]+$w[1],6,$model->code.". ".$model->name,'LT');
			$this->Cell($w[2],6,'','T');
			$this->Cell($w[3],6,number_format($_amount,0,',','.'),'TLR',0,'R');
			$this->Cell($w[4],6,'','T',0,'R');
			//$this->Cell($w[5],6,number_format($_paid,2,',','.'),'T',0,'R');
			//$this->Cell($w[6],6,number_format($_unpaid,2,',','.'),'T',0,'R');
			//$this->Cell($w[5],6,'','T',0,'R');
			//$this->Cell($w[6],6,'','T',0,'R');
			$this->Cell($w[7],6,number_format($_endBalance,0,',','.'),'TLR',0,'R');
			$this->Ln();

			$_total = 0;

			foreach($model->ch as $mod)
			{
				$this->SetFont('Arial','',6);
				$this->Cell($w[0]+$w[1],4,'        '.$mod->name,'L');
				$this->Cell($w[2],4,'');
				$this->Cell($w[3],4,number_format($mod->amount,0,',','.'),'LR',0,'R');

				$crit=new CDbCriteria;
				$crit->with=array('po_detail');
				$crit->condition='approved_date is not null';
				$crit->compare('po_detail.budget_id',$mod->id);

				$modelT1=aPorderDetail::model()->countBySql('
						SELECT SUM(a.amount) AS total
						FROM a_porder_detail a INNER JOIN a_porder b ON a.parent_id = b.id
						WHERE b.approved_date IS NOT NULL
						GROUP BY a.budget_id
						HAVING a.budget_id =
						'.$mod->id);
					
				$this->Cell($w[4],4,number_format($modelT1,0,',','.'),0,0,'R');
				$_balance1=$mod->amount-$modelT1;
				//$this->Cell($w[5],4,'',0,0,'R');
				//$this->Cell($w[6],4,'',0,0,'R');
				$this->Cell($w[7],4,number_format($_balance1,0,',','.'),'LR',0,'R');
				$this->Ln();

				$_total =$_total+$modelT1;

				foreach($mod->ch as $m)
				{
					$this->SetFont('Arial','',6);
					$this->Cell($w[0]+$w[1],4,'                '.$m->name,'L');
					$this->Cell($w[2],4,'');
					$this->Cell($w[3],4,number_format($m->amount,0,',','.'),'LR',0,'R');

					$modelT2=aPorderDetail::model()->countBySql('
							SELECT SUM(a.amount) AS total
							FROM a_porder_detail a INNER JOIN a_porder b ON a.parent_id = b.id
							WHERE b.approved_date IS NOT NULL
							GROUP BY a.budget_id
							HAVING a.budget_id =
							'.$m->id);

					$this->Cell($w[4],4,number_format($modelT2,0,',','.'),0,0,'R');
					$_balance2=$m->amount-$modelT2;
					//$this->Cell($w[5],4,'',0,0,'R');
					//$this->Cell($w[6],4,'',0,0,'R');
					$this->Cell($w[7],4,number_format($_balance2,0,',','.'),'LR',0,'R');
					$this->Ln();

					$_total =$_total+$modelT2;
					if ($this->GetY()>=250) {
						$this->Cell(array_sum($w)-46,4,'','T');
						$this->AddPage();
						$this->myheader($id, $pro_id);
					}
				}

				if ($this->GetY()>=250) {
					$this->Cell(array_sum($w)-46,4,'','T');
					$this->AddPage();
					$this->myheader($id, $pro_id);
				}

			}

			//*
			$this->SetFont('Arial','B',6);
			$this->Cell($w[0]+$w[1],4,'Check Balance','L');
			$this->Cell($w[2],4,'');
			$this->Cell($w[3],4,'','L');
			$this->Cell($w[4],4,number_format($_total,0,',','.'),'L',0,'R');
			$_checkbalance=$model->amount-$_total;
			//$this->Cell($w[5],4,'',0,0,'R');
			//$this->Cell($w[6],4,'',0,0,'R');
			$this->Cell($w[7],4,number_format($_checkbalance,0,',','.'),'LR',0,'R');
			$this->Ln();
			//*/
			$this->Cell(array_sum($w)-46,4,'','T');
			$this->Ln(1);

		}

	}

}

?>