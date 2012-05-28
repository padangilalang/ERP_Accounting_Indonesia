<?php $this->widget('bootstrap.widgets.BootCarousel', array(
    'items'=>array(
        array('image'=>'images/icon/header.jpg', 
			'caption'=>Yii::app()->name,
		),
        array('image'=>'images/icon/header2.jpg', 
			//'caption'=>'Second Menu label'
		),
        array('image'=>'images/icon/header3.jpg', 
			//'caption'=>'Third Menu label'
		),
    ),
	'options'=>array(
		'interval'=>5000,
	),
	//'noNav'=>true,
)); 
?>


