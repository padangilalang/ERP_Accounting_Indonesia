<?php if (!Yii::app()->user->isGuest) {
	$this->widget('bootstrap.widgets.BootNavbar', array(
    'fixed'=>false,
    'brand'=>false,
    'brandUrl'=>'#',
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.BootMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>'Current Periode: '.Yii::app()->settings->get("System", "cCurrentPeriod"), 'url'=>'#'),
                array('label'=>Yii::app()->user->name, 'url'=>'#', 'items'=>array(
                    array('label'=>'Help', 'url'=>'#'),
                    array('label'=>'Setting', 'url'=>'#'),
                    '---',
                    array('label'=>'Log Out', 'url'=>Yii::app()->createUrl("site/logout")),
                )),
            ),
        ),
    ),
)); 

} else {
	$this->widget('bootstrap.widgets.BootNavbar', array(
    'fixed'=>true,
    'brand'=>true,
    'brandUrl'=>'#',
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
    ),
)); 



}
?> 
