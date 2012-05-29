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
					   
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
		'id'=>'dialogProduct',
		'options'=>array(
				'title'=>'Create New Product',
				'autoOpen'=>false,
				'modal'=>true,
				'width'=>'600px',
				'height'=>'400px',
		),
));?>
<div class="divForForm"></div>

<?php $this->endWidget();?>

<script type="text/javascript">
// here is the magic
function addNewProduct()
{
    <?php echo CHtml::ajax(array(
            'url'=>array('pProduct/create'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogProduct div.divForForm').html(data.div);
                          // Here is the trick: on submit-> once again this function!
                    $('#dialogProduct div.divForForm form').submit(addNewProduct);
                }
                else
                {
                    $('#dialogProduct div.divForForm').html(data.div);
					$('#item_id');
                    setTimeout(\"$('#dialogProduct').dialog('close') \",3000);
					$('#item_id').serialize()
                }
 
            } ",
            ))?>;
    return false; 
 
}
 
</script>


<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	'id'=>'bporder-form',
		'type' => 'horizontal',
		'enableAjaxValidation'=>false,
));
?>

<?php echo $form->errorSummary($model); ?>

<div class="control-group">
	<?php echo $form->labelEx($model,'input_date',array("class"=>"control-label")); ?>
	<div class="controls">
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'value'=>CTimestamp::formatDate('yyyy-MM-dd',$model->input_date),
				'attribute'=>'input_date',
				// additional javascript options for the date picker plugin
				'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'dd-mm-yy',
				),
				'htmlOptions'=>array(
						
				),
		));
		?>
	</div>
</div>

<?php echo $form->dropDownListRow($model,'supplier_id',cSupplier::items()); ?>

<?php echo $form->textAreaRow($model,'remark',array('rows'=>2, 'class'=>'span5')); ?>

<?php /*
<?php echo CHtml::link('Create New Product', "",  // the link for open the dialog
		array(
				'style'=>'cursor: pointer; text-decoration: underline;',
				'onclick'=>"{addNewProduct(); $('#dialogProduct').dialog('open');}"));
		?>
*/
?>

<a id="copylink" href="#" rel=".row">Add Row</a>

<table class="appendo-gii" id="copylink">
	<thead>
		<tr>
			<th>Item</th>
			<th>Desc</th>
			<th>Qty</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php if (empty($modelD)): ?>	
			<tr class="row">
				<td><?php echo CHtml::dropDownList('ModelD[budget_id][]','',tAccount::item()); ?>
				</td>
				<td><?php echo CHtml::textField('ModelD[description][]','',array()); ?></td>
				<td><?php echo CHtml::textField('ModelD[qty][]','',array('maxlength'=>15)); ?>
				</td>
				<td><?php echo CHtml::textField('ModelD[amount][]','',array('maxlength'=>15)); ?>
				</td>
			</tr>
		<?php else: ?>
			<?php
			$idx = 0;
			$count = count($modelD);
	 
			foreach($modelD as $mod):
				//the last added row is the row to copy
				$copyClass = ($idx == $count-1) ? ' copy' : '';

				?>
				<tr class="row<?php echo $copyClass;  ?>">		 
					<td><?php echo CHtml::dropDownList('item_id[]',$mod->item_id,pProduct::items()); ?>
					</td>
					<td><?php echo CHtml::textField('description[]',$mod->description,array()); ?>
					</td>
					<td><?php echo CHtml::textField('qty[]',$mod->qty,array('maxlength'=>15)); ?>
					</td>
					<td><?php echo CHtml::textField('amount[]',$mod->amount,array('maxlength'=>15)); ?>
					</td>
					<td><a class="nocopy" onclick="$(this).parent().remove(); return false;" href="#"><?php echo "Remove";  ?></a>
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

