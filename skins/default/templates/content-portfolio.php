<?php
/**
 * The Portfolio template to display the content
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

$thegig_post_format = get_post_format();
$thegig_post_format = empty( $thegig_post_format ) ? 'standard' : str_replace( 'post-format-', '', $thegig_post_format );

?><div class="
<?php
if ( ! empty( $thegig_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( thegig_is_blog_style_use_masonry( $thegig_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $thegig_columns ) : esc_attr( $thegig_columns_class ));
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $thegig_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $thegig_columns )
		. ( 'portfolio' != $thegig_blog_style[0] ? ' ' . esc_attr( $thegig_blog_style[0] )  . '_' . esc_attr( $thegig_columns ) : '' )
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

	$thegig_hover   = ! empty( $thegig_template_args['hover'] ) && ! thegig_is_inherit( $thegig_template_args['hover'] )
								? $thegig_template_args['hover']
								: thegig_get_theme_option( 'image_hover' );

	if ( 'dots' == $thegig_hover ) {
		$thegig_post_link = empty( $thegig_template_args['no_links'] )
								? ( ! empty( $thegig_template_args['link'] )
									? $thegig_template_args['link']
									: get_permalink()
									)
								: '';
		$thegig_target    = ! empty( $thegig_post_link ) && false === strpos( $thegig_post_link, home_url() )
								? ' target="_blank" rel="nofollow"'
								: '';
	}
	
	// Meta parts
	$thegig_components = ! empty( $thegig_template_args['meta_parts'] )
							? ( is_array( $thegig_template_args['meta_parts'] )
								? $thegig_template_args['meta_parts']
								: explode( ',', $thegig_template_args['meta_parts'] )
								)
							: thegig_array_get_keys_by_value( thegig_get_theme_option( 'meta_parts' ) );

	// Featured image
	thegig_show_post_featured( apply_filters( 'thegig_filter_args_featured',
        array(
			'hover'         => $thegig_hover,
			'no_links'      => ! empty( $thegig_template_args['no_links'] ),
			'thumb_size'    => ! empty( $thegig_template_args['thumb_size'] )
								? $thegig_template_args['thumb_size']
								: thegig_get_thumb_size(
									thegig_is_blog_style_use_masonry( $thegig_blog_style[0] )
										? (	strpos( thegig_get_theme_option( 'body_style' ), 'full' ) !== false || $thegig_columns < 3
											? 'masonry-big'
											: 'masonry'
											)
										: (	strpos( thegig_get_theme_option( 'body_style' ), 'full' ) !== false || $thegig_columns < 3
											? 'square'
											: 'square'
											)
								),
			'thumb_bg' => thegig_is_blog_style_use_masonry( $thegig_blog_style[0] ) ? false : true,
			'show_no_image' => true,
			'meta_parts'    => $thegig_components,
			'class'         => 'dots' == $thegig_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $thegig_hover
										? '<div class="post_info"><h5 class="post_title">'
											. ( ! empty( $thegig_post_link )
												? '<a href="' . esc_url( $thegig_post_link ) . '"' . ( ! empty( $target ) ? $target : '' ) . '>'
												: ''
												)
												. esc_html( get_the_title() ) 
											. ( ! empty( $thegig_post_link )
												? '</a>'
												: ''
												)
											. '</h5></div>'
										: '',
            'thumb_ratio'   => 'info' == $thegig_hover ?  '100:102' : '',
        ),
        'content-portfolio',
        $thegig_template_args
    ) );
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!