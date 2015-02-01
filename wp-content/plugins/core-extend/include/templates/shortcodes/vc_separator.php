<?php
$output = '';
	extract(shortcode_atts(array(
		'style' => '',
		'align' => 'center',
		'icon' => 'check',
		'color' => '#e2e2e2',
		'iconcolor' => ''
	), $atts));
	

if($style == 'simple'){
	$output .= '<div class="separator_simple" style="border-color:'.$color.';"></div>';
} elseif ($style == 'double') {
	$output .= '<div class="separator_double" style="border-color:'.$color.';"></div>';
} elseif ($style == 'shadow') {
	$output .= '<div class="separator_shadow"></div>';
} else {
	if($align == 'left'){
		$output .= '<div class="separator_w_icon"><div class="seperator_container icon_align_left"><i class="fa '.$icon.'" style="color:'.$iconcolor.';">
		</i><span style="border-color:'.$color.';"></span></div></div>';
	} elseif ($align == 'right'){
		$output .= '<div class="separator_w_icon"><div class="seperator_container icon_align_right"><span style="border-color:'.$color.';"></span><i class="fa '.$icon.'" style="color:'.$iconcolor.';" >
		</i></div></div>';

	} else {
		$output .= '<div class="separator_w_icon"><div class="seperator_container"><span style="border-color:'.$color.';"></span><i class="fa '.$icon.'" style="color:'.$iconcolor.';" >
		</i><span style="border-color:'.$color.';"></span></div></div>';

	}

}

echo $output;