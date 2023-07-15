<?php
/**
 * The template to display Admin notices
 *
 * @package THEGIG
 * @since THEGIG 1.0.64
 */

$thegig_skins_url  = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$thegig_skins_args = get_query_var( 'thegig_skins_notice_args' );
?>
<div class="thegig_admin_notice thegig_skins_notice notice notice-info is-dismissible" data-notice="skins">
	<?php
	// Theme image
	$thegig_theme_img = thegig_get_file_url( 'screenshot.jpg' );
	if ( '' != $thegig_theme_img ) {
		?>
		<div class="thegig_notice_image"><img src="<?php echo esc_url( $thegig_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'thegig' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="thegig_notice_title">
		<?php esc_html_e( 'New skins available', 'thegig' ); ?>
	</h3>
	<?php

	// Description
	$thegig_total      = $thegig_skins_args['update'];	// Store value to the separate variable to avoid warnings from ThemeCheck plugin!
	$thegig_skins_msg  = $thegig_total > 0
							// Translators: Add new skins number
							? '<strong>' . sprintf( _n( '%d new version', '%d new versions', $thegig_total, 'thegig' ), $thegig_total ) . '</strong>'
							: '';
	$thegig_total      = $thegig_skins_args['free'];
	$thegig_skins_msg .= $thegig_total > 0
							? ( ! empty( $thegig_skins_msg ) ? ' ' . esc_html__( 'and', 'thegig' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d free skin', '%d free skins', $thegig_total, 'thegig' ), $thegig_total ) . '</strong>'
							: '';
	$thegig_total      = $thegig_skins_args['pay'];
	$thegig_skins_msg .= $thegig_skins_args['pay'] > 0
							? ( ! empty( $thegig_skins_msg ) ? ' ' . esc_html__( 'and', 'thegig' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d paid skin', '%d paid skins', $thegig_total, 'thegig' ), $thegig_total ) . '</strong>'
							: '';
	?>
	<div class="thegig_notice_text">
		<p>
			<?php
			// Translators: Add new skins info
			echo wp_kses_data( sprintf( __( "We are pleased to announce that %s are available for your theme", 'thegig' ), $thegig_skins_msg ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="thegig_notice_buttons">
		<?php
		// Link to the theme dashboard page
		?>
		<a href="<?php echo esc_url( $thegig_skins_url ); ?>" class="button button-primary"><i class="dashicons dashicons-update"></i> 
			<?php
			// Translators: Add theme name
			esc_html_e( 'Go to Skins manager', 'thegig' );
			?>
		</a>
	</div>
</div>
