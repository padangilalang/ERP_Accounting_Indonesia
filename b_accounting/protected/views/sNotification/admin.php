<?php
$this->breadcrumbs=array(
		'Notification'=>array('index'),
		'Manage',
);

Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('sNotification-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>

<div class="page-header">
	<h1><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/preferences_desktop_notification.png') ?>
	Notification Manager</h1>
</div>
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',
		array('id'=>'advancedsearch_dialog',
				// additional javascript options for the dialog plugin
				'options'=>array(
						'title'=>'Advanced Search',
						'width'=>'auto',
						'autoOpen'=>false,
				),
		));
$this->renderPartial('_search', array('model'=>$model));

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<div class="mymenu">
	<?php echo CHtml::link('Add New', array('create')); 
	echo CHtml::label(' | ','#');
	echo CHtml::link('Search', '#',array('onclick'=>'$("#advancedsearch_dialog").dialog("open"); return false;',))
	?>
</div>

<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'sNotification-grid',
		'dataProvider'=>$model->search(),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				array(
						'class'=>'CButtonColumn',
						'template'=>'{view}{update}{delete}{archive}',
						'buttons'=>array(
								'archive' => array(
										'label'=>'archive',
										'url'=>'Yii::app()->createUrl("sNotification/markarchive", array("id"=>$data->id))',
										'visible'=>'$data->read_id != 6',
								),
						)
				),
				array(
						'name'=>'type_id',
						'value'=>'sParameter::item("cNotifType",$data->type_id)',
						'filter'=>sParameter::items("cNotifType"),
				),
				'broadcast_code',
				array(
						'name'=>'sender_date',
						'value'=>'$data->sender_date',
				),
				array(
						'name'=>'sender_id',
						'value'=>'sUser::model()->findName($data->sender_id)',
						'filter'=>sUser::model()->allUsers(),
				),
				//'sender_ref',
				array(
						'name'=>'receiver_date',
						'value'=>'$data->receiver_date',
				),
				array(
						'name'=>'receiver_id',
						'value'=>'sUser::model()->findName($data->receiver_id)',
						'filter'=>sUser::model()->allUsers('all'),
				),
				//'receiver_ref',
				array(
						'name'=>'category_id',
						'value'=>'sParameter::item("cCategory",$data->category_id)',
						'filter'=>sParameter::items("cCategory"),
				),
				array(
						'name'=>'long_desc',
						'filter'=>false,
				),
				array(
						'name'=>'read_id',
						'value'=>'sParameter::item("cRead",$data->read_id)',
						'filter'=>sParameter::items("cRead"),
				),
		),
)); ?>
