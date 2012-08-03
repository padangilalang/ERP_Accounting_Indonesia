<?php

class balanceSheet2 extends fpdf
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
				'Report Code: balanceSheet2',0,0,'C');
	}

	function myheader($periode_date,$report_id)
	{
		//Header

		$this->y0=$this->GetY();
		//$this->Image('css/Logo_GBI.jpg',14,9,12);
		$this->SetY($this->y0);
		$this->SetFont('Arial','B',10);
		$this->Cell(100,5,Yii::app()->name);
		$this->Ln(5);
		$this->Cell(0,2,'','T');
		$this->Ln();

		$this->SetFont('Arial','B',12);
		$this->Cell(0,5,'BALANCE SHEET (STANDARD)',0,0,'C');
		$this->Ln();
		$this->SetFont('Arial','B',8);
		$this->Cell(0,4,'Periode: '.$periode_date,0,0,'C');


		$this->Ln(6);

		$w=array(100,20);
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],5,'DESCRIPTION','B');
		$this->x0=$this->GetX();
		$this->Cell($w[1],5,'CURRENT','B',0,'R');
		$this->Cell($w[1]+20,5,'LAST','B',0,'R');
		$this->Ln(6);

	}

	function report($periode_date,$report_id)
	{
		$this->myheader($periode_date,$report_id);

		$w=array(130,20);

		$model1=tAccountMain::model()->with('account_list')->findAll('type_id= 1');

		$_labarugi=tAccount::labarugiDitahan($periode_date);

		$_s=3;
		//Reset
		$_total=0;
		$_subtotal=0;
		$_grandtotal=0;
		$_grandtotalA=0;
		$_grandtotalP=0;

		$_totalLast=0;
		$_subtotalLast=0;
		$_grandtotalLast=0;
		$_grandtotalALast=0;
		$_grandtotalPLast=0;


		//Print/Preview Report

		foreach($model1 as $mmm) {

			if ($mmm->id ==2) { //pasiva
				$_s=$_s+3;
				$this->SetFont('Arial','B',8);
				$this->Cell($w[0],4,$mmm->name);
				$this->Cell($w[1],4,'');
				$this->Ln();
			}

			foreach($mmm->account_list as $mm) {
				$model2=tAccount::model()->findByPk((int)$mm->parent_id);

				$this->SetFont('Arial','B',8);
				if ($mmm->id == 2)  $this->Cell(5,4,'');
				$this->Cell($w[0],4,$model2->account_concat());
				$this->SetX($this->x0);
				$this->Cell($w[1],4,'');
				$this->Ln();

				foreach($model2->childs as $model) {
					$this->SetFont('Arial','B',8);
					$this->Cell($_s,4,'');
					$this->Cell($w[0],4,$model->account_concat());
					$this->SetX($this->x0);
					$this->Cell($w[1],4,'');
					$this->Ln();

					if ($model->childs) {
						foreach($model->childs as $mod) {
							if ($mod->childs) {
								$this->SetFont('Arial','B',8);
							} else
								$this->SetFont('Arial','',8);

							$this->Cell($_s+3,4,'');
							$this->Cell($w[0],4,$mod->account_concat());
							$this->SetX($this->x0);
							$_mod=$mod->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
							$_periode_date_last=sParameter::cBeginDateBefore($periode_date);
							$_modLast=$mod->balancesheet(array('condition'=>'yearmonth_periode ='.$_periode_date_last));
							if (isset($_mod->end_balance)){
								$_balance=number_format($_mod->end_balance,0,',','.');
								$_mmodLast = isset($_modLast->end_balance) ? $_modLast->end_balance : 0;
								$_balanceLast=number_format($_mmodLast,0,',','.');
								$_subtotal=$_subtotal+$_mod->end_balance;
								$_grandtotal=$_grandtotal+$_mod->end_balance;

								$_subtotalLast=$_subtotalLast+$_mmodLast;
								$_grandtotalLast=$_grandtotalLast+$_mmodLast;
							} else {
								$_balance=0;
								$_balanceLast=0;
							}

							if ($mod->childs) {
								$this->Cell($w[1],4,'',0,0,'R');
							} else {
								$this->Cell($w[1],4,$_balance,0,0,'R');
								$this->Cell($w[1]+20,4,$_balanceLast,0,0,'R');
							}

							$this->Ln();


							if ($mod->childs) {
								foreach($mod->childs as $m) {
									if ($m->childs) {
										$this->SetFont('Arial','B',8);
									} else
										$this->SetFont('Arial','',8);

									$this->Cell($_s+10,4,'');
									$this->Cell($w[0],4,$m->account_concat());
									$this->SetX($this->x0);
									$_m=$m->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
									$_mLast=$m->balancesheet(array('condition'=>'yearmonth_periode ='.$_periode_date_last));
									if (isset($_m->end_balance)){
										$_balance=number_format($_m->end_balance,0,',','.');
										$_mmLast = isset($_mLast->end_balance) ? $_mLast->end_balance : 0;
										$_balanceLast=number_format($_mmLast,0,',','.');
										$_total=$_total+$_m->end_balance;
										$_subtotal=$_subtotal+$_m->end_balance;
										$_grandtotal=$_grandtotal+$_m->end_balance;

										$_totalLast=$_totalLast+$_mmLast;
										$_subtotalLast=$_subtotalLast+$_mmLast;
										$_grandtotalLast=$_grandtotalLast+$_mmLast;
									} else {
										$_balance=0;
										$_balanceLast=0;
									}

									if ($m->childs) {
										$this->Cell($w[1],4,'',0,0,'R');
									} else {
										$this->Cell($w[1],4,$_balance,0,0,'R');
										$this->Cell($w[1]+20,4,$_balanceLast,0,0,'R');
									}

									$this->Ln();

									if ($m->childs) {

										////////////////LAST
										foreach($m->childs as $n) {
											if ($n->childs) {
												$this->SetFont('Arial','B',8);
											} else
												$this->SetFont('Arial','',8);

											$this->Cell($_s+15,4,'');
											$this->Cell($w[0],4,$n->account_concat());
											$this->SetX($this->x0);
											$_n=$n->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
											$_nLast=$n->balancesheet(array('condition'=>'yearmonth_periode ='.$_periode_date_last));
											if (isset($_n->end_balance)){
												$_balance=number_format($_n->end_balance,0,',','.');
												$_nnLast = isset($_nLast->end_balance) ? $_nLast->end_balance : 0;
												$_balanceLast=number_format($_nnLast,0,',','.');
												$_total=$_total+$_n->end_balance;
												$_subtotal=$_subtotal+$_n->end_balance;
												$_grandtotal=$_grandtotal+$_n->end_balance;

												$_totalLast=$_totalLast+$_nnLast;
												$_subtotalLast=$_subtotalLast+$_nnLast;
												$_grandtotalLast=$_grandtotalLast+$_nnLast;
											} else {
												$_balance=0;
												$_balanceLast=0;
											}

											if ($n->childs) {
												$this->Cell($w[1],4,'',0,0,'R');
											} else {
												$this->Cell($w[1],4,$_balance,0,0,'R');
												$this->Cell($w[1]+20,4,$_balanceLast,0,0,'R');
											}

											$this->Ln();
										}
										///LAST
									}

								}
							}

							if ($mod->childs && $mod->childsCount >=2) {
								$this->SetFont('Arial','B',8);
								$this->Cell($_s+3,4,'');
								$this->Cell($w[0],4,'TOTAL '.$mod->account_name);
								$this->SetX($this->x0);
								$this->Cell($w[1],4,number_format($_total,0,',','.'),'T',0,'R');
								$this->Cell($w[1],4,'',0);
								$this->Cell($w[1],4,number_format($_totalLast,0,',','.'),'T',0,'R');
								$this->Ln(5);
							}

							if ($mod->childs) {
								$_total=0;
								$_totalLast=0;
							}

							if ($this->GetY() >=250) {
								$this->AddPage();
								$this->myheader($periode_date,$report_id);
							}

						}
					}
					$this->SetFont('Arial','B',8);
					$this->Cell($_s,4,'');
					$this->Cell($w[0],4,'TOTAL '.$model->account_name);
					$this->SetX($this->x0+20);
					$this->Cell($w[1],4,number_format($_subtotal,0,',','.'),'T',0,'R');
					$this->Cell($w[1],4,'',0);
					$this->Cell($w[1],4,number_format($_subtotalLast,0,',','.'),'T',0,'R');
					$this->Ln(5);

					$_subtotal=0;
					$_subtotalLast=0;

					if ($this->GetY() >=250) {
						$this->AddPage();
						$this->myheader($periode_date,$report_id);
					}
				}

				$this->SetFillColor(224,224,224);
				$this->SetFont('Arial','B',8);
				if ($mmm->id == 2)  $this->Cell(5,4,'');
				$this->Cell($w[0],4,'TOTAL '.$model2->account_name,0,0,'L',true);
				$this->SetX($this->x0+20);
				$this->Cell($w[1],4,number_format($_grandtotal,0,',','.'),0,0,'R',true);
				$this->Cell($w[1]+20,4,number_format($_grandtotalLast,0,',','.'),0,0,'R',true);
				$this->Cell($w[1],4,'');
				$this->Ln(8);

				if ($mmm->id ==1) {  //Aktiva
					$_grandtotalA=$_grandtotal;
					$_grandtotalALast=$_grandtotalLast;
				} else {
					$_grandtotalP=$_grandtotalP+$_grandtotal;
					$_grandtotalPLast=$_grandtotalPLast+$_grandtotalLast;
				}

				$_grandtotal=0;
				$_grandtotalLast=0;
			}

			if ($mmm->id ==2) { //Pasiva
				$_s=$_s+3;
				$this->SetFont('Arial','B',8);
				$this->Cell($w[0],4,$mmm->name,0,0,'L',true);
				$this->SetX($this->x0+20);
				$this->Cell($w[1],4,number_format($_grandtotalP,0,',','.'),0,0,'R',true);
				$this->Cell($w[1]+20,4,number_format($_grandtotalPLast,0,',','.'),0,0,'R',true);
				$this->Ln();
			}
		}
	}
}
?>