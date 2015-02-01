<?php
require_once vc_path_dir('SHORTCODES_DIR', 'vc-column.php');

class WPBakeryShortCode_VC_Tooltip extends WPBakeryShortCode_VC_Column {
    protected $controls_css_settings = 'out-tc vc_controls-content-widget';
	protected $controls_list = array('add', 'edit', 'clone', 'delete');

	public function __construct( $settings ) {
		parent::__construct( $settings );
	}
	
	public function mainHtmlBlockParams( $width, $i ) {
		return 'data-element_type="' . $this->settings["base"] . '" class="wpb_' . $this->settings['base'] . ' wpb_sortable wpb_content_holder wpb_content_element"' . $this->customAdminBlockParams();
	}

	public function containerHtmlBlockParams( $width, $i ) {
		return 'class="wpb_column_container vc_container_for_children"';
	}

	public function getColumnControls( $controls, $extended_css = '' ) {
		return $this->getColumnControlsModular($extended_css);
	}

}