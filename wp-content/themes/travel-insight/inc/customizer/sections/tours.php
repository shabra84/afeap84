<?php
/**
 * Tours Section options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

$wp_customize->add_section( 'travel_insight_tours', array(
	'title'             => esc_html__( 'Tours','travel-insight' ),
	'description'       => esc_html__( 'Tours Options.', 'travel-insight' ),
	'panel'             => 'travel_insight_sections_panel',
) );

// Tours Section enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[tours_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['tours_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[tours_enable]', array(
	'label'            	=> esc_html__( 'Enable Tours Section', 'travel-insight' ),
	'section'          	=> 'travel_insight_tours',
	'type'             	=> 'checkbox',
) );

// Tour title setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[tours_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> $options['tours_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'travel_insight_theme_options[tours_title]', array(
	'label'           	=> esc_html__( 'Title', 'travel-insight' ),
	'section'        	=> 'travel_insight_tours',
	'active_callback' 	=> 'travel_insight_is_tours_enable',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'travel_insight_theme_options[tours_title]', array(
		'selector'            => '#tour .wrapper .tour-details .tour-title h4',
		'settings'            => 'travel_insight_theme_options[tours_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'travel_insight_tours_title',
    ) );
}

// Tours category setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[tours_content_category]', array(
	'sanitize_callback' => 'travel_insight_sanitize_category_list'
) );

$wp_customize->add_control( new Travel_Insight_Dropdown_Category_Control( $wp_customize, 'travel_insight_theme_options[tours_content_category]', array(
	'label'           => esc_html__( 'Select Multiple Categories', 'travel-insight' ),
	'description'     => esc_html__( 'Note: Press Shift and Click on multiple categories to select. Selected categories will be shown.', 'travel-insight' ),
	'section'         => 'travel_insight_tours',
	'type'			  => 'dropdown-categories',
	'active_callback' => 'travel_insight_is_tours_enable',
) ) );
