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
//$this->widget('bootstrap.widgets.BootDetailView', array(
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
