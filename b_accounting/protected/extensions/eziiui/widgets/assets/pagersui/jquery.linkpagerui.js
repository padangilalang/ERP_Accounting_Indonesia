;(function($) {
	$.fn.linkPagerUI = function() {
		return this.each(function(){
			var $this = $(this);
			var id = $this.attr('id');
		
			$('#'+id+' > li > a.ui-button:not(.ui-state-disabled)').live('mouseover',
				function(){
					$(this).addClass('ui-state-focus');
					return false;
				}
			);

			$('#'+id+' > li > a.ui-button:not(.ui-state-active)').live('mouseout',
				function() {
					$(this).removeClass('ui-state-focus ui-state-active');
					return false;
				}
			);
		});
	};
})(jQuery);
