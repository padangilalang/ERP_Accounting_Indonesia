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
			'attribute'=>'system_ref',
			'source'=>$this->createUrl('uJournal/journalAutoComplete'),
			'options'=>array(
					'minLength'=>'2',
					'focus'=> 'js:function( event, ui ) {
						$("#'.CHtml::activeId($model,'system_ref').'").val(ui.item.label);
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

	<?php echo CHtml::htmlButton('<i class="icon-search"></i> Search', array('class'=>'btn','type'=>'submit')); ?>

	<?php $this->endWidget(); ?>

</div>
