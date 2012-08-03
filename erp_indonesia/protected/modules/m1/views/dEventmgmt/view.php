<?php
$this->breadcrumbs=array(
		'Event Management'=>array('index'),
		$model->id,
);

?>

<div class="page-header">
	<h1>
		<?php echo $model->issue; ?>
	</h1>
</div>
<?php
$this->widget('ext.JuiButtonSet.JuiButtonSet', array(
		'items' => array(
				array(
						'label'=>'List View',
						'icon-position'=>'left',
						'url'=>array('admin'),
				),
				array(
						'label'=>'Update',
						'icon-position'=>'left',
						'url'=>array('update', 'id'=>$model->id),
				),
		),
		'htmlOptions' => array('style' => 'clear: both;'),
));
?>

<?php 
//$this->widget('bootstrap.widgets.BootDetailView', array(
$this->widget('ext.XDetailView', array(
		'ItemColumns' => 2,

		'data'=>$model,
		'attributes'=>array(
				array(
						'name'=>'event_id',
						'value'=>sParameter::item("cEvent",$model->event_id),
				),
				'id',
				array(
						'name'=>'category_id',
						'value'=>sParameter::item("cEventCat",$model->category_id),
				),
				'issue',
				'person_incharge',
				'todo',
				'progress',
				'incomplete_exp',
				'remark',
		),
)); ?>
