<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_viewMySelf',
		'template'=>'{items}{pager}'
)); ?>
