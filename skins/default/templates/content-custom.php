<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package THEGIG
 * @since THEGIG 1.0.50
 */

$thegig_template_args = get_query_var( 'thegig_template_args' );
if ( is_array( $thegig_template_args ) ) {
	$thegig_columns    = empty( $thegig_template_args['columns'] ) ? 2 : max( 1, $thegig_template_args['columns'] );
	$thegig_blog_style = array( $thegig_template_args['type'], $thegig_columns );
} else {
	$thegig_blog_style = explode( '_', thegig_get_theme_option( 'blog_style' ) );
	$thegig_columns    = empty( $thegig_blog_style[1] ) ? 2 : max( 1, $thegig_blog_style[1] );
}
$thegig_blog_id       = thegig_get_custom_blog_id( join( '_', $thegig_blog_style ) );
$thegig_blog_style[0] = str_replace( 'blog-custom-', '', $thegig_blog_style[0] );
$thegig_expanded      = ! thegig_sidebar_present() && thegig_get_theme_option( 'expand_content' ) == 'expand';
$thegig_components    = ! empty( $thegig_template_args['meta_parts'] )
							? ( is_array( $thegig_template_args['meta_parts'] )
								? join( ',', $thegig_template_args['meta_parts'] )
								: $thegig_template_args['meta_parts']
								)
							: thegig_array_get_keys_by_value( thegig_get_theme_option( 'meta_parts' ) );
$thegig_post_format   = get_post_format();
$thegig_post_format   = empty( $thegig_post_format ) ? 'standard' : str_replace( 'post-format-', '', $thegig_post_format );

$thegig_blog_meta     = thegig_get_custom_layout_meta( $thegig_blog_id );
$thegig_custom_style  = ! empty( $thegig_blog_meta['scripts_required'] ) ? $thegig_blog_meta['scripts_required'] : 'none';

if ( ! empty( $thegig_template_args['slider'] ) || $thegig_columns > 1 || ! thegig_is_off( $thegig_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $thegig_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo esc_attr( ( thegig_is_off( $thegig_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $thegig_custom_style ) ) . "-1_{$thegig_columns}" );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_item_container post_format_' . esc_attr( $thegig_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $thegig_columns )
					. ' post_layout_' . esc_attr( $thegig_blog_style[0] )
					. ' post_layout_' . esc_attr( $thegig_blog_style[0] ) . '_' . esc_attr( $thegig_columns )
					. ( ! thegig_is_off( $thegig_custom_style )
						? ' post_layout_' . esc_attr( $thegig_custom_style )
							. ' post_layout_' . esc_attr( $thegig_custom_style ) . '_' . esc_attr( $thegig_columns )
						: ''
						)
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
	// Custom layout
	do_action( 'thegig_action_show_layout', $thegig_blog_id, get_the_ID() );
	?>
</article><?php
if ( ! empty( $thegig_template_args['slider'] ) || $thegig_columns > 1 || ! thegig_is_off( $thegig_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
