<?php
/**
 * The template to display default site footer
 *
 * @package THEGIG
 * @since THEGIG 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$thegig_footer_scheme = thegig_get_theme_option( 'footer_scheme' );
if ( ! empty( $thegig_footer_scheme ) && ! thegig_is_inherit( $thegig_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $thegig_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'thegig_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'thegig_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'thegig_filter_get_template_part', 'templates/footer-socials' ) );

	// Copyright area
	get_template_part( apply_filters( 'thegig_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
