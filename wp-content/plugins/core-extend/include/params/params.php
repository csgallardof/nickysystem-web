<?php

/*---------------------------------------------------------------*/
/* Create custom param for Visual Composer
/*---------------------------------------------------------------*/

// Icon param
function mnky_font_icons($settings, $value) {
	$output = $icon = '';

	require_once (  MNKY_PLUGIN_PATH . '/include/icon-font/icon_list.php' );

	$output .= '<ul>';
	foreach ( $mnky_icon_list as $list_name => $icons ) {
			$selected_icon = ( $icon == $value ) ? ' checked' : '';

			$output .= '<div class="icon-list-section">'. $list_name .'</div>';
			
			foreach ( $icons as $icon ) {
				$output .= '<li><input type="radio" name="icons" value="' . $icon . '" id="' . $icon . '"'.$selected_icon.'><label for="' . $icon . '"><i class="fa ' . $icon . '"></i></label></li>';
			}
	}
	$output .= '</ul>';
	
	$saved_icon_class = ($value != '') ? 'class="selected_icon_wrapper fa '. $value .'"' : '';
	
	return '<button type="button" class="button button-large add_icon">Choose Icon</button> <i id="selected_icon" '.$saved_icon_class.'></i><input name="'.$settings['param_name'].'" id="vc_selected_icon" class="wpb_vc_param_value  '.$settings['param_name'].' '.$settings['type'].'_field"  value="'.$value.'" type="hidden"/><div class="mnky-icon-list">'. $output .'</div>';	
}

add_shortcode_param('font_icons', 'mnky_font_icons', MNKY_PLUGIN_URL . 'assets/js/extend-params.js' );