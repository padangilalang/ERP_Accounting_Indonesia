<?php
/*
 $Hierarchy=cJemaat::model()->findAll(array('condition'=>'parent_id = 0'));

foreach ($Hierarchy as $Hierarchy){
$models = cJemaat::model()->findByPk($Hierarchy->id);
$items[] = $models->getTree();
}
*/
$this->beginWidget('CTreeView', array(
		'id'=>'module-tree',
		//'data'=>$items,
		'url' => array('/aOrganization/ajaxFillTree'),
		'collapsed'=>true,
		'unique'=>true,
));
$this->endWidget();

?>
