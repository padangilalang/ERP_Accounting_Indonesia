<?php if (!Yii::app()->user->isGuest) {

	if (Yii::app()->user->name == 'admin') {
		$Hierarchy=menu::model()->findAll(array('condition'=>'parent_id = \'0\' AND (name = \'m1\' OR name = \'m0\') ','order'=>'sort'));
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
									array('label'=>Yii::app()->user->name, 'icon'=>'icon-th', 'url'=>'#', 'items'=>array(
											array('label'=>'Help', 'icon'=>'question-sign','url'=>Yii::app()->createUrl("sAdmin/help"),'visible'=>(Yii::app()->user->name == "admin")),
											'---',
											array('label'=>'Profile', 'icon'=>'road','url'=>Yii::app()->createUrl('/sUser/viewPublic',array('id'=>Yii::app()->user->id))),
											array('label'=>'Theme', 'icon'=>'road','url'=>'#'),
											array('label'=>'Bookmark', 'icon'=>'list','url'=>'#'),
											array('label'=>'Version', 'icon'=>'info-sign','url'=>Yii::app()->createUrl("menu/version")),
											array('label'=>'About', 'icon'=>'qrcode', 'url'=>Yii::app()->createUrl("menu/about")),
											'---',
											array('label'=>'Log Out', 'icon'=>'off', 'url'=>Yii::app()->createUrl("site/logout")),
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
