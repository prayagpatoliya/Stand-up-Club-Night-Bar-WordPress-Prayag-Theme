<?php
/**
 * The template to display Admin notices
 *
 * @package THEGIG
 * @since THEGIG 1.0.1
 */

$thegig_theme_slug = get_option( 'template' );
$thegig_theme_obj  = wp_get_theme( $thegig_theme_slug );
?>
<div class="thegig_admin_notice thegig_welcome_notice notice notice-info is-dismissible" data-notice="admin">
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
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'thegig' ),
				$thegig_theme_obj->get( 'Name' ) . ( THEGIG_THEME_FREE ? ' ' . __( 'Free', 'thegig' ) : '' ),
				$thegig_theme_obj->get( 'Version' )
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="thegig_notice_text">
		<p class="thegig_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $thegig_theme_obj->description ) );
			?>
		</p>
		<p class="thegig_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'thegig' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="thegig_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=thegig_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'thegig' );
			?>
		</a>
	</div>
</div>
