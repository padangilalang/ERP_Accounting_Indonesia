<div class="pull-right">

	<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
			'action'=>Yii::app()->createUrl('/m1/gLeave/list'),
			'method'=>'get',
			'id'=>'searchForm',
			'htmlOptions'=>array('class'=>'form-inline'),
	)); ?>

	<?php //echo $form->textField($model,'vc_psnama',array('class'=>'span3','maxlength'=>100)); ?>
	<?php
	$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model'=>$model,
			'attribute'=>'vc_psnama',
			'source'=>$this->createUrl('/m1/gPerson/personAutoComplete'),
			'options'=>array(
					'minLength'=>'2',
					'focus'=> 'js:function( event, ui ) {
					$("#'.CHtml::activeId($model,'vc_psnama').'").val(ui.item.label);
					return false;
}',
					'select'=> 'js:function( event, ui ) {
					$("#searchForm").submit();
					return false;
}',
			),
			'htmlOptions'=>array(
					'class'=>'input-medium',
					'placeholder'=>'Search Name',
			),
	));

	?>

	<?php echo CHtml::htmlButton('<i class="icon-search"></i> Search', array('class'=>'btn','type'=>'submit')); ?>

	<?php $this->endWidget(); ?>

</div>
