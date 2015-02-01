<?php
$output = $color = $size = $icon = $target = $link = $el_class = $title = '';
	extract(shortcode_atts(array(
		'color' => 'wpb_button',
		'size' => '',
		'icon_name' => '',
		'link' => '',
		'button_style' => '',
		'el_class' => '',
		'title' => __('Text on the button', 'core-extend'),
		'css_animation' => '',
		'css_animation_delay' => ''
	), $atts));
	$a_class = '';

	if ( $el_class != '' ) {
		$tmp_class = explode(" ", strtolower($el_class));
		$tmp_class = str_replace(".", "", $tmp_class);
		if ( in_array("prettyphoto", $tmp_class) ) {
			wp_enqueue_script( 'prettyphoto' );
			wp_enqueue_style( 'prettyphoto' );
			$a_class .= ' prettyphoto';
			$el_class = str_ireplace("prettyphoto", "", $el_class);
		}
		if ( in_array("pull-right", $tmp_class) && $link != '' ) { $a_class .= ' pull-right'; $el_class = str_ireplace("pull-right", "", $el_class); }
		if ( in_array("pull-left", $tmp_class) && $link != '' ) { $a_class .= ' pull-left'; $el_class = str_ireplace("pull-left", "", $el_class); }
	}

	$link = ($link=='||') ? '' : $link;
	$link = vc_build_link($link);
	$a_href = $link['url'];
	$a_title = $link['title'];
	($link['target'] != '') ? $a_target = $link['target'] : $a_target = '_self';

	$color = ( $color != '' ) ? ' wpb_'.$color : '';
	$size = ( $size != '' && $size != 'wpb_regularsize' ) ? ' wpb_'.$size : ' '.$size;
	$i_icon = ( $icon_name != '' ) ? ' <i class="fa '. $icon_name .'"></i>' : '';
	$button_style = ( $button_style != '' ) ? ' wpb_btn-minimal' : '';
	$el_class = $this->getExtraClass($el_class);
	
	$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_button'.$color.$size.$el_class.$button_style, $this->settings['base']);
	$css_class .= $this->getCSSAnimation($css_animation);
	($css_animation != '' && $css_animation_delay != '') ? $css_class .= $this->getExtraClass($css_animation_delay) : '';


	if ( $a_href != '' ) {
		$output .= '<span class="'.$css_class.'">'.$i_icon.$title.'</span>';
		$output = '<a class="wpb_button_a'.$a_class.'" title="'.esc_attr($a_title).'" href="'.$a_href.'" target="'.$a_target.'">' . $output . '</a>';
	} else {
		$output .= '<button class="'.$css_class.'">'.$i_icon.$title.'</button>';
	}

echo $output . $this->endBlockComment('button') . "\n";