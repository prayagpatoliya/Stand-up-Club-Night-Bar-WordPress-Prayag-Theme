<?php
/**
 * The template to display the widgets area in the header
 *
 * @package THEGIG
 * @since THEGIG 1.0
 */

// Header sidebar
$thegig_header_name    = thegig_get_theme_option( 'header_widgets' );
$thegig_header_present = ! thegig_is_off( $thegig_header_name ) && is_active_sidebar( $thegig_header_name );
if ( $thegig_header_present ) {
	thegig_storage_set( 'current_sidebar', 'header' );
	$thegig_header_wide = thegig_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $thegig_header_name ) ) {
		dynamic_sidebar( $thegig_header_name );
	}
	$thegig_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $thegig_widgets_output ) ) {
		$thegig_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $thegig_widgets_output );
		$thegig_need_columns   = strpos( $thegig_widgets_output, 'columns_wrap' ) === false;
		if ( $thegig_need_columns ) {
			$thegig_columns = max( 0, (int) thegig_get_theme_option( 'header_columns' ) );
			if ( 0 == $thegig_columns ) {
				$thegig_columns = min( 6, max( 1, thegig_tags_count( $thegig_widgets_output, 'aside' ) ) );
			}
			if ( $thegig_columns > 1 ) {
				$thegig_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $thegig_columns ) . ' widget', $thegig_widgets_output );
			} else {
				$thegig_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $thegig_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<?php do_action( 'thegig_action_before_sidebar_wrap', 'header' ); ?>
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $thegig_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $thegig_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'thegig_action_before_sidebar', 'header' );
				thegig_show_layout( $thegig_widgets_output );
				do_action( 'thegig_action_after_sidebar', 'header' );
				if ( $thegig_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $thegig_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
			<?php do_action( 'thegig_action_after_sidebar_wrap', 'header' ); ?>
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
