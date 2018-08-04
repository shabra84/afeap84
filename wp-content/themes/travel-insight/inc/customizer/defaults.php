<?php
/**
 * Customizer default options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 * @return array An array of default values
 */

function travel_insight_get_default_theme_options() {
	$theme_data = wp_get_theme();
	$travel_insight_default_options = array(

		// Theme Options
		'loader_enable'         		=> false,
		'site_layout'         			=> 'wide',
		'sidebar_position'         		=> 'right-sidebar',
		'long_excerpt_length'           => 25,
		'author_box_enable'          	=> true,
		'single_pagination_enable'      => true,
		'single_date_enable'      		=> true,
		'single_category_enable'      	=> true,
		'breadcrumb_enable'         	=> true,
		'pagination_enable'         	=> true,
		'pagination_type'         		=> 'default',
		'copyright_text'           		=> sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved', '1: Year, 2: Site Title with home URL', 'travel-insight' ), '[the-year]', '[site-link]' ),
		'scroll_top_visible'        	=> true,
		'reset_options'      			=> false,
		'enable_frontpage_content' 		=> true,
		'site_title_enable'				=> true,
		'site_description_enable'		=> true,
		'site_logo_enable'				=> true,
		'menu_label_enable'				=> true,
		'header_social_enable'			=> true,
		'blog_img_enable'				=> true,
		'blog_date_enable'				=> true,
		'blog_category_enable'			=> true,
		'content_width'					=> 'content-width',

		// Slider Section
		'slider_enable'					=> false,
		'slider_caption_enable'			=> true,
		'slider_search_enable'			=> true,

		// Popular Destination
		'popular_destination_enable'	=> false,
		'popular_destination_title'		=> esc_html__( 'Popular Destination', 'travel-insight' ),
		'no_of_popular_destination' 	=> 5,

		// About Us
		'about_us_enable'				=> false,
		'about_us_btn_label'			=> esc_html__( 'Read More', 'travel-insight' ),

		// Articles
		'articles_enable'				=> false,
		'articles_background'			=> get_template_directory_uri() . '/assets/uploads/background-02.jpg',

		// Tours
		'tours_enable'					=> false,
		'tours_title'					=> esc_html__( 'Tour', 'travel-insight' ),
		'no_of_tours'					=> 6,

		// Guide
		'guide_enable'					=> false,
		'guide_title'					=> esc_html__( 'Survival Guide', 'travel-insight' ),

		// Call To Action
		'call_to_action_enable'			=> false,
		'call_to_action_btn_label'		=> esc_html__( 'Learn More', 'travel-insight' ),

	);

	$output = apply_filters( 'travel_insight_default_theme_options', $travel_insight_default_options );
	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}