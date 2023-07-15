<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package THEGIG
 * @since THEGIG 1.0
 */

if ( thegig_sidebar_present() ) {
	
	$thegig_sidebar_type = thegig_get_theme_option( 'sidebar_type' );
	if ( 'custom' == $thegig_sidebar_type && ! thegig_is_layouts_available() ) {
		$thegig_sidebar_type = 'default';
	}
	
	// Catch output to the buffer
	ob_start();
	if ( 'default' == $thegig_sidebar_type ) {
		// Default sidebar with widgets
		$thegig_sidebar_name = thegig_get_theme_option( 'sidebar_widgets' );
		thegig_storage_set( 'current_sidebar', 'sidebar' );
		if ( is_active_sidebar( $thegig_sidebar_name ) ) {
			dynamic_sidebar( $thegig_sidebar_name );
		}
	} else {
		// Custom sidebar from Layouts Builder
		$thegig_sidebar_id = thegig_get_custom_sidebar_id();
		do_action( 'thegig_action_show_layout', $thegig_sidebar_id );
	}
	$thegig_out = trim( ob_get_contents() );
	ob_end_clean();
	
	// If any html is present - display it
	if ( ! empty( $thegig_out ) ) {
		$thegig_sidebar_position    = thegig_get_theme_option( 'sidebar_position' );
		$thegig_sidebar_position_ss = thegig_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $thegig_sidebar_position );
			echo ' sidebar_' . esc_attr( $thegig_sidebar_position_ss );
			echo ' sidebar_' . esc_attr( $thegig_sidebar_type );

			$thegig_sidebar_scheme = apply_filters( 'thegig_filter_sidebar_scheme', thegig_get_theme_option( 'sidebar_scheme' ) );
			if ( ! empty( $thegig_sidebar_scheme ) && ! thegig_is_inherit( $thegig_sidebar_scheme ) && 'custom' != $thegig_sidebar_type ) {
				echo ' scheme_' . esc_attr( $thegig_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php

			// Skip link anchor to fast access to the sidebar from keyboard
			?>
			<a id="sidebar_skip_link_anchor" class="thegig_skip_link_anchor" href="#"></a>
			<?php

			do_action( 'thegig_action_before_sidebar_wrap', 'sidebar' );

			// Button to show/hide sidebar on mobile
			if ( in_array( $thegig_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$thegig_title = apply_filters( 'thegig_filter_sidebar_control_title', 'float' == $thegig_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'thegig' ) : '' );
				$thegig_text  = apply_filters( 'thegig_filter_sidebar_control_text', 'above' == $thegig_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'thegig' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $thegig_title ); ?>"><?php echo esc_html( $thegig_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'thegig_action_before_sidebar', 'sidebar' );
				thegig_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $thegig_out ) );
				do_action( 'thegig_action_after_sidebar', 'sidebar' );
				?>
			</div>
			<?php

			do_action( 'thegig_action_after_sidebar_wrap', 'sidebar' );

			?>
		</div>
		<div class="clearfix"></div>
		<?php
	}
}
