<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'stask-grid',
		'dataProvider'=>sTask::model()->search(),
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				'subject',
				'start_date',
				//'end_date',
				array(
						'name'=>'status_id',
						'value'=>'sParameter::item("cStatusTask",$data->status_id)',
				),
				//array(
				//		'name'=>'priority_id',
				//		'value'=>'sParameter::item("cPriority",$data->priority_id)',
				//),
				//array(
				//		'name'=>'category_id',
				//		'value'=>'sParameter::item("cTaskCategory",$data->category_id)',
				//),
				//'notes',
				array(
						'class'=>'BootButtonColumn',
				),
		),
)); ?>

<hr />

<?php //echo $this->renderPartial('_formReminder', array('model'=>$modeltask)); ?>

