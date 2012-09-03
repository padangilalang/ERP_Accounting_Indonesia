<?php
require('phplot/phplot.php');
require('mem_image.php');

$graph = new PHPlot(500,300);
$graph->SetDataType('data-data');

//Specify some data
$data = array(
    array('', 2000,  750),
    array('', 2010, 1700),
    array('', 2015, 2000),
    array('', 2020, 1800),
    array('', 2025, 1300),
    array('', 2030,  400)
);
$graph->SetDataValues($data);

//Specify plotting area details
$graph->SetPlotType('lines');
$graph->SetTitleFontSize('2');
$graph->SetTitle('Social Security trust fund asset estimates, in $ billions');
$graph->SetMarginsPixels(null,null,40,null);
$graph->SetPlotAreaWorld(2000,0,2035,2000);
$graph->SetPlotBgColor('white');
$graph->SetPlotBorderType('left');
$graph->SetBackgroundColor('white');
$graph->SetDataColors(array('red'),array('black'));

//Define the X axis
$graph->SetXLabel('Year');
$graph->SetXTickIncrement(5);

//Define the Y axis
$graph->SetYTickIncrement(500);
$graph->SetPrecisionY(0);
$graph->SetLightGridColor('blue');

//Disable image output
$graph->SetPrintImage(false);
//Draw the graph
$graph->DrawGraph();

$pdf = new PDF_MemImage();
$pdf->AddPage();
$pdf->GDImage($graph->img,30,20,140);
$pdf->Output();
?>
