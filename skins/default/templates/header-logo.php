<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package THEGIG
 * @since THEGIG 1.0
 */

$thegig_args = get_query_var( 'thegig_logo_args' );

// Site logo
$thegig_logo_type   = isset( $thegig_args['type'] ) ? $thegig_args['type'] : '';
$thegig_logo_image  = thegig_get_logo_image( $thegig_logo_type );
$thegig_logo_text   = thegig_is_on( thegig_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$thegig_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $thegig_logo_image['logo'] ) || ! empty( $thegig_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $thegig_logo_image['logo'] ) ) {
			if ( empty( $thegig_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric($thegig_logo_image['logo']) && (int) $thegig_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$thegig_attr = thegig_getimagesize( $thegig_logo_image['logo'] );
				echo '<img src="' . esc_url( $thegig_logo_image['logo'] ) . '"'
						. ( ! empty( $thegig_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $thegig_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $thegig_logo_text ) . '"'
						. ( ! empty( $thegig_attr[3] ) ? ' ' . wp_kses_data( $thegig_attr[3] ) : '' )
						. '>';
			}
		} else {
			thegig_show_layout( thegig_prepare_macros( $thegig_logo_text ), '<span class="logo_text">', '</span>' );
			thegig_show_layout( thegig_prepare_macros( $thegig_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
