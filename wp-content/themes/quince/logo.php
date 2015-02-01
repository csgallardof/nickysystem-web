<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Template part: page title & before content area
*	--------------------------------------------------------------------- 
*/
	

// Logo URLs	
$default_logo = ot_get_option('logo');
$retina_logo = ot_get_option('logo_retina');
$overlay_default_logo = ot_get_option('overlay_header_logo');
$overlay_retina_logo = ot_get_option('overlay_header_logo_retina');

// Logo output
if ( is_page() && ot_get_option('overlay_header') != 'off' && ( in_array( get_the_ID(), ot_get_option('overlay_header_pages', array()) ) && $overlay_default_logo != '' ) ){ 
	if ($overlay_retina_logo ){
		echo '<a href="'. home_url() .'">
				<img src="'. esc_attr($overlay_default_logo) .'" alt="', esc_attr(bloginfo('name')) .'" class="default-logo" />
				<img src="'. esc_attr($overlay_retina_logo) .'" width="'. esc_attr(str_replace( "px", "", ot_get_option('retina_logo_width') )) .'" height="'. esc_attr(str_replace( "px", "",ot_get_option('retina_logo_height') )) .'" alt="', esc_attr(bloginfo('name')) .'" class="retina-logo" />
			</a>';
	} else {
		echo '<a href="'. esc_url(home_url()) .'"><img src="'. esc_attr($overlay_default_logo) .'" alt="', esc_attr(bloginfo('name')) .'" /></a>';
	}

} else {	
	if ($default_logo != ''){
		if ($retina_logo ){
			echo '<a href="'. home_url() .'">
					<img src="'. esc_attr($default_logo) .'" alt="', esc_attr(bloginfo('name')) .'" class="default-logo" />
					<img src="'. esc_attr($retina_logo) .'" width="'. esc_attr(str_replace( "px", "", ot_get_option('retina_logo_width') )) .'" height="'. esc_attr(str_replace( "px", "",ot_get_option('retina_logo_height') )) .'" alt="', esc_attr(bloginfo('name')) .'" class="retina-logo" />
				</a>';
		} else {
			echo '<a href="'. esc_url(home_url()) .'"><img src="'. esc_attr($default_logo) .'" alt="', esc_attr(bloginfo('name')) .'" /></a>';
		}
	} else {
		echo '<h1 class="site-title"><a href="'. esc_url(home_url()) .'" title="', esc_attr(bloginfo('name')) .'" rel="home">', bloginfo('name') .'</a></h1>';
	}
}
