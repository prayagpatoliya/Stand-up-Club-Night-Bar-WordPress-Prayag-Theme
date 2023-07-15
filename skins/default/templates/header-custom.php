<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package THEGIG
 * @since THEGIG 1.0.06
 */

$thegig_header_css   = '';
$thegig_header_image = get_header_image();
$thegig_header_video = thegig_get_header_video();
if ( ! empty( $thegig_header_image ) && thegig_trx_addons_featured_image_override( is_singular() || thegig_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$thegig_header_image = thegig_get_current_mode_image( $thegig_header_image );
}

$thegig_header_id = thegig_get_custom_header_id();
$thegig_header_meta = get_post_meta( $thegig_header_id, 'trx_addons_options', true );
if ( ! empty( $thegig_header_meta['margin'] ) ) {
	thegig_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( thegig_prepare_css_value( $thegig_header_meta['margin'] ) ) ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $thegig_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $thegig_header_id ) ) ); ?>
				<?php
				echo ! empty( $thegig_header_image ) || ! empty( $thegig_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
				if ( '' != $thegig_header_video ) {
					echo ' with_bg_video';
				}
				if ( '' != $thegig_header_image ) {
					echo ' ' . esc_attr( thegig_add_inline_css_class( 'background-image: url(' . esc_url( $thegig_header_image ) . ');' ) );
				}
				if ( is_single() && has_post_thumbnail() ) {
					echo ' with_featured_image';
				}
				if ( thegig_is_on( thegig_get_theme_option( 'header_fullheight' ) ) ) {
					echo ' header_fullheight thegig-full-height';
				}
				$thegig_header_scheme = thegig_get_theme_option( 'header_scheme' );
				if ( ! empty( $thegig_header_scheme ) && ! thegig_is_inherit( $thegig_header_scheme  ) ) {
					echo ' scheme_' . esc_attr( $thegig_header_scheme );
				}
				?>
">
	<?php

	// Background video
	if ( ! empty( $thegig_header_video ) ) {
		get_template_part( apply_filters( 'thegig_filter_get_template_part', 'templates/header-video' ) );
	}

	// Custom header's layout
	do_action( 'thegig_action_show_layout', $thegig_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'thegig_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
