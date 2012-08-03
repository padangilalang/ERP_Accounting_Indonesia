<?php if (!Yii::app()->user->isGuest) {

	if (Yii::app()->user->name == 'admin') {
		$Hierarchy=menu::model()->findAll(array('condition'=>'parent_id = \'0\' AND (name = \'m2\' OR name = \'m0\') ','order'=>'sort'));
	} else {

		$Hierarchy=menu::model()->findAllBySql('SELECT a.id FROM s_module a
				LEFT JOIN s_user_module b ON a.id = b.s_module_id
				WHERE a.parent_id = "0"
				AND b.s_user_id = '.Yii::app()->user->id .' order by sort');
	}

	foreach ($Hierarchy as $Hierarchy){
		$models = menu::model()->findBypk($Hierarchy->id);
		$items[] = $models->getListed();
	}

	$this->widget('bootstrap.widgets.BootNavbar', array(
			//'fixed'=>true,
			'brand'=>Yii::app()->name,
			'brandUrl'=>Yii::app()->createUrl("menu"),
			'collapse'=>true, // requires bootstrap-responsive.css
			'items'=>array(
					array(
							'class'=>'bootstrap.widgets.BootMenu',
							'items'=>$items,
					),
					array(
							'class'=>'bootstrap.widgets.BootMenu',
							'htmlOptions'=>array('class'=>'pull-right'),
							'items'=>array(
									array('label'=>'This Periode: '.Yii::app()->settings->get("System", "cCurrentPeriod"), 'url'=>'#'),
									array('label'=>Yii::app()->user->name, 'url'=>'#', 'items'=>array(
											array('label'=>'Help', 'url'=>Yii::app()->createUrl("/sAdmin/help"),'visible'=>(Yii::app()->user->name == "admin")),
											array('label'=>'Setting', 'url'=>'#'),
											array('label'=>'Version', 'url'=>Yii::app()->createUrl("/menu/version")),
											array('label'=>'About', 'url'=>Yii::app()->createUrl("/menu/about")),
											'---',
											array('label'=>'Log Out', 'url'=>Yii::app()->createUrl("/site/logout")),
									)),
							),
					),
			),
	));
} else {
	$this->widget('bootstrap.widgets.BootNavbar', array(
			//'fixed'=>true,
			'brand'=>Yii::app()->name,
			'brandUrl'=>'#',
			'collapse'=>true, // requires bootstrap-responsive.css
			'items'=>array(
			),
	));
}

?>
