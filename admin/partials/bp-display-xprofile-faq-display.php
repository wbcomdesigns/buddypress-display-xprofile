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

?>

<div class="wbcom-tab-content">
<div class="wbcom-faq-adming-setting">
	<div class="wbcom-admin-title-section">
		<h3><?php esc_html_e( 'Have some questions?', 'bp-display-xprofile' ); ?></h3>
	</div>
<div class="wbcom-faq-admin-settings-block">
<div id="wbcom-faq-settings-section" class="wb-ads-table">
	<div class="wbcom-faq-admin-row">
		<div class="wbcom-faq-section-row">
			<button class="wbcom-faq-accordion">
				<?php esc_html_e( 'Is this plugin requires another plugin?', 'bp-display-xprofile' ); ?>
			</button>
			<div class="wbcom-faq-panel">
				<p>
					<?php esc_html_e( 'Yes, this plugin requires BuddyPress plugin.', 'bp-display-xprofile' ); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="wbcom-faq-admin-row">
		<div class="wbcom-faq-section-row">
			<button class="wbcom-faq-accordion">
				<?php esc_html_e( 'What does this plugin work?', 'bp-display-xprofile' ); ?>
			</button>
			<div class="wbcom-faq-panel">
				<p>
					<?php esc_html_e( 'This plugin adds option for admin to select which xprofile field will be displayed inside members loop and on profile header.', 'bp-display-xprofile' ); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="wbcom-faq-admin-row">
		<div class="wbcom-faq-section-row">
			<button class="wbcom-faq-accordion">
				<?php esc_html_e( 'How to display some xprofile field inside BuddyPress members loop?', 'bp-display-xprofile' ); ?>
			</button>
			<div class="wbcom-faq-panel">
				<p>
					<?php esc_html_e( 'This plugin includes settings to display xprofile fields with field group name, here you can enable those fields which you want to display inside members loop.', 'bp-display-xprofile' ); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="wbcom-faq-admin-row">
		<div class="wbcom-faq-section-row">
			<button class="wbcom-faq-accordion">
				<?php esc_html_e( 'How to display some xprofile field on BuddyPress single page profile header?', 'bp-display-xprofile' ); ?>
			</button>
			<div class="wbcom-faq-panel">
				<p>
					<?php esc_html_e( 'This plugin includes settings to display xprofile fields with field group name, here you can enable those fields which you want to display on BuddyPress single page profile header.', 'bp-display-xprofile' ); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="wbcom-faq-admin-row">
		<div class="wbcom-faq-section-row">
			<button class="wbcom-faq-accordion">
				<?php esc_html_e( 'Where do I ask for support?', 'bp-display-xprofile' ); ?>
			</button>
			<div class="wbcom-faq-panel">
				<p>
					<?php
					/* translators: %s: http://wbcomdesigns.com/contact */
					$text = sprintf(
					/* translators: %s: */
						__( 'Please visit <a href="%s"  rel="nofollow" target="_blank">Wbcom Designs</a> for any query related to plugin and BuddyPress.', 'bp-display-xprofile' ),
						__( 'http://wbcomdesigns.com/contact', 'bp-display-xprofile' )
					);
					echo wp_kses_post( $text );
					?>
				</p>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
