<?php
if (!Yii::app()->user->isGuest) {

	//$Hierarchy=menu::model()->findAll(array('condition'=>'parent_id = 0'));
	if (Yii::app()->user->name == 'admin') {
		$Hierarchy=menu::model()->findAll(array('condition'=>'parent_id = 0','order'=>'sort'));
	} else {

		$Hierarchy=menu::model()->findAllBySql('SELECT a.id FROM s_module a
				LEFT JOIN s_user_module b ON a.id = b.s_module_id
				WHERE a.parent_id = "0"
				AND b.s_user_id = '.Yii::app()->user->id .' order by sort');
	}

	foreach ($Hierarchy as $Hierarchy){
		$models = menu::model()->findByPk($Hierarchy->id);
		$items[] = $models->getListed();
	}

	$this->widget('bootstrap.widgets.BootMenu', array(
			'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
			'stacked'=>false, // whether this is a stacked menu
			'items'=>$items,
	));
}  else
	$this->widget('bootstrap.widgets.BootMenu', array(
			'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
			'stacked'=>false, // whether this is a stacked menu
			//'items'=>$items,
	));

?>
