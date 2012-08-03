<?php
$this->breadcrumbs=array(
		'G people'=>array('index'),
		$model->id,
);

$this->menu=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/m1/gPerson')),

		array('label'=>'Update', 'icon'=>'edit', 'url'=>array('update', 'id'=>$model->id)),
);


?>

<?php /*
<div class="pull-right">
<?php $this->widget('bootstrap.widgets.BootButtonGroup', array(
		'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'buttons'=>array(
				array('label'=>'Person', 'items'=>array(
						array('label'=>'Leave', 'url'=>Yii::app()->createUrl("/m1/gLeave/view",array("id"=>$model->id))),
						array('label'=>'Absence', 'url'=>'#'),
						array('label'=>'Payroll', 'url'=>'#'),
						array('label'=>'Other Module', 'url'=>'#'),
				)),
		),
)); ?>
</div>
*/ ?>

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
				array('label'=>'Detail','content'=>$this->renderPartial("_tabDetail", array("model"=>$model), true),'active'=>true),
				array('label'=>'Position','content'=>$this->renderPartial("_tabKarir", array("model"=>$model), true)),
				array('label'=>'Family','content'=>$this->renderPartial("_tabFamily", array("model"=>$model), true)),
				array('label'=>'Education','content'=>$this->renderPartial("_tabEducation", array("model"=>$model), true)),
				array('label'=>'Experience','content'=>$this->renderPartial("_tabOrganization", array("model"=>$model), true)),
				array('label'=>'Organization','content'=>$this->renderPartial("_tabOrganization", array("model"=>$model), true)),
				array('label'=>'Photo','content'=>$this->renderPartial("_tabOrganization", array("model"=>$model), true)),
		),
));
?>