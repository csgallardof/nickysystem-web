<?php
$output = $text_align = $img = $img_2 = $name = $author_dec = '';

	extract(shortcode_atts(array(
		'el_class' => '',
		'img_url' => '',
		'name' => '',
		'author_dec' => '',
		'description' => ''
	), $atts));
			
	$el_class = $this->getExtraClass($el_class);
	
	if($img_url != '') {
		$img_url = wp_get_attachment_image_src( $img_url, 'large');
		$img_url = $img_url[0];
		$img = '<div class="testimonial-img"><img src="'. aq_resize($img_url, '300', '300', true) .'" alt="" /></div>';
		$img_2 = '<div class="testimonial-img-2"><img src="'. aq_resize($img_url, '80', '80', true) .'" alt="" /></div>';
	}
	
	if($name != '') {
		$name = $img_2.'<div class="testimonial-author" >'.$name;
		if($author_dec != '') { $name .= '<span class="testimonial-author-desc">'.$author_dec.'</span>'; }
		$name .= '</div>';	
	}
	
	$output .= '<li class="testimonial-wrapper" style="display:none;"><div class="testimonial-line tl-top"><i class="fa fa-quote-left"></i><span></span></div>';
	$output .= $img;	
	$output .= '<div class="testimonial-content">'.wpb_js_remove_wpautop($content).'</div>';
	$output .= '<div class="testimonial-line tl-bottom"><i class="fa fa-quote-right"></i><span></span></div>';
	$output .= $name;	
	$output .= '</li>';

echo $output;