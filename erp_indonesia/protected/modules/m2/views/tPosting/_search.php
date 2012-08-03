<div class="pull-right">

	<?php $form=$this->beginWidget('BootActiveForm', array(
			'action'=>Yii::app()->createUrl($this->route),
			'method'=>'get',
			'htmlOptions'=>array('class'=>'form-inline'),
	)); ?>

	<?php 
	$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model'=>$model,
			'attribute'=>'system_ref',
			'source'=>$this->createUrl('/m2/tPosting/postingAutoComplete'),
			'options'=>array(
					'minLength'=>'2',
					//'select'=>'js:function( event, ui ) {
					//	window.open("'.$this->createUrl('/m2/tAccount/index',array("tAccount[account_name]"=>"penj","q"=>"Search")).'","_self");
					//	return false;
					//}',
					//'select'=>'js:function( event, ui ) {
					//	alert("Testing: "+'.time().');
					//	return false;
					//}',
			),
			'htmlOptions'=>array(
					'class'=>'input-medium',
					'placeholder'=>'Search NoRef or Remark',
			),
	));

	?>

	<?php echo CHtml::htmlButton('<i class="icon-search"></i> Search', array('class'=>'btn','type'=>'submit')); ?>

	<?php $this->endWidget(); ?>

</div>

