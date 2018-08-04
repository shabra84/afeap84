<?php
/**
 * Popular Destination Section options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

$wp_customize->add_section( 'travel_insight_popular_destination', array(
	'title'             => esc_html__( 'Popular Destination','travel-insight' ),
	'description'       => esc_html__( 'Popular Destination Options.', 'travel-insight' ),
	'panel'             => 'travel_insight_sections_panel',
) );

// Popular Destination Section enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[popular_destination_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['popular_destination_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[popular_destination_enable]', array(
	'label'            	=> esc_html__( 'Enable Popular Destination Section', 'travel-insight' ),
	'section'          	=> 'travel_insight_popular_destination',
	'type'             	=> 'checkbox',
) );

// Popular Destination title setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[popular_destination_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> $options['popular_destination_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'travel_insight_theme_options[popular_destination_title]', array(
	'label'           	=> esc_html__( 'Title', 'travel-insight' ),
	'section'        	=> 'travel_insight_popular_destination',
	'active_callback' 	=> 'travel_insight_is_popular_destination_enable',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'travel_insight_theme_options[popular_destination_title]', array(
		'selector'            => '#popular-destinations .wrapper .entry-header h2.entry-title',
		'settings'            => 'travel_insight_theme_options[popular_destination_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'travel_insight_popular_destination_title',
    ) );
}

// Add popular destination number setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[no_of_popular_destination]', array(
	'default'           => $options['no_of_popular_destination'],
	'sanitize_callback' => 'travel_insight_sanitize_number_range',
	'validate_callback' => 'travel_insight_validate_popular_destination_count',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'travel_insight_theme_options[no_of_popular_destination]', array(
	'label'           	=> esc_html__( 'Number of Destinations', 'travel-insight' ),
	'description'       => esc_html__( 'Note: Min 1 & Max 7. Please input the valid number and save. Then referesh the page to see the change.', 'travel-insight' ),
	'section'         	=> 'travel_insight_popular_destination',
	'type'            	=> 'number',
	'active_callback' 	=> 'travel_insight_is_popular_destination_enable',
	'input_attrs'     	=> array(
		'max' 	=> 7,
		'min' 	=> 1,
		'style' => 'width:100px'
	)
) );

// Popular Destination category setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[popular_destination_content_category]', array(
	'sanitize_callback' => 'travel_insight_sanitize_single_category'
) );

$wp_customize->add_control( new Travel_Insight_Dropdown_Taxonomies_Control( $wp_customize, 'travel_insight_theme_options[popular_destination_content_category]', array(
	'label'           => esc_html__( 'Select Category', 'travel-insight' ),
	'description'     => esc_html__( 'Latest posts from selected category will be shown.', 'travel-insight' ),
	'section'         => 'travel_insight_popular_destination',
	'type'			  => 'dropdown-category',
	'active_callback' => 'travel_insight_is_popular_destination_enable',
) ) );
