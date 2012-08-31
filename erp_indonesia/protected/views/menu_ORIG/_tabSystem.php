<?php		//$this->renderPartial('_formNotification3', array('model'=>$model)); ?>

<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'/sNotification/_view3',
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

