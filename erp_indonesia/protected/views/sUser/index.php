<?php
$this->breadcrumbs=array(
		'User'=>array('/sUser'),
		'Manage',
);

$this->menu=array(
		//array('label'=>'Create', 'url'=>array('create')),
);

$this->menu2=sUser::getTopCreated();


?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/user.png') ?>
		User Management
	</h1>
</div>
<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'user-module-grid',
		'dataProvider'=>sUser::model()->search(),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				array(
						'class'=>'bootstrap.widgets.BootButtonColumn',
						'template'=>'{delete}{update}',
				),
				array(
						'class'=>'BootButtonColumn',
						'template'=>'{password}',
						'buttons'=>array
						(
								'password' => array
								(
										'label'=>'<i class="icon-barcode"></i> Password',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/process.png',
										'url'=>'Yii::app()->createUrl("sUser/updatePassword", array("id"=>$data->id))',
								),
						),
						'htmlOptions'=>array(
							//'style'=>'width: 20px',
						)
				),
				array(
						'name'=>'username',
						'type'=>'raw',
						'value'=>'CHtml::link($data->username,Yii::app()->createUrl("sUser/view",array("id"=>$data->id)))',
				),
				array(
						'name'=>'password',
						'type'=>'raw',
				),
				array(
						'name'=>'default_group',
						'value'=>'aOrganization::model()->findByPk($data->default_group)->name',
				),
				array(
						'header'=>'Status',
						'value'=>'$data->status->name',
				),
				array(
						'name'=>'last_login',
						'value'=>'Yii::app()->dateFormatter->format("dd-MM-yyyy hh:mm",$data->last_login)',
				),

		),
)); ?>


<div class="page-header">
	<h2>Create New user</h2>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$modeluser)); ?>

