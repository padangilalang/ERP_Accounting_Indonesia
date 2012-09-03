<?php
require('pdf_tree.php');

// LOAD DATA INTO AN ARRAY
$data = array(
			'Operating Systems'=>array(
									'Microsoft Windows'=>array(
															'3.1'=>'NotAvailable',
															'NT'=>'$120.00',
															'95'=>'$120.00',
															'98'=>'$120.00',
															'2000'=>array(
																		'Home'=>'$120.00',
																		'Professional'=>'$320.00',
																		'Server'=>'$1200.00'
																		),
															'ME'=>'NotAvailable',
															'XP'=>'NotAvailable'
															),
									'Linux'=>array(
												'Red Hat',
												'Debian',
												'Mandrake'
												),
									'FreeBSD',
									'AS400',
									'OS/2'
									),
			'Food'=>array(
						'Fruits'=>array(
										'Apple',
										'Pear'
									),
						'Vegetables'=>array(
										'Carot',
										'Salad',
										'Bean'
										),
						'Chicken',
						'Hamburger'
						)
			);
									
// CREATE PDF
$pdf=new PDF_Tree();
$pdf->SetMargins(5,0,5);
$pdf->SetAutoPageBreak(true,0);
$pdf->AddPage();
$pdf->SetFont('Arial','',5);
$pdf->SetFillColor(150,150,150);
$pdf->SetDrawColor(20,20,20);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,6,'My Tree Example',0,'','R');
$pdf->Ln(6);

// TREE 1
$pdf->SetY(6);
$pdf->MakeTree($data);

// TREE 2
$startX      = 30;
$nodeFormat  = '[Node: %k]';
$childFormat = '[Child: %k = <%v>]';
$w           = 40;
$h           = 5;
$border      = 0;
$fill        = 0;
$align       = 'L';
$indent      = 2;
$vspacing    = 1;
$pdf->SetY(6);
$pdf->MakeTree($data,$startX,$nodeFormat,$childFormat,$w,$h,$border,$fill,$align,$indent,$vspacing);

// TREE 3
$startX      = 75;
$nodeFormat  = '+%k';
$childFormat = "%k:\n%v";
$w           = 20;
$h           = 3;
$border      = 0;
$fill        = 1;
$align       = 'C';
$indent      = 5;
$vspacing    = 3;
$pdf->SetY(6);
$pdf->MakeTree($data,$startX,$nodeFormat,$childFormat,$w,$h,$border,$fill,$align,$indent,$vspacing);

// TREE 4
$startX      = 140;
$nodeFormat  = '<%k>';
$childFormat = '<%k> = [%v]';
$w           = 20;
$h           = 3;
$border      = 1;
$fill        = 1;
$align       = 'R';
$indent      = 8;
$vspacing    = 0;
$pdf->SetY(6);
$pdf->MakeTree($data,$startX,$nodeFormat,$childFormat,$w,$h,$border,$fill,$align,$indent,$vspacing);

// TREE 5
$startX      = 115;
$nodeFormat  = '%k';
$childFormat = '%k = [%v]';
$w           = 25;
$h           = 3;
$border      = 0;
$fill        = 1;
$align       = 'J';
$indent      = 18;
$vspacing    = 1;
$drawlines   = false;
$pdf->SetY(120);
$pdf->MakeTree($data,$startX,$nodeFormat,$childFormat,$w,$h,$border,$fill,$align,$indent,$vspacing,$drawlines);

$pdf->Output();
?>
