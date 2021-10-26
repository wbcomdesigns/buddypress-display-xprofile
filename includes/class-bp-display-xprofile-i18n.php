<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.wbcomdesigns.com/
 * @since      1.0.0
 *
 * @package    Bp_Display_Xprofile
 * @subpackage Bp_Display_Xprofile/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Bp_Display_Xprofile
 * @subpackage Bp_Display_Xprofile/includes
 * @author     Wbcom Designs <<admin@wbcomdesigns.com>>
 */
class Bp_Display_Xprofile_I18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'bp-display-xprofile',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
