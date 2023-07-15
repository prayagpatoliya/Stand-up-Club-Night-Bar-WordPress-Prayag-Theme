<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package THEGIG
 * @since THEGIG 1.0
 */

							do_action( 'thegig_action_page_content_end_text' );
							
							// Widgets area below the content
							thegig_create_widgets_area( 'widgets_below_content' );
						
							do_action( 'thegig_action_page_content_end' );
							?>
						</div>
						<?php
						
						do_action( 'thegig_action_after_page_content' );

						// Show main sidebar
						get_sidebar();

						do_action( 'thegig_action_content_wrap_end' );
						?>
					</div>
					<?php

					do_action( 'thegig_action_after_content_wrap' );

					// Widgets area below the page and related posts below the page
					$thegig_body_style = thegig_get_theme_option( 'body_style' );
					$thegig_widgets_name = thegig_get_theme_option( 'widgets_below_page' );
					$thegig_show_widgets = ! thegig_is_off( $thegig_widgets_name ) && is_active_sidebar( $thegig_widgets_name );
					$thegig_show_related = thegig_is_single() && thegig_get_theme_option( 'related_position' ) == 'below_page';
					if ( $thegig_show_widgets || $thegig_show_related ) {
						if ( 'fullscreen' != $thegig_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $thegig_show_related ) {
							do_action( 'thegig_action_related_posts' );
						}

						// Widgets area below page content
						if ( $thegig_show_widgets ) {
							thegig_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $thegig_body_style ) {
							?>
							</div>
							<?php
						}
					}
					do_action( 'thegig_action_page_content_wrap_end' );
					?>
			</div>
			<?php
			do_action( 'thegig_action_after_page_content_wrap' );

			// Don't display the footer elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ( ! thegig_is_singular( 'post' ) && ! thegig_is_singular( 'attachment' ) ) || ! in_array ( thegig_get_value_gp( 'action' ), array( 'full_post_loading', 'prev_post_loading' ) ) ) {
				
				// Skip link anchor to fast access to the footer from keyboard
				?>
				<a id="footer_skip_link_anchor" class="thegig_skip_link_anchor" href="#"></a>
				<?php

				do_action( 'thegig_action_before_footer' );

				// Footer
				$thegig_footer_type = thegig_get_theme_option( 'footer_type' );
				if ( 'custom' == $thegig_footer_type && ! thegig_is_layouts_available() ) {
					$thegig_footer_type = 'default';
				}
				get_template_part( apply_filters( 'thegig_filter_get_template_part', "templates/footer-" . sanitize_file_name( $thegig_footer_type ) ) );

				do_action( 'thegig_action_after_footer' );

			}
			?>

			<?php do_action( 'thegig_action_page_wrap_end' ); ?>

		</div>

		<?php do_action( 'thegig_action_after_page_wrap' ); ?>

	</div>

	<?php do_action( 'thegig_action_after_body' ); ?>

	<?php wp_footer(); ?>

</body>
</html>