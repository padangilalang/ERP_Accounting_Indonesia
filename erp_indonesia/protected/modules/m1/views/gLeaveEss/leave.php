<?php
$this->breadcrumbs=array(
		'G people'=>array('index'),
		$model->id,
);

$this->menu5=array('Leave');

?>

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
				array('label'=>'Detail','content'=>$this->renderPartial("_tabDetail", array("model"=>$model), true)),
				//array('label'=>'Sub Account','content'=>$this->renderPartial("_tabSub", array("model"=>$model), true)),
				//array('label'=>'Linked Module','content'=>$this->renderPartial("_tabModule", array("model"=>$model), true)),
		),
));
?>