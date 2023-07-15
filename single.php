<?php
/**
 * The template to display single post
 *
 * @package THEGIG
 * @since THEGIG 1.0
 */

// Full post loading
$full_post_loading          = thegig_get_value_gp( 'action' ) == 'full_post_loading';

// Prev post loading
$prev_post_loading          = thegig_get_value_gp( 'action' ) == 'prev_post_loading';
$prev_post_loading_type     = thegig_get_theme_option( 'posts_navigation_scroll_which_block' );

// Position of the related posts
$thegig_related_position   = thegig_get_theme_option( 'related_position' );

// Type of the prev/next post navigation
$thegig_posts_navigation   = thegig_get_theme_option( 'posts_navigation' );
$thegig_prev_post          = false;
$thegig_prev_post_same_cat = thegig_get_theme_option( 'posts_navigation_scroll_same_cat' );

// Rewrite style of the single post if current post loading via AJAX and featured image and title is not in the content
if ( ( $full_post_loading 
		|| 
		( $prev_post_loading && 'article' == $prev_post_loading_type )
	) 
	&& 
	! in_array( thegig_get_theme_option( 'single_style' ), array( 'style-6' ) )
) {
	thegig_storage_set_array( 'options_meta', 'single_style', 'style-6' );
}

do_action( 'thegig_action_prev_post_loading', $prev_post_loading, $prev_post_loading_type );

get_header();

while ( have_posts() ) {

	the_post();

	// Type of the prev/next post navigation
	if ( 'scroll' == $thegig_posts_navigation ) {
		$thegig_prev_post = get_previous_post( $thegig_prev_post_same_cat );  // Get post from same category
		if ( ! $thegig_prev_post && $thegig_prev_post_same_cat ) {
			$thegig_prev_post = get_previous_post( false );                    // Get post from any category
		}
		if ( ! $thegig_prev_post ) {
			$thegig_posts_navigation = 'links';
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $thegig_prev_post ) ) {
		thegig_sc_layouts_showed( 'featured', false );
		thegig_sc_layouts_showed( 'title', false );
		thegig_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $thegig_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'thegig_filter_get_template_part', 'templates/content', 'single-' . thegig_get_theme_option( 'single_style' ) ), 'single-' . thegig_get_theme_option( 'single_style' ) );

	// If related posts should be inside the content
	if ( strpos( $thegig_related_position, 'inside' ) === 0 ) {
		$thegig_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'thegig_action_related_posts' );
		$thegig_related_content = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $thegig_related_content ) ) {
			$thegig_related_position_inside = max( 0, min( 9, thegig_get_theme_option( 'related_position_inside' ) ) );
			if ( 0 == $thegig_related_position_inside ) {
				$thegig_related_position_inside = mt_rand( 1, 9 );
			}

			$thegig_p_number         = 0;
			$thegig_related_inserted = false;
			$thegig_in_block         = false;
			$thegig_content_start    = strpos( $thegig_content, '<div class="post_content' );
			$thegig_content_end      = strrpos( $thegig_content, '</div>' );

			for ( $i = max( 0, $thegig_content_start ); $i < min( strlen( $thegig_content ) - 3, $thegig_content_end ); $i++ ) {
				if ( $thegig_content[ $i ] != '<' ) {
					continue;
				}
				if ( $thegig_in_block ) {
					if ( strtolower( substr( $thegig_content, $i + 1, 12 ) ) == '/blockquote>' ) {
						$thegig_in_block = false;
						$i += 12;
					}
					continue;
				} else if ( strtolower( substr( $thegig_content, $i + 1, 10 ) ) == 'blockquote' && in_array( $thegig_content[ $i + 11 ], array( '>', ' ' ) ) ) {
					$thegig_in_block = true;
					$i += 11;
					continue;
				} else if ( 'p' == $thegig_content[ $i + 1 ] && in_array( $thegig_content[ $i + 2 ], array( '>', ' ' ) ) ) {
					$thegig_p_number++;
					if ( $thegig_related_position_inside == $thegig_p_number ) {
						$thegig_related_inserted = true;
						$thegig_content = ( $i > 0 ? substr( $thegig_content, 0, $i ) : '' )
											. $thegig_related_content
											. substr( $thegig_content, $i );
					}
				}
			}
			if ( ! $thegig_related_inserted ) {
				if ( $thegig_content_end > 0 ) {
					$thegig_content = substr( $thegig_content, 0, $thegig_content_end ) . $thegig_related_content . substr( $thegig_content, $thegig_content_end );
				} else {
					$thegig_content .= $thegig_related_content;
				}
			}
		}

		thegig_show_layout( $thegig_content );
	}

	// Comments
	do_action( 'thegig_action_before_comments' );
	comments_template();
	do_action( 'thegig_action_after_comments' );

	// Related posts
	if ( 'below_content' == $thegig_related_position
		&& ( 'scroll' != $thegig_posts_navigation || thegig_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || thegig_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'thegig_action_related_posts' );
	}

	// Post navigation: type 'scroll'
	if ( 'scroll' == $thegig_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $thegig_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $thegig_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $thegig_prev_post ) ); ?>"
			<?php do_action( 'thegig_action_nav_links_single_scroll_data', $thegig_prev_post ); ?>
		></div>
		<?php
	}
}

get_footer();
