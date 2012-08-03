<div class="pull-right">

	<?php $form=$this->beginWidget('BootActiveForm', array(
			'action'=>Yii::app()->createUrl($this->route),
			'method'=>'get',
			'id'=>'searchForm',
			'htmlOptions'=>array('class'=>'form-inline'),
	)); ?>

	<?php 
	$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model'=>$model,
			'attribute'=>'account_name',
			'source'=>$this->createUrl('/m2/tAccount/accountAutoComplete'),
			'options'=>array(
					'minLength'=>'2',
					'focus'=> 'js:function( event, ui ) {
						$("#'.CHtml::activeId($model,'account_name').'").val(ui.item.label);
						return false;
					}',
					'select'=> 'js:function( event, ui ) {
						$("#searchForm").submit();
						return false;
					}',
			),
			'htmlOptions'=>array(
					'class'=>'input-medium',
					'placeholder'=>'Search NoRef or Remark',
			),
	));

	?>

	<!-- 
	setTimeout(\"$('#mydialog').dialog('close') \",1200); 
	$("#'.CHtml::activeId($model,'nig').'").val(ui.item.label);
	+ui.item.label);
	-->


	<?php echo CHtml::htmlButton('<i class="icon-search"></i> Search', array('class'=>'btn','type'=>'submit')); ?>

	<?php $this->endWidget(); ?>

</div>
