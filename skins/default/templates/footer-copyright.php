<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package THEGIG
 * @since THEGIG 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$thegig_copyright_scheme = thegig_get_theme_option( 'copyright_scheme' );
if ( ! empty( $thegig_copyright_scheme ) && ! thegig_is_inherit( $thegig_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $thegig_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$thegig_copyright = thegig_get_theme_option( 'copyright' );
			if ( ! empty( $thegig_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$thegig_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $thegig_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$thegig_copyright = thegig_prepare_macros( $thegig_copyright );
				// Display copyright
				echo wp_kses( nl2br( $thegig_copyright ), 'thegig_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
