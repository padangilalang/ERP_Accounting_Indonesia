<?php
$this->breadcrumbs=array(
		'G people'=>array('index'),
		$model->id,
);

$this->menu=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/m1/gLeave')),
);


$this->menu1=gLeave::getTopUpdated();
$this->menu2=gLeave::getTopCreated();
$this->menu5=array('Leave');

?>

<div class="pull-right">
	<?php $this->widget('bootstrap.widgets.BootButtonGroup', array(
			'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'buttons'=>array(
					array('label'=>'Leave', 'items'=>array(
							array('label'=>'Person', 'url'=>Yii::app()->createUrl("/m1/gPerson/view",array("id"=>$model->id))),
							array('label'=>'Absence', 'url'=>'#'),
							array('label'=>'Payroll', 'url'=>'#'),
							array('label'=>'Other Module', 'url'=>'#'),
					)),
			),
	)); ?>
</div>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/user.png') ?>
		<?php echo $model->vc_psnama; ?>
	</h1>
</div>


<?php
$this->widget('bootstrap.widgets.BootTabbable', array(
		'type'=>'tabs', // 'tabs' or 'pills'
		'tabs'=>array(
				array('label'=>'List Cuti','content'=>$this->renderPartial("_tabList", array("model"=>$model), true),'active'=>true),
				array('label'=>'Detail','content'=>$this->renderPartial("/gPerson/_tabDetail", array("model"=>$model), true)),
				//array('label'=>'Sub Account','content'=>$this->renderPartial("_tabSub", array("model"=>$model), true)),
				//array('label'=>'Linked Module','content'=>$this->renderPartial("_tabModule", array("model"=>$model), true)),
		),
));
?>