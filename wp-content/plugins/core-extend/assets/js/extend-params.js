(function($) {
	"use strict";
	
	$('.add_icon').click(function() {
		$('.mnky-icon-list').show();
	});
	
	$('.mnky-icon-list input[type=radio]').click(function() {
		var icon_name = $('.mnky-icon-list input:checked').val();
		$('#vc_selected_icon').val(icon_name);
		$('#selected_icon').removeClass();
		$('#selected_icon').addClass('selected_icon_wrapper fa ' + icon_name);
		$('.mnky-icon-list').hide();
	});

})(jQuery);