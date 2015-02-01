<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Theme Setup
*	--------------------------------------------------------------------- 
*/


/* Set content width */
if ( ! isset( $content_width ) ) $content_width = 940;

/* Register menu */
register_nav_menus( array(
	'primary' => __( 'Main Navigation', 'quince' )
) );

/* Menu fallback */
function mnky_no_menu(){
	$url = admin_url( 'nav-menus.php');
	echo '<div class="menu-container"><ul class="menu"><li><a href="'. esc_url($url) .'">Click here to assign menu!</a></li></ul></div>';
}   

/* Thumbnails */
add_theme_support( 'post-thumbnails' );

/* Post formats */
add_theme_support( 'post-formats', array( 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio' ) );

/* Feeds */
add_theme_support( 'automatic-feed-links' );

/* HTML5 */
add_theme_support( 'html5', array( 'gallery', 'caption' ) );

/* Use shortcodes in text widgets */
add_filter('widget_text', 'do_shortcode');

/* Redirect to "Theme Options/Import Data" after activation */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
	wp_redirect( admin_url( 'themes.php?page=ot-theme-options#section_import_data' ) );
}

/* Extend editor */
function mnky_more_buttons($buttons) {
  $buttons[] = 'fontsizeselect';
 
  return $buttons;
}
add_filter("mce_buttons_2", "mnky_more_buttons");

/* Extend wp_title */
function mnky_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep" . sprintf( __( 'Page %s', 'quince' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'mnky_wp_title', 10, 2 );

/* Languages */
function mnky_language_setup(){
    load_theme_textdomain( 'quince', get_template_directory() . '/languages' );
}
add_action('after_setup_theme', 'mnky_language_setup');

/* Editor style */
add_editor_style('/css/editor-style.css');

?>