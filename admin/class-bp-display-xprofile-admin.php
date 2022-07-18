<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.wbcomdesigns.com/
 * @since      1.0.0
 *
 * @package    Bp_Display_Xprofile
 * @subpackage Bp_Display_Xprofile/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bp_Display_Xprofile
 * @subpackage Bp_Display_Xprofile/admin
 * @author     Wbcom Designs <<admin@wbcomdesigns.com>>
 */
class Bp_Display_Xprofile_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bp_Display_Xprofile_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bp_Display_Xprofile_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( 'jquery-ui-css', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bp_Display_Xprofile_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bp_Display_Xprofile_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( ! wp_script_is( 'jquery-ui-accordion', 'enqueued' ) ) {
			wp_enqueue_script( 'jquery-ui-accordion' );
		}

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bp-display-xprofile-admin.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Register admin menu page for plugin
	 *
	 * @since    1.0.0
	 * @access   public
	 * @author   Wbcom Designs
	 */
	public function bpmmd_admin_menu() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bp_Xprofile_Export_Import_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bp_Xprofile_Export_Import_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( empty( $GLOBALS['admin_page_hooks']['wbcomplugins'] ) ) {
			add_menu_page( esc_html__( 'WB Plugins', 'bp-display-xprofile' ), esc_html__( 'WB Plugins', 'bp-display-xprofile' ), 'manage_options', 'wbcomplugins', array( $this, 'bp_modify_profile_directory_setting_page' ), 'dashicons-lightbulb', 59 );
			add_submenu_page( 'wbcomplugins', esc_html__( 'General', 'bp-display-xprofile' ), esc_html__( 'General', 'bp-display-xprofile' ), 'manage_options', 'wbcomplugins' );
		}

		add_submenu_page( 'wbcomplugins', esc_html__( 'BP Display xProfile', 'bp-display-xprofile' ), esc_html__( 'BP Display xProfile', 'bp-display-xprofile' ), 'manage_options', 'bp-modify-directory', array( $this, 'bp_modify_profile_directory_setting_page' ) );

	}


	/**
		 * Hide all notices from the setting page.
		 *
		 * @return void
		 */
		public function wbcom_hide_all_admin_notices_from_setting_page() {
			$wbcom_pages_array  = array( 'wbcomplugins', 'wbcom-plugins-page', 'wbcom-support-page', 'bp-modify-directory' );
			$wbcom_setting_page = filter_input( INPUT_GET, 'page' ) ? filter_input( INPUT_GET, 'page' ) : '';

			if ( in_array( $wbcom_setting_page, $wbcom_pages_array, true ) ) {
				remove_all_actions( 'admin_notices' );
				remove_all_actions( 'all_admin_notices' );
			}

		}


	/**
	 * Callback function for bp member xprofile export import settings page.
	 *
	 * @since 1.0.0
	 */
	public function bp_modify_profile_directory_setting_page() {
		$current = filter_input( INPUT_GET, 'tab' ) ? filter_input( INPUT_GET, 'tab' ) : 'bpmmd_welcome';
		?>
		<div class="wrap">
				<div class="wbcom-bb-plugins-offer-wrapper">
				<div id="wb_admin_logo">
					<a href="https://wbcomdesigns.com/downloads/buddypress-community-bundle/" target="_blank">
						<img src="<?php echo esc_url( BPMMD_PLUGIN_URL ) . 'admin/wbcom/assets/imgs/wbcom-offer-notice.png'; ?>">
					</a>
				</div>
			</div>
		<div class="wbcom-wrap bp-member-blog-wrap">
			<div class="blpro-header">
					<div class="wbcom_admin_header-wrapper">
						<div id="wb_admin_plugin_name">
							<?php esc_html_e( 'BP Display xProfile', 'bp-display-xprofile' ); ?>
							<span><?php printf( __( 'Version %s', 'bp-display-xprofile' ), BPMMD_PLUGIN_VERSION ); ?></span>
						</div>
						<?php echo do_shortcode( '[wbcom_admin_setting_header]' ); ?>
					</div>
				</div>
		<div class="wbcom-admin-settings-page">
		<?php
		$bpmmd_tabs = array(
			'bpmmd_welcome'          => __( 'Welcome', 'bp-display-xprofile' ),
			'bpmmd_general_settings' => __( 'General', 'bp-display-xprofile' ),
			'bpmmd_faq'              => __( 'FAQ', 'bp-display-xprofile' ),
		);

		$tab_html = '<div class="wbcom-tabs-section"><div class="nav-tab-wrapper"><div class="wb-responsive-menu"><span>' . esc_html( 'Menu' ) . '</span><input class="wb-toggle-btn" type="checkbox" id="wb-toggle-btn"><label class="wb-toggle-icon" for="wb-toggle-btn"><span class="wb-icon-bars"></span></label></div><ul>';
		foreach ( $bpmmd_tabs as $bpmmd_tab => $bpmmd_name ) {
			$class     = ( $bpmmd_tab === $current ) ? 'nav-tab-active' : '';
			$tab_html .= '<li class="' . esc_attr( $bpmmd_tab ) . '"><a class="nav-tab ' . $class . '" href="admin.php?page=bp-modify-directory&tab=' . $bpmmd_tab . '">' . $bpmmd_name . '</a></li>';
		}
		$tab_html .= '</div></ul></div>';
		echo wp_kses_post( $tab_html );
		wp_cache_flush();
		$this->bpmmd_plugin_option_pages();
		echo '</div>'; /* closing of div class wbcom-admin-settings-page */
		echo '</div>'; /* closing div class wrap */
		echo '</div>'; /* closing div class wrap */
	}


	/**
	 * Get desired options page file at admin settings end.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @author   Wbcom Designs
	 */
	public function bpmmd_plugin_option_pages() {
			$bpxp_tab = filter_input( INPUT_GET, 'tab' ) ? filter_input( INPUT_GET, 'tab' ) : 'bpmmd_welcome';
			$this->bpmmd_include_admin_setting_tabs( $bpxp_tab );
	}

	/**
	 * Include setting template.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @author   Wbcom Designs
	 * @param current $current current.
	 */
	public function bpmmd_include_admin_setting_tabs( $current ) {
		$bpmmd = filter_input( INPUT_GET, 'tab' ) ? filter_input( INPUT_GET, 'tab' ) : $current;
		switch ( $bpmmd ) {
			case 'bpmmd_welcome':
				$this->bpmmd_welcome_section();
				break;
			case 'bpmmd_general_settings':
				$this->bpmmd_general_settings_section();
				break;
			case 'bpmmd_faq':
				$this->bpmmd_faq_section();
				break;
			default:
				$this->bpmmd_welcome_section();
				break;
		}
	}

	/**
	 * Bpmmd_welcome_section
	 */
	public function bpmmd_welcome_section() {
		include BPMMD_PLUGIN_PATH . 'admin/partials/bp-display-xprofile-welcome-page.php';
	}
	/**
	 * Include admin genral setting tab.
	 */
	public function bpmmd_general_settings_section() {
		include BPMMD_PLUGIN_PATH . 'admin/partials/bp-display-xprofile-genral-display.php';

	}

	/**
	 * Include admin faq section tab.
	 */
	public function bpmmd_faq_section() {
		include BPMMD_PLUGIN_PATH . 'admin/partials/bp-display-xprofile-faq-display.php';
	}

}
