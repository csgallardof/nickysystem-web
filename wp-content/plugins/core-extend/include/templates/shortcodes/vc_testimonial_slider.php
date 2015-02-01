<?php
$output = '';

	extract(shortcode_atts(array(
		'animation' => 'fade',
		'slide_speed' => '5',
		'style' => 'testimonials-style-1',
		'bullets' => '',
		'el_class' => ''
	), $atts));
			
    wp_enqueue_style('flexslider');
    wp_enqueue_script('flexslider');

	$el_class = $this->getExtraClass($el_class);
	$style = $this->getExtraClass($style);	
	$style .= $this->getExtraClass($bullets);	
	
	$output .= '<div class="testimonials-slider'.$style.$el_class.'"><div class="wpb_flexslider" data-interval="'.$slide_speed.'" data-flex_fx="'.$animation.'"><ul class="slides">';
		
	$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
	
	$output .= '</ul></div></div>';

echo $output;
