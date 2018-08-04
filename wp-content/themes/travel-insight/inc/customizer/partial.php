<?php
/**
 * Partial functions
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

if ( ! function_exists( 'travel_insight_popular_destination_title' ) ) :
	// popular destination
	function travel_insight_popular_destination_title() {
		$options = travel_insight_get_theme_options();
		return esc_html( $options['popular_destination_title'] );
	}
endif;

if ( ! function_exists( 'travel_insight_about_us_btn' ) ) :
	// about us
	function travel_insight_about_us_btn() {
		$options = travel_insight_get_theme_options();
		return esc_html( $options['about_us_btn_label'] );
	}
endif;

if ( ! function_exists( 'travel_insight_tours_title' ) ) :
	// tours title
	function travel_insight_tours_title() {
		$options = travel_insight_get_theme_options();
		return esc_html( $options['tours_title'] );
	}
endif;

if ( ! function_exists( 'travel_insight_guide_title' ) ) :
	// guide title
	function travel_insight_guide_title() {
		$options = travel_insight_get_theme_options();
		return esc_html( $options['guide_title'] );
	}
endif;

if ( ! function_exists( 'travel_insight_call_to_action_btn_label' ) ) :
	// call_to_action btn label
	function travel_insight_call_to_action_btn_label() {
		$options = travel_insight_get_theme_options();
		return esc_html( $options['call_to_action_btn_label'] );
	}
endif;

if ( ! function_exists( 'travel_insight_footer_site_info_copyright' ) ) :
	// call_to_action btn label
	function travel_insight_footer_site_info_copyright() {
		$options = travel_insight_get_theme_options();
		return esc_html( $options['copyright_text'] );
	}
endif;
