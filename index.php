<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: //codex.wordpress.org/Template_Hierarchy
 *
 * @package THEGIG
 * @since THEGIG 1.0
 */

$thegig_template = apply_filters( 'thegig_filter_get_template_part', thegig_blog_archive_get_template() );

if ( ! empty( $thegig_template ) && 'index' != $thegig_template ) {

	get_template_part( $thegig_template );

} else {

	thegig_storage_set( 'blog_archive', true );

	get_header();

	if ( have_posts() ) {

		// Query params
		$thegig_stickies   = is_home()
								|| ( in_array( thegig_get_theme_option( 'post_type' ), array( '', 'post' ) )
									&& (int) thegig_get_theme_option( 'parent_cat' ) == 0
									)
										? get_option( 'sticky_posts' )
										: false;
		$thegig_post_type  = thegig_get_theme_option( 'post_type' );
		$thegig_args       = array(
								'blog_style'     => thegig_get_theme_option( 'blog_style' ),
								'post_type'      => $thegig_post_type,
								'taxonomy'       => thegig_get_post_type_taxonomy( $thegig_post_type ),
								'parent_cat'     => thegig_get_theme_option( 'parent_cat' ),
								'posts_per_page' => thegig_get_theme_option( 'posts_per_page' ),
								'sticky'         => thegig_get_theme_option( 'sticky_style' ) == 'columns'
															&& is_array( $thegig_stickies )
															&& count( $thegig_stickies ) > 0
															&& get_query_var( 'paged' ) < 1
								);

		thegig_blog_archive_start();

		do_action( 'thegig_action_blog_archive_start' );

		if ( is_author() ) {
			do_action( 'thegig_action_before_page_author' );
			get_template_part( apply_filters( 'thegig_filter_get_template_part', 'templates/author-page' ) );
			do_action( 'thegig_action_after_page_author' );
		}

		if ( thegig_get_theme_option( 'show_filters' ) ) {
			do_action( 'thegig_action_before_page_filters' );
			thegig_show_filters( $thegig_args );
			do_action( 'thegig_action_after_page_filters' );
		} else {
			do_action( 'thegig_action_before_page_posts' );
			thegig_show_posts( array_merge( $thegig_args, array( 'cat' => $thegig_args['parent_cat'] ) ) );
			do_action( 'thegig_action_after_page_posts' );
		}

		do_action( 'thegig_action_blog_archive_end' );

		thegig_blog_archive_end();

	} else {

		if ( is_search() ) {
			get_template_part( apply_filters( 'thegig_filter_get_template_part', 'templates/content', 'none-search' ), 'none-search' );
		} else {
			get_template_part( apply_filters( 'thegig_filter_get_template_part', 'templates/content', 'none-archive' ), 'none-archive' );
		}
	}

	get_footer();
}
