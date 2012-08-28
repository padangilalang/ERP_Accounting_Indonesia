<?php $this->widget('bootstrap.widgets.BootCarousel', array(
		'items'=>array(
				array('image'=>Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'images/icon/header.jpg',
						'caption'=>Yii::app()->name,
				),
				array('image'=>Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'images/icon/header2.jpg',
						//'caption'=>'Second Menu label'
				),
				array('image'=>Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'images/icon/header3.jpg',
						//'caption'=>'Third Menu label'
				),
		),
		'options'=>array(
				'interval'=>5000,
		),
		'displayPrevAndNext'=>false,
));
?>


