<?php
/**
 * Destination options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

$wp_customize->add_section( 'travel_insight_destination_single', array(
	'title'            		=> esc_html__( 'Destination Page','travel-insight' ),
	'description'      		=> esc_html__( 'Destination single page options.', 'travel-insight' ),
	'panel'            		=> 'travel_insight_theme_options_panel',
) );

// Destination Section background setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[destination_content_background]', array(
	'sanitize_callback' => 'travel_insight_sanitize_image',
	'default' 			=> $options['destination_content_background'],
) );

$wp_customize->add_control(
	new WP_Customize_Image_Control( $wp_customize, 'travel_insight_theme_options[destination_content_background]',
		array(
		'label'       		=> esc_html__( 'Select Content Background Image', 'travel-insight' ),
		'description' 		=> sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx ', 'travel-insight' ), 1920, 1080 ),
		'section'     		=> 'travel_insight_destination_single',
) ) );


// Destination Related title setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[related_destination_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> $options['related_destination_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'travel_insight_theme_options[related_destination_title]', array(
	'label'           	=> esc_html__( 'Related Destination Title', 'travel-insight' ),
	'section'        	=> 'travel_insight_destination_single',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'travel_insight_theme_options[related_destination_title]', array(
		'selector'            => '#top-places .wrapper .entry-header h2.entry-title',
		'settings'            => 'travel_insight_theme_options[about_us_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'travel_insight_related_destination_title',
    ) );
}

// Destination Related sub title setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[related_destination_sub_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> $options['related_destination_sub_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'travel_insight_theme_options[related_destination_sub_title]', array(
	'label'           	=> esc_html__( 'Related Destination Sub Title', 'travel-insight' ),
	'section'        	=> 'travel_insight_destination_single',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'travel_insight_theme_options[related_destination_sub_title]', array(
		'selector'            => '#top-places .wrapper .entry-header h3.sub-title',
		'settings'            => 'travel_insight_theme_options[about_us_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'travel_insight_related_destination_sub_title',
    ) );
}