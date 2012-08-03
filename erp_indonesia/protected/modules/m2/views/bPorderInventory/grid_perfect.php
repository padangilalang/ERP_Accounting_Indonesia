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
	
	function movieFormatResult(movie) {
        var markup = \"<table class='movie-result'><tr>\";
        if (movie.posters !== undefined && movie.posters.thumbnail !== undefined) {
            markup += \"<td class='movie-image'><img src='\" + movie.posters.thumbnail + \"'/></td>\";
        }
        markup += \"<td class='movie-info'><div class='movie-title'>\" + movie.title + \"</div>\";
        if (movie.critics_consensus !== undefined) {
            markup += \"<div class='movie-synopsis'>\" + movie.critics_consensus + \"</div>\";
        }
        else if (movie.synopsis !== undefined) {
            markup += \"<div class='movie-synopsis'>\" + movie.synopsis + \"</div>\";
        }
        markup += \"</td></tr></table>\"
        return markup;
    }

    function movieFormatSelection(movie) {
        return movie.title;
    }	
	
");

Yii::app()->clientScript->registerScript('knockout1', "

	ko.bindingHandlers.select2 = {
        init: function (element, params) {
			$(element).select2({
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
 
    self.addGift = function() {
        self.gifts.push({
            name: \"\",
            price: \"\"
        });
    };
 
    self.removeGift = function(gift) {
        self.gifts.remove(gift);
    };
 
    self.save = function(form) {
        alert(\"Could now transmit to server: \" + ko.utils.stringifyJson(self.gifts));
        // To actually transmit to server as a regular form post, write this: ko.utils.postJson($(\"form\")[0], self.gifts);
    };
};
 
var viewModel = new GiftModel([
    { name: \"Tall Hat\", price: \"39.95\"},
    { name: \"Long Cloak\", price: \"120.00\"}
]);

ko.applyBindings(viewModel);
 
// Activate jQuery Validation
$(document).ready(function() {
	//$(\"form\").validate({ submitHandler: viewModel.save });
	$(\"form\").validationEngine();
	//$(\"a\").bind(\"click\", function() { alert($(\"form\").valid()); });
});


");
?>


<form action= <? echo Yii::app()->createUrl('/m2/bPorderInventory/grid')?> >
    <p>You have asked for <span data-bind='text: gifts().length'>&nbsp;</span> gift(s)</p>
    <table data-bind='visible: gifts().length > 0'>
        <thead>
            <tr>
                <th>Gift name</th>
                <th>Price</th>
                <th />
            </tr>
        </thead>
        <tbody data-bind='foreach: gifts'>
            <tr>
				<td><input class='required' data-bind="value: name, uniqueName: true, select2:''" /></td>
				<td><input class='validate[required]' data-bind='value: price, uniqueName: true' /></td>
                <td><a href='#' data-bind='click: $root.removeGift'>Delete</a></td>
            </tr>
        </tbody>
    </table>
 
    <button data-bind='click: addGift'>Add Gift</button>
    <button data-bind='enable: gifts().length > 0' type='submit'>Submit</button>
</form>

<?php /*
<a href="javascript:void(0)" class="span5" id="e1"s>Search for a movie</a>
*/ ?>