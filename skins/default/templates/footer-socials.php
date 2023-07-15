<?php
/**
 * The template to display the socials in the footer
 *
 * @package THEGIG
 * @since THEGIG 1.0.10
 */


// Socials
if ( thegig_is_on( thegig_get_theme_option( 'socials_in_footer' ) ) ) {
	$thegig_output = thegig_get_socials_links();
	if ( '' != $thegig_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php thegig_show_layout( $thegig_output ); ?>
			</div>
		</div>
		<?php
	}
}
