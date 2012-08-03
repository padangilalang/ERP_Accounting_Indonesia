<?php

class cAbsence1 extends fpdf
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
				'Report Code: appForm1/R1',0,0,'C');
	}

	function myheader()
	{
		//Header

		$this->y0=$this->GetY();
		//$this->Image('css/Logo.jpg',14,9,12);
		$this->SetY($this->y0);
		$this->SetFont('Arial','',10);
		$this->Cell(20);
		$this->Cell(100,5,'CENTRAL PARK MALL');
		$this->Ln();
		$this->Cell(20);
		$this->Cell(100,5,'HR DEPARTMEN');
		$this->Ln(7);
		$this->Cell(0,2,'','T');
		$this->Ln();

		$this->SetFont('Arial','B',12);
		$this->Cell(0,5,'RECAPITULATION PERIOD',0,0,'C');

		$this->Ln(6);
		$this->SetFont('Arial','',8);
		$this->Cell(40,5,'Project:');
		$this->Cell(20,5,'');
		$this->Ln(4);
		$this->Cell(40,5,'Departmen:');
		$this->Cell(20,5,'');
		$this->Ln(4);
		$this->Cell(40,5,'Periode:');
		//$this->Cell(20,5, $begindate . " - " . $enddate);
		$this->Cell(20,5,'');

		$this->Ln(6);

		$w=array(8,50,30,30,30,30,30,30,30);
		$this->SetFont('Arial','',8);
		$this->Cell($w[0],8,'NO',1,0,1,0,'C');
		$this->Cell($w[1],8,'EMPLOYEE NAME',1,0,'C');
		$this->Cell($w[2],8,'ATTENDANCE',1,0,'C');
		$this->Cell($w[3],8,'SICK',1,0,'C');
		$this->Cell($w[4],8,'LEAVE',1,0,'C');
		$this->Cell($w[5],8,'PERMISSION',1,0,'C');
		$this->Cell($w[6],8,'NOT IN',1,0,'C');
		$this->Cell($w[7],8,'LATE IN',1,0,'C');
		$this->Cell($w[8],8,'EARLY OUT',1,0,'C');
		$this->Ln();

	}

	function report($project_id,$departmen_id=0)
	{

		$this->myheader();

		$sql = '
		select a.id, a.name,
		count(f.id) as TotalDay,
		sum(if(f.realpattern_id <>17 AND f.daystatus1_id =0,1,0)) as Workday,
		sum(if(f.daystatus1_id =8,1,0)) as Overtime,
		sum(if(f.daystatus1_id =4,1,0)) as Sick,
		sum(if(f.daystatus1_id =10,1,0)) as Absence,
		sum(if(h.id =11,1,0)) as Permission,
		sum(if(f.realpattern_id =17 AND f.daystatus1_id = 0,1,0)) as Off,
		SUM(if(TIME(i.in) < TIME(f.in) AND f.daystatus1_id <> 4,1,0)) as LateIn,
		sum(if(TIME(i.out) > TIME(f.out) AND f.daystatus1_id <> 4,1,0)) as EarlyOut

		from c_personalia a
		inner join c_personalia_status b ON a.id = b.parent_id and b.valid_id = 1
		inner join c_personalia_structure c ON a.id = c.parent_id and c.valid_id = 1

		inner join a_organization d ON c.structure_id = d.id
		inner join a_organization e ON e.id = d.parent_id
		inner join a_organization j ON j.id = e.parent_id

		left join c_personalia_absence f ON a.absensi_id = f.parent_id
		left join c_daycategory g ON g.id = f.daystatus1_id
		left join c_daycategory h ON h.id = g.parent_id

		left join c_timeblock i ON i.id = f.realpattern_id

		';

		if ($departmen_id !=0) {
			$sql = Yii::app()->db->createCommand($sql.' where b.status_id = 1 and j.id = '.$project_id.'
					and e.id = '.$departmen_id.'
					group by a.id');
		} else {
			$sql = Yii::app()->db->createCommand($sql.' where b.status_id = 1 and j.id = '.$project_id.'
					group by a.id');
		}
			
		$models=$sql->queryAll();

			
		$_count = 0;
		$_total = 0;
		$_counter = 1;
		$_countert = 1;


		$_counter = 1;
		$_countert = 1;
		$_totalc = 0;
		$w=array(8,50,30,30,30,30,30,30,30);

		foreach($models as $model)
		{
			$this->SetFont('Arial','',8);
			$this->Cell($w[0],4,number_format($_countert,0,',','.'),'LB',0,'R');
			$this->Cell($w[1],4,$model["name"],'LB');
			$this->Cell($w[2],4,$model["Workday"],'LB',0,'C');
			$this->Cell($w[3],4,$model["Sick"],'LB',0,'C');
			$this->Cell($w[4],4,$model["Absence"],'LB',0,'C');
			$this->Cell($w[5],4,$model["Permission"],'LB',0,'C');
			$this->Cell($w[6],4,$model["Off"],'LB',0,'C');
			$this->Cell($w[7],4,$model["LateIn"],'LB',0,'C');
			$this->Cell($w[8],4,$model["EarlyOut"],'LBR',0,'C');
			$this->Ln();


			$_counter++;
			$_countert++;

			if ($_counter==34) {
				$this->Cell(array_sum($w),0,'','T');
				$this->AddPage();

				$this->myheader();

				$_counter = 1;

			}
		}

		//Closure line
		$this->Cell(array_sum($w),0,'','T');
		$this->Ln(2);

		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],5,'','TLB');
		$this->Cell($w[1],5,'T O T A L','TLB',0,'C');
		$this->Cell($w[2],5,'','TLB');
		$this->Cell($w[3],5,'','TLB');
		$this->Cell($w[4],5,'','TLB');
		$this->Cell($w[5],5,'','TLB');
		$this->Cell($w[6],5,number_format($_totalc,0,',','.'),'TLBR',0,'R');
		$this->Cell($w[7],5,'','TLB');
		$this->Cell($w[8],5,'','TLBR');
		$this->Ln(7);

		$w=array(47.5,47.5,47.5,47.5);

		$this->Cell($w[0],4,'Date','LTR');
		$this->Cell($w[1],4,'Date','LTR');
		$this->Cell($w[2],4,'Date','LTR');
		$this->Cell($w[3],4,'Date','LTR');
		$this->Ln();
		$this->Cell($w[0],4,'Proposed By','LR');
		$this->Cell($w[1],4,'','LR');
		$this->Cell($w[2],4,'Approved By','LR');
		$this->Cell($w[3],4,'','LR');
		$this->Ln();
		$this->Cell($w[0],20,'','LR');
		$this->Cell($w[1],20,'','LR');
		$this->Cell($w[2],20,'','LR');
		$this->Cell($w[3],20,'','LR');
		$this->Ln();
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],4,'A','LR',0,'C');
		$this->Cell($w[1],4,'B','LR',0,'C');
		$this->Cell($w[2],4,'C','LR',0,'C');
		$this->Cell($w[3],4,'','LR',0,'C');
		$this->Ln();
		$this->SetFont('Arial','',8);
		$this->Cell($w[0],4,'AA','LBR',0,'C');
		$this->Cell($w[1],4,'BB','LBR',0,'C');
		$this->Cell($w[2],4,'CC','LBR',0,'C');
		$this->Cell($w[3],4,'','LBR',0,'C');
	}

}

?>