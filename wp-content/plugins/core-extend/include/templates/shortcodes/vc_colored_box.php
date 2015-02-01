<?php
$output = $styles = $style = $css_class = '';
	
	$accent_color = '#14b8c0';
	
	if ( function_exists( 'ot_get_option' ) ) {
	  $accent_color = ot_get_option('accent_color');
	}
	
	extract(shortcode_atts(array(
		'el_class' => '',
		'bg_color' => $accent_color,
		'border_color' => '',
		'width' => '',
		'align' => '',
		'padding' => '',
		'margin_left' => '', 
		'margin_right' => '', 
		'css_animation' => '',
		'css_animation_delay' => ''
	), $atts));
	
	$el_class = $this->getExtraClass($el_class);
	$align = $this->getExtraClass($align);
	
	$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'colored-box'.$el_class.$align, $this->settings['base']);
	$css_class .= $this->getCSSAnimation($css_animation);
	($css_animation != '' && $css_animation_delay != '') ? $css_class .= $this->getExtraClass($css_animation_delay) : '';
	
	$styles = array(
		($width != '') ? 'max-width:'.$width.';' : null,
		($bg_color != '') ? 'background-color:'.$bg_color.';' : null,
		($border_color != '') ? 'border-color:'.$border_color.';' : null,
		($padding != '') ? 'padding:'.$padding.';' : null,
		($margin_left != '' && $align != 'aligncenter') ? 'margin-left:'.$margin_left.';' : null,
		($margin_right != '' && $align != 'aligncenter' ) ? 'margin-right:'.$margin_right.';' : null
	); 
	
	if( !empty($styles) ){
		$style = implode(' ', array_filter($styles));	
		$style = ' style="'.$style.'"';
	}

	
	$output .= '<div class="'.$css_class.'"'.$style.'>';
	$output .= wpb_js_remove_wpautop($content);
	$output .= '</div>';

echo $output;