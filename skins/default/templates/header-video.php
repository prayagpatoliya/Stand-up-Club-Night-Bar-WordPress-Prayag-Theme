<?php
/**
 * The template to display the background video in the header
 *
 * @package THEGIG
 * @since THEGIG 1.0.14
 */
$thegig_header_video = thegig_get_header_video();
$thegig_embed_video  = '';
if ( ! empty( $thegig_header_video ) && ! thegig_is_from_uploads( $thegig_header_video ) ) {
	if ( thegig_is_youtube_url( $thegig_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $thegig_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php thegig_show_layout( thegig_get_embed_video( $thegig_header_video ) ); ?></div>
		<?php
	}
}
