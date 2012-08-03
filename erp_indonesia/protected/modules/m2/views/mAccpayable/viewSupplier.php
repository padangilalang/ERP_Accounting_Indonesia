<?php
$this->breadcrumbs=array(
		'Supplier'=>array('index'),
		$model->company_name,
);

$this->menu=array(
		array('label'=>'Home AP', 'icon'=>'home', 'url'=>array('/m2/mAccpayable/')),
		array('label'=>'Home Supplier', 'icon'=>'home', 'url'=>array('/m2/mAccpayable/indexSupplier')),
);

$this->menu1=cSupplier::getTopUpdated();
$this->menu2=cSupplier::getTopCreated();

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/lorrygreen.png') ?>
		<?php echo $model->company_name; ?>
	</h1>
</div>

<?php $this->widget('bootstrap.widgets.BootTabbable', array(
		'type'=>'tabs', // 'tabs' or 'pills'
		'tabs'=>array(
				array('label'=>'AP State', 'content'=>$this->renderPartial("_tabState", array("model"=>$model), true),'active'=>true),
				array('label'=>'Detail', 'content'=>$this->renderPartial("_tabDetail", array("model"=>$model), true)),
		),
)); ?>
