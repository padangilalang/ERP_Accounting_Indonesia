/**
 * jquery.slidetoggle.js
 *
 * Part of Yii extension 'slidetoggle'
 * @author Joe Blocher
 *
 */

jQuery.fn.collapse = function(options) {

	var defaults = {
		duration: 'slow',
		easing: 'linear',
		classCollapsed: 'slidetoggle-collapsed'
	}

	var settings = jQuery.extend({}, defaults, options);

	$(this).click(function(){
	    $(this).toggleClass(settings.classCollapsed);
		jQuery(this).parent().children().not(this).slideToggle(settings.duration,settings.easing);
		return false; //No jump to the link anchor
	});

};