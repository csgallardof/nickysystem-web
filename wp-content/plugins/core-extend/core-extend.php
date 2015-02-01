<?php
/*
Plugin Name: MNKY | Theme Core Extend
Plugin URI: http://themeforest.net/user/MNKY
Description: Extend Theme and Visual Composer features.
Version: 1.0.0
Author: MNKY
Author URI: http://mnkythemes.com/
License: Envato Marketplaces Split Licence
License URI: Envato Marketplace Item License Certificate 
*/


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) die;


class MNKY_Core_Extend {
	
	function __construct() {
		require_once ( 'include/aq_resizer.php' );
		require_once ( 'include/Mobile_Detect.php' );
		require_once ( 'include/portfolio_post_type.php' );
		$this->_constants();
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}
	
	protected function _constants() {
		define( 'MNKY_PLUGIN_MAIN', __FILE__);
		define( 'MNKY_PLUGIN_PATH', plugin_dir_path(__FILE__) );
		define( 'MNKY_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	}
	
	public function init() { 
		load_plugin_textdomain( 'core-extend', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 

		if ( ! function_exists( 'vc_map' ) ) {
			add_action('admin_notices', array( $this, 'vc_error' ) ); 
		} else {
			$this->vc_edit();
			add_action('wp_enqueue_scripts', array( $this, 'vc_scripts' ) );
			add_action( 'init', array( $this, 'remove_vc_options' ) );
		}
	}

	// Display notice if Visual Composer is not installed or activated
	public function vc_error() {
		echo '
		<div class="updated">
			<p>'. __( '<strong>MNKY | Theme Core Extend</strong> requires Visual Composer plugin to be installed and activated on your site.', 'core-extend' ) .'</p>
		</div>';
	}
	
	// Enqueue scripts
	public function vc_scripts() {
		wp_register_style( 'core-extend', MNKY_PLUGIN_URL . 'assets/css/core-extend.css', array('js_composer_front') );
		wp_register_style( 'font-awesome', MNKY_PLUGIN_URL . 'assets/css/font-awesome.css', false, '', 'all' );

		wp_enqueue_style( 'core-extend' );
		wp_enqueue_style( 'font-awesome' );
	}
	
	// Disable VC design options
	public function remove_vc_options() {
		vc_set_as_theme($notifier = false);
	}
	
	// Extend & configure VC	
	public function vc_edit() { 
		
		// Set shortcode template dir
		$dir = MNKY_PLUGIN_PATH . '/include/templates/shortcodes/';
		vc_set_template_dir($dir);
		
		// Disable VC front-end editor
		vc_disable_frontend();
		
		// Remove VC elements
		vc_remove_element('vc_text_separator');
		vc_remove_element('vc_gallery');
		vc_remove_element('vc_posts_slider');
		vc_remove_element('vc_carousel');
		vc_remove_element('vc_posts_grid');
		vc_remove_element('vc_cta_button');
		vc_remove_element('vc_cta_button2');
		
		// Add params
		require_once ('include/params/params.php');
		
		// Add shortcodes
		require_once ('include/classes/heading.php');	
		require_once ('include/classes/team.php');
		require_once ('include/classes/testimonials.php');
		require_once ('include/classes/icon.php');
		require_once ('include/classes/list.php');
		require_once ('include/classes/service.php');
		require_once ('include/classes/colored-box.php');	
		require_once ('include/classes/counter.php');	
		require_once ('include/classes/pricing-box.php');	
		require_once ('include/classes/tooltip.php');	
		
		// Edit VC map
		require_once ('config/map.php');
	}
}
$mnky_core_extend = new MNKY_Core_Extend();