<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Register sidebars
*	--------------------------------------------------------------------- 
*/

function mnky_sidebars() {
	register_sidebar( array(
		'name' => __( 'Blog/Post Sidebar', 'quince' ),
		'id' => 'blog-sidebar',
		'description' => __( 'Appears on blog layout and posts', 'quince' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'quince' ),
		'id' => 'default-sidebar',
		'description' => __( 'Appears as default sidebar on pages', 'quince' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	
	
	if( ot_get_option('top_bar') != 'off' ) {
		register_sidebar( array(
			'name' => __( 'Top Bar Sidebar Left', 'quince' ),
			'id' => 'top-left-widget-area',
			'description' => __( 'Top bar widget area (align left)', 'quince' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<li class="widget-title">',
			'after_title' => '</li>',
		) );
		
		register_sidebar( array(
			'name' => __( 'Top Bar Sidebar Right', 'quince' ),
			'id' => 'top-right-widget-area',
			'description' => __( 'Top bar widget area (align right)', 'quince' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<li class="widget-title">',
			'after_title' => '</li>',
		) );
	}
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar 1', 'quince' ),
		'id' => 'footer-widget-area-1',
		'description' => __( 'Appears in the footer section', 'quince' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar 2', 'quince' ),
		'id' => 'footer-widget-area-2',
		'description' => __( 'Appears in the footer section', 'quince' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar 3', 'quince' ),
		'id' => 'footer-widget-area-3',
		'description' => __( 'Appears in the footer section', 'quince' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar 4', 'quince' ),
		'id' => 'footer-widget-area-4',
		'description' => __( 'Appears in the footer section', 'quince' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Copyright Area', 'quince' ),
		'id' => 'copyright-widget-area',
		'description' => __( 'Appears in the footer section', 'quince' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'WooCommerce Page Sidebar', 'quince' ),
		'id' => 'shop-widget-area',
		'description' => __( 'Product page widget area', 'quince' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}

add_action( 'widgets_init', 'mnky_sidebars' );

?>