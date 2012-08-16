<?php
$this->breadcrumbs=array(
		'Account Payable'=>array('index'),
		$model->system_ref,
);

$this->menu=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/m2/mAccpayable/')),
		array('label'=>'Approval', 'icon'=>'lock', 'url'=>array('/m2/mAccpayable/','id'=>1)),
		array('label'=>'Payment', 'icon'=>'plus', 'url'=>array('/m2/mAccpayable/','id'=>2)),
		array('label'=>'Paid', 'icon'=>'gift', 'url'=>array('/m2/mAccpayable/','id'=>3)),
		array('label'=>'Show All', 'icon'=>'zoom-in', 'url'=>array('/m2/mAccpayable/','id'=>0)),
		array('label'=>'Print', 'icon'=>'print', 'url'=>array('print', 'id'=>$model->id)),
);

$this->menu1=vPorder::getTopUpdated(1);
$this->menu2=vPorder::getTopCreated(1);
//$this->menu3=uJournal::getTopRelated($model->user_ref);

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/payment.png') ?>
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
<?php echo CHtml::link('See Journal Detail >>',Yii::app()->createUrl('/m2/mAccpayable/viewRelated',array("id"=>$model->id))); ?>
