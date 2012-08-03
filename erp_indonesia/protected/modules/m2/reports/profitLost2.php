<?php

class profitLost2 extends fpdf
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
				'Report Code: profitLost2',0,0,'C');
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
		$this->Cell(0,5,'PROFIT AND LOST (STANDARD)',0,0,'C');
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

		$w=array(100,20);

		$model1=tAccountMain::model()->with('account_list')->findAll('type_id= 2');

		$_s=3;
		//Reset
		$_total=0;
		$_subtotal=0;
		$_grandtotal=0;
		$_grandtotalI=0;
		$_grandtotalH=0;
		$_grandtotalE=0;

		$_totalLast=0;
		$_subtotalLast=0;
		$_grandtotalLast=0;
		$_grandtotalILast=0;
		$_grandtotalHLast=0;
		$_grandtotalELast=0;


		//Print/Preview Report

		foreach($model1 as $mmm) {

			foreach($mmm->account_list as $mm) {
				$model2=tAccount::model()->findByPk((int)$mm->parent_id);

				$this->SetFont('Arial','B',8);
				if ($mmm->id == 2)  $this->Cell(5,4,'');
				$this->Cell($w[0],4,$model2->account_concat());
				$this->SetX($this->x0);
				$this->Cell($w[1],4,'');
				$this->Ln();

				foreach($model2->childs as $model) {
					if ($model->childs) {
						$this->SetFont('Arial','B',8);
					} else
						$this->SetFont('Arial','',8);

					$this->Cell($_s,4,'');
					$this->Cell($w[0],4,$model->account_concat());
					$this->SetX($this->x0);
					$_model=$model->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
					$_periode_date_last=sParameter::cBeginDateBefore($periode_date);
					$_modelLast=$model->balancesheet(array('condition'=>'yearmonth_periode ='.$_periode_date_last));
					if (isset($_model->end_balance)){
						$_balance=number_format($_model->end_balance,0,',','.');
						$_mmodelLast = isset($_modelLast->end_balance) ? $_modelLast->end_balance : 0;

						$_balanceLast=number_format($_mmodelLast,0,',','.');
						$_subtotal=$_subtotal+$_model->end_balance;
						$_grandtotal=$_grandtotal+$_model->end_balance;

						$_subtotalLast=$_subtotalLast+$_mmodelLast;
						$_grandtotalLast=$_grandtotalLast+$_mmodelLast;
					} else {
						$_balance=0;
						$_balanceLast=0;
					}

					if ($model->childs) {
						$this->Cell($w[1],4,'',0,0,'R');
					} else {
						$this->Cell($w[1],4,$_balance,0,0,'R');
						$this->Cell($w[1]+20,4,$_balanceLast,0,0,'R');
					}

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
									$this->SetFont('Arial','',8);
									$this->Cell($_s+10,4,'');
									$this->Cell($w[0],4,$m->account_concat());
									$this->SetX($this->x0);
									$_m=$m->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
									$_mLast=$m->balancesheet(array('condition'=>'yearmonth_periode ='.$_periode_date_last));
									$_mmLast = isset($_mLast->end_balance) ? $_mLast->end_balance : 0;
									if (isset($_m->end_balance)){
										$_balance=number_format($_m->end_balance,0,',','.');
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
								}
							}

							if ($mod->childs) {
								$this->SetFont('Arial','B',8);
								$this->Cell($_s+3,4,'');
								$this->Cell($w[0],4,'TOTAL '.$mod->account_name);
								$this->SetX($this->x0);
								$this->Cell($w[1],4,number_format($_total,0,',','.'),'T',0,'R');
								$this->Cell($w[1],4,'','');
								$this->Cell($w[1],4,number_format($_totalLast,0,',','.'),'T',0,'R');
								$this->Ln(5);

								$_total=0;
								$_totalLast=0;

								if ($this->GetY() >=250) {
									$this->AddPage();
									$this->myheader($periode_date,$report_id);
								}

							}
						}
					}
					if ($model->childs && $model->childsCount >=2) {
						$this->SetFont('Arial','B',8);
						$this->Cell($_s,4,'');
						$this->Cell($w[0],4,'TOTAL '.$model->account_name);
						$this->SetX($this->x0);
						$this->Cell($w[1],4,number_format($_subtotal,0,',','.'),'T',0,'R');
						$this->Cell($w[1],4,'',0);
						$this->Cell($w[1],4,number_format($_subtotalLast,0,',','.'),'T',0,'R');
						$this->Ln(5);
					}

					$_subtotal=0;
					$_subtotalLast=0;

					if ($this->GetY() >=250) {
						$this->AddPage();
						$this->myheader($periode_date,$report_id);
					}

				}

				$this->SetFont('Arial','B',8);
				if ($mmm->id == 2)  $this->Cell(5,4,'');
				$this->Cell($w[0],4,'TOTAL '.$model2->account_name);
				$this->SetX($this->x0+20);
				$this->Cell($w[1],4,number_format($_grandtotal,0,',','.'),0,0,'R');
				$this->Cell($w[1]+20,4,number_format($_grandtotalLast,0,',','.'),0,0,'R');
				$this->Cell($w[1],4,'');
				$this->Ln(8);

				if ($mmm->id ==3) {  //income
					$_grandtotalI=$_grandtotal;
					$_grandtotalILast=$_grandtotalLast;
				} elseif ($mmm->id ==4) { //HPP
					$_grandtotalH=$_grandtotal;
					$_grossprofit=$_grandtotalI-$_grandtotalH;

					$_grandtotalHLast=$_grandtotalLast;
					$_grossprofitLast=$_grandtotalILast-$_grandtotalHLast;
				} else { //Expenses
					$_grandtotalE=$_grandtotal;
					$_netprofit=$_grossprofit-$_grandtotalE;

					$_grandtotalELast=$_grandtotalLast;
					$_netprofitLast=$_grossprofitLast-$_grandtotalELast;
				}

				$_grandtotal=0;
				$_grandtotalLast=0;
			}

			if ($mmm->id ==4) {  //GROSS PROFIT
				//$_s=$_s+3;
				$this->SetFont('Arial','B',8);
				$this->Cell(array_sum($w),4,'GROSS PROFIT','T');
				$this->SetX($this->x0+20);
				$this->Cell($w[1],4,number_format($_grossprofit,0,',','.'),'T',0,'R');
				$this->Cell($w[1],4,'');
				$this->Cell($w[1],4,number_format($_grossprofitLast,0,',','.'),'T',0,'R');
				$this->Ln(8);
			}
		}

		$_s=$_s+3;
		$this->SetFont('Arial','B',8);
		$this->Cell(array_sum($w),4,'INCOME OPERATION','T');
		$this->SetX($this->x0+20);
		$this->Cell($w[1],4,number_format($_netprofit,0,',','.'),'T',0,'R');
		$this->Cell($w[1]+20,4,number_format($_netprofitLast,0,',','.'),'T',0,'R');
		$this->Ln(8);

		//Other Income and Other Expenses
		$model1=tAccountMain::model()->with('account_list')->findAll('type_id= 3');

		$_grandtotalOI=0;
		$_grandtotalOE=0;
		$_netprofitFinal=0;

		$_grandtotalOILast=0;
		$_grandtotalOELast=0;
		$_netprofitFinalLast=0;

		foreach($model1 as $mmm) {

			foreach($mmm->account_list as $mm) {
				$model2=tAccount::model()->findByPk((int)$mm->parent_id);

				$this->SetFont('Arial','B',8);
				if ($mmm->id == 2)  $this->Cell(5,4,'');
				$this->Cell($w[0],4,$model2->account_concat());
				$this->SetX($this->x0);
				$this->Cell($w[1],4,'');
				$this->Ln();

				foreach($model2->childs as $model) {
					if ($model->childs) {
						$this->SetFont('Arial','B',8);
					} else
						$this->SetFont('Arial','',8);

					$this->Cell($_s,4,'');
					$this->Cell($w[0],4,$model->account_concat());
					$this->SetX($this->x0);
					$_model=$model->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
					$_periode_date_last=sParameter::cBeginDateBefore($periode_date);
					$_modelLast=$model->balancesheet(array('condition'=>'yearmonth_periode ='.$_periode_date_last));
					if (isset($_model->end_balance)){
						$_balance=number_format($_model->end_balance,0,',','.');
						$_mmodelLast = isset($_modelLast->end_balance) ? $_modelLast->end_balance : 0;
						$_balanceLast=number_format($_mmodelLast,0,',','.');
						$_subtotal=$_subtotal+$_model->end_balance;
						$_grandtotal=$_grandtotal+$_model->end_balance;

						$_subtotalLast=$_subtotalLast+$_mmodelLast;
						$_grandtotalLast=$_grandtotalLast+$_mmodelLast;
					} else {
						$_balance=0;
						$_balanceLast=0;
					}

					if ($model->childs) {
						$this->Cell($w[1],4,'',0,0,'R');
					} else {
						$this->Cell($w[1],4,$_balance,0,0,'R');
						$this->Cell($w[1]+20,4,$_balanceLast,0,0,'R');
					}

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
							$_modLast=$mod->balancesheet(array('condition'=>'yearmonth_periode ='.$_periode_date_last));
							$_mmodLast = isset($_modLast->end_balance) ? $_modLast->end_balance : 0;
							if (isset($_mod->end_balance)){
								if ($mod->reverse) {
									$_balanceR=-($_mod->end_balance);
									$_balanceRLast=-($_mmodLast);
								} else {
									$_balanceR=$_mod->end_balance;
									$_balanceRLast=$_mmodLast;
								}

								$_balance=number_format($_balanceR,0,',','.');
								$_subtotal=$_subtotal+$_balanceR;
								$_grandtotal=$_grandtotal+$_balanceR;

								$_balanceLast=number_format($_balanceRLast,0,',','.');
								$_subtotalLast=$_subtotalLast+$_balanceRLast;
								$_grandtotalLast=$_grandtotalLast+$_balanceRLast;
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
									$this->SetFont('Arial','',8);
									$this->Cell($_s+10,4,'');
									$this->Cell($w[0],4,$m->account_concat());
									$this->SetX($this->x0);
									$_m=$m->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
									$_mLast=$m->balancesheet(array('condition'=>'yearmonth_periode ='.$_periode_date_last));
									$_mmLast = isset($_mLast->end_balance) ? $_mLast->end_balance : 0;
									if (isset($_m->end_balance)){
										if ($mod->reverse) {
											$_balanceR=-($_m->end_balance);
											$_balanceRLast=-($_mmLast);
										} else {
											$_balanceR=$_m->end_balance;
											$_balanceRLast=$_mmLast;
										}

										$_balance=number_format($_balanceR,0,',','.');
										$_total=$_total+$_balanceR;
										$_subtotal=$_subtotal+$_balanceR;
										$_grandtotal=$_grandtotal+$_balanceR;

										$_balanceLast=number_format($_balanceRLast,0,',','.');
										$_totalLast=$_totalLast+$_balanceRLast;
										$_subtotalLast=$_subtotalLast+$_balanceRLast;
										$_grandtotalLast=$_grandtotalLast+$_balanceRLast;
									} else {
										$_balance=0;
										$_balanceLast=0;
									}

									if ($m->childs) {
										$this->Cell($w[1],4,'',0,0,'R');
									} else {
										$this->Cell($w[1],4,$_balance,0,0,'R');
										$this->Cell($w[1],4,$_balanceLast,0,0,'R');
									}

									$this->Ln();
								}
							}

							if ($mod->childs) {
								$this->SetFont('Arial','B',8);
								$this->Cell($_s+3,4,'');
								$this->Cell($w[0],4,'TOTAL '.$mod->account_name);
								$this->SetX($this->x0);
								$this->Cell($w[1],4,number_format($_total,0,',','.'),'T',0,'R');
								$this->Cell($w[1],4,'',0);
								$this->Cell($w[1],4,number_format($_totalLast,0,',','.'),'T',0,'R');
								$this->Ln(5);

								$_total=0;
							}
						}
					}
					if ($model->childs && $model->childsCount >=2) {
						$this->SetFont('Arial','B',8);
						$this->Cell($_s,4,'');
						$this->Cell($w[0],4,'TOTAL '.$model->account_name);
						$this->SetX($this->x0);
						$this->Cell($w[1],4,number_format($_subtotal,0,',','.'),'T',0,'R');
						$this->Cell($w[1],4,'',0);
						$this->Cell($w[1],4,number_format($_subtotalLast,0,',','.'),'T',0,'R');
						$this->Ln(5);
					}

					if ($_grandtotalOI==0) {  //other Income
						$_grandtotalOI=$_subtotal;
						$_grandtotalOILast=$_subtotalLast;
					} else { //Expenses
						$_grandtotalOE=$_subtotal;
						$_grandtotalOELast=$_subtotalLast;
					}
					$_subtotal=0;
					$_subtotalLast=0;
				}

				$this->SetFont('Arial','B',8);
				if ($mmm->id == 2)  $this->Cell(5,4,'');
				$this->Cell($w[0],4,'TOTAL '.$model2->account_name);
				$this->SetX($this->x0+20);
				$this->Cell($w[1],4,number_format($_grandtotal,0,',','.'),0,0,'R');
				$this->Cell($w[1],4,'');
				$this->Cell($w[1],4,number_format($_grandtotalLast,0,',','.'),0,0,'R');
				$this->Ln(8);

				$_grandtotalOIE=$_grandtotal;
				$_grandtotal=0;

				$_grandtotalOIELast=$_grandtotalLast;
				$_grandtotalLast=0;
			}

			$_netprofitFinal=$_netprofit+$_grandtotalOIE;
			$_netprofitFinalLast=$_netprofitLast+$_grandtotalOIELast;

			//$_s=$_s+3;
			$this->SetFont('Arial','B',8);
			$this->Cell(array_sum($w),4,'NET INCOME','T');
			$this->SetX($this->x0+20);
			$this->Cell($w[1],4,number_format($_netprofitFinal,0,',','.'),'T',0,'R');
			$this->Cell($w[1],4,'');
			$this->Cell($w[1],4,number_format($_netprofitFinalLast,0,',','.'),'T',0,'R');
			$this->Ln(8);
		}

	}
}
?>