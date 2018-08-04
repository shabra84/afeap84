<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

if ( ! function_exists( 'travel_insight_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function travel_insight_posted_on() {
		$options = travel_insight_get_theme_options();
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$year  = get_the_time('Y');
	    $month = get_the_time('m');
	    $post_type = get_post_type();

		$date_url = get_month_link( $year, $month );

		$posted_on = '<a href="' . esc_url( $date_url ) . '" rel="bookmark">' . $time_string . '</a>';

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( ' ' );
		if ( $categories_list && travel_insight_categorized_blog() ) {
			$categories_list = '<span class="cat-links">' . $categories_list . '</span>'; // WPCS: XSS OK.
		}

		$output = '';
		if ( is_home() || is_search() || is_archive() ) {
			if ( true === $options['blog_date_enable'] ) 
				$output .= '<span class="posted-on">' . $posted_on . '</span>';
			if ( true === $options['blog_category_enable'] )
				$output .= $categories_list;
		}
		elseif ( is_single() ) {
			if ( true === $options['single_date_enable'] )
				$output .= '<span class="posted-on">' . $posted_on . '</span>';
			if ( true === $options['single_category_enable'] )
				$output .= $categories_list;
		}
		else {
			$output .= '<span class="posted-on">' . $posted_on . '</span>' . $categories_list; // WPCS: XSS OK.
		}

		echo $output;

	}
endif;

if ( ! function_exists( 'travel_insight_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function travel_insight_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() && is_single() ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'travel-insight' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'travel-insight' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'travel-insight' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function travel_insight_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'travel_insight_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'travel_insight_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so travel_insight_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so travel_insight_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in travel_insight_categorized_blog.
 */
function travel_insight_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'travel_insight_categories' );
}
add_action( 'edit_category', 'travel_insight_category_transient_flusher' );
add_action( 'save_post',     'travel_insight_category_transient_flusher' );
