<?php
$output = '';
	
	$accent_color = '#14b8c0';
	
	if ( function_exists( 'ot_get_option' ) ) {
	  $accent_color = ot_get_option('accent_color');
	}
	
	extract(shortcode_atts(array(
		'el_class' => '',
		'color_scheme' => $accent_color,
		'img_url' => '',
		'name' => 'John Doe',
		'position' => 'Designer',
		'hover_txt' => '',
		'style' => 'team-style-1',
		'css_animation' => '',
		'css_animation_delay' => ''
	), $atts));
	
	$el_class = $this->getExtraClass($el_class);
	$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'team_wrapper'.$el_class, $this->settings['base']);
	$css_class .= $this->getCSSAnimation($css_animation);
	($css_animation != '' && $css_animation_delay != '') ? $css_class .= $this->getExtraClass($css_animation_delay) : '';
	
	if($hover_txt != '') { 
		$hover_txt = '<figcaption style="background:' . $color_scheme . ';"><span>'.$hover_txt.'</span></figcaption>';
		$css_class .= ' add_team_hover';
	}
	
	if($img_url != '') {
		$img_url = wp_get_attachment_image_src( $img_url, 'full');
		$img_url = $img_url[0];
		$img = '<img src="'. aq_resize($img_url, 540, 580, true, true, true) .'" alt="" />';
	} else {
		$img = '';
	}

	if($style == 'team-style-2') {
		$output .= '<div class="'.$css_class.' team-style-2"><div class="team_image">'.$img.$hover_txt.'</div><div class="team_member_name">'.$name.'</div><div class="team_member_position">'.$position.'</div><div class="team_info">';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div></div>';
	} else {
			$output .= '<div class="'.$css_class.'"><figure class="team_image"><div>'.$img.$hover_txt.'</div></figure><div class="team_member_name"><span>'.$name.'</span></div><p><span style="color:' . $color_scheme . ';"></span>'.$position.'</p><div class="team_info">';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div></div>';
	}

echo $output;
