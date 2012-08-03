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

Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/knockout.js');
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/jquery.validate.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/jquery.validationEngine.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/jquery.validationEngine-en.js');

Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/css/select2/select2.js');

Yii::app()->clientScript->registerScript('select2', "

	$(document).ready(function() {
		$(\".e1\").select2({
            placeholder: {title: \"Search for a movie\", id: \"\"},
            minimumInputLength: 1,
			ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: \"http://api.rottentomatoes.com/api/public/v1.0/movies.json\",
                dataType: 'jsonp',
                data: function (term, page) {
                    return {
                        q: term, // search term
                        page_limit: 10,
                        apikey: \"ju6z9mjyajq2djue3gbvv26t\" // please do not use so this example keeps working
                    };
                },
                results: function (data, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter remote JSON data
                    return {results: data.movies};
                }
            },
            formatResult: movieFormatResult, // omitted for brevity, see the source of this page
            formatSelection: movieFormatSelection  // omitted for brevity, see the source of this page
        });
	});
	
	function movieFormatResult(data) {
        var markup = \"<table><tr>\";
        markup += \"<td>\" + data.title;
        markup += \"</td></tr></table>\"
        return markup;
    }

    function movieFormatSelection(data) {
        return data.title;
    }	
	
");

Yii::app()->clientScript->registerScript('knockout1', "

	ko.bindingHandlers.select2 = {
        init: function (element, params) {
			$(element).select2({
				placeholder: {title: \"Search for Product\", id: \"\"},
				minimumInputLength: 1,
				ajax: { 
					url: \""  .$this->createUrl('/m2/CProduct/CProductAutoComplete'). "\",
					dataType: \"json\",
					data: function (term,page) {
						return {
							q: term
						};
					},
					results: function (data) { 
						return {results: data};
					}
				},
				formatResult: movieFormatResult, 
				formatSelection: movieFormatSelection  
			});
        },
        update: function (element, params) {
        }
    };

	ko.bindingHandlers.autocomplete = {
        init: function (element, params) {
            var options = params().split(' ');
            $(element).bind(\"focus\", function () {
                $(element).change();
            });
            $(element).autocomplete({ source: function (request, response) {
                $.getJSON(options[0], { q: request.term }, function (data) {
                    response($.map(data, function (item) {
                        return { label: item[options[1]], value: item[options[2]] };
                    }));
                });
            }
            });
        },
        update: function (element, params) {
        }
    };

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
 
    self.save = function(form) {
		$(\"form\").validationEngine();
		//$(\"form\").validate({ submitHandler: viewModel.save });
      //  alert(\"Could now transmit to server: \" + ko.utils.stringifyJson(self.gifts));
		//ko.utils.postJson($(\"form\")[0], self.gifts);
    };
};
 
var viewModel = new GiftModel([
    { input_date: \"\", supplier_id: \"\", remark: \"\", item_name: \"\", description: \"\", qty: \"\", amount: \"\"},
]);

ko.applyBindings(viewModel);
 
// Activate jQuery Validation
$(document).ready(function() {
	//$(\"form\").validate({ submitHandler: viewModel.save });
	//$(\"form\").validationEngine();
	//$(\"a\").bind(\"click\", function() { alert($(\"form\").valid()); });
});


");
?>


<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	
		'id'=>'bporder-form',
		'type' => 'horizontal',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('data-bind'=>"submit: save"),
));
?>

<div data-bind='foreach: gifts2'>
	<?php echo $form->textFieldRow($model,'input_date'); ?>

	<?php //echo $form->dropDownListRow($model,'supplier_id',cSupplier::items(),array('data-bind'=>"value: supplier_id")); ?>
	<div class="control-group">
	<?php echo CHtml::label('Supplier','',array("class"=>"control-label")); ?>
	<div class="controls">
		<?php echo Chtml::dropDownList('','supplier_id',cSupplier::items(),array('data-bind'=>"value: supplier_id")); ?>
	</div>
	</div>

	<?php //echo $form->textAreaRow($model,'remark',array('rows'=>2, 'class'=>'span5','data-bind'=>"value: remark")); ?>
	<div class="control-group">
	<?php echo CHtml::label('Remark','',array("class"=>"control-label")); ?>
	<div class="controls">
		<?php echo Chtml::textArea('','remark',array('rows'=>2, 'class'=>'span5','data-bind'=>"value: remark")); ?>
	</div>
	</div>
</div>


    <table data-bind='visible: gifts().length > 0'>
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody data-bind='foreach: gifts'>
            <tr>
				<td><input data-bind="value: item_name,  select2:''" /></td>
				<td><input data-bind='value: description' /></td>
				<td><input class='validate [required]' data-bind='value: qty' /></td>
				<td><input class='validate [required]' data-bind='value: amount' /></td>
                <td><a href='#' data-bind='click: $root.removeGift'>Delete</a></td>
            </tr>
        </tbody>
    </table>
 
    <button data-bind='click: addGift'>Add Row</button>
    <button data-bind='enable: gifts().length > 0' type='submit'>Submit</button>

<?php $this->endWidget(); ?>
