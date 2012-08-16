<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		'id'=>'mydialog',
		'options'=>array(
				'title'=>'Sick, Absence, Leave',
				'autoOpen'=>false,
				'modal'=>true,
		),
));
echo 'Day Status Complete...';
$this->endWidget('zii.widgets.jui.CJuiDialog');


?>

<?php
//$this->renderPartial('_formAbsence', array('model'=>$modelAbsence));
?>

<hr />

<?php
$this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
		'stacked'=>false, // whether this is a stacked menu
		'items'=>array(
				array('label'=>'<< Previous Month','url'=>Yii::app()->createUrl("/m1/cAbsence/view",array("id"=>$model->id, "month"=>$month-1))),
				array('label'=>sParameter::BulanTahun(date("Ym",strtotime(date("Y-m",strtotime($month." month"))."-01"))),
						'url'=>Yii::app()->createUrl("/m1/cAbsence/view",array("id"=>$model->id, "month"=>$month))),
				array('label'=>'Next Month >>','url'=>Yii::app()->createUrl("/m1/cAbsence/view",array("id"=>$model->id, "month"=>$month+1))),
		),
));
?>


<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'cpersonalia-absence-grid',
		'dataProvider'=>gPersonAbsence::model()->search((int)$model->id,$month),
		'template'=>'{items}',
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}{summary}',
		//'filter'=>$model,
		'columns'=>array(
				/*array(
				 'class'=>'BootButtonColumn',
						'template'=>'{update}{delete}',
						'updateButtonUrl'=>'Yii::app()->createUrl("/m1/cAbsence//updateAbsence",array("id"=>$data->id,"pid"=>$data->parent_id))',
						'deleteButtonUrl'=>'Yii::app()->createUrl("/m1/cAbsence//deleteAbsence",array("id"=>$data->id))',
				),*/
				array(
						'class'=>'BootButtonColumn',
						'template'=>'{sakit}{alpha}{permission}',
						'buttons'=>array
						(
								'sakit' => array
								(
										'label'=>'Sakit',
										'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/sakit.png',
										'url'=>'Yii::app()->createUrl("/m1/cAbsence//setSakit", array("id"=>$data->id))',
										'options'=>array(
												'ajax'=>array(
														'type'=>'GET',
														'url'=>"js:$(this).attr('href')",
														'success'=>'js:function(data){$("#mydialog").dialog("open");
														$.fn.yiiGridView.update("cpersonalia-absence-grid", {
														data: $(this).serialize()
});
}',
												),
										),
								),
								'alpha' => array
								(
										'label'=>'Absence',
										'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/alpha.png',
										'url'=>'Yii::app()->createUrl("/m1/cAbsence//setAlpha", array("id"=>$data->id))',
										'options'=>array(
												'ajax'=>array(
														'type'=>'GET',
														'url'=>"js:$(this).attr('href')",
														'success'=>'js:function(data){$("#mydialog").dialog("open");
														$.fn.yiiGridView.update("cpersonalia-absence-grid", {
														data: $(this).serialize()
});
}',
												),
										),
								),
								'permission' => array
								(
										'label'=>'Update',
										'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/ijin.png',
										'url'=>'$this->grid->controller->createUrl("/CAbsence/updateAbsence", array("id"=>$data->id,"pid"=>$data->parent_id,"asDialog"=>1,"gridId"=>$this->grid->id))',
										'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open"); return false;}',

								),
						),

				),
				array (
						'name'=>'cdate',
						'value'=>'$data->cdate',
				),
				array(
						'name'=>'realpattern_id',
						'value'=>'$data->timeBlock->code',
				),
				array(
						'header'=>'Sched In',
						//'name'=>'realpattern_id',
						'value'=>'Yii::app()->dateFormatter->formatDateTime($data->timeBlock->in,null,"medium")',
				),
				array(
						'header'=>'Sched Out',
						//'name'=>'realpattern_id',
						'value'=>'Yii::app()->dateFormatter->formatDateTime($data->timeBlock->out,null,"medium")',
				),
				array(
						'name'=>'in',
						'value'=>'Yii::app()->dateFormatter->formatDateTime($data->in,null,"medium")',
				),
				array(
						'name'=>'out',
						'value'=>'Yii::app()->dateFormatter->formatDateTime($data->out,null,"medium")',
				),
				array(
						'header'=>'In Status',
						'value'=>'$data->lateIn'
				),
				array(
						'header'=>'Out Status',
						'value'=>'$data->EarlyOut'
				),
				'remark',
				array(
						'name'=>'daystatus1_id',
						'value'=>'$data->daystatus1_id == 0 ? "" : $data->dayCategory->name',
				),
				/*array(
				 'name'=>'daystatus2_id',
						'value'=>'$data->daystatus2_id == 0 ? "" : $data->dayCategory->name',
				),
array(
		'name'=>'daystatus3_id',
		'value'=>'$data->daystatus3_id == 0 ? "" : $data->dayCategory->name',
),*/
		),
)); ?>

<?php
//--------------------- begin new code --------------------------
// add the (closed) dialog for the iframe
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		'id'=>'cru-dialog',
		'options'=>array(
				'title'=>'Update',
				'autoOpen'=>false,
				'modal'=>true,
				'width'=>'70%',
				'height'=>'400',
		),
));
?>
<iframe id="cru-frame" width="100%" height="100%"></iframe>
<?php

$this->endWidget();
//--------------------- end new code --------------------------
?>
