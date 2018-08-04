<?php
/**
 * Layout options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

// Add sidebar section
$wp_customize->add_section( 'travel_insight_layout', array(
	'title'               => esc_html__('Layout','travel-insight'),
	'description'         => esc_html__( 'Layout section options.', 'travel-insight' ),
	'panel'               => 'travel_insight_theme_options_panel',
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[sidebar_position]', array(
	'sanitize_callback'   => 'travel_insight_sanitize_select',
	'default'             => $options['sidebar_position'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[sidebar_position]', array(
	'label'               => esc_html__( 'Sidebar Position', 'travel-insight' ),
	'section'             => 'travel_insight_layout',
	'type'                => 'select',
	'choices'			  => travel_insight_sidebar_position(),
) );

// Content width setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[content_width]', array(
	'sanitize_callback'   => 'travel_insight_sanitize_select',
	'default'             => $options['content_width'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[content_width]', array(
	'label'               => esc_html__( 'Content Width', 'travel-insight' ),
	'description'         => esc_html__( 'Note: It works on single post and page', 'travel-insight' ),
	'section'             => 'travel_insight_layout',
	'type'                => 'select',
	'choices'			  => travel_insight_single_content_width(),
) );

// Site layout setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[site_layout]', array(
	'sanitize_callback'   => 'travel_insight_sanitize_select',
	'default'             => $options['site_layout'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'travel-insight' ),
	'section'             => 'travel_insight_layout',
	'type'                => 'select',
	'choices'			  => travel_insight_site_layout(),
) );
