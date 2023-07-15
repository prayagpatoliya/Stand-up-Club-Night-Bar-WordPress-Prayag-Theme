<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package THEGIG
 * @since THEGIG 1.0
 */

$thegig_template_args = get_query_var( 'thegig_template_args' );
$thegig_columns = 1;
if ( is_array( $thegig_template_args ) ) {
	$thegig_columns    = empty( $thegig_template_args['columns'] ) ? 1 : max( 1, $thegig_template_args['columns'] );
	$thegig_blog_style = array( $thegig_template_args['type'], $thegig_columns );
	if ( ! empty( $thegig_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $thegig_columns > 1 ) {
	    $thegig_columns_class = thegig_get_column_class( 1, $thegig_columns, ! empty( $thegig_template_args['columns_tablet']) ? $thegig_template_args['columns_tablet'] : '', ! empty($thegig_template_args['columns_mobile']) ? $thegig_template_args['columns_mobile'] : '' );
		?>
		<div class="<?php echo esc_attr( $thegig_columns_class ); ?>">
		<?php
	}
}
$thegig_expanded    = ! thegig_sidebar_present() && thegig_get_theme_option( 'expand_content' ) == 'expand';
$thegig_post_format = get_post_format();
$thegig_post_format = empty( $thegig_post_format ) ? 'standard' : str_replace( 'post-format-', '', $thegig_post_format );
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_excerpt post_format_' . esc_attr( $thegig_post_format ) );
	thegig_add_blog_animation( $thegig_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$thegig_hover      = ! empty( $thegig_template_args['hover'] ) && ! thegig_is_inherit( $thegig_template_args['hover'] )
							? $thegig_template_args['hover']
							: thegig_get_theme_option( 'image_hover' );
	$thegig_components = ! empty( $thegig_template_args['meta_parts'] )
							? ( is_array( $thegig_template_args['meta_parts'] )
								? $thegig_template_args['meta_parts']
								: array_map( 'trim', explode( ',', $thegig_template_args['meta_parts'] ) )
								)
							: thegig_array_get_keys_by_value( thegig_get_theme_option( 'meta_parts' ) );
	thegig_show_post_featured( apply_filters( 'thegig_filter_args_featured',
		array(
			'no_links'   => ! empty( $thegig_template_args['no_links'] ),
			'hover'      => $thegig_hover,
			'meta_parts' => $thegig_components,
			'thumb_size' => ! empty( $thegig_template_args['thumb_size'] )
							? $thegig_template_args['thumb_size']
							: thegig_get_thumb_size( strpos( thegig_get_theme_option( 'body_style' ), 'full' ) !== false
								? 'full'
								: ( $thegig_expanded 
									? 'huge' 
									: 'big' 
									)
								),
		),
		'content-excerpt',
		$thegig_template_args
	) );

	// Title and post meta
	$thegig_show_title = get_the_title() != '';
	$thegig_show_meta  = count( $thegig_components ) > 0 && ! in_array( $thegig_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $thegig_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if ( apply_filters( 'thegig_filter_show_blog_title', true, 'excerpt' ) ) {
				do_action( 'thegig_action_before_post_title' );
				if ( empty( $thegig_template_args['no_links'] ) ) {
					the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				} else {
					the_title( '<h3 class="post_title entry-title">', '</h3>' );
				}
				do_action( 'thegig_action_after_post_title' );
			}
			?>
		</div><!-- .post_header -->
		<?php
	}

	// Post content
	if ( apply_filters( 'thegig_filter_show_blog_excerpt', empty( $thegig_template_args['hide_excerpt'] ) && thegig_get_theme_option( 'excerpt_length' ) > 0, 'excerpt' ) ) {
		?>
		<div class="post_content entry-content">
			<?php

			// Post meta
			if ( apply_filters( 'thegig_filter_show_blog_meta', $thegig_show_meta, $thegig_components, 'excerpt' ) ) {
				if ( count( $thegig_components ) > 0 ) {
					do_action( 'thegig_action_before_post_meta' );
					thegig_show_post_meta(
						apply_filters(
							'thegig_filter_post_meta_args', array(
								'components' => join( ',', $thegig_components ),
								'seo'        => false,
								'echo'       => true,
							), 'excerpt', 1
						)
					);
					do_action( 'thegig_action_after_post_meta' );
				}
			}

			if ( thegig_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
				<div class="post_content_inner">
					<?php
					do_action( 'thegig_action_before_full_post_content' );
					the_content( '' );
					do_action( 'thegig_action_after_full_post_content' );
					?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'thegig' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'thegig' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			} else {
				// Post content area
				thegig_show_post_content( $thegig_template_args, '<div class="post_content_inner">', '</div>' );
			}

			// More button
			if ( apply_filters( 'thegig_filter_show_blog_readmore',  ! isset( $thegig_template_args['more_button'] ) || ! empty( $thegig_template_args['more_button'] ), 'excerpt' ) ) {
				if ( empty( $thegig_template_args['no_links'] ) ) {
					do_action( 'thegig_action_before_post_readmore' );
					if ( thegig_get_theme_option( 'blog_content' ) != 'fullpost' ) {
						thegig_show_post_more_link( $thegig_template_args, '<p>', '</p>' );
					} else {
						thegig_show_post_comments_link( $thegig_template_args, '<p>', '</p>' );
					}
					do_action( 'thegig_action_after_post_readmore' );
				}
			}

			?>
		</div><!-- .entry-content -->
		<?php
	}
	?>
</article>
<?php

if ( is_array( $thegig_template_args ) ) {
	if ( ! empty( $thegig_template_args['slider'] ) || $thegig_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
