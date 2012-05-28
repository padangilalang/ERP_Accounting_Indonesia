<?php
$this->breadcrumbs=array(
		'Journal Voucher'=>array('index'),
		$model->system_ref,
);

$this->menu=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/uJournal/')),
		
		array('label'=>'Update', 'icon'=>'edit', 'url'=>array('update', 'id'=>$model->id),'visible'=>$model->state_id !=4),
		array('label'=>'Delete', 'icon'=>'remove', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),'visible'=>$model->state_id !=4),
		array('label'=>'Print', 'icon'=>'print', 'url'=>array('print', 'id'=>$model->id)),
);

$this->menu1=uJournal::getTopUpdated(1);
$this->menu2=uJournal::getTopCreated(1);
//$this->menu3=uJournal::getTopRelated($model->user_ref);
$this->menu5=array('Journal');

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/cash.png') ?>
		Journal:
		<?php echo $model->system_reff(); ?>
	</h1>
</div>

<?php 

//$this->widget('bootstrap.widgets.BootDetailView', array(
$this->widget('ext.XDetailView', array(
		'ItemColumns' => 2,
		'data'=>$model,
		'attributes'=>array(
				'input_date',
				'yearmonth_periode',
				array(
						'label'=>'Module',
						'value'=>$model->module->name,
				),
				'user_ref',
				'system_ref',
				null,
				'remark',
				//'journal_type_id',
		),
)); ?>

<br />

<?php echo $this->renderPartial('/uJournal/_viewDetail', array('id'=>$model->id)); ?>

