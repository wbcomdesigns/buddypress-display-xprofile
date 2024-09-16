<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.wbcomdesigns.com/
 * @since      1.0.0
 *
 * @package    Bp_Display_Xprofile
 * @subpackage Bp_Display_Xprofile/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bp_Display_Xprofile
 * @subpackage Bp_Display_Xprofile/public
 * @author     Wbcom Designs <<admin@wbcomdesigns.com>>
 */
class Bp_Display_Xprofile_Public {

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
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bp-display-xprofile-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bp-display-xprofile-public.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Showing xprofile field on members loop page
	 */
	public function member_loop_modification_function() {
		$profile_groups      = BP_XProfile_Group::get( array( 'fetch_fields' => true ) );
		$bpmpd_fields_get_db = get_option( $this->plugin_name );
		$mergerd_loop_array  = array();

		if ( ! empty( $bpmpd_fields_get_db ) && isset( $bpmpd_fields_get_db[0] ) && is_array( $bpmpd_fields_get_db[0] ) ) {
			foreach ( $bpmpd_fields_get_db['0'] as $merged_loop_value ) {
				$mergerd_loop_array = array_merge( $mergerd_loop_array, $merged_loop_value );
			}
		} ?>

		<div class="bpmpd-fields-loop">
			<div class="bpmpd-fields-loop-inner">
				<?php
				if ( ! empty( $profile_groups ) ) {
					global $wpdb;
					$user_id = bp_get_member_user_id();
					if ( ! is_numeric( $user_id ) ) {
						return;
					}
					$xprofile_usr_fields_id = $wpdb->get_results( $wpdb->prepare( 'SELECT field_id FROM ' . $wpdb->prefix . 'bp_xprofile_data WHERE user_id=%d', $user_id ) );
					$xprofile_usr_fields_id_arr = array();

					if ( ! empty( $xprofile_usr_fields_id ) ) {
						foreach ( $xprofile_usr_fields_id as $value ) {
							$xprofile_usr_fields_id_arr[] = $value->field_id;
						}
					}

					foreach ( $profile_groups as $profile_group ) {
						if ( ! empty( $profile_group->fields ) && is_array( $profile_group->fields ) ) {
							foreach ( $profile_group->fields as $profile_field ) {
								if ( in_array( $profile_field->id, $mergerd_loop_array ) && in_array( $profile_field->id, $xprofile_usr_fields_id_arr ) ) {
									$profile_data = bp_get_member_profile_data( 'field=' . $profile_field->name );
									if ( ! empty( $profile_data ) ) { ?>
										<div>
											<span class="member-field-name members-<?php echo esc_attr( $profile_field->name ); ?>">
												<?php echo esc_html( $profile_field->name ) . ' : '; ?>
											</span>
											<span class="member-field-value members-value-<?php echo esc_attr( $profile_field->name ); ?>">
												<?php
												$xprofile_data = xprofile_get_field_data( $profile_field->name, $user_id );
												if ( is_array( $xprofile_data ) ) {
													echo wp_kses_post( implode( ', ', $xprofile_data ) );
												} else {
													echo wp_kses_post( $xprofile_data );
												}
												?>
											</span>
										</div>
										<?php
									}
								}
							}
						}
					}
				}
				?>
			</div>
		</div>
		<?php
	}

