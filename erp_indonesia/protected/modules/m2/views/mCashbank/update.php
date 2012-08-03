<?php
$this->breadcrumbs=array(
		'Cash and Bank'=>array('/m2/mCashbank'),
		'Update',
);

$this->menu=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/m2/mCashbank')),
);

$this->menu1=uJournal::getTopUpdated(2);
$this->menu2=uJournal::getTopCreated(2);


?>


<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/bank.png') ?>
		Cash and Bank
	</h1>
</div>

<?php
if (!isset($model->cb_receiver) && !isset($model->cb_received_from)) {
	$this->widget('bootstrap.widgets.BootTabbable', array(
			'type'=>'tabs', // 'tabs' or 'pills'
			'tabs'=>array(
					array('label'=>'Expense', 'content'=>$this->renderPartial("_tabCreateOut", array("model"=>$model), true),'active'=>true),
					array('label'=>'Income', 'content'=>$this->renderPartial("_tabCreateIn", array("model"=>$model), true)),
			),
	));
} elseif (isset($model->cb_receiver)) {
	$this->widget('bootstrap.widgets.BootTabbable', array(
			'type'=>'tabs', // 'tabs' or 'pills'
			'tabs'=>array(
					array('label'=>'Expense', 'content'=>$this->renderPartial("_tabCreateOut", array("model"=>$model), true),'active'=>true),
			),
	));

} else {
	$this->widget('bootstrap.widgets.BootTabbable', array(
			'type'=>'tabs', // 'tabs' or 'pills'
			'tabs'=>array(
					array('label'=>'Income', 'content'=>$this->renderPartial("_tabCreateIn", array("model"=>$model), true),'active'=>true),
			),
	));

}

?>

