// jQuery CountTo// http://stackoverflow.com/questions/2540277/jquery-counter-to-count-up-to-a-target-number(function($){"use strict";$.fn.countTo=function(options){options=$.extend({},$.fn.countTo.defaults,options||{});var loops=Math.ceil(options.speed/options.refreshInterval),increment=(options.to-options.from)/loops;return $(this).each(function(){var _this=this,loopCount=0,value=options.from,interval=setInterval(updateTimer,options.refreshInterval);function updateTimer(){value+=increment;loopCount++;$(_this).html(value.toFixed(options.decimals));if(typeof(options.onUpdate)=="function"){options.onUpdate.call(_this,value)}if(loopCount>=loops){clearInterval(interval);value=options.to;if(typeof(options.onComplete)=="function"){options.onComplete.call(_this,value)}}}})};$.fn.countTo.defaults={from:0,to:100,speed:1000,refreshInterval:100,decimals:0,onUpdate:null,onComplete:null}})(jQuery);

if(jQuery().waypoint) {	"use strict";
	jQuery('.counter_wrapper').waypoint(function() {
		jQuery(this).find('.count_data').each(function() {
			var count_from = jQuery(this).data('count-from'),
			count_to = jQuery(this).data('count-to'),
			count_speed = jQuery(this).data('count-speed'),
			count_interval = jQuery(this).data('count-interval'),
			count_decimals = jQuery(this).data('count-decimals');
			
			jQuery(this).countTo({
				from: count_from, 
				to: count_to, 
				refreshInterval: count_interval, 
				speed: count_speed,
				decimals: count_decimals
			});
		});
	}, {
		triggerOnce: true,
		offset: 'bottom-in-view'
	});
}