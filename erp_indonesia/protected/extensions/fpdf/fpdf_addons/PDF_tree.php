<?php
////////////////////////////////////////////////////
// PDF Tree 
//
// Extension for the FPDF Class (http://www.fpdf.org) to print a tree based on an array structure
// where each internal array represents a node and its elements the children
//
// Copyright (C) 2004 InterWorld Srl (ITALY)
// http://www.webjam.it
//-------------------------------------------------------------------
// VERSIONS:
// 1.0 : Initial release
// BUGS:
// 1) Does not support multipage
// 2) Problems when the text of each line in the nodes is bigger then the width given. 
////////////////////////////////////////////////////

/**
* PDF Tree
* @package PDF
* @authors:
* - Simone Cosci <simone@webarts.it>
* - Raffaele Montagnani <raffaele@webarts.it>
* @copyright 2004 InterWorld Srl
* @return double (height of the tree)
* @desc Print a Tree from an Array Structure
* @param $data array            // Data in Array format
* @param $x int                 // Starting X position (units from lMargin) default=0
* @param $nodeFormat string     // Format of a node, where %k is the Key of element; default='+%k'
* @param $childFormat string    // Format of a terminal child (leaf), where %k is the key of element and %v is the value; default='-%k: %v'
* @param $w int                 // Width of the nodes; default=20
* @param $h int                 // Height of the nodes; default=5
* @param $border int            // Border of the nodes; default=1 (0=N, 1=Y)
* @param $fill boolean          // Fill the nodes; default=false
* @param $align string          // Align of the text in the nodes; default=''
* @param $indent int            // Units of indentation of the children; default=1
* @param $vspacing int          // Vertical nodes spacing; default=1 
* @param $drawlines boolean     // Draw also the lines of the tree structure; default=true 
* @param $level int             // Reserved (recursive use)
* @param $hcell array           // Reserved (recursive use)
* @param $treeHeight double     // Reserved (recursive use)
**/

//require_once('fpdf.php');

class PDF_tree extends fpdf {
	function MakeTree($data, $x=0, $nodeFormat='+%k', $childFormat='-%k: %v', $w=20, $h=5, $border=1, $fill=false, $align='', $indent=1, $vspacing=1, $drawlines=true, $level=0, $hcell=array(), $treeHeight=0.00){
		if(is_array($data)){
			$countData = count($data); $c=0; $hcell[$level]=array();
			foreach($data as $key=>$value){
				$this->SetXY($x+$this->lMargin+($indent*$level),$this->GetY()+$vspacing);
				if(is_array($value)){
					$pStr = str_replace('%k',$key,$nodeFormat);
				}else{
					$pStr = str_replace('%k',$key,$childFormat);
					$pStr = str_replace('%v',$value,$pStr);
				}
				$pStr = str_replace("\r",'',$pStr);
				$pStr = str_replace("\t",'',$pStr);
				while(ord(substr($pStr,-1,1))==10)
					$pStr = substr($pStr,0,(strlen($pStr)-1));
				$line = explode("\n",$pStr);
				$rows = 0; $addLines = 0;
				foreach ($line as $l){
					$widthLine = $this->GetStringWidth($l);
					$rows = $widthLine/$w;
					if($rows>1)
						$addLines+=($widthLine%$w==0) ? $rows-1 : $rows;
				}
				$hcell[$level][$c]=intval(count($line)+$addLines)*$h;
				$this->MultiCell($w,$h,$pStr,$border,$align,$fill);
				$x1 = $x+$this->lMargin+($indent*$level);
				$y1 = $this->GetY()-($hcell[$level][$c]/2);
				if($drawlines)
					$this->Line($x1,$y1,$x1-$indent,$y1);
				if($c==$countData-1){
					$x1 = $x+$this->lMargin+($indent*$level)-$indent;
					$halfHeight = 0;
					if(isset($hcell[$level-1])){
						$lastKeys = array_keys($hcell[$level-1]);
						$lastKey = $lastKeys[count($lastKeys)-1];
						$halfHeight = $hcell[$level-1][$lastKey]/2;
					}
					$y2 = $y1-$treeHeight-($hcell[$level][$c]/2)-$halfHeight-$vspacing;
					if($drawlines)
						$this->Line($x1,$this->GetY()-($hcell[$level][$c]/2),$x1,$y2);
				}
				if(is_array($value))
					$treeHeight += $this->MakeTree($value,$x,$nodeFormat,$childFormat,$w,$h,$border,$fill,$align,$indent,$vspacing,$drawlines,$level+1,$hcell);
				$treeHeight += $hcell[$level][$c]+$vspacing;
				$c++;
			}
			return $treeHeight;
		}
	}
}
?>
