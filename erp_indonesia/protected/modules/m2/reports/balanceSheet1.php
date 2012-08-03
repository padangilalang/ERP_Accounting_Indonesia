<?php

class balanceSheet1 extends fpdf
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
				'Report Code: balanceSheet1',0,0,'C');
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
		$this->Cell(0,5,'BALANCE SHEET (STANDARD)',0,0,'C');
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

	function report($periode_date,$report_id)
	{
		$this->myheader($periode_date,$report_id);

		$w=array(130,20);

		$model1=tAccountMain::model()->with('account_list')->findAll('type_id = 1');

		$_labarugi=tAccount::labarugiDitahan($periode_date);

		$_s=5;
		//Reset
		$_total=0;
		$_subtotal=0;
		$_grandtotal=0;
		$_grandtotalA=0;
		$_grandtotalP=0;


		//Print/Preview Report

		foreach($model1 as $mmm) {

			if ($mmm->id ==2) { //pasiva
				$_s=$_s+5;
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

							$this->Cell($_s+5,4,'');
							$this->Cell($w[0],4,$mod->account_concat());
							$this->SetX($this->x0);
							$_mod=$mod->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
							if (isset($_mod->end_balance)){
								$_balance=number_format($_mod->end_balance,0,',','.');
								$_subtotal=$_subtotal+$_mod->end_balance;
								$_grandtotal=$_grandtotal+$_mod->end_balance;
							} else
								$_balance=0;

							if ($mod->childs) {
								$this->Cell($w[1],4,'',0,0,'R');
							} else {
								/* if (isset($mod->accmain) && $mod->accmain->mvalue ==8) {
									$this->Cell($w[1],4,number_format($_labarugi,0,',','.'),0,0,'R');
								$_total=$_total+$_labarugi;
								$_subtotal=$_subtotal+$_labarugi;
								$_grandtotal=$_grandtotal+$_labarugi;
								} else */
								$this->Cell($w[1],4,$_balance,0,0,'R');
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
									if (isset($_m->end_balance)){
										$_balance=number_format($_m->end_balance,0,',','.');
										$_total=$_total+$_m->end_balance;
										$_subtotal=$_subtotal+$_m->end_balance;
										$_grandtotal=$_grandtotal+$_m->end_balance;
									} else
										$_balance=0;

									if ($m->childs) {
										$this->Cell($w[1],4,'',0,0,'R');
									} else {
										/* if (isset($m->accmain) && $m->accmain->mvalue ==8) {
											$this->Cell($w[1],4,number_format($_labarugi,0,',','.'),0,0,'R');
										$_total=$_total+$_labarugi;
										$_subtotal=$_subtotal+$_labarugi;
										$_grandtotal=$_grandtotal+$_labarugi;
										} else */
										$this->Cell($w[1],4,$_balance,0,0,'R');
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
											if (isset($_n->end_balance)){
												$_balance=number_format($_n->end_balance,0,',','.');
												$_total=$_total+$_n->end_balance;
												$_subtotal=$_subtotal+$_n->end_balance;
												$_grandtotal=$_grandtotal+$_n->end_balance;
											} else
												$_balance=0;

											if ($n->childs) {
												$this->Cell($w[1],4,'',0,0,'R');
											} else {
												/* if (isset($n->accmain) && $n->accmain->mvalue ==8) {
													$this->Cell($w[1],4,number_format($_labarugi,0,',','.'),0,0,'R');
												$_total=$_total+$_labarugi;
												$_subtotal=$_subtotal+$_labarugi;
												$_grandtotal=$_grandtotal+$_labarugi;
												} else */
												$this->Cell($w[1],4,$_balance,0,0,'R');
											}

											$this->Ln();
										}
										///LAST
									}

								}
							}

							if ($mod->childs && $mod->childsCount >=2) {
								$this->SetFont('Arial','B',8);
								$this->Cell($_s+5,4,'');
								$this->Cell($w[0],4,'TOTAL '.$mod->account_name);
								$this->SetX($this->x0);
								$this->Cell($w[1],4,number_format($_total,0,',','.'),'T',0,'R');
								$this->Ln(5);
							}

							if ($mod->childs) {
								$_total=0;
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
					$this->Ln(5);

					$_subtotal=0;

					if ($this->GetY() >=250) {
						$this->AddPage();
						$this->myheader();
					}
				}

				$this->SetFillColor(224,224,224);
				$this->SetFont('Arial','B',8);
				if ($mmm->id == 2)  $this->Cell(5,4,'');
				$this->Cell($w[0],4,'TOTAL '.$model2->account_name,0,0,'L',true);
				$this->SetX($this->x0+20);
				$this->Cell($w[1],4,number_format($_grandtotal,0,',','.'),0,0,'R',true);
				$this->Cell($w[1],4,'');
				$this->Ln(8);

				if ($mmm->id ==1) {  //Aktiva
					$_grandtotalA=$_grandtotal;
				} else {
					$_grandtotalP=$_grandtotalP+$_grandtotal;
				}

				$_grandtotal=0;
			}

			if ($mmm->id ==2) { //Pasiva
				$_s=$_s+5;
				$this->SetFont('Arial','B',8);
				$this->Cell($w[0],4,$mmm->name,0,0,'L',true);
				$this->SetX($this->x0+20);
				$this->Cell($w[1],4,number_format($_grandtotalP,0,',','.'),0,0,'R',true);
				$this->Ln();
			}
		}
	}
}
?>