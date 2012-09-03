<?php
require('cellpdf.php');

$pdf=new CellPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

$pdf->VCell(15,50,"Text at\nbottom",1,0,'D');
$pdf->VCell(10,50,'Centered text',2,0,'C');
$pdf->VCell(15,50,"Text\non top",1,0,'U');

$pdf->Cell(50,50,"Text on\nthe left",'lbtR',0,'L');
$pdf->Cell(50,50,'This line is very long and gets compressed','LtRb',0,'C');
$pdf->Cell(50,50,"Text on\nthe right",'Ltrb',0,'R');

$pdf->Output();
?>
