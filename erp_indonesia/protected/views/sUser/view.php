<?php
$this->breadcrumbs=array(
		'User'=>array('view'),
		$model->id,
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/sUser')),
		array('label'=>'Update', 'url'=>array('update','id'=>$model->id)),
		array('label'=>'Update Password', 'url'=>array('updatePassword','id'=>$model->id)),
);

$this->menu2=sUser::getTopCreated();


?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/user.png') ?>
		<?php echo CHtml::encode($model->username); ?>
	</h1>
</div>

<?php 
$this->widget('bootstrap.widgets.BootDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'username',
				'password',
				array(
						'label'=>'Default Group',
						'value'=>aOrganization::model()->findByPk($model->default_group)->name,
				),
				array(
						'label'=>'Status',
						'value'=>$model->status->name,
				),

		),
));

?>
<br />

<?php
$this->widget('bootstrap.widgets.BootTabbable', array(
		'type'=>'tabs', // 'tabs' or 'pills'
		'tabs'=>array(
				array('label'=>'Module', 'content'=>$this->renderPartial("_tabModule", array("model"=>$model,"modelModule"=>$modelModule), true),'active'=>true),
				array('label'=>'Group', 'content'=>$this->renderPartial("_tabGroup", array("model"=>$model,"modelGroup"=>$modelGroup), true)),
		),
));
?>