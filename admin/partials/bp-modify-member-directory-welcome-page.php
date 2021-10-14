<?php
/**
 * This file is used for rendering and saving plugin welcome settings.
 *
 * @link       http://www.wbcomdesigns.com/
 * @since      1.0.0
 *
 * @package    Bp_Modify_Member_Directory
 * @subpackage Bp_Modify_Member_Directory/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
	// Exit if accessed directly.
}
?>

<div class="wbcom-tab-content">
	<div class="wbcom-welcome-main-wrapper">
		<div class="wbcom-welcome-head">
			<h2 class="wbcom-welcome-title"><?php esc_html_e( 'BuddyPress Modify Member Directory/Header', 'bp-modify-member-directory' ); ?></h2>
			<p class="wbcom-welcome-description"><?php esc_html_e( 'The plugin provides you with the ability to display important profile fields on the BuddyPress Member directory and on member profile header.', 'bp-modify-member-directory' ); ?></p>
		</div><!-- .wbcom-welcome-head -->

		<div class="wbcom-welcome-content">
			<div class="wbcom-video-link-wrapper">

			</div>

			<div class="wbcom-welcome-support-info">
				<h3><?php esc_html_e( 'Help &amp; Support Resources', 'bp-modify-member-directory' ); ?></h3>
				<p><?php esc_html_e( 'Here are all the resources you may need to get help from us. Documentation is usually the best place to start. Should you require help anytime, our customer care team is available to assist you at the support center.', 'bp-modify-member-directory' ); ?></p>
				<hr>

				<div class="three-col">

					<div class="col">
						<h3><span class="dashicons dashicons-book"></span><?php esc_html_e( 'Documentation', 'bp-modify-member-directory' ); ?></h3>
						<p><?php esc_html_e( 'We have prepared an extensive guide on BuddyPress Modify Member Directory/Header to learn all aspects of the plugin. You will find most of your answers here.', 'bp-modify-member-directory' ); ?></p>
						<a href="<?php echo esc_url( 'https://wbcomdesigns.com/docs/buddypress-free-addons/buddypress-modify-member-header-directory/' ); ?>" class="button button-primary button-welcome-support" target="_blank"><?php esc_html_e( 'Read Documentation', 'bp-modify-member-directory' ); ?></a>
					</div>

					<div class="col">
						<h3><span class="dashicons dashicons-sos"></span><?php esc_html_e( 'Support Center', 'bp-modify-member-directory' ); ?></h3>
						<p><?php esc_html_e( 'We strive to offer the best customer care via our support center. Once your theme is activated, you can ask us for help anytime.', 'bp-modify-member-directory' ); ?></p>
						<a href="<?php echo esc_url( 'https://wbcomdesigns.com/support/' ); ?>" class="button button-primary button-welcome-support" target="_blank"><?php esc_html_e( 'Get Support', 'bp-modify-member-directory' ); ?></a>
					</div>

					<div class="col">
						<h3><span class="dashicons dashicons-admin-comments"></span><?php esc_html_e( 'Got Feedback?', 'bp-modify-member-directory' ); ?></h3>
						<p><?php esc_html_e( 'We want to hear about your experience with the plugin. We would also love to hear any suggestions you may for future updates.', 'bp-modify-member-directory' ); ?></p>
						<a href="<?php echo esc_url( 'https://wbcomdesigns.com/contact/' ); ?>" class="button button-primary button-welcome-support" target="_blank"><?php esc_html_e( 'Send Feedback', 'bp-modify-member-directory' ); ?></a>
					</div>

				</div>

			</div>
		</div>

	</div><!-- .wbcom-welcome-content -->
</div><!-- .wbcom-welcome-main-wrapper -->
