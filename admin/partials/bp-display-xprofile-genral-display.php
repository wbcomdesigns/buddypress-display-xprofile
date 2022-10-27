<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.wbcomdesigns.com/
 * @since      1.0.0
 *
 * @package    Bp_Display_Xprofile
 * @subpackage Bp_Display_Xprofile/admin/partials
 */

$profile_groups = BP_XProfile_Group::get( array( 'fetch_fields' => true ) );

// Submitting form on admin page and saving to DB.

if ( isset( $_POST['bpmpd-fields-submit'] ) && check_admin_referer( 'bpmpd_fields_nonce_action', 'bpmpd_fields_nonce_value' ) ) :
	$bpmpd_fields_loops = array();

	if ( ! empty( $profile_groups ) ) {
		foreach ( $profile_groups as $profile_group ) {
			$bpmpd_fields_loops[ $profile_group->id ] = isset( $_POST[ $profile_group->id . '-loop' ] ) ? filter_input( INPUT_POST, $profile_group->id . '-loop', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY ) : array();
		}
	}

	if ( is_array( $bpmpd_fields_loops ) ) {
		foreach ( $bpmpd_fields_loops as $loop_key => $bpmpd_fields_loop ) {
			foreach ( $bpmpd_fields_loop as $loop_key_1 => $loop_value ) {
				filter_var( $bpmpd_fields_loops[ $loop_key ][ $loop_key_1 ], FILTER_SANITIZE_NUMBER_INT );
			}
		}
	}

	$bpmpd_fields_single_members = array();

	if ( ! empty( $profile_groups ) ) {
		foreach ( $profile_groups as $profile_group ) {
			$bpmpd_fields_single_members[ $profile_group->id ] = isset( $_POST[ $profile_group->id . '-single' ] ) ? filter_input( INPUT_POST, $profile_group->id . '-single', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY ) : array();
		}
	}

	if ( is_array( $bpmpd_fields_single_members ) ) {
		foreach ( $bpmpd_fields_single_members as $single_key => $bpmpd_fields_single_member ) {
			foreach ( $bpmpd_fields_single_member as $single_key_1 => $single_value_ ) {
				filter_var( $bpmpd_fields_single_members[ $single_key ][ $single_key_1 ], FILTER_SANITIZE_NUMBER_INT );
			}
		}
	}

	// Updating database.

	$bpmpd_fields_db = array();
	array_push( $bpmpd_fields_db, $bpmpd_fields_loops );
	array_push( $bpmpd_fields_db, $bpmpd_fields_single_members );
	update_option( $this->plugin_name, $bpmpd_fields_db );

endif;
?>

<?php
$bpmpd_fields_get_db = get_option( $this->plugin_name );

$mergerd_loop_array = array();
if ( ! empty( $bpmpd_fields_get_db ) ) {
	foreach ( $bpmpd_fields_get_db['0'] as $merged_loop_value ) {
		$mergerd_loop_array = array_merge( $mergerd_loop_array, $merged_loop_value );
	}

	$mergerd_single_array = array();

	foreach ( $bpmpd_fields_get_db['1'] as $merged_single_value ) {
		$mergerd_single_array = array_merge( $mergerd_single_array, $merged_single_value );
	}
}
?>
<div class="wbcom-tab-content">
<div class="wbcom-wrapper-admin">	
<div class="wbcom-admin-title-section">
	<h3><?php esc_html_e( 'General Settings', 'bp-display-xprofile' ); ?></h3>
</div>
<div class="wbcom-admin-option-wrap wbcom-admin-option-wrap-view">
<form method="post" action="" class="bpmmd-general-settings">
	<?php wp_nonce_field( 'bpmpd_fields_nonce_action', 'bpmpd_fields_nonce_value' ); ?>
	<h3 class="members-loop"><?php esc_html_e( 'Select fields from each group to show on member\'s loop page', 'bp-display-xprofile' ); ?>
	</h3>
	<div class="wbcom-settings-section-wrap" >
	<?php
	if ( ! empty( $profile_groups ) ) :
		$i = 1;
		foreach ( $profile_groups as $profile_group ) :
			?>
		<div class="wbcom-settings-section-options-heading">
			<label class="field-description" >
			<?php
			esc_html_e( 'Field Group : ', 'bp-display-xprofile' );
			echo esc_html( $profile_group->name );
			?>
		</label></div>
			<?php if ( ! empty( $profile_group->fields ) ) : ?>
			<table class="bpmpd-fields">
				<?php foreach ( $profile_group->fields as $field ) : ?>
				<tr>
				<td>
					<input type="checkbox" name="<?php echo esc_attr( $profile_group->id ); ?>-loop[]" value="<?php echo esc_attr( $field->id ); ?>" <?php echo ( isset( $bpmpd_fields_get_db['0'] ) && in_array( $field->id, $mergerd_loop_array ) ) ? 'checked' : ''; ?>>
					<?php echo esc_html( $field->name ); ?>
				</td>
				</tr>
			<?php endforeach; ?>

			</table>

				<?php
			endif;
			$i++;
			?>
		<?php endforeach; ?>
		</div>
	<h3><?php esc_html_e( 'Select fields from each group to show on single member\'s page', 'bp-display-xprofile' ); ?>
	</h3>
	<div class="wbcom-settings-section-wrap" >
		<?php
		$j = 1;
		foreach ( $profile_groups as $profile_group ) :
			?>
			<div class="wbcom-settings-section-options-heading">
				<label class="field-description" >
					<?php
					esc_html_e( 'Field Group : ', 'bp-display-xprofile' );
					echo esc_html_e( $profile_group->name );
					?>
			</label>
			</div>
			<?php if ( ! empty( $profile_group->fields ) ) : ?>
			<table class="bpmpd-fields">
				<?php foreach ( $profile_group->fields as $field ) : ?>
				<tr>
				<td>
					<input type="checkbox" name="<?php echo esc_attr( $profile_group->id ); ?>-single[]" value="<?php echo esc_attr( $field->id ); ?>" <?php echo ( isset( $bpmpd_fields_get_db['1'] ) && in_array( $field->id, $mergerd_single_array ) ) ? 'checked' : ''; ?>><?php echo esc_html_e( $field->name ); ?>
				</td>
				</tr>
			<?php endforeach; ?>
			</table>
				<?php
			endif;
			$j++;
			?>
		<?php endforeach; ?>
		</div>
<?php endif; ?>
	<div class="submit">
	<input type="submit" name="bpmpd-fields-submit" value="<?php esc_html_e( 'Save Settings', 'bp-display-xprofile' ); ?>" class="button button-primary">
</div>
</form>
</div>
</div>
</div>
