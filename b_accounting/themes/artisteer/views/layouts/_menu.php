<?php if (!Yii::app()->user->isGuest) {
	$this->widget('bootstrap.widgets.BootNavbar', array(
			'fixed'=>true,
			'brand'=>Yii::app()->name,
			'brandUrl'=>Yii::app()->createUrl('/menu'),
			'collapse'=>true, // requires bootstrap-responsive.css
			'items'=>array(
					array(
							'class'=>'bootstrap.widgets.BootMenu',
							'htmlOptions'=>array('class'=>'pull-right'),
							'items'=>array(
									array('label'=>'Current Periode: '.Yii::app()->settings->get("System", "cCurrentPeriod"), 'url'=>'#'),
									array('label'=>Yii::app()->user->name, 'url'=>'#', 'items'=>array(
											array('label'=>'Help', 'url'=>Yii::app()->createUrl("sAdmin/help"),'visible'=>(Yii::app()->user->name == "admin")),
											array('label'=>'Setting', 'url'=>'#'),
											array('label'=>'Version', 'url'=>Yii::app()->createUrl("menu/version")),
											array('label'=>'About', 'url'=>Yii::app()->createUrl("menu/about")),
											'---',
											array('label'=>'Log Out', 'url'=>Yii::app()->createUrl("site/logout")),
									)),
							),
					),
			),
	));

}
?>
