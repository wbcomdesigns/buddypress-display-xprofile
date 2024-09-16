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
 * Defines the plugin name, version, and hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bp_Display_Xprofile
 * @subpackage Bp_Display_Xprofile/admin
 * @author     Wbcom Designs
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
	 * @param string $plugin_name       The name of this plugin.
	 * @param string $version    The version of this plugin.
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
		wp_enqueue_style( 'jquery-ui-css', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.min.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		if ( ! wp_script_is( 'jquery-ui-accordion', 'enqueued' ) ) {
			wp_enqueue_script( 'jquery-ui-accordion' );
		}
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bp-display-xprofile-admin.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Register admin menu page for plugin.
	 *
	 * @since    1.0.0
	 */
	public function bpmmd_admin_menu() {
		if ( empty( $GLOBALS['admin_page_hooks']['wbcomplugins'] ) ) {
			add_menu_page(
				esc_html__( 'WB Plugins', 'bp-display-xprofile' ),
				esc_html__( 'WB Plugins', 'bp-display-xprofile' ),
				'manage_options',
				'wbcomplugins',
				array( $this, 'bp_modify_profile_directory_setting_page' ),
				'dashicons-lightbulb',
				59
			);
			add_submenu_page(
				'wbcomplugins',
				esc_html__( 'General', 'bp-display-xprofile' ),
				esc_html__( 'General', 'bp-display-xprofile' ),
				'manage_options',
				'wbcomplugins'
			);
		}

		add_submenu_page(
			'wbcomplugins',
			esc_html__( 'BP Display xProfile', 'bp-display-xprofile' ),
			esc_html__( 'BP Display xProfile', 'bp-display-xprofile' ),
			'manage_options',
			'bp-modify-directory',
			array( $this, 'bp_modify_profile_directory_setting_page' )
		);
	}

	/**
	 * Hide all admin notices from the plugin's setting page.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function wbcom_hide_all_admin_notices_from_setting_page() {
		$wbcom_pages_array  = array( 'wbcomplugins', 'wbcom-plugins-page', 'wbcom-support-page', 'bp-modify-directory' );
		$wbcom_setting_page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );

		if ( in_array( $wbcom_setting_page, $wbcom_pages_array, true ) ) {
			remove_all_actions( 'admin_notices' );
			remove_all_actions( 'all_admin_notices' );
		}
	}

	/**
	 * Callback function for the settings page.
	 *
	 * @since 1.0.0
	 */
	public function bp_modify_profile_directory_setting_page() {
		$current_tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING ) ?: 'bpmmd_welcome';
		?>
		<div class="wrap">
			<div class="wbcom-bb-plugins-offer-wrapper">
				<div id="wb_admin_logo">
					<a href="https://wbcomdesigns.com/downloads/buddypress-community-bundle/?utm_source=pluginoffernotice&utm_medium=community_banner" target="_blank">
						<img src="<?php echo esc_url( BPMMD_PLUGIN_URL . 'admin/wbcom/assets/imgs/wbcom-offer-notice.png' ); ?>" alt="<?php esc_attr_e( 'Wbcom Offer Notice', 'bp-display-xprofile' ); ?>">
					</a>
				</div>
			</div>
			<div class="wbcom-wrap bp-member-blog-wrap">
				<div class="blpro-header">
					<div class="wbcom_admin_header-wrapper">
						<div id="wb_admin_plugin_name">
							<?php esc_html_e( 'BP Display xProfile', 'bp-display-xprofile' ); ?>
							<span><?php printf( esc_html__( 'Version %s', 'bp-display-xprofile' ), esc_attr( BPMMD_PLUGIN_VERSION ) ); ?></span>
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
						$class     = ( $bpmmd_tab === $current_tab ) ? 'nav-tab-active' : '';
						$tab_html .= '<li class="' . esc_attr( $bpmmd_tab ) . '"><a class="nav-tab ' . esc_attr( $class ) . '" href="admin.php?page=bp-modify-directory&tab=' . esc_attr( $bpmmd_tab ) . '">' . esc_html( $bpmmd_name ) . '</a></li>';
					}
					$tab_html .= '</div></ul></div>';
					echo wp_kses_post( $tab_html );

					$this->bpmmd_plugin_option_pages();
					?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Get the desired options page at admin settings.
	 *
	 * @since    1.0.0
	 */
	public function bpmmd_plugin_option_pages() {
		$current_tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING ) ?: 'bpmmd_welcome';
		$this->bpmmd_include_admin_setting_tabs( $current_tab );
	}

	/**
	 * Include the setting template based on the current tab.
	 *
	 * @since    1.0.0
	 * @param string $current_tab Current tab.
	 */
	public function bpmmd_include_admin_setting_tabs( $current_tab ) {
		switch ( $current_tab ) {
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
	 * Display the welcome section of the settings page.
	 *
	 * @since 1.0.0
	 */
	public function bpmmd_welcome_section() {
		include BPMMD_PLUGIN_PATH . 'admin/partials/bp-display-xprofile-welcome-page.php';
	}

	/**
	 * Display the general settings section.
	 *
	 * @since 1.0.0
	 */
	public function bpmmd_general_settings_section() {
		include BPMMD_PLUGIN_PATH . 'admin/partials/bp-display-xprofile-genral-display.php';
	}

	/**
	 * Display the FAQ section.
	 *
	 * @since 1.0.0
	 */
	public function bpmmd_faq_section() {
		include BPMMD_PLUGIN_PATH . 'admin/partials/bp-display-xprofile-faq-display.php';
	}
}
