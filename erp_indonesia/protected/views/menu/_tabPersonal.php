<?php		$this->renderPartial('_formNotification', array('model'=>$model)); ?>

<?php $this->widget('zii.widgets.CListView', array(
	 //$this->widget('ext.bootstrap.widgets.BootListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'/sNotification/_view',
		'template'=>'{items}{pager}'
)); ?>

<br>

<?php
//$this->widget('sms');
//$this->widget('smssend');
//echo Yii::app()->getDateFormatter()->format('dd-MM-yyyy',time());
//echo Yii::app()->getLocale()->id;
//echo Yii::app()->getTimeZone();
//echo Yii::app()->getTheme()->name;

?>

