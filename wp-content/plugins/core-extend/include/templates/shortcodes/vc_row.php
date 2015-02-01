<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $styles = $style = $parallax_speed = '';
	extract(shortcode_atts(array(
		'el_class' => '',
		'bg_color' => '',
		'font_color' => '',
		'font_weight' => '',
		'bg_image' => '',
		'full_content_width' => '',
		'bg_repeat' => '',
		'bg_position' => '',
		'bg_attachment' => '',
		'bg_cover' => '',
		'row_seperator' => 'no-seperator',
		'section_id' => '',
		'textalign' => '',
		'top' => '',
		'bottom' => '',
		'row_mobile_style' => '',
		'parallax_bg' => '',
		'speed' => '0.20',
		'row_show_on' => ''
	), $atts));
	
	//wp_enqueue_style( 'js_composer_front' );
	wp_enqueue_script( 'wpb_composer_front_js' );
	//wp_enqueue_style('js_composer_custom_css');
	
	$detect = new Mobile_Detect;
	if ( !$detect->isMobile() ) {
		if($parallax_bg == 'parallax-bg') {
			wp_enqueue_script( 'parallax-bg', MNKY_PLUGIN_URL . 'assets/js/parallax-bg.js', array('jquery') );
			$parallax_speed = ' data-parallax-speed="'.$speed.'"';
		}
	}	

	$el_class = $this->getExtraClass($el_class);
	$full_content_width = $this->getExtraClass($full_content_width);

	$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row main_row '.get_row_css_class().$el_class, $this->settings['base']);
	
	$css_class .= $this->getExtraClass($parallax_bg);
	$css_class .= $this->getExtraClass($row_seperator);
	$css_class .= $this->getExtraClass($row_mobile_style);
	($section_id != '') ? $section_id = 'id="'.$section_id.'"' : '';
	($row_show_on != '') ? $css_class .= $this->getExtraClass( str_replace(',', ' ', $row_show_on) ) : '';
		
	if($bg_image != '') {
		$image_url = wp_get_attachment_image_src( $bg_image, 'full');
		$image_url = $image_url[0];
	}

	$styles = array(
		($textalign != '') ? 'text-align:'.$textalign.';' : null,
		($bg_color != '') ? 'background-color:'.$bg_color.';' : null,
		($font_color != '') ? 'color:'.$font_color.';' : null,
		($font_weight != '') ? 'font-weight:'.$font_weight.';' : null,
		($bg_image != '') ? 'background-image:url('.$image_url.');' : null,
		($top != '') ? 'padding-top:'.$top.';' : null,
		($bottom != '') ? 'padding-bottom:'.$bottom.';' : null,
		($bg_image != '' && $bg_repeat != '') ? 'background-repeat:'.$bg_repeat.';' : null,
		($bg_image != '' && $bg_position != '' && $parallax_bg == '') ? 'background-position:'.$bg_position.';' : null,
		($bg_image != '' && $parallax_bg == 'parallax-bg') ? 'background-position:center top;' : null,
		($bg_image != '' && $bg_attachment != '' || $parallax_bg == 'parallax-bg') ? 'background-attachment:fixed;' : null,
		($bg_image != '' && $bg_cover != '') ? 'background-size:'.$bg_cover.';' : null
	); 
	
	$styles = array_filter($styles);
	
	if( !empty($styles) ){
		$style = implode(' ', $styles);	
		$style = ' style="'.$style.'"';
	}

	$output .= '<section '.$section_id.' class="'.$css_class.'"'.$style.$parallax_speed.'><div class="row-inner'.$full_content_width.'">';
	$output .= wpb_js_remove_wpautop($content);
	$output .= '</div></section>'.$this->endBlockComment('row');

echo $output;