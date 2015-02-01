<?php
$output = '';
	
	$accent_color = '#14b8c0';
	
	if ( function_exists( 'ot_get_option' ) ) {
	  $accent_color = ot_get_option('accent_color');
	}
		
	extract(shortcode_atts(array(
		'el_class' => '',
		'title' => 'Your service title',
		'icon_color' => $accent_color,
		'heading_color' => '',
		'link' => '',
		'position' => '',
		'icon_name' => 'fa-check',
		'css_animation' => '',
		'css_animation_delay' => ''
	), $atts));

	wp_enqueue_script( 'modernizr', MNKY_PLUGIN_URL . 'assets/js/modernizr.custom.js', array('jquery'));
	
	$el_class = $this->getExtraClass($el_class);
	$position = $this->getExtraClass($position);
	
	$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'service_icon', $this->settings['base']);
	$css_class .= $this->getCSSAnimation($css_animation);
	($css_animation != '' && $css_animation_delay != '') ? $css_class .= $this->getExtraClass($css_animation_delay) : '';

	$link = ($link=='||') ? '' : $link;
	$link = vc_build_link($link);
	$a_href = $link['url'];
	$a_title = $link['title'];
	($link['target'] != '') ? $a_target = $link['target'] : $a_target = '_self';
	
	if ( $a_href != '' ) {
		$output .= '<div class="'.$css_class.'"><i style="color:' . $icon_color . ';" class="fa ' . $icon_name . '"><span style="background-color:' . $icon_color . ';"></span></i></div>';
		$output .= '<div class="service-content"><h5 style="color:' . $heading_color . ';">' . $title . '</h5>';
		$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
		$output .= '</div>';

		$output = '<div class="service-box'.$el_class.$position.'"><a class="wpb_button_a" href="'.$a_href.'" title="'.esc_attr($a_title).'" target="'.$a_target.'">' . $output . '</a></div>';
	} else {
		$output .= '<div class="service-box'.$el_class.$position.'"><div class="'.$css_class.'"><i style="color:' . $icon_color . ';" class="fa ' . $icon_name . '"><span style="background-color:' . $icon_color . ';"></span></i></div><div class="service-content"><h5 style="color:' . $heading_color . ';">' . $title . '</h5>';
		$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
		$output .= '</div></div>';
	}

	
echo $output;
