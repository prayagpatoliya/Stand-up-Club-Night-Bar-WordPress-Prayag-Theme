<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package THEGIG
 * @since THEGIG 1.0
 */

// Page (category, tag, archive, author) title

if ( thegig_need_page_title() ) {
	thegig_sc_layouts_showed( 'title', true );
	thegig_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								thegig_show_post_meta(
									apply_filters(
										'thegig_filter_post_meta_args', array(
											'components' => join( ',', thegig_array_get_keys_by_value( thegig_get_theme_option( 'meta_parts' ) ) ),
											'counters'   => join( ',', thegig_array_get_keys_by_value( thegig_get_theme_option( 'counters' ) ) ),
											'seo'        => thegig_is_on( thegig_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$thegig_blog_title           = thegig_get_blog_title();
							$thegig_blog_title_text      = '';
							$thegig_blog_title_class     = '';
							$thegig_blog_title_link      = '';
							$thegig_blog_title_link_text = '';
							if ( is_array( $thegig_blog_title ) ) {
								$thegig_blog_title_text      = $thegig_blog_title['text'];
								$thegig_blog_title_class     = ! empty( $thegig_blog_title['class'] ) ? ' ' . $thegig_blog_title['class'] : '';
								$thegig_blog_title_link      = ! empty( $thegig_blog_title['link'] ) ? $thegig_blog_title['link'] : '';
								$thegig_blog_title_link_text = ! empty( $thegig_blog_title['link_text'] ) ? $thegig_blog_title['link_text'] : '';
							} else {
								$thegig_blog_title_text = $thegig_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $thegig_blog_title_class ); ?>">
								<?php
								$thegig_top_icon = thegig_get_term_image_small();
								if ( ! empty( $thegig_top_icon ) ) {
									$thegig_attr = thegig_getimagesize( $thegig_top_icon );
									?>
									<img src="<?php echo esc_url( $thegig_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'thegig' ); ?>"
										<?php
										if ( ! empty( $thegig_attr[3] ) ) {
											thegig_show_layout( $thegig_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $thegig_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $thegig_blog_title_link ) && ! empty( $thegig_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $thegig_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $thegig_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( ! is_paged() && ( is_category() || is_tag() || is_tax() ) ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						ob_start();
						do_action( 'thegig_action_breadcrumbs' );
						$thegig_breadcrumbs = ob_get_contents();
						ob_end_clean();
						thegig_show_layout( $thegig_breadcrumbs, '<div class="sc_layouts_title_breadcrumbs">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
