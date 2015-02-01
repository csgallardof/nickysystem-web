<?php
$output = '';

	extract(shortcode_atts(array(
		'el_class' => '',
		'from' => '0',
		'to' => '1000',
		'speed' => '2000',
		'interval' => '10',
		'decimals' => '0'
	), $atts));
	
	wp_enqueue_script( 'waypoints' );
	wp_enqueue_script( 'CountTo', MNKY_PLUGIN_URL . 'assets/js/countTo.js', array('jquery'));
	
	$el_class = $this->getExtraClass($el_class);
	
	$output .= '<div class="counter_wrapper'.$el_class.'"><span class="count_data" data-count-from="'.$from.'" data-count-to="'.$to.'" data-count-speed="'.$speed.'" data-count-interval="'.$interval.'" data-count-decimals="'.$decimals.'">'.$from.'</span></div>';

echo $output;
