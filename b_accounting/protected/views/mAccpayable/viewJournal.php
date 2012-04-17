<?php
$this->breadcrumbs=array(
		'Account Payable'=>array('index'),
		$model->system_ref,
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/mAccpayable/')),
		array('label'=>'Approval', 'url'=>array('/mAccpayable/','id'=>1)),
		array('label'=>'Payment', 'url'=>array('/mAccpayable/','id'=>2)),
		array('label'=>'Paid', 'url'=>array('/mAccpayable/','id'=>3)),
		array('label'=>'Show All', 'url'=>array('/mAccpayable/','id'=>0)),
		array('label'=>'Print', 'url'=>array('print', 'id'=>$model->id)),
);

$this->menu1=bPorder::getTopUpdated(1);
$this->menu2=bPorder::getTopCreated(1);
//$this->menu3=uJournal::getTopRelated($model->user_ref);

?>

<div class="page-header">
	<h1>
		Account Payable:
		<?php echo $model->system_ref; 		
		if ($model->state_id != 1) echo " (" .sParameter::item("cStatus",$model->state_id) .")";
		?>
	</h1>
</div>

<?php 

$this->widget('bootstrap.widgets.BootDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'input_date',
				'yearmonth_periode',
				'user_ref',
				'system_ref',
				'remark',
				//'journal_type_id',
		),
)); ?>

<br />

<?php echo $this->renderPartial('/uJournal/_viewDetail', array('id'=>$model->id)); ?>

<hr />
<?php echo CHtml::link('See Journal Detail >>',Yii::app()->createUrl('/mAccpayable/viewRelated',array("id"=>$model->id))); ?>
