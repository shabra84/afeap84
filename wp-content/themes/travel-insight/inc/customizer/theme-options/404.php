<?php
/**
 * 404 options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

// 404 Section
$wp_customize->add_section( 'travel_insight_404',
	array(
		'title'      			=> esc_html__( '404 Options', 'travel-insight' ),
		'priority'   			=> 900,
		'panel'      			=> 'travel_insight_theme_options_panel',
	)
);

// Slider Section background setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[404_image]', array(
	'sanitize_callback' => 'travel_insight_sanitize_image'
) );

$wp_customize->add_control(
	new WP_Customize_Image_Control( $wp_customize, 'travel_insight_theme_options[404_image]',
		array(
		'label'       		=> esc_html__( 'Select 404 Image', 'travel-insight' ),
		'description' 		=> sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx in png format.', 'travel-insight' ), 482, 212 ),
		'section'     		=> 'travel_insight_404',
) ) );
