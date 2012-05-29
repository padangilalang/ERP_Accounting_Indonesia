
<?php if (!Yii::app()->user->isGuest) {

	$this->widget('bootstrap.widgets.BootNavbar', array(
			'fixed'=>true,
			'brand'=>Yii::app()->name,
			'brandUrl'=>Yii::app()->createUrl("menu"),
			'collapse'=>true, // requires bootstrap-responsive.css
			'items'=>array(
					array(
							'class'=>'bootstrap.widgets.BootMenu',
							'htmlOptions'=>array('class'=>'pull-right'),
							'items'=>array(
									array('label'=>Yii::app()->user->name, 'url'=>'#', 'items'=>array(
											array('label'=>'Help', 'url'=>'#'),
											array('label'=>'Settings', 'url'=>'#'),
											'---',
											array('label'=>'Sign Out', 'url'=>Yii::app()->createUrl("/site/logout")),
									)),
							),
					),
			),
	));
} else {
	$this->widget('bootstrap.widgets.BootNavbar', array(
			'fixed'=>true,
			'brand'=>Yii::app()->name,
			'brandUrl'=>'#',
			'collapse'=>true, // requires bootstrap-responsive.css
			'items'=>array(
			),
	));
}

?>
