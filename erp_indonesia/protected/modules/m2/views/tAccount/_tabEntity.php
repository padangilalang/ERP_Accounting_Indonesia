<h2>Listed Entity</h2>

<?php $this->widget('bootstrap.widgets.BootGridView', array(

		'id'=>'t-account-entity-grid',
		'dataProvider'=>tAccountEntity::model()->searchAccount($model->id),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				array(
						'class'=>'bootstrap.widgets.BootButtonColumn',
						'template'=>'{delete}',
						'deleteButtonUrl'=>'Yii::app()->createUrl("/m2/tAccount/deleteEntity",array("id"=>$data->id))',
				),
				array (
						'name'=>'entity_id',
						'type'=>'raw',
						'value'=>'CHtml::link($data->entity->name,Yii::app()->createUrl("/m2/aOrganization/view",array("id"=>$data->entity->id)))',
				),
				array (
						'name'=>'state_id',
						'value'=>'sParameter::item("cStatusP",$data->state_id)',
				),
				'remark',
		),
)); ?>

<br />
<h2>New Entity</h2>
<?php echo $this->renderPartial('_formEntity', array('model'=>$modelEntity)); ?>