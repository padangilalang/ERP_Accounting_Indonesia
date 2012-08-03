<?php
$this->breadcrumbs=array(
		'SMS'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);

?>

<div class="page-header">
	<h1>
		<?php echo $model->id; ?>
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
		),
		'htmlOptions' => array('style' => 'clear: both;'),
));
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>