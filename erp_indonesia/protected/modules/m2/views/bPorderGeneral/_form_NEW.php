<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/css/jui-bootstrap/js/jquery-ui-1.8.16.custom.min.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/jui-bootstrap/jquery-ui-1.8.16.custom.css');


Yii::app()->clientScript->registerScript('datepicker', "
	$(function() {
		$( \"#".CHtml::activeId($model,'input_date')."\" ).datepicker({
			
			'dateFormat' : 'dd-mm-yy',
		});
	});

");
?>


<?php
$this->widget('ext.jqrelcopy.JQRelcopy',array(
 
 //the id of the 'Copy' link in the view, see below.
 'id' => 'copylink',
 
  //add a icon image tag instead of the text
  //leave empty to disable removing
 'removeText' => 'Remove',
 
 //htmlOptions of the remove link
 'removeHtmlOptions' => array('style'=>'color:red'),
 
 //options of the plugin, see http://www.andresvidal.com/labs/relcopy.html
 'options' => array(
 
       //A class to attach to each copy
      'copyClass'=>'newcopy',
 
      // The number of allowed copies. Default: 0 is unlimited
      'limit'=>5,
 
      //Option to clear each copies text input fields or textarea
      'clearInputs'=>true,
 
      //A jQuery selector used to exclude an element and its children
      'excludeSelector'=>'.skipcopy',
 
      //Additional HTML to attach at the end of each copy.
      'append'=>CHtml::tag('span',array('class'=>'hint'),''),
   )
));

?>					   
					   
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	
		'id'=>'bporder-form',
		'type' => 'horizontal',
		'enableAjaxValidation'=>false,
));
?>
<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'input_date'); ?>
<?php /*		
<div class="control-group">
		<?php echo $form->labelEx($model,'periode_date',array("class"=>"control-label")); ?>
		<div class="controls">
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'id'=>'balance-begin1',
				'value'=>CTimestamp::formatDate('yyyy-MM-dd',$model->periode_date),
				'attribute'=>'periode_date',
				// additional javascript options for the date picker plugin
				'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'yymm',
				),
				'htmlOptions'=>array(
						
				),
		));
		?>
		</div>
		</div>
		*/ ?>

<?php //echo $form->dropDownListRow($model,'budgetcomp_id',tAccount::purchasingAccount()); ?>

<?php echo $form->dropDownListRow($model,'supplier_id',cSupplier::items()); ?>

<?php echo $form->textAreaRow($model,'remark',array('rows'=>2, 'class'=>'span5')); ?>

<a id="copylink" href="#" rel=".row">Add Row</a>

<table class="appendo-gii" id="copylink">
	<thead>
		<tr>
			<th>Budget</th>
			<th>Desc</th>
			<th>Qty</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php if (empty($data)): ?>	
			<tr class="row">
				<td><?php echo CHtml::dropDownList('budget_id[]','',tAccount::item()); ?>
				</td>
				<td><?php echo CHtml::textField('description[]','',array()); ?></td>
				<td><?php echo CHtml::textField('qty[]','',array('maxlength'=>15)); ?>
				</td>
				<td><?php echo CHtml::textField('amount[]','',array('maxlength'=>15)); ?>
				</td>
			</tr>
		<?php else: ?>
			<?php
			$idx = 0;
			$count = count($data);
	 
			foreach($data as $person):
				//the last added row is the row to copy
				$copyClass = ($idx == $count-1) ? ' copy' : '';

				?>
				<tr class="row<?php echo $copyClass;  ?>">		 
					<td><?php echo CHtml::dropDownList('budget_id[]',$model->budget_id[$i],tAccount::item()); ?>
					</td>
					<td><?php echo CHtml::textField('description[]',$model->description[$i],array()); ?>
					</td>
					<td><?php echo CHtml::textField('qty[]',$model->qty[$i],array('maxlength'=>15)); ?>
					</td>
					<td><?php echo CHtml::textField('amount[]',$model->amount[$i],array('maxlength'=>15)); ?>
					</td>
					<td><a class="nocopy" onclick="$(this).parent().remove(); return false;" href="#"><?php echo $removeText;  ?></a>
					</td>
				</tr>
		<?php 
			$idx++; 
			endforeach; 
		?>
		<?php endif; ?>		 
	</tbody>
</table>



<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i>'.$model->isNewRecord ? 'Create':'Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>
