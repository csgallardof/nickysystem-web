<?php
$output = '';

	extract(shortcode_atts(array(
		'title' => '',
		'popover_content' => 'Content...',
		'placement' => 'auto',
		'trigger' => 'hover',
		'width' => 'auto',
		'height' => 'auto',
		'style' => '',
		'el_class' => ''
	), $atts));
	
	wp_enqueue_script( 'webui-popover', MNKY_PLUGIN_URL . 'assets/js/jquery.webui-popover.js', array('jquery'), '', false );

				
	$el_class = $this->getExtraClass($el_class);
	$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tooltip_wrapper'.$el_class, $this->settings['base']);
	
	
	$output .= '<div class="'.$css_class.'" data-title="'.$title.'" data-width="'.$width.'"  data-height="'.$height.'" data-placement="'.$placement.'" data-trigger="'.$trigger.'" data-style="'.$style.'"><div class="tooltip_content">'.$popover_content.'</div>';
	$output .= wpb_js_remove_wpautop($content);
	$output .= '</div>';


echo $output;