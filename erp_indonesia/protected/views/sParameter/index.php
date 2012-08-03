<?php
$this->breadcrumbs=array(
		'Parameter'=>array('index'),
		'Manage',
);

?>

<div class="page-header">
	<h1><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/ms_dos_batch_file.png') ?>
	Data Parameter</h1>
</div>
<?php
$this->widget('DropDownRedirect', array(
		'data' => sParameter::items3("Any"),
		'url' => $this->createUrl($this->route, array_merge($_GET, array('type' => '__value__'))),
		'select' =>(isset($_GET['type'])) ? $_GET['type'] : "(ALL)",
));
?>

<?php 
		//$this->widget('bootstrap.widgets.BootGridView', array(
		$this->widget('ext.groupgridview.GroupGridView', array(
		'extraRowColumns' => array('type'),  
		'id'=>'parameter-grid',
		'dataProvider'=>$model->search($type),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				array(
					'class'=>'bootstrap.widgets.BootButtonColumn',
					'template'=>'{updated}{delete}',
					'deleteButtonUrl'=>'Yii::app()->createUrl("/sParameter/delete",array("pk1"=>$data->type,"pk2"=>$data->code))',
					'buttons'=>array
					(
						'updated' => array
						(
							'label'=>'Update',
							'url'=>'Yii::app()->createUrl("/sParameter/update",array("pk1"=>$data->type,"pk2"=>$data->code,"asDialog"=>1,"gridId"=>$this->grid->id))',
							'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',

						),
					),
				),
				'code',
				'name',
		),
)); ?>

<hr />

<?php $this->widget('bootstrap.widgets.BootTabbable', array(
    'type'=>'tabs', // 'tabs' or 'pills'
    'tabs'=>array(
		array('label'=>'Existing Parameter', 'content'=>$this->renderPartial("_formE", array("model"=>$modelParameter), true),'active'=>true),
		array('label'=>'New Parameter', 'content'=>$this->renderPartial("_form", array("model"=>$modelParameter), true)),
	),
)); 

?>

<?php
//--------------------- begin new code --------------------------
// add the (closed) dialog for the iframe
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		'id'=>'cru-dialog',
		'options'=>array(
				'title'=>'Update Detail',
				'autoOpen'=>false,
				'modal'=>true,
				'width'=>'70%',
				'height'=>'550',
		),
));
?>

<iframe id="cru-frame"
	width="100%" height="100%">
</iframe>
<?php
$this->endWidget();
//--------------------- end new code --------------------------
?>

