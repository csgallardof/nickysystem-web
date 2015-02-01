<?php
$output = '';

	extract(shortcode_atts(array(
		'el_class' => '',
		'title' => '',
		'subtitle' => '',
		'color' => '',
		'position' => 'center',
		'css_animation' => '',
		'css_animation_delay' => ''
	), $atts));
	
	$el_class = $this->getExtraClass($el_class);
	($color != '') ? $color = ' style="color:'.$color.';"' : '';
	
	$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'heading_wrapper'.$el_class, $this->settings['base']);
	$css_class .= $this->getCSSAnimation($css_animation);
	($css_animation != '' && $css_animation_delay != '') ? $css_class .= $this->getExtraClass($css_animation_delay) : '';

	
	$output .= '<div class="'.$css_class.'" style="text-align:'.$position.'"><h2'.$color.'>'.$title.'</h2><div class="heading_subtitle">'.$subtitle.'</div></div>';

echo $output;