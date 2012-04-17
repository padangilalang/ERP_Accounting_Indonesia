<?php
$this->breadcrumbs=array(
		'SMS'=>array('index'),
		$model->id,
);

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::encode($model->cfrom); ?>
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

$this->widget('bootstrap.widgets.BootDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'filename',
				'cfrom',
				'sent',
				'received',
				'modem',
				'message',
				'reply_id',
		),
)); ?>
