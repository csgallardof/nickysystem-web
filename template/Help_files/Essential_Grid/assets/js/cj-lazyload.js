(function($) {
	
	var images, win, winHeight;
	
	$(document).ready(function() {
        
		images = [];
		$('img').each(function(i) {images[i] = jQuery(this);});
		
		win = $(window).on('scroll', checkImages).on('resize', checkSize);
		checkSize();
		
    });
	
	function checkSize() {
	
		winHeight = win.height();
		checkImages();
		
	}
	
	function checkImages() {
		
		var len = images.length;
		
		if(!len) {
			
			win.off('scroll', checkImages).off('resize', checkSize);
			win = images = null;
			return;
			
		}
		
		var scrTop = win.scrollTop();
		if(!scrTop) return;
		
		var i, img, offset, 
		index, high, toPop = [];
		
		for(i = 0 ; i < len; i++) {
			
			img = images[i];
			high = img.attr('height');
			offset = img.offset().top;
			
			if(offset <= scrTop + winHeight && offset + parseInt(high, 10) >= scrTop) {
				
				var par = img.parent().css({width: img.attr('width'), height: high}).addClass('img-loading'),
				newImg = $('<img class="img-new img-replace" />').data('par', par).one('load', loaded).insertAfter(img);
				newImg.attr('src', img.attr('data-src'));
				toPop[toPop.length] = img;
				
			}
			
		}
		
		len = toPop.length;
		for(i = 0; i < len; i++) {
			
			index = images.indexOf(toPop[i]);
			if(index !== -1) images.splice(index, 1);
			
		}
		
	}
	
	function loaded() {
		
		var $this = $(this);
		$this.data('par').removeClass('img-loading');
		$this.removeData('par').removeClass('img-replace');
		
	}
	
})(jQuery);