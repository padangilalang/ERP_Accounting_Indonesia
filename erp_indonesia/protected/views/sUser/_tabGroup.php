<?php $this->widget('ext.bootstrap.widgets.BootGridView',array(
		'id'=>'s-group-grid',
		'dataProvider'=>sGroup::model()->search($model->id),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		//'filter'=>$model,
		'columns'=>array(
				array(
						'class'=>'bootstrap.widgets.BootButtonColumn',
						'template'=>'{delete}',
						'deleteButtonUrl'=>'Yii::app()->createUrl("sUser/deleteGroup",array("id"=>$data->id))',
				),
				'organization_root.name',
		),
)); ?>

<hr>
<?php 
$this->renderPartial('_formGroup', array('model'=>$modelGroup));
?>

