<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package THEGIG
 * @since THEGIG 1.0
 */

$thegig_template_args = get_query_var( 'thegig_template_args' );

if ( is_array( $thegig_template_args ) ) {
	$thegig_columns    = empty( $thegig_template_args['columns'] ) ? 2 : max( 1, $thegig_template_args['columns'] );
	$thegig_blog_style = array( $thegig_template_args['type'], $thegig_columns );
    $thegig_columns_class = thegig_get_column_class( 1, $thegig_columns, ! empty( $thegig_template_args['columns_tablet']) ? $thegig_template_args['columns_tablet'] : '', ! empty($thegig_template_args['columns_mobile']) ? $thegig_template_args['columns_mobile'] : '' );
} else {
	$thegig_blog_style = explode( '_', thegig_get_theme_option( 'blog_style' ) );
	$thegig_columns    = empty( $thegig_blog_style[1] ) ? 2 : max( 1, $thegig_blog_style[1] );
    $thegig_columns_class = thegig_get_column_class( 1, $thegig_columns );
}
$thegig_expanded   = ! thegig_sidebar_present() && thegig_get_theme_option( 'expand_content' ) == 'expand';

$thegig_post_format = get_post_format();
$thegig_post_format = empty( $thegig_post_format ) ? 'standard' : str_replace( 'post-format-', '', $thegig_post_format );

?><div class="<?php
	if ( ! empty( $thegig_template_args['slider'] ) ) {
		echo ' slider-slide swiper-slide';
	} else {
		echo ( thegig_is_blog_style_use_masonry( $thegig_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $thegig_columns ) : esc_attr( $thegig_columns_class ) );
	}
?>"><article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $thegig_post_format )
				. ' post_layout_classic post_layout_classic_' . esc_attr( $thegig_columns )
				. ' post_layout_' . esc_attr( $thegig_blog_style[0] )
				. ' post_layout_' . esc_attr( $thegig_blog_style[0] ) . '_' . esc_attr( $thegig_columns )
	);
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
								: explode( ',', $thegig_template_args['meta_parts'] )
								)
							: thegig_array_get_keys_by_value( thegig_get_theme_option( 'meta_parts' ) );

	thegig_show_post_featured( apply_filters( 'thegig_filter_args_featured',
		array(
			'thumb_size' => ! empty( $thegig_template_args['thumb_size'] )
				? $thegig_template_args['thumb_size']
				: thegig_get_thumb_size(
					'classic' == $thegig_blog_style[0]
						? ( strpos( thegig_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $thegig_columns > 2 ? 'big' : 'huge' )
								: ( $thegig_columns > 2
									? ( $thegig_expanded ? 'square' : 'square' )
									: ($thegig_columns > 1 ? 'square' : ( $thegig_expanded ? 'huge' : 'big' ))
									)
							)
						: ( strpos( thegig_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $thegig_columns > 2 ? 'masonry-big' : 'full' )
								: ($thegig_columns === 1 ? ( $thegig_expanded ? 'huge' : 'big' ) : ( $thegig_columns <= 2 && $thegig_expanded ? 'masonry-big' : 'masonry' ))
							)
			),
			'hover'      => $thegig_hover,
			'meta_parts' => $thegig_components,
			'no_links'   => ! empty( $thegig_template_args['no_links'] ),
        ),
        'content-classic',
        $thegig_template_args
    ) );

	// Title and post meta
	$thegig_show_title = get_the_title() != '';
	$thegig_show_meta  = count( $thegig_components ) > 0 && ! in_array( $thegig_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $thegig_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php

			// Post meta
			if ( apply_filters( 'thegig_filter_show_blog_meta', $thegig_show_meta, $thegig_components, 'classic' ) ) {
				if ( count( $thegig_components ) > 0 ) {
					do_action( 'thegig_action_before_post_meta' );
					thegig_show_post_meta(
						apply_filters(
							'thegig_filter_post_meta_args', array(
							'components' => join( ',', $thegig_components ),
							'seo'        => false,
							'echo'       => true,
						), $thegig_blog_style[0], $thegig_columns
						)
					);
					do_action( 'thegig_action_after_post_meta' );
				}
			}

			// Post title
			if ( apply_filters( 'thegig_filter_show_blog_title', true, 'classic' ) ) {
				do_action( 'thegig_action_before_post_title' );
				if ( empty( $thegig_template_args['no_links'] ) ) {
					the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
				} else {
					the_title( '<h4 class="post_title entry-title">', '</h4>' );
				}
				do_action( 'thegig_action_after_post_title' );
			}

			if( !in_array( $thegig_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
				// More button
				if ( apply_filters( 'thegig_filter_show_blog_readmore', ! $thegig_show_title || ! empty( $thegig_template_args['more_button'] ), 'classic' ) ) {
					if ( empty( $thegig_template_args['no_links'] ) ) {
						do_action( 'thegig_action_before_post_readmore' );
						thegig_show_post_more_link( $thegig_template_args, '<div class="more-wrap">', '</div>' );
						do_action( 'thegig_action_after_post_readmore' );
					}
				}
			}
			?>
		</div><!-- .entry-header -->
		<?php
	}

	// Post content
	if( in_array( $thegig_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
		ob_start();
		if (apply_filters('thegig_filter_show_blog_excerpt', empty($thegig_template_args['hide_excerpt']) && thegig_get_theme_option('excerpt_length') > 0, 'classic')) {
			thegig_show_post_content($thegig_template_args, '<div class="post_content_inner">', '</div>');
		}
		// More button
		if(! empty( $thegig_template_args['more_button'] )) {
			if ( empty( $thegig_template_args['no_links'] ) ) {
				do_action( 'thegig_action_before_post_readmore' );
				thegig_show_post_more_link( $thegig_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'thegig_action_after_post_readmore' );
			}
		}
		$thegig_content = ob_get_contents();
		ob_end_clean();
		thegig_show_layout($thegig_content, '<div class="post_content entry-content">', '</div><!-- .entry-content -->');
	}
	?>

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
