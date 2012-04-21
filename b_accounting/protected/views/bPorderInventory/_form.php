
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

<?php echo CHtml::link('Create New Product', "",  // the link for open the dialog
		array(
				'style'=>'cursor: pointer; text-decoration: underline;',
				'onclick'=>"{addNewProduct(); $('#dialogProduct').dialog('open');}"));
		?>

<?php 
$this->widget('ext.appendo.JAppendo',array(
		'id' => 'repeateEnum',
		'model' => $model,
		'viewName' => '_detailPorderInventory',
		'labelDel' => 'Remove Row'
		//'cssFile' => 'css/jquery.appendo2.css'
));
?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i>'.$model->isNewRecord ? 'Create':'Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>
