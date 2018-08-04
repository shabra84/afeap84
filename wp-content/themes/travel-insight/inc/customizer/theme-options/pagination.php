<?php
/**
 * pagination options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

// Add sidebar section
$wp_customize->add_section( 'travel_insight_pagination', array(
	'title'               => esc_html__('Pagination','travel-insight'),
	'description'         => esc_html__( 'Pagination section options.', 'travel-insight' ),
	'panel'               => 'travel_insight_theme_options_panel',
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[pagination_enable]', array(
	'sanitize_callback'   => 'travel_insight_sanitize_checkbox',
	'default'             => $options['pagination_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[pagination_enable]', array(
	'label'               => esc_html__( 'Pagination Enable', 'travel-insight' ),
	'section'             => 'travel_insight_pagination',
	'type'                => 'checkbox',
) );

// Site layout setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[pagination_type]', array(
	'sanitize_callback'   => 'travel_insight_sanitize_select',
	'default'             => $options['pagination_type'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[pagination_type]', array(
	'label'               => esc_html__( 'Pagination Type', 'travel-insight' ),
	'section'             => 'travel_insight_pagination',
	'type'                => 'select',
	'choices'			  => travel_insight_pagination_options(),
	'active_callback'	  => 'travel_insight_is_pagination_enable',
) );
