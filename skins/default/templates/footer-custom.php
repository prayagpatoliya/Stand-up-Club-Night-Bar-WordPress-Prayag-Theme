<?php
/**
 * The template to display default site footer
 *
 * @package THEGIG
 * @since THEGIG 1.0.10
 */

$thegig_footer_id = thegig_get_custom_footer_id();
$thegig_footer_meta = get_post_meta( $thegig_footer_id, 'trx_addons_options', true );
if ( ! empty( $thegig_footer_meta['margin'] ) ) {
	thegig_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( thegig_prepare_css_value( $thegig_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $thegig_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $thegig_footer_id ) ) ); ?>
						<?php
						$thegig_footer_scheme = thegig_get_theme_option( 'footer_scheme' );
						if ( ! empty( $thegig_footer_scheme ) && ! thegig_is_inherit( $thegig_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $thegig_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'thegig_action_show_layout', $thegig_footer_id );
	?>
</footer><!-- /.footer_wrap -->
