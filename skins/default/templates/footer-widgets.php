<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package THEGIG
 * @since THEGIG 1.0.10
 */

// Footer sidebar
$thegig_footer_name    = thegig_get_theme_option( 'footer_widgets' );
$thegig_footer_present = ! thegig_is_off( $thegig_footer_name ) && is_active_sidebar( $thegig_footer_name );
if ( $thegig_footer_present ) {
	thegig_storage_set( 'current_sidebar', 'footer' );
	$thegig_footer_wide = thegig_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $thegig_footer_name ) ) {
		dynamic_sidebar( $thegig_footer_name );
	}
	$thegig_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $thegig_out ) ) {
		$thegig_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $thegig_out );
		$thegig_need_columns = true;   //or check: strpos($thegig_out, 'columns_wrap')===false;
		if ( $thegig_need_columns ) {
			$thegig_columns = max( 0, (int) thegig_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $thegig_columns ) {
				$thegig_columns = min( 4, max( 1, thegig_tags_count( $thegig_out, 'aside' ) ) );
			}
			if ( $thegig_columns > 1 ) {
				$thegig_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $thegig_columns ) . ' widget', $thegig_out );
			} else {
				$thegig_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $thegig_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<?php do_action( 'thegig_action_before_sidebar_wrap', 'footer' ); ?>
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $thegig_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $thegig_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'thegig_action_before_sidebar', 'footer' );
				thegig_show_layout( $thegig_out );
				do_action( 'thegig_action_after_sidebar', 'footer' );
				if ( $thegig_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $thegig_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
			<?php do_action( 'thegig_action_after_sidebar_wrap', 'footer' ); ?>
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
