<?php
$output = '';
	
	$accent_color = '#14b8c0';
	
	if ( function_exists( 'ot_get_option' ) ) {
	  $accent_color = ot_get_option('accent_color');
	}
		
	extract(shortcode_atts(array(
		'icon_name' => 'fa-check',
		'icon_color' => $accent_color,
		'link' => '',
		'css_animation' => '',
		'css_animation_delay' => '',
		'el_class' => ''
	), $atts));
	
	$el_class = $this->getExtraClass($el_class);
	($icon_color != '') ? $icon_color = ' style="color:'.$icon_color.'"' : '';
	
	$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'custom-list-item'.$el_class, $this->settings['base']);
	$css_class .= $this->getCSSAnimation($css_animation);
	($css_animation != '' && $css_animation_delay != '') ? $css_class .= $this->getExtraClass($css_animation_delay) : '';

	$link = ($link=='||') ? '' : $link;
	$link = vc_build_link($link);
	$a_href = $link['url'];
	$a_title = $link['title'];
	($link['target'] != '') ? $a_target = $link['target'] : $a_target = '_self';

	if ( $a_href != '' ) {
		$output .= '<i class="fa '.$icon_name.'"'.$icon_color.'></i>';
		$output = '<div class="'.$css_class.'">' . $output .'<a href="'.$a_href.'" title="'.esc_attr($a_title).'" target="'.$a_target.'">'. wpb_js_remove_wpautop($content).'</a></div>';
	} else {
		$output .= '<div class="'.$css_class.'"><i class="fa '.$icon_name.'"'.$icon_color.'></i>'.wpb_js_remove_wpautop($content).'</div>';
	}
	
echo $output;
