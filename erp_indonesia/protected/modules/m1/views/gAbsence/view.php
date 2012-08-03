<?php
$this->breadcrumbs=array(
		'G people'=>array('index'),
		$model->id,
);

$this->menu=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/m1/gPerson')),

		array('label'=>'Update', 'icon'=>'edit', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete', 'icon'=>'remove', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),
		),
);



$this->menu1=gPerson::getTopUpdated();
$this->menu2=gPerson::getTopCreated();
$this->menu5=array('Person');

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

<div class="pull-right">
	<?php $this->renderPartial('_search',array(
			'model'=>$model,
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
		'tabs' => array(
				//array('label'=>'Absence','content' =>$this->renderPartial("_tabAbsence", array("model"=>$model,"modelAbsence"=>$modelAbsence,"month"=>$month), true),),
				array('label'=>'Absence','content' =>$this->renderPartial("_tabAbsence", array("model"=>$model,"month"=>$month), true),'active'=>true),
				array('label'=>'Detail','content' =>$this->renderPartial("/gPerson/_tabDetail", array("model"=>$model), true),),
		),
));
?>

