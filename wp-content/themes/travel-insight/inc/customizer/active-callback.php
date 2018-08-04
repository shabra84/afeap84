<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

if ( ! function_exists( 'travel_insight_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since Travel Insight 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function travel_insight_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'travel_insight_theme_options[pagination_enable]' )->value();
	}
endif;

if ( ! function_exists( 'travel_insight_is_footer_logo_enable' ) ) :
	/**
	 * Check if footer logo is enabled.
	 *
	 * @since Travel Insight 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function travel_insight_is_footer_logo_enable( $control ) {
		return $control->manager->get_setting( 'travel_insight_theme_options[footer_logo_enable]' )->value();
	}
endif;

if ( ! function_exists( 'travel_insight_is_slider_enable' ) ) :
	/**
	 * Check if slider is enabled.
	 *
	 * @since Travel Insight 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function travel_insight_is_slider_enable( $control ) {
		return $control->manager->get_setting( 'travel_insight_theme_options[slider_enable]' )->value();
	}
endif;

if ( ! function_exists( 'travel_insight_is_popular_destination_enable' ) ) :
	/**
	 * Check if popular destination is enabled.
	 *
	 * @since Travel Insight 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function travel_insight_is_popular_destination_enable( $control ) {
		return $control->manager->get_setting( 'travel_insight_theme_options[popular_destination_enable]' )->value();
	}
endif;

if ( ! function_exists( 'travel_insight_is_about_us_enable' ) ) :
	/**
	 * Check if about us is enabled.
	 *
	 * @since Travel Insight 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function travel_insight_is_about_us_enable( $control ) {
		return $control->manager->get_setting( 'travel_insight_theme_options[about_us_enable]' )->value();
	}
endif;

if ( ! function_exists( 'travel_insight_is_articles_enable' ) ) :
	/**
	 * Check if articles is enabled.
	 *
	 * @since Travel Insight 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function travel_insight_is_articles_enable( $control ) {
		return $control->manager->get_setting( 'travel_insight_theme_options[articles_enable]' )->value();
	}
endif;

if ( ! function_exists( 'travel_insight_is_tours_enable' ) ) :
	/**
	 * Check if tours is enabled.
	 *
	 * @since Travel Insight 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function travel_insight_is_tours_enable( $control ) {
		return $control->manager->get_setting( 'travel_insight_theme_options[tours_enable]' )->value();
	}
endif;

if ( ! function_exists( 'travel_insight_is_guide_enable' ) ) :
	/**
	 * Check if guide is enabled.
	 *
	 * @since Travel Insight 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function travel_insight_is_guide_enable( $control ) {
		return $control->manager->get_setting( 'travel_insight_theme_options[guide_enable]' )->value();
	}
endif;

if ( ! function_exists( 'travel_insight_is_call_to_action_enable' ) ) :
	/**
	 * Check if call_to_action is enabled.
	 *
	 * @since Travel Insight 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function travel_insight_is_call_to_action_enable( $control ) {
		return $control->manager->get_setting( 'travel_insight_theme_options[call_to_action_enable]' )->value();
	}
endif;

if ( ! function_exists( 'travel_insight_is_counter_enable' ) ) :
	/**
	 * Check if counter is enabled.
	 *
	 * @since Travel Insight 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function travel_insight_is_counter_enable( $control ) {
		return $control->manager->get_setting( 'travel_insight_theme_options[counter_enable]' )->value();
	}
endif;

if ( ! function_exists( 'travel_insight_counter_content_custom' ) ) :
	/**
	 * Check if counter content custom.
	 *
	 * @since Travel Insight 0.1
	 * @param WP_postize_Control $control WP_postize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function travel_insight_counter_content_custom( $control ) {
		$content_type = $control->manager->get_setting( 'travel_insight_theme_options[counter_content_type]' )->value();
		if ( travel_insight_is_counter_enable( $control ) && 'custom' === $content_type )
			return true;
		else
			return false;
	}
endif;
