<?php

$Hierarchy=tAccount::model()->findAll(array('condition'=>'parent_id = 0'));

foreach ($Hierarchy as $Hierarchy){
	$models = tAccount::model()->findByPk($Hierarchy->id);
	$items[] = $models->getTree();
}

$this->beginWidget('CTreeView', array(
		'id'=>'module-tree',
		//'data'=>$items,
		'url' => array('/m2/tAccount/ajaxFillTree'),
		//'collapsed'=>true,
		//'unique'=>true,
));
$this->endWidget();

?>
