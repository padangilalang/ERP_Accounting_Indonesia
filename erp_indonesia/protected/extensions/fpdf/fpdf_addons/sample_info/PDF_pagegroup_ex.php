<?php
require('pagegroup.php');

class PDF extends PDF_PageGroup
{
function Footer()
{
	$this->SetY(-20);
	$this->Cell(0, 6, 'Page '.$this->GroupPageNo().'/'.$this->PageGroupAlias(), 0, 0, 'C');
}
}

$pdf = new PDF();
$pdf->SetFont('Arial', '', 12);

$pdf->StartPageGroup();
$pdf->AddPage();
$pdf->Write(5, 'Start of group 1');
$pdf->AddPage();

$pdf->StartPageGroup();
$pdf->AddPage();
$pdf->Write(5, 'Start of group 2');
$pdf->AddPage();
$pdf->AddPage();
$pdf->AddPage();

$pdf->Output();
?>
