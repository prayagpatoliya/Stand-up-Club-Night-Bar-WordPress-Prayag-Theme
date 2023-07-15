<?php
/**
 * The template to display the site logo in the footer
 *
 * @package THEGIG
 * @since THEGIG 1.0.10
 */

// Logo
if ( thegig_is_on( thegig_get_theme_option( 'logo_in_footer' ) ) ) {
	$thegig_logo_image = thegig_get_logo_image( 'footer' );
	$thegig_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $thegig_logo_image['logo'] ) || ! empty( $thegig_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $thegig_logo_image['logo'] ) ) {
					$thegig_attr = thegig_getimagesize( $thegig_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $thegig_logo_image['logo'] ) . '"'
								. ( ! empty( $thegig_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $thegig_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'thegig' ) . '"'
								. ( ! empty( $thegig_attr[3] ) ? ' ' . wp_kses_data( $thegig_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $thegig_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $thegig_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
