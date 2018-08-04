<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function travel_insight_body_classes( $classes ) {
	$options = travel_insight_get_theme_options();

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class for layout
	$classes[] = esc_attr( $options['site_layout'] );

	// Add a class for sidebar
	$sidebar_position = travel_insight_layout();

	if( is_singular() ) {
		$sidebar = get_post_meta( get_the_id(), 'travel-insight-selected-sidebar', true );
		$post_sidebar = ! empty( $sidebar ) ? $sidebar : 'sidebar-1';
	} else {
		$post_sidebar = 'sidebar-1';
	}

	if ( is_active_sidebar( $post_sidebar ) ) {
		$classes[] = esc_attr( $sidebar_position );
	} else {
		$classes[] = 'no-sidebar';
	}

	$footer_sidebar_data = travel_insight_footer_sidebar_class();
	$footer_sidebar 	 = $footer_sidebar_data['active_sidebar'];
	if ( empty( $footer_sidebar ) ) {
		$classes[] = 'no-footer-widgets';
	}

	$content_width = ! empty( $options['content_width'] ) ? $options['content_width'] : 'content-width';
	$classes[]	= esc_attr( $content_width );

	if ( false === $options['slider_caption_enable'] ) {
		$classes[] = 'slider-caption-disabled';
	}

	if ( false === $options['slider_search_enable'] ) {
		$classes[] = 'slider-search-disabled';
	}

	return $classes;
}
add_filter( 'body_class', 'travel_insight_body_classes' );
