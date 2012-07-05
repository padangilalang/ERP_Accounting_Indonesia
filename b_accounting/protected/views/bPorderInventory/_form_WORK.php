<?php

Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/knockout.js');
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/jquery.validate.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/jquery.validationEngine.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/jquery.validationEngine-en.js');

Yii::app()->clientScript->registerScript('knockout', "


////////AUTOCOMPLETE
ko.bindingHandlers.autocomplete = {
        init: function (element, params) {
            var options = params().split(' ');
            $(element).bind(\"focus\", function () {
                $(element).change();
            });
            $(element).autocomplete({ 
			source: function( request, response ) {
				$.ajax({
					url: \""  .$this->createUrl('/CProduct/CProductAutoComplete'). "\",
					dataType: \"json\",
					data: {
						term: request.term
					},
					success: function( data ) {
						response($.map( data, function(item) {
							  return {
								label: item,
								value: item
							  }
						}));
					}
				})
			},
			minLength: 2,
			focus: function( event, ui ) {
				$(\"#bPorder_item_name\").val(ui.item.label);
				return false;
			},
			
			
            });
        },
        update: function (element, params) {
        }
    };
////////AUTOCOMPLETE

var GiftModel = function(gifts) {
    var self = this;
    self.gifts = ko.observableArray(gifts);
    self.gifts2 = ko.observableArray(gifts);
 
    self.addGift = function() {
        self.gifts.push({
            input_date: \"\",
            supplier_id: \"\",
            remark: \"\",
            item_name: \"\",
            description: \"\",
            qty: \"\",
            amount: \"\"
        });
    };
 
    self.removeGift = function(gift) {
        self.gifts.remove(gift);
    };
 
    //self.save = function(form) {
        //alert(ko.utils.stringifyJson(self.gifts));
		//ko.utils.postJson($(\"form\"), { gifts: self.gifts });  
		//ko.utils.postJson(location.href, { gifts: self.gifts });
		//ko.utils.postJson($(\"form\"), self.gifts);
    //};
	
	self.save = function (form) {
		$.ajax({
			url: \""  .Yii::app()->createUrl('/bPorderInventory/create') . "\",
			type: 'post',
			//data: ko.toJSON(this),
			data: ko.utils.postJson(location.href, { gifts: self.gifts }),
			contentType: 'application/json',
			success: function () {
				alert('Data Berhasil dimasukkan');
			}
		});
	};
	
};
 
var viewModel = new GiftModel([
    { input_date: \"\", supplier_id: \"\", remark: \"\", item_name: \"\", description: \"\", qty: \"\", amount: \"\"},
]);


ko.applyBindings(viewModel);
 
// Activate jQuery Validation
//$(\"form\").validate({ submitHandler: viewModel.save });
$(\"form\").validationEngine();



");
?>

					   
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	
		'id'=>'bporder-form',
		'type' => 'horizontal',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('data-bind'=>"submit: save"),
));
?>

<?php echo $form->errorSummary($model); ?>

<div data-bind='foreach: gifts2'>
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
						'data-bind'=>"value: input_date",
					),
			));
			?>
		</div>
	</div>

	<?php echo $form->dropDownListRow($model,'supplier_id',cSupplier::items(),array('data-bind'=>"value: supplier_id")); ?>

	<?php echo $form->textAreaRow($model,'remark',array('rows'=>2, 'class'=>'span5','data-bind'=>"value: remark")); ?>
</div>


    <table data-bind='visible: gifts().length > 0'>
        <thead>
            <tr>
                <th>Item</th>
                <th>Item Name</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody data-bind='foreach: gifts'>
            <tr>
				<td><?php echo $form->textField($model,'item_name',array('class'=>'span3','data-bind'=>"value: item_name, autocomplete: '',uniqueName: true")); ?></td>
				<td><?php echo $form->textField($model,'description',array('class'=>'span4','data-bind'=>"value: description, uniqueName: true")); ?></td>
				<td><?php echo $form->textField($model,'qty',array('class'=>'span1 validate[required]','data-bind'=>"value: qty, uniqueName: true")); ?></td>
				<td><?php echo $form->textField($model,'qty',array('class'=>'span3 validate[required]','data-bind'=>"value: amount, uniqueName: true")); ?></td>
                <td><a href='#' data-bind='click: $root.removeGift'>Delete</a></td>
            </tr>
        </tbody>
    </table>
 
    <button data-bind='click: addGift'>Add Row</button>
    <button data-bind='enable: gifts().length > 0' type='submit'>Submit</button>

<?php $this->endWidget(); ?>
