<?php	//$this->renderPartial('_formNotification', array('model'=>$model)); ?>

<?php //$this->widget('zii.widgets.CListView', array(
	 $this->widget('ext.bootstrap.widgets.BootListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'/sNotification/_view',
		'template'=>'{items}'
)); ?>

<br>
