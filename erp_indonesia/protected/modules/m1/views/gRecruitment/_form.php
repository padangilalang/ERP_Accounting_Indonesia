<?php
Yii::app()->clientScript->registerCss('userAutoComplete', <<<EOCSS
		.userautocompletelink {height:52px;}
		.userautocompletelink img {float:left;margin-right:5px;width:40px;}
		EOCSS
);
		?>


<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->getClientScript()->getCoreScriptUrl().'/jui/css/2jui-bootstrap/js/jquery-ui-1.8.16.custom.min.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->getClientScript()->getCoreScriptUrl().'/jui/css/2jui-bootstrap/jquery-ui.css');
Yii::app()->clientScript->registerCoreScript('maskedinput');

Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
			$( \"#".CHtml::activeId($model,'birthdate')."\" ).datepicker({
				'dateFormat' : 'dd-mm-yy',
			});
			$( \"#".CHtml::activeId($model,'candidate_name')."\" ).autocomplete({
				'minLength' : 2,
				'source': ' ".Yii::app()->createUrl('/m1/gRecruitment/recruitAutoComplete')."',
			})
			.data( \"autocomplete\" )._renderItem = function( ul, item ) {
			return $( \"<li></li>\" )
				.data( \"item.autocomplete\", item )
				.append('<a class=\'userautocompletelink\'><img src=\''+item.ppath+'\'/><h5>'+item.label+'</h5><h6>'+item.bdate+'</h6></a>')
				.appendTo( ul );
			};			
			
			
		});
	");
?>

<div class="raw">

<?php $form=$this->beginWidget('BootActiveForm', array(
	'id'=>'g-recruitment-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->textFieldRow($model,'for_position',array('class'=>'span3','maxlength'=>50)); ?>

		<?php echo $form->textFieldRow($model,'for_project',array('class'=>'span3','maxlength'=>50)); ?>

		<?php echo $form->textFieldRow($model,'candidate_name',array('class'=>'span4','maxlength'=>50)); ?>

		<?php echo $form->textFieldRow($model,'birthdate'); ?>

		<?php echo $form->textAreaRow($model,'quick_background',array('class'=>'span4','rows'=>4)); ?>

		<?php echo $form->textAreaRow($model,'work_experience',array('class'=>'span5','rows'=>8)); ?>

		<?php echo $form->textFieldRow($model,'sallary_expectation'); ?>

		<?php echo $form->dropDownListRow($model,'source_id',array('1'=>'StreetJobs','2'=>'LinkedIn','3'=>'Direct Applying')); ?>

		<?php echo $form->textAreaRow($model,'general_remark',array('class'=>'span4','rows'=>4)); ?>

		<?php echo $form->fileFieldRow($model,'image',array('size'=>50,'maxlength'=>50)); ?> 

		<?php $this->widget('CMultiFileUpload', array(
                'name' => 'docs',
                'accept' => 'pdf', // useful for verifying files
                'duplicate' => 'Duplicate file!', // useful, i think
                'denied' => 'Invalid file type', // useful, i think
            ));	
		?> 

		
		<div class="form-actions">
			<?php $this->widget('bootstrap.widgets.BootButton', array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>$model->isNewRecord ? 'Create' : 'Save',
			)); ?>
		</div>

<?php $this->endWidget(); ?>

</div><!-- form -->