<?php
/**
 * The Header: Logo and main menu
 *
 * @package THEGIG
 * @since THEGIG 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js<?php
	// Class scheme_xxx need in the <html> as context for the <body>!
	echo ' scheme_' . esc_attr( thegig_get_theme_option( 'color_scheme' ) );
?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'thegig_action_before_body' );
	?>

	<div class="<?php echo esc_attr( apply_filters( 'thegig_filter_body_wrap_class', 'body_wrap' ) ); ?>" <?php do_action('thegig_action_body_wrap_attributes'); ?>>

		<?php do_action( 'thegig_action_before_page_wrap' ); ?>

		<div class="<?php echo esc_attr( apply_filters( 'thegig_filter_page_wrap_class', 'page_wrap' ) ); ?>" <?php do_action('thegig_action_page_wrap_attributes'); ?>>

			<?php do_action( 'thegig_action_page_wrap_start' ); ?>

			<?php
			$thegig_full_post_loading = ( thegig_is_singular( 'post' ) || thegig_is_singular( 'attachment' ) ) && thegig_get_value_gp( 'action' ) == 'full_post_loading';
			$thegig_prev_post_loading = ( thegig_is_singular( 'post' ) || thegig_is_singular( 'attachment' ) ) && thegig_get_value_gp( 'action' ) == 'prev_post_loading';

			// Don't display the header elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ! $thegig_full_post_loading && ! $thegig_prev_post_loading ) {

				// Short links to fast access to the content, sidebar and footer from the keyboard
				?>
				<a class="thegig_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'thegig_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to content", 'thegig' ); ?></a>
				<?php if ( thegig_sidebar_present() ) { ?>
				<a class="thegig_skip_link skip_to_sidebar_link" href="#sidebar_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'thegig_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to sidebar", 'thegig' ); ?></a>
				<?php } ?>
				<a class="thegig_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'thegig_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to footer", 'thegig' ); ?></a>

				<?php
				do_action( 'thegig_action_before_header' );

				// Header
				$thegig_header_type = thegig_get_theme_option( 'header_type' );
				if ( 'custom' == $thegig_header_type && ! thegig_is_layouts_available() ) {
					$thegig_header_type = 'default';
				}
				get_template_part( apply_filters( 'thegig_filter_get_template_part', "templates/header-" . sanitize_file_name( $thegig_header_type ) ) );

				// Side menu
				if ( in_array( thegig_get_theme_option( 'menu_side' ), array( 'left', 'right' ) ) ) {
					get_template_part( apply_filters( 'thegig_filter_get_template_part', 'templates/header-navi-side' ) );
				}

				// Mobile menu
				get_template_part( apply_filters( 'thegig_filter_get_template_part', 'templates/header-navi-mobile' ) );

				do_action( 'thegig_action_after_header' );

			}
			?>

			<?php do_action( 'thegig_action_before_page_content_wrap' ); ?>

			<div class="page_content_wrap<?php
				if ( thegig_is_off( thegig_get_theme_option( 'remove_margins' ) ) ) {
					if ( empty( $thegig_header_type ) ) {
						$thegig_header_type = thegig_get_theme_option( 'header_type' );
					}
					if ( 'custom' == $thegig_header_type && thegig_is_layouts_available() ) {
						$thegig_header_id = thegig_get_custom_header_id();
						if ( $thegig_header_id > 0 ) {
							$thegig_header_meta = thegig_get_custom_layout_meta( $thegig_header_id );
							if ( ! empty( $thegig_header_meta['margin'] ) ) {
								?> page_content_wrap_custom_header_margin<?php
							}
						}
					}
					$thegig_footer_type = thegig_get_theme_option( 'footer_type' );
					if ( 'custom' == $thegig_footer_type && thegig_is_layouts_available() ) {
						$thegig_footer_id = thegig_get_custom_footer_id();
						if ( $thegig_footer_id ) {
							$thegig_footer_meta = thegig_get_custom_layout_meta( $thegig_footer_id );
							if ( ! empty( $thegig_footer_meta['margin'] ) ) {
								?> page_content_wrap_custom_footer_margin<?php
							}
						}
					}
				}
				do_action( 'thegig_action_page_content_wrap_class', $thegig_prev_post_loading );
				?>"<?php
				if ( apply_filters( 'thegig_filter_is_prev_post_loading', $thegig_prev_post_loading ) ) {
					?> data-single-style="<?php echo esc_attr( thegig_get_theme_option( 'single_style' ) ); ?>"<?php
				}
				do_action( 'thegig_action_page_content_wrap_data', $thegig_prev_post_loading );
			?>>
				<?php
				do_action( 'thegig_action_page_content_wrap', $thegig_full_post_loading || $thegig_prev_post_loading );

				// Single posts banner
				if ( apply_filters( 'thegig_filter_single_post_header', thegig_is_singular( 'post' ) || thegig_is_singular( 'attachment' ) ) ) {
					if ( $thegig_prev_post_loading ) {
						if ( thegig_get_theme_option( 'posts_navigation_scroll_which_block' ) != 'article' ) {
							do_action( 'thegig_action_between_posts' );
						}
					}
					// Single post thumbnail and title
					$thegig_path = apply_filters( 'thegig_filter_get_template_part', 'templates/single-styles/' . thegig_get_theme_option( 'single_style' ) );
					if ( thegig_get_file_dir( $thegig_path . '.php' ) != '' ) {
						get_template_part( $thegig_path );
					}
				}

				// Widgets area above page
				$thegig_body_style   = thegig_get_theme_option( 'body_style' );
				$thegig_widgets_name = thegig_get_theme_option( 'widgets_above_page' );
				$thegig_show_widgets = ! thegig_is_off( $thegig_widgets_name ) && is_active_sidebar( $thegig_widgets_name );
				if ( $thegig_show_widgets ) {
					if ( 'fullscreen' != $thegig_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					thegig_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $thegig_body_style ) {
						?>
						</div>
						<?php
					}
				}

				// Content area
				do_action( 'thegig_action_before_content_wrap' );
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $thegig_body_style ? '_fullscreen' : ''; ?>">

					<?php do_action( 'thegig_action_content_wrap_start' ); ?>

					<div class="content">
						<?php
						do_action( 'thegig_action_page_content_start' );

						// Skip link anchor to fast access to the content from keyboard
						?>
						<a id="content_skip_link_anchor" class="thegig_skip_link_anchor" href="#"></a>
						<?php
						// Single posts banner between prev/next posts
						if ( ( thegig_is_singular( 'post' ) || thegig_is_singular( 'attachment' ) )
							&& $thegig_prev_post_loading 
							&& thegig_get_theme_option( 'posts_navigation_scroll_which_block' ) == 'article'
						) {
							do_action( 'thegig_action_between_posts' );
						}

						// Widgets area above content
						thegig_create_widgets_area( 'widgets_above_content' );

						do_action( 'thegig_action_page_content_start_text' );
