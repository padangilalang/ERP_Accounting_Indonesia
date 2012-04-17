/**
 * jQuery Plugin for creating collapsible fieldset
 * @requires jQuery 1.2 or later
 *
 * Copyright (c) 2010 Lucky
 * Licensed under the GPL license:
 *   http://www.gnu.org/licenses/gpl.html
 */

(function($) {
	function hideFieldsetContent(obj, options){
		var setting={animation:true};
		$.extend(setting, options);
		
		if(setting.animation==true)
			obj.find('div').slideUp("medium");
		else
			obj.find('div').hide();
		
		obj.removeClass("expanded");
		obj.addClass("collapsed");
	}
	
	function showFieldsetContent(obj){
		obj.find('div').slideDown("medium");
		obj.removeClass("collapsed");
		obj.addClass("expanded");
	}
	
	$.fn.coolfieldset = function(options){
		var setting={collapsed:false};
		$.extend(setting, options);
		
		this.each(function(){
			var fieldset=$(this);
			var legend=fieldset.children('legend');
			
			if(setting.collapsed==true){
				legend.toggle(
					function(){
						showFieldsetContent(fieldset);
					},
					function(){
						hideFieldsetContent(fieldset);
					}
				)
				
				hideFieldsetContent(fieldset, {animation:false});
			}
			else{
				legend.toggle(
					function(){
						hideFieldsetContent(fieldset);
					},
					function(){
						showFieldsetContent(fieldset);
					}
				)
			}
		});
	}
})(jQuery);