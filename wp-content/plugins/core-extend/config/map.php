<?php
/*---------------------------------------------------------------*/
/* Register shortcode within Visual Composer interface
/*---------------------------------------------------------------*/

add_action( 'init', 'mnky_vc_map' );
function mnky_vc_map() {

	$add_css_animation = array(
		'type' => 'dropdown',
		'heading' => __( 'CSS Animation', 'core-extend' ),
		'param_name' => 'css_animation',
		'admin_label' => true,
		'value' => array(
			__( 'No', 'core-extend' ) => '',
			__( 'Top to bottom', 'core-extend' ) => 'top-to-bottom',
			__( 'Bottom to top', 'core-extend' ) => 'bottom-to-top',
			__( 'Left to right', 'core-extend' ) => 'left-to-right',
			__( 'Right to left', 'core-extend' ) => 'right-to-left',
			__( 'Appear from center', 'core-extend' ) => "appear"
		),
		'description' => __( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'core-extend' )
	);

	$add_css_animation_delay = array(
		"type" => "dropdown",
		"heading" => __('CSS Animation Delay', 'core-extend'),
		"param_name" => "css_animation_delay",
		"value" => array(
			'0ms' => '', 
			'100ms' => 'delay-100', 
			'200ms' => 'delay-200', 
			'300ms' => 'delay-300', 
			'400ms' => 'delay-400', 
			'500ms' => 'delay-500', 
			'600ms' => 'delay-600', 
			'700ms' => 'delay-700', 
			'800ms' => 'delay-800', 
			'900ms' => 'delay-900', 
			'1000ms' => 'delay-1000', 
			'1100ms' => 'delay-1100', 
			'1200ms' => 'delay-1200', 
			'1300ms' => 'delay-1300', 
			'1400ms' => 'delay-1400', 
			'1500ms' => 'delay-1500', 
			'1600ms' => 'delay-1600',
			'1700ms' => 'delay-1700',
			'1800ms' => 'delay-1800', 
			'1900ms' => 'delay-1900', 
			'2000ms' => 'delay-2000'
		),
		"dependency" => Array('element' => "css_animation", 'not_empty' => true)
	);

	  
	// Row
	vc_map( array(
		"name" => __('Row', 'core-extend'),
		"base" => "vc_row",
		"is_container" => true,
		"icon" => "icon-wpb-row",
		"show_settings_on_create" => false,
		"category" => __('Content', 'core-extend'),
		"admin_enqueue_css" => array( MNKY_PLUGIN_URL . 'assets/css/font-devices.css'),
		"description" => __('Place content elements inside the row', 'core-extend'),
		"params" => array(		
			array(
				"type" => 'checkbox',
				"heading" => __('Full width content', 'core-extend'),
				"param_name" => "full_content_width",
				"value" => Array(__('Yes, please', 'core-extend') => 'row-inner-full'),
			),
			array(
				"type" => "colorpicker",
				"heading" => __('Background color', 'core-extend'),
				"param_name" => "bg_color",
				"group" => __('Background', 'core-extend')
			),		
			array(
				"type" => "attach_image",
				"heading" => __('Background image', 'core-extend'),
				"param_name" => "bg_image",
				"group" => __('Background', 'core-extend')
			),
			array(
				"type" => 'checkbox',
				"heading" => __('Parallax background', 'core-extend'),
				"param_name" => "parallax_bg",
				"description" => __('Enable parallax effect during the scroll', 'core-extend'),
				"value" => Array(__('Enable', 'core-extend') => 'parallax-bg'),
				"dependency" => Array('element' => "bg_image", 'not_empty' => true),
				"group" => __('Background', 'core-extend')
			),
			array(
				"type" => "textfield",
				"heading" => __('Parallax speed', 'core-extend'),
				"param_name" => "speed",
				"value" => "0.20",
				"description" => __('You can change the speed by altering the decimal number.  A lower number means slower, higher means faster, and 0.20 is the default.', 'core-extend'),
				"dependency" => Array('element' => "parallax_bg", 'not_empty' => true),
				"group" => __('Background', 'core-extend')
			),			
			array(
				"type" => 'checkbox',
				"heading" => __('Full background cover', 'core-extend'),
				"param_name" => "bg_cover",
				"description" => __('Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area.', 'core-extend'),
				"value" => Array(__('Enable', 'core-extend') => 'cover'),
				"dependency" => Array('element' => "bg_image", 'not_empty' => true),
				"group" => __('Background', 'core-extend')
			),
			array(
				"type" => "dropdown",
				"heading" => __('Background repeat', 'core-extend'),
				"param_name" => "bg_repeat",
				"value" => array('Repeat all' => '', 'Repeat horizontally' => 'repeat-x', 'Repeat vertically' => 'repeat-y', 'No repeat' => 'no-repeat'),
				"description" => __('The background-repeat property sets if/how a background image will be repeated.', 'core-extend'),
				"dependency" => Array('element' => "bg_image", 'not_empty' => true),
				"group" => __('Background', 'core-extend')
			),		
			array(
				"type" => "dropdown",
				"heading" => __('Background position', 'core-extend'),
				"param_name" => "bg_position",
				"value" => array('Left top' => '', 'Left center', 'Left bottom', 'Right top', 'Right center', 'Right bottom', 'Center top', 'Center center', 'Center bottom'),
				"description" => __('The background-position property sets the starting position of a background image.', 'core-extend'),
				"dependency" => Array('element' => "bg_image", 'not_empty' => true),
				"group" => __('Background', 'core-extend')
			),
			array(
				"type" => "dropdown",
				"heading" => __('Background attachment', 'core-extend'),
				"param_name" => "bg_attachment",
				"value" => array('Scroll' => '', 'Fixed' => 'fixed'),
				"description" => __('The background-attachment property sets whether a background image is fixed or scrolls with the rest of the page.', 'core-extend'),
				"dependency" => Array('element' => "bg_image", 'not_empty' => true),
				"group" => __('Background', 'core-extend')
			),
			array(
				"type" => "dropdown",
				"heading" => __('Row top seperator (divider)', 'core-extend'),
				"param_name" => "row_seperator",
				"value" => array('None' => 'no-seperator', 'Solid line' => 'row-line-seperator', 'Shadow' => 'row-shadow-seperator'),
				"description" => __('Separator separates current row from content element above', 'core-extend')
			),
			array(
				"type" => "colorpicker",
				"heading" => __('Font Color', 'core-extend'),
				"param_name" => "font_color",
				"group" => __('Typography', 'core-extend'),
			),
			array(
				"type" => "dropdown",
				"heading" => __('Font weight', 'core-extend'),
				"param_name" => "font_weight",
				"value" => array(__('Inherit', 'core-extend') => "", __('Normal', 'core-extend') => "normal", __('Lighter', 'core-extend') => "lighter", __('Bold', 'core-extend') => "bold", __('Bolder', 'core-extend') => "bolder"),
				"group" => __('Typography', 'core-extend')
			),
			array(
				"type" => "dropdown",
				"heading" => __('Row text align', 'core-extend'),
				"param_name" => "textalign",
				"value" => array(__('Inherit', 'core-extend') => "", __('Left', 'core-extend') => "left", __('Center', 'core-extend') => "center", __('Right', 'core-extend') => "right"),
				"group" => __('Typography', 'core-extend')
			),
			array(
				"type" => "textfield",
				"heading" => __('Padding top', 'core-extend'),
				"param_name" => "top",
				"value" => '70px',
				"description" => __('The padding-top property sets the top padding (space) of an element.', 'core-extend')
			),
			array(
				"type" => "textfield",
				"heading" => __('Padding bottom', 'core-extend'),
				"param_name" => "bottom",
				"value" => '70px',
				"description" => __('The padding-badding property sets the bottom padding (space) of an element.', 'core-extend')
			),
			array(
				"type" => "textfield",
				"heading" => __('Add ID to section', 'core-extend'),
				"param_name" => "section_id",
				"group" => __('Section ID', 'core-extend'),
				"description" => __('This ID is used to make one page menu or scroll to anchor. Please give unique ID to each row, if using menu for one page style.', 'core-extend')
			),
			array(
				"type" => "textfield",
				"heading" => __('Extra class name', 'core-extend'),
				"param_name" => "el_class",
				"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'core-extend')
			),
			array(
				"type" => 'checkbox',
				"heading" => __('Row columns', 'core-extend'),
				"param_name" => "row_mobile_style",
				"description" => __('When enabled, all columns are made 100% wide and stacked above each other', 'core-extend'),
				"value" => Array(__('Make this row content 100% width in Tablet Portrait (on screen sizes smaller than 979px)', 'core-extend') => 'ipad_full_width'),
				"group" => __('Responsive options', 'core-extend')
			),		
			array(
				"type" => 'checkbox',
				"heading" => __('Hide this row on screen sizes:', 'core-extend'),
				"param_name" => "row_show_on",
				"value" => Array(
					"<strong>Desktop</strong> (on screen sizes larger than 1025px)<br/><br/>" => 'hide_on_normal_screen', 
					"<strong>Tablet Landscape</strong> (on screen sizes from 980px - 1024px)<br/><br/>" => 'hide_tablet_landscape', 
					"<strong>Tablet Portrait</strong> (on screen sizes from 768px - 979px)<br/><br/>" => 'hide_tablet_portrait', 
					"<strong>Mobile Landscape</strong> (on screen sizes from 480px - 767px)<br/><br/>" => 'hide_mobile_landscape', 
					"<strong>Mobile Portrait</strong> (on screen sizes smaller than 479px)" => 'hide_mobile_portrait'
				),
				"group" => __('Responsive options', 'core-extend')
			)
		),
		"js_view" => 'VcRowView'
	) );


	// Buttons
	vc_map( array(
		"name" => __('Styled Button', 'core-extend'),
		"base" => "vc_button",
		"icon" => "icon-wpb-ui-button",
		"category" => __('Content', 'core-extend'),
		"description" => __('Eye catching button', 'core-extend'),
		"params" => array(
			array(
				"type" => "vc_link",
				"heading" => __('URL (Link)', 'core-extend'),
				"param_name" => "link",
			),
			array(
				"type" => "textfield",
				"heading" => __('Text on the button', 'core-extend'),
				"holder" => "button",
				"class" => "wpb_button",
				"param_name" => "title",
				"value" => __('Text on the button', 'core-extend'),
			),
			array(
				"type" => "dropdown",
				"heading" => __('Size', 'core-extend'),
				"param_name" => "size",
				"value" => array(__('Regular size', 'core-extend') => "wpb_regularsize", __('Medium', 'core-extend') => "btn-medium", __('Large', 'core-extend') => "btn-large"),
			),
			array(
				"type" => "dropdown",
				"heading" => __('Color', 'core-extend'),
				"param_name" => "color",
				"value" => array(__('Theme accent color', 'core-extend') => "btn_themecolor", __('White', 'core-extend') => "btn_white", __('Grey', 'core-extend') => "btn_grey", __('Blue', 'core-extend') => "btn_blue", __('Turquoise', 'core-extend') => "btn_turquoise", __('Green', 'core-extend') => "btn_green", __('Orange', 'core-extend') => "btn_orange", __('Red', 'core-extend') => "btn_red", __('Black', 'core-extend') => "btn_black"),
				"description" => __('Button color.', 'core-extend')
			),
			array(
				"type" => 'checkbox',
				"heading" => __('Minimal button style?', 'core-extend'),
				"param_name" => "button_style",
				"description" => __('Contours & text in selected color with transparent background', 'core-extend'),
				"value" => Array(__('Enable', 'core-extend') => 'minimal_style')
			),
			array(
				"type" => "font_icons",
				"class" => "",
				"heading" => __('Icon', 'core-extend'),
				"param_name" => "icon_name",
				"value" => ''
			),
			$add_css_animation,
			$add_css_animation_delay,
			array(
				"type" => "textfield",
				"heading" => __('Extra class name', 'core-extend'),
				"param_name" => "el_class",
				"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'core-extend')
			)
		),
		"js_view" => 'VcButtonView'
	) );


	// Colored box
	vc_map( array(
		"name" => __('Colored Box', 'core-extend'),
		"base" => "vc_colored_box",
		"icon" => "icon-wpb-colored_box",
		"category" => __('Premium', 'core-extend'),
		"description" => __('Colored background box with text', 'core-extend'),
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => __('Box width (optional)', 'core-extend'),
				"param_name" => "width",
				"value" => "",
				"description" => __('Default width is 100%. You can use % or px. Example: 550px', 'core-extend')
			),
			array(
				"type" => "dropdown",
				"heading" => __('Box align', 'core-extend'),
				"param_name" => "align",
				"value" => array(__('Left', 'core-extend') => "", __('Right', 'core-extend') => "float-right", __('Centred', 'core-extend') => "aligncenter"),
				"dependency" => Array('element' => "href", 'not_empty' => true)
			),
			array(
				"type" => "colorpicker",
				"heading" => __('Background color', 'core-extend'),
				"param_name" => "bg_color",
				"value" => '',
				"description" => __('Leave empty to use \"Theme accent color\"', 'core-extend')
			),
			array(
				"type" => "colorpicker",
				"heading" => __('Border color', 'core-extend'),
				"param_name" => "border_color",
				"value" => '',
				"description" => __('Leave empty for no border', 'core-extend')
			),
			array(
				"type" => "textfield",
				"heading" => __('Box paddings', 'core-extend'),
				"param_name" => "padding",
				"value" => "45px",
				"description" => __('The padding property can have from one to four values. Example: 25px 50px 75px 90px', 'core-extend')
			),
			array(
				"type" => "textfield",
				"heading" => __('Margin left (optional)', 'core-extend'),
				"param_name" => "margin_left",
				"description" => __('The margin-left property sets the left margin of an element. Example: 40px', 'core-extend'),
				"dependency" => Array('element' => "align", 'value' => array('float-right',''))
			),		
			array(
				"type" => "textfield",
				"heading" => __('Margin right (optional)', 'core-extend'),
				"param_name" => "margin_right",
				"description" => __('The margin-right property sets the right margin of an element. Example: 40px', 'core-extend'),
				"dependency" => Array('element' => "align", 'value' => array('float-right',''))
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"heading" => __('Box text', 'core-extend'),
				"param_name" => "content",
				"value" => __('<p>Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'core-extend')
			),
			$add_css_animation,
			$add_css_animation_delay,
			array(
				"type" => "textfield",
				"heading" => __('Extra class name', 'core-extend'),
				"param_name" => "el_class",
				"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'core-extend')
			)
		),
		"js_view" => 'VcButtonView'
	) );


	// Progress Bar
	vc_map( array(
	  "name" => __('Progress Bar', 'core-extend'),
	  "base" => "vc_progress_bar",
	  "icon" => "icon-wpb-graph",
	  "category" => __('Content', 'core-extend'),
	  "description" => __('Animated progress bar', 'core-extend'),
	  "params" => array(
		array(
		  "type" => "textfield",
		  "heading" => __('Widget title', 'core-extend'),
		  "param_name" => "title",
		  "description" => __('What text use as a widget title. Leave blank if no title is needed.', 'core-extend')
		),
		array(
		  "type" => "exploded_textarea",
		  "heading" => __('Graphic values', 'core-extend'),
		  "param_name" => "values",
		  "description" => __('Input graph values here. Divide values with linebreaks (Enter). Example: 90|Development', 'core-extend'),
		  "value" => "90|Development,80|Design,70|Marketing"
		),
		array(
		  "type" => "textfield",
		  "heading" => __('Units', 'core-extend'),
		  "param_name" => "units",
		  "description" => __('Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'core-extend')
		),
		array(
		  "type" => "dropdown",
		  "heading" => __('Bar color', 'core-extend'),
		  "param_name" => "bgcolor",
		  "value" => array(__('Theme accent color', 'core-extend') => "bar_themecolor", __('Grey', 'core-extend') => "bar_grey", __('Blue', 'core-extend') => "bar_blue", __('Turquoise', 'core-extend') => "bar_turquoise", __('Green', 'core-extend') => "bar_green", __('Orange', 'core-extend') => "bar_orange", __('Red', 'core-extend') => "bar_red", __('Black', 'core-extend') => "bar_black", __('Custom Color', 'core-extend') => "custom"),
		  "description" => __('Select bar background color.', 'core-extend'),
		  "admin_label" => true
		),
		array(
		  "type" => "colorpicker",
		  "heading" => __('Bar custom color', 'core-extend'),
		  "param_name" => "custombgcolor",
		  "description" => __('Select custom background color for bars.', 'core-extend'),
		  "dependency" => Array('element' => "bgcolor", 'value' => array('custom'))
		),
		array(
		  "type" => "checkbox",
		  "heading" => __('Options', 'core-extend'),
		  "param_name" => "options",
		  "value" => array(__('Add Stripes?', 'core-extend') => "striped", __('Add animation? Will be visible with striped bars.', 'core-extend') => "animated")
		),
		array(
		  "type" => "textfield",
		  "heading" => __('Extra class name', 'core-extend'),
		  "param_name" => "el_class",
		  "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'core-extend')
		)
	  )
	) );


	// Heading
	vc_map( array(
		"name" => __('Styled Heading', 'core-extend'),
		"base" => "vc_heading",
		"icon" => "icon-wpb-vc_heading",
		"category" => __('Premium', 'core-extend'),
		"description" => __('Eye catching headings', 'core-extend'),
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => __('Title', 'core-extend'),
				"param_name" => "title",
				"value" => "This is title",
				"admin_label" => true,

			),		
			array(
				"type" => "textfield",
				"heading" => __('Sub-title', 'core-extend'),
				"param_name" => "subtitle",
				"admin_label" => true,
				"value" => "",
				"description" => __('Subtitle will be positioned under main title', 'core-extend')
			),
			array(
				"type" => "colorpicker",
				"heading" => __('Text color', 'core-extend'),
				"param_name" => "color",
				"value" => '',
				"description" => __('', 'core-extend')
			),
			array(
				"type" => "dropdown",
				"heading" => __('Text align', 'core-extend'),
				"param_name" => "position",
				"value" => array(__('Center', 'core-extend') => "center", __('Left', 'core-extend') => "left", __('Right', 'core-extend') => "right")
			),
			$add_css_animation,
			$add_css_animation_delay,
			array(
				"type" => "textfield",
				"heading" => __('Extra class name', 'core-extend'),
				"param_name" => "el_class",
				"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'core-extend')
			)
		)
	) );


	// Icons
	vc_map( array(
		"name" => __('Icons', 'core-extend'),
		"base" => "vc_icon",
		"icon" => "icon-wpb-vc_icons",
		"category" => __('Premium', 'core-extend'),
		"description" => __('Scalable vector icons', 'core-extend'),
		"admin_enqueue_js" => array( MNKY_PLUGIN_URL . 'assets/js/extend-composer-custom-views.js' ),
		"admin_enqueue_css" => array( MNKY_PLUGIN_URL . 'assets/css/core-extend-backend.css', MNKY_PLUGIN_URL . 'assets/css/font-awesome.css'),
		"params" => array(
			array(
				"type" => "font_icons",
				"class" => "",
				"heading" => __('Icon', 'core-extend'),
				"param_name" => "name",
				"holder" => "div",
				"value" => "fa-check"
			),
			array(
				"type" => "textfield",
				"heading" => __('Icon size', 'core-extend'),
				"param_name" => "icon_size",
				"value" => "28px",
				"description" => __('', 'core-extend')
			),
			array(
				"type" => "colorpicker",
				"heading" => __('Icon color', 'core-extend'),
				"param_name" => "icon_color",
				"value" => '#444444',
				"description" => __('', 'core-extend')
			),
			array(
				"type" => "textfield",
				"heading" => __('Padding left', 'core-extend'),
				"param_name" => "padding_left",
				"value" => "0px",
				"description" => __('The padding-left property sets the left padding (space) of an element.', 'core-extend')
			),
			array(
				"type" => "textfield",
				"heading" => __('Padding right', 'core-extend'),
				"param_name" => "padding_right",
				"value" => "0px",
				"description" => __('The padding-right property sets the right padding (space) of an element.', 'core-extend')
			),	
			array(
				"type" => "vc_link",
				"heading" => __('URL (Link)', 'core-extend'),
				"param_name" => "link",
			),
			array(
				"type" => "dropdown",
				"heading" => __('Hover effect', 'core-extend'),
				"param_name" => "hover_effect",
				"value" => array(__('None', 'core-extend') => "", __('Fade out', 'core-extend') => "fade_out", __('Change color', 'core-extend') => "change_color", __('Bounce', 'core-extend') => "bounce", __('Shrink', 'core-extend') => "shrink")
			),
			array(
				"type" => "colorpicker",
				"heading" => __('Hover color', 'core-extend'),
				"param_name" => "hover_color",
				"description" => __('Leave empty to use \"Theme accent color\"', 'core-extend'),
				"dependency" => Array('element' => "hover_effect", 'value' => array('change_color'))
			),
			$add_css_animation,
			$add_css_animation_delay,		
			array(
				"type" => "textfield",
				"heading" => __('Extra class name', 'core-extend'),
				"param_name" => "el_class",
				"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'core-extend')
			)
		),
		"js_view" => "VcIconView"
	) );


	// Team
	vc_map( array(
		"name" => __('Team', 'core-extend'),
		"base" => "vc_team",
		"icon" => "icon-wpb-vc_team",
		"wrapper_class" => "clearfix",
		"category" => __('Premium', 'core-extend'),
		"description" => __('Staff members', 'core-extend'),
		"params" => array(
			array(
				"type" => "dropdown",
				"heading" => __('Style', 'core-extend'),
				"param_name" => "style",
				"value" => array(__('Style 1', 'core-extend') => "team-style-1", __('Style 2', 'core-extend') => "team-style-2")
			),
			array(
				"type" => "attach_image",
				"heading" => __('Member image', 'core-extend'),
				"param_name" => "img_url",
				"value" => "",
				"holder" => "img", 
				"description" => __('Recommended min. width: 540px', 'core-extend')
			),
			array(
				"type" => "textfield",
				"heading" => __('Name', 'core-extend'),
				"param_name" => "name",
				"value" => "John Doe",
				"holder" => "div",
				"description" => __('', 'core-extend')
			),		
			array(
				"type" => "textfield",
				"heading" => __('Position', 'core-extend'),
				"param_name" => "position",
				"value" => "designer",
				"holder" => "i",
				"description" => __('e.g. \"Senior Designer\"', 'core-extend')
			),
			array(
				"type" => "textarea",
				"heading" => __('Hover text (optional)', 'core-extend'),
				"param_name" => "hover_txt",
				"value" => "",
				"description" => __('', 'core-extend'),
				"dependency" => array('element' => "style", 'value' => array('team-style-1'))
			),		
			array(
				"type" => "textarea",
				"heading" => __('Aditional info (optional)', 'core-extend'),
				"param_name" => "content",
				"value" => "",
				"description" => __('', 'core-extend')
			),
			array(
				"type" => "colorpicker",
				"heading" => __('Color scheme', 'core-extend'),
				"param_name" => "color_scheme",
				"description" => __('Leave empty to use \"Theme accent color\"', 'core-extend'),
				"dependency" => array('element' => "style", 'value' => array('team-style-1'))
			),
			$add_css_animation,
			$add_css_animation_delay,
			array(
				"type" => "textfield",
				"heading" => __('Extra class name', 'core-extend'),
				"param_name" => "el_class",
				"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'core-extend')
			)
		),
		"js_view" => 'VcTeamView'
	) );


	// Testimonial slider
	vc_map( array(
		"name" => __('Testimonials', 'core-extend'),
		"base" => "vc_testimonial_slider",
		"icon" => "icon-wpb-vc_testimonials", 
		"as_parent" => array('only' => 'vc_testimonial'),
		"is_container" => true,
		"show_settings_on_create" => true,
		"category" => __('Premium', 'core-extend'),
		"description" => __('Quote slider', 'core-extend'),
		"params" => array(	
			array(
				"type" => "dropdown",
				"heading" => __('Style', 'core-extend'),
				"param_name" => "style",
				"value" => array(__('Style 1', 'core-extend') => "testimonials-style-1", __('Style 2', 'core-extend') => "testimonials-style-2", __('Style 3', 'core-extend') => "testimonials-style-3", __('Style 4', 'core-extend') => "testimonials-style-4")
			),
			array(
				"type" => "dropdown",
				"heading" => __('Animation', 'core-extend'),
				"param_name" => "animation",
				"value" => array(__('Fade', 'core-extend') => "fade", __('Slide', 'core-extend') => "slide",)
			),
			array(
				"type" => "textfield",
				"heading" => __('Slide show speed', 'core-extend'),
				"param_name" => "slide_speed",
				"value" => "5",
				"description" => __('Set the speed of the slideshow cycling, in seconds', 'core-extend')
			),
			array(
				"type" => 'checkbox',
				"heading" => __( 'Hide paging control?', 'core-extend' ),
				"param_name" => "bullets",
				"value" => Array(__( 'Yes, please', 'core-extend' ) => 'paging-false')
			),				
			array(
				"type" => "textfield",
				"heading" => __('Extra class name', 'core-extend'),
				"param_name" => "el_class",
				"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'core-extend')
			)
		),
		"custom_markup" => '
			<h4>Testimonials/Quotes</h4>
			<div class="wpb_tetimonial_holder wpb_holder clearfix vc_container_for_children">
			%content%
			</div>
			<div class="tab_controls">
			    <a class="add_tab" title="' . __( 'Add navigation link', 'core-extend' ) . '"><span class="vc_icon"></span> <span class="tab-label">' . __( 'Add testimonial', 'core-extend' ) . '</span></a>
			</div>
		',
	  'default_content' => '
	  [vc_testimonial name="John Doe" position="Designer"]I am tetimonial text. Click edit button to change this text.[/vc_testimonial]
	  [vc_testimonial name="Nathan Benson" position="Developer"]I am tetimonial text 2. Click edit button to change this text.[/vc_testimonial]
	  ',
	  "js_view" => 'VcTestimonialSliderView'
	  
	) );


	// Testimonial
	vc_map( array(
		"name" => __('Testimonial', 'core-extend'),
		"base" => "vc_testimonial",
		"is_container" => true,
		"content_element" => false,
		"as_child" => array('only' => 'vc_testimonial_slider'),
		"category" => __('Premium', 'core-extend'),
		"params" => array(
			array(
				"type" => "attach_image",
				"heading" => __('Author image', 'core-extend'),
				"param_name" => "img_url"
			),		
			array(
				"type" => "textfield",
				"heading" => __('Author name', 'core-extend'),
				"param_name" => "name",
				"value" => "John Doe",
				"holder" => "h3",
				"description" => __('', 'core-extend')
			),		
			array(
				"type" => "textfield",
				"heading" => __('Author info', 'core-extend'),
				"param_name" => "author_dec",
				"value" => "Designer",
				"description" => __('e.g. \"Senior Designer\" or  \"Happy Customer\"', 'core-extend')
			),
			array(
				"type" => "textarea",
				"class" => "quote_text",
				"heading" => __('Testimonial/Quote text', 'core-extend'),
				"holder" => "div",
				"param_name" => "content",
				"value" => __('<p>I am tetimonial text. Click edit button to change this text.</p>', 'core-extend')
			),
			array(
				"type" => "textfield",
				"heading" => __('Extra class name', 'core-extend'),
				"param_name" => "el_class",
				"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'core-extend')
			)
		),
		"js_view" => 'VcTestimonialView'
	) );


	// List item
	vc_map( array(
		"name" => __('List Item', 'core-extend'),
		"base" => "vc_list_item",
		"icon" => "icon-wpb-vc_list", 
		"is_container" => false,
		"description" => __('List with custom icon', 'core-extend'),
		"category" => __('Premium', 'core-extend'),
		"params" => array(
			array(
				"type" => "font_icons",
				"class" => "",
				"heading" => __('Icon', 'core-extend'),
				"param_name" => "icon_name",
				"holder" => "div",
				"value" => "fa-check"
			),
			array(
				"type" => "colorpicker",
				"heading" => __('List icon color', 'core-extend'),
				"param_name" => "icon_color",
				"description" => __('Leave empty to use \"Theme accent color\"', 'core-extend')
			),
			array(
				"type" => "vc_link",
				"heading" => __('URL (Link)', 'core-extend'),
				"param_name" => "link",
			),
			array(
				"type" => "textarea",
				"heading" => __('List item text', 'core-extend'),
				"holder" => "div",
				"param_name" => "content",
				"value" => __('I am a list item', 'core-extend')
			),
			$add_css_animation,
			$add_css_animation_delay,
			array(
				"type" => "textfield",
				"heading" => __('Extra class name', 'core-extend'),
				"param_name" => "el_class",
				"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'core-extend')
			)		
		),
		"js_view" => 'VcListItemView'
	) );


	// Service
	vc_map( array(
		"name" => __('Service', 'core-extend'),
		"base" => "vc_service",
		"icon" => "icon-wpb-vc_service",
		"category" => __('Premium', 'core-extend'),
		"description" => __('Service info with custom icon', 'core-extend'),
		"params" => array(
			array(
				"type" => "font_icons",
				"class" => "",
				"heading" => __('Icon', 'core-extend'),
				"param_name" => "icon_name",
				"holder" => "div",
				"value" => "fa-check"
			),
			array(
				"type" => "colorpicker",
				"heading" => __('Icon color', 'core-extend'),
				"param_name" => "icon_color",
				"description" => __('Leave empty to use \"Theme accent color\"', 'core-extend')
			),
			array(
				"type" => "colorpicker",
				"heading" => __('Heading color', 'core-extend'),
				"param_name" => "heading_color",
				"description" => __('Leave empty to use default heading color', 'core-extend')
			),
			array(
				"type" => "textfield",
				"heading" => __('Title', 'core-extend'),
				"param_name" => "title",
				"holder" => "h4",
				"value" => __('Your service title', 'core-extend')
			),
			array(
				"type" => "textarea",
				"heading" => __('Service description', 'core-extend'),
				"holder" => "div",
				"param_name" => "content",
				"value" => __('I am service box text. Click edit button to change this text.', 'core-extend')
			),
			array(
				"type" => "dropdown",
				"heading" => __('Layout style', 'core-extend'),
				"param_name" => "position",
				"value" => array(__('Left', 'core-extend') => "", __('Right', 'core-extend') => "sb_right", __('Center', 'core-extend') => "sb_center")
			),
			array(
				"type" => "vc_link",
				"heading" => __('URL (Link)', 'core-extend'),
				"param_name" => "link",
			),
			$add_css_animation,
			$add_css_animation_delay,
			array(
				"type" => "textfield",
				"heading" => __('Extra class name', 'core-extend'),
				"param_name" => "el_class",
				"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'core-extend')
			)
		),
		 "js_view" => 'VcServiceView'

	) );


	// Separator (Divider)
	vc_map( array(
		"name"		=> __('Separator', 'core-extend'),
		"base"		=> "vc_separator",
		"icon"		=> "icon-wpb-ui-separator",
		"category"  => __('Content', 'core-extend'),
		"description" => __('Horizontal separator line', 'core-extend'),
		"params" => array(
			array(
				"type" => "dropdown",
				"heading" => __('Type', 'core-extend'),
				"param_name" => "style",
				"value" => array(__('Line with icon', 'core-extend') => "w_icon", __('Simple line', 'core-extend') => "simple", __('Short double line', 'core-extend') => "double", __('Shadow line', 'core-extend') => "shadow")
			),
			array(
				"type" => "font_icons",
				"class" => "",
				"heading" => __('Icon', 'core-extend'),
				"param_name" => "icon",
				"value" => "",
				"dependency" => Array('element' => "style", 'value' => array('w_icon'))
			),
			array(
				"type" => "dropdown",
				"heading" => __('Icon align', 'core-extend'),
				"param_name" => "align",
				"value" => array(__('Center', 'core-extend') => "center", __('Left', 'core-extend') => "left", __('Right', 'core-extend') => "right"),
				"dependency" => Array('element' => "style", 'value' => array('w_icon'))
			),
			array(
				"type" => "colorpicker",
				"heading" => __('Separator line color', 'core-extend'),
				"param_name" => "color",
				"value" => '#e2e2e2',
				"dependency" => Array('element' => "style", 'value' => array('w_icon', 'simple', 'double'))
			),	
			array(
				"type" => "colorpicker",
				"heading" => __('Icon color', 'core-extend'),
				"param_name" => "iconcolor",
				"value" => '#e2e2e2',
				"dependency" => Array('element' => "style", 'value' => array('w_icon'))
			)	
		)

	) );	
	
	
	// Counter
	vc_map( array(
		"name"		=> __('Count To', 'core-extend'),
		"base"		=> "vc_counter",
		"icon"		=> "icon-wpb-vc_counter",
		"category"  => __('Premium', 'core-extend'),
		"description" => __('Animated numerical data', 'core-extend'),
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => __('Value you want to begin at', 'core-extend'),
				"param_name" => "from",
				"value" => "0",
				"description" => __('', 'core-extend')
			),			
			array(
				"type" => "textfield",
				"heading" => __('Value you want to arrive at', 'core-extend'),
				"param_name" => "to",
				"value" => "2000",
				"admin_label" => true,
				"description" => __('', 'core-extend')
			),			
			array(
				"type" => "textfield",
				"heading" => __('Duration in milliseconds', 'core-extend'),
				"param_name" => "speed",
				"value" => "1000",
				"description" => __('', 'core-extend')
			),			
			array(
				"type" => "textfield",
				"heading" => __('Interval', 'core-extend'),
				"param_name" => "interval",
				"value" => "10",
				"description" => __('How often the element should be updated', 'core-extend')
			),	
			array(
				"type" => "textfield",
				"heading" => __('Decimals', 'core-extend'),
				"param_name" => "decimals",
				"value" => "0",
				"description" => __('The number of decimal places to show', 'core-extend')
			),
			array(
				"type" => "textfield",
				"heading" => __('Extra class name', 'core-extend'),
				"param_name" => "el_class",
				"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'core-extend')
			)
		)

	) );
	
	
	// Pricing box
	vc_map( array(
	  "name"		=> __('Pricing', 'core-extend'),
	  "base"		=> "vc_pricing_box",
	  "icon"		=> "icon-wpb-vc_pricing_box",
	  "allowed_container_element" => false,
	  "is_container" => true,
	  "category"  => __('Premium', 'core-extend'),
	  "description" => __('Styled pricing boxes', 'core-extend'),
	  "params" => array(
			array(
				"type" => "textfield",
				"heading" => __( 'Title', 'core-extend' ),
				"param_name" => "title",
				"holder" => "h4",
				"description" => __( 'Give your plan a title.', 'core-extend' ),
				"value" => __( 'Starter Pack', 'core-extend' ),
			),
			array(
				"type" => "textfield",
				"heading" => __( 'Currency', 'core-extend' ),
				"param_name" => "currency",
				"holder" => "span",
				"description" => __( 'Enter currency symbol or text, e.g., $ or USD.', 'core-extend' ),
				"value" => __( '$', 'core-extend' )
			),	
			array(
				"type" => "textfield",
				"heading" => __( 'Price', 'core-extend' ),
				"param_name" => "price",
				"holder" => "span",
				"description" => __( 'Set the price for this plan.', 'core-extend' ),
				"value" => __( '10', 'core-extend' )
			),						
			array(
				"type" => "textfield",
				"heading" => __( 'Time', 'core-extend' ),
				"param_name" => "time",
				"holder" => "span",
				"description" => __( 'Choose time span for you plan, e.g., /mo, month or /yr.', 'core-extend' ),
				"value" => __( '/mo', 'core-extend' )
			),				
			array(
				"type" => "textfield",
				"heading" => __( 'Meta', 'core-extend' ),
				"param_name" => "meta",
				"holder" => "span",
				"description" => __( 'A short desciption or slogan for the plan.', 'core-extend' ),
				"value" => __( 'Great for small business', 'core-extend' )
			),
			array(
				"type" => "vc_link",
				"heading" => __( 'Add URL to the whole box (optional)', 'core-extend' ),
				"param_name" => "link",
			),
			$add_css_animation,
			$add_css_animation_delay,
			array(
				"type" => "textfield",
				"heading" => __( 'Extra class name', 'core-extend' ),
				"param_name" => "el_class",
				"description" => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'core-extend' )
			),
			array(
				"type" => "dropdown",
				"heading" => __( 'Select style', 'core-extend' ),
				"param_name" => "box_style",
				"value" => array('Minimal' => 'box-style-1', 'Strict' => 'box-style-2', 'Header' => 'box-style-3', 'Circle' => 'box-style-4'),
				"description" => __( 'Choose style for this pricing box.', 'core-extend' ),
				"group" => __('Design', 'core-extend')
			),	
			array(
				"type" => "colorpicker",
				"heading" => __( 'Background color', 'core-extend' ),
				"param_name" => "bg_color",
				"value" => "#FFFFFF",
				"description" => __( 'Set background color for pricing box body.', 'core-extend' ),
				"group" => __('Design', 'core-extend')
			),					
			array(
				"type" => "colorpicker",
				"heading" => __( 'Text color', 'core-extend' ),
				"param_name" => "color",
				"value" => "#5E5E5E",
				"description" => __( 'Set text color for pricing box content.', 'core-extend' ),
				"group" => __('Design', 'core-extend')
			),
			array(
				"type" => "colorpicker",
				"heading" => __( 'Header background color', 'core-extend' ),
				"param_name" => "header_bg",
				"value" => "#5E5E5E",
				"group" => __('Design', 'core-extend'),
				"description" =>  __( 'Set background color for box header.', 'core-extend' ),
				"dependency" => Array('element' => "box_style", 'value' => array('box-style-2', 'box-style-3', 'box-style-4') )
			),			
			array(
				"type" => "colorpicker",
				"heading" => __( 'Header text color', 'core-extend' ),
				"param_name" => "header_color",
				"value" => "#FFFFFF",
				"group" => __('Design', 'core-extend'),
				"description" => __( 'Set color for text inside box header area.', 'core-extend' ),
				"dependency" => Array('element' => "box_style", 'value' => array('box-style-2', 'box-style-3', 'box-style-4') )
			),
			array(
				"type" => "colorpicker",
				"heading" => __( 'Border color (optional)', 'core-extend' ),
				"param_name" => "border_color",
				"description" => __( 'Add border to whole box. Leave empty for no border.', 'core-extend' ),
				"group" => __('Design', 'core-extend')
			),			
			array(
				"type" => 'checkbox',
				"heading" => __( 'Add badge?', 'core-extend' ),
				"param_name" => "add_badge",
				"group" => __('Badge', 'core-extend'),
				"description" => "Adds a nice badge to your pricing box.",
				"value" => Array(__( 'Yes, please', 'core-extend' ) => 'on')
			),			
			array(
				"type" => "colorpicker",
				"heading" => __( 'Badge background color', 'core-extend' ),
				"param_name" => "badge_bg",
				"group" => __('Badge', 'core-extend'),
				"description" => __( 'Set a background color for the badge.', 'core-extend' ),
				"dependency" => Array('element' => "add_badge", 'not_empty' => true)
			),			
			array(
				"type" => "colorpicker",
				"heading" => __( 'Badge text color', 'core-extend' ),
				"param_name" => "badge_color",
				"group" => __('Badge', 'core-extend'),
				"value" => "#fff",
				"description" => __( 'Set a text color for the badge.', 'core-extend' ),
				"dependency" => Array('element' => "add_badge", 'not_empty' => true)
			),				
			array(
				"type" => "textfield",
				"heading" => __( 'Badge text', 'core-extend' ),
				"param_name" => "badge_text",
				"value" => __( 'Best Offer', 'core-extend' ),
				"group" => __('Badge', 'core-extend'),
				"description" => __( 'What do you want your badge to say? , E.g., 50% Off or Save 30%.', 'core-extend' ),
				"dependency" => Array('element' => "add_badge", 'not_empty' => true)
			),			
			array(
				"type" => "dropdown",
				"heading" => __( 'Hover effect', 'core-extend' ),
				"param_name" => "hover_effect",
				"value" => array('None' => '', 'Emphasize' => 'box-effect-1', 'Add Shadow' => 'box-effect-2', 'Emphasize + Add Shadow' => 'box-effect-3'),
				"description" => __( 'Enable and choose a hover effect.', 'core-extend' ),
				"group" => __('Effect', 'core-extend')
			),
			array(
				"type" => 'checkbox',
				"heading" => __( 'Always active? (by default only on hover state)', 'core-extend' ),
				"param_name" => "effect_active",
				"group" => __('Effect', 'core-extend'),
				"value" => Array(__( 'Yes, please', 'core-extend' ) => 'box-effect-active'),
				"description" => __( 'Use this option, if you want to accentuate one of the boxes.', 'core-extend' ),
			)			
		),
		"js_view" => 'VcPricingView'
	) );	

	// Popover
	vc_map( array(
		"name"		=> __('Popover', 'core-extend'),
		"base"		=> "vc_tooltip",
		"icon"		=> "icon-wpb-vc_popover",
		"category"  => __('Premium', 'core-extend'),
		"description" => __('Tooltip with custom content', 'core-extend'),
		"allowed_container_element" => false,
		"is_container" => true,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => __( 'Title', 'core-extend' ),
				"param_name" => "title",
				"description" => __( 'If title is left empty, title bar will be hidden', 'core-extend' )
			),				
			array(
				"type" => "textarea",
				"heading" => __( 'Popover text', 'core-extend' ),
				"param_name" => "popover_content", 
				"description" => __( 'Add some tooltip content', 'core-extend' )
			),
			array(
				"type" => "textfield",
				"heading" => __( 'Width', 'core-extend' ),
				"param_name" => "width",
				"value" => "auto",
				"description" => __( 'Enter popover width e.g. 300', 'core-extend' )
			),				
			array(
				"type" => "textfield",
				"heading" => __( 'Height', 'core-extend' ),
				"param_name" => "height",
				"value" => "auto",
				"description" => __( 'Enter popover height e.g. 200', 'core-extend' )
			),				
			array(
				"type" => "dropdown",
				"heading" => __( 'Placement', 'core-extend' ),
				"param_name" => "placement",
				"value" => array('Auto' => 'auto', 'Top' => 'top', 'Bottom' => 'bottom', 'Left' => 'left', 'Right' => 'right'),
				"description" => __( 'Choose placement for the tooltip', 'core-extend' )
			),				
			array(
				"type" => "dropdown",
				"heading" => __( 'Trigger', 'core-extend' ),
				"param_name" => "trigger",
				"value" => array('On hover' => 'hover', 'On click' => 'click'),
				"description" => __( 'Choose between on-hover or on-click trigger', 'core-extend' )
			),				
			array(
				"type" => "dropdown",
				"heading" => __( 'Style', 'core-extend' ),
				"param_name" => "style",
				"value" => array('Light' => '', 'Dark' => 'inverse'),
				"description" => __( 'What style do you prefer?', 'core-extend' )
			),				
			array(
				"type" => "textfield",
				"heading" => __( 'Extra class name', 'core-extend' ),
				"param_name" => "el_class",
				"description" => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'core-extend' )
			)	
		),
		"js_view" => 'VcTooltipView'

	) );	
	
}