	/**
	 * Showing xprofile field on members loop page for BuddyBoss
	 */
	public function buddyboss_member_loop_modification_function() {
		$profile_groups      = BP_XProfile_Group::get( array( 'fetch_fields' => true ) );
		$bpmpd_fields_get_db = get_option( $this->plugin_name );
		$mergerd_loop_array  = array();

		if ( ! empty( $bpmpd_fields_get_db ) && isset( $bpmpd_fields_get_db[0] ) && is_array( $bpmpd_fields_get_db[0] ) ) {
			foreach ( $bpmpd_fields_get_db['0'] as $merged_loop_value ) {
				$mergerd_loop_array = array_merge( $mergerd_loop_array, $merged_loop_value );
			}
		} ?>

		<div class="bpmpd-fields-loop">
			<div class="bpmpd-fields-loop-inner">
				<?php
				if ( ! empty( $profile_groups ) ) {
					global $wpdb;
					$user_id = bp_get_member_user_id();
					if ( ! is_numeric( $user_id ) ) {
						return;
					}
					$xprofile_usr_fields_id = $wpdb->get_results( $wpdb->prepare( 'SELECT field_id FROM ' . $wpdb->prefix . 'bp_xprofile_data WHERE user_id=%d', $user_id ) );
					$xprofile_usr_fields_id_arr = array();

					if ( ! empty( $xprofile_usr_fields_id ) ) {
						foreach ( $xprofile_usr_fields_id as $value ) {
							$xprofile_usr_fields_id_arr[] = $value->field_id;
						}
					}

					foreach ( $profile_groups as $profile_group ) {
						if ( ! empty( $profile_group->fields ) && is_array( $profile_group->fields ) ) {
							foreach ( $profile_group->fields as $profile_field ) {
								if ( in_array( $profile_field->id, $mergerd_loop_array ) && in_array( $profile_field->id, $xprofile_usr_fields_id_arr ) ) {
									$profile_data = bp_get_member_profile_data( 'field=' . $profile_field->name );
									if ( ! empty( $profile_data ) ) { ?>
										<div>
											<span class="member-field-name members-<?php echo esc_attr( $profile_field->name ); ?>">
												<?php echo esc_html( $profile_field->name ) . ' : '; ?>
											</span>
											<span class="member-field-value members-value-<?php echo esc_attr( $profile_field->name ); ?>">
												<?php
												$xprofile_data = xprofile_get_field_data( $profile_field->name, $user_id );
												if ( is_array( $xprofile_data ) ) {
													echo wp_kses_post( implode( ', ', $xprofile_data ) );
												} else {
													echo wp_kses_post( $xprofile_data );
												}
												?>
											</span>
										</div>
										<?php
									}
								}
							}
						}
					}
				}
				?>
			</div>
		</div>
		<?php
	}

	/**
	 * Showing xprofile fields on member's header cover image
	 */
	public function member_header_modification_function() {
		$profile_groups       = BP_XProfile_Group::get( array( 'fetch_fields' => true ) );
		$bpmpd_fields_get_db  = get_option( $this->plugin_name );
		$mergerd_member_array = array();

		if ( ! empty( $bpmpd_fields_get_db ) && isset( $bpmpd_fields_get_db['1'] ) && is_array( $bpmpd_fields_get_db['1'] ) ) {
			foreach ( $bpmpd_fields_get_db['1'] as $merged_member_value ) {
				$mergerd_member_array = array_merge( $mergerd_member_array, $merged_member_value );
			}
		} ?>

		<div class="bpmpd-fields-member">
			<div class="bpmpd-fields-member-inner">
				<?php
				if ( ! empty( $profile_groups ) ) {
					global $wpdb;
					$user_id = bp_displayed_user_id();
					if ( ! is_numeric( $user_id ) ) {
						return;
					}
					$xprofile_usr_fields_id = $wpdb->get_results( $wpdb->prepare( 'SELECT field_id FROM ' . $wpdb->prefix . 'bp_xprofile_data WHERE user_id=%d', $user_id ) );
					$xprofile_usr_fields_id_arr = array();
					if ( ! empty( $xprofile_usr_fields_id ) ) {
						foreach ( $xprofile_usr_fields_id as $value ) {
							$xprofile_usr_fields_id_arr[] = $value->field_id;
						}
					}

					foreach ( $profile_groups as $profile_group ) {
						if ( ! empty( $profile_group->fields ) && is_array( $profile_group->fields ) ) {
							foreach ( $profile_group->fields as $profile_field ) {
								if ( in_array( $profile_field->id, $mergerd_member_array ) && in_array( $profile_field->id, $xprofile_usr_fields_id_arr ) ) {
									$profile_data = bp_get_member_profile_data( 'field=' . $profile_field->name );
									if ( ! empty( $profile_data ) ) { ?>
										<div>
											<span class="member-field-name members-<?php echo esc_attr( $profile_field->name ); ?>">
												<?php echo esc_html( $profile_field->name ) . ' : '; ?>
											</span>
											<span class="member-field-value members-value-<?php echo esc_attr( $profile_field->name ); ?>">
												<?php
												$xprofile_data = xprofile_get_field_data( $profile_field->name, $user_id );
												if ( is_array( $xprofile_data ) ) {
													echo wp_kses_post( implode( ', ', $xprofile_data ) );
												} else {
													echo wp_kses_post( $xprofile_data );
												}
												?>
											</span>
										</div>
										<?php
									}
								}
							}
						}
					}
				}
				?>
			</div>
		</div>
		<?php
	}
}
