<?php
$this->breadcrumbs=array(
		'G people',
);

$this->menu=array(
		array('label'=>'Home','url'=>array('/m1/gLeave')),
		//array('label'=>'Manage gPerson','url'=>array('admin')),
);


$this->menu1=gLeave::getTopUpdated();
$this->menu2=gLeave::getTopCreated();
$this->menu5=array('Leave');

?>

<div class="pull-right">
	<?php $this->renderPartial('_search',array(
			'model'=>$model,
	)); ?>
</div>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/user.png') ?>
		Leave
	</h1>
</div>

<?php
$this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
		'stacked'=>false, // whether this is a stacked menu
		'items'=>array(
				array('label'=>'Waiting for Approval','url'=>Yii::app()->createUrl('/m1/gLeave')),
				array('label'=>'Pending State','url'=>Yii::app()->createUrl('/m1/gLeave/onPending'),'active'=>true),
				array('label'=>'Employee On Leave','url'=>Yii::app()->createUrl('/m1/gLeave/onLeave')),
				array('label'=>'Recent Leave','url'=>Yii::app()->createUrl('/m1/gLeave/recentLeave')),

		),
));
?>


<?php $this->widget('bootstrap.widgets.BootGridView',array(
		'id'=>'g-person-grid',
		'dataProvider'=>gPerson::model()->onPending(),
		//'filter'=>$model,
		'columns'=>array(
				array(
						'header'=>'Name',
						'type'=>'raw',
						'value'=>'CHtml::link($data->vc_psnama,Yii::app()->createUrl("/m1/gLeave/view",array("id"=>$data->id)))',
				),
				'position.unit.name',
				'position.c_departkr',
				'leave.d_dari',
				'leave.d_sampai',
				'leave.n_jmlhari',
				'leaveBalance.n_sisacuti',
				array(
						'header'=>'Status',
						'value'=>'$data->leave->approved->name',
				),
				array(
						'class'=>'BootButtonColumn',
						'template'=>'{unblock}',
						'buttons'=>array
						(
								'unblock' => array
								(
										'label'=>'Unblock',
										'url'=>'Yii::app()->createUrl("/m1/gLeave/unblock",array("id"=>$data->leave->id,"pid"=>$data->id))',
										'visible'=>'$data->leave->approved_id ==4',
										'options'=>array(
												'ajax'=>array(
														'type'=>'GET',
														'url'=>"js:$(this).attr('href')",
														'success'=>'js:function(data){
														$.fn.yiiGridView.update("g-person-grid", {
														data: $(this).serialize()
});
}',
												),
												'class'=>'btn btn-mini',
										),
								),
						),

				),

		),
)); ?>
