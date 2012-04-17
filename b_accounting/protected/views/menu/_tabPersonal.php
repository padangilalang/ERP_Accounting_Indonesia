<?php		$this->renderPartial('_formNotification', array('model'=>$model)); ?>

<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'template'=>'{items}{pager}',
		'itemView'=>'/sNotification/_view',
)); ?>

<br>

