<?php
/**
 * Single Page options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

$wp_customize->add_section( 'travel_insight_single_page', array(
	'title'             => esc_html__( 'Single Page','travel-insight' ),
	'description'       => esc_html__( 'Single Page section options.', 'travel-insight' ),
	'panel'             => 'travel_insight_theme_options_panel',
) );

// Single Page date enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[single_date_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['single_date_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[single_date_enable]', array(
	'label'            	=> esc_html__( 'Enable Post Date', 'travel-insight' ),
	'section'          	=> 'travel_insight_single_page',
	'type'             	=> 'checkbox',
) );

// Single Page category enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[single_category_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['single_category_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[single_category_enable]', array(
	'label'            	=> esc_html__( 'Enable Post Categories', 'travel-insight' ),
	'section'          	=> 'travel_insight_single_page',
	'type'             	=> 'checkbox',
) );

// Single Page author enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[author_box_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['author_box_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[author_box_enable]', array(
	'label'            	=> esc_html__( 'Enable Author Box', 'travel-insight' ),
	'section'          	=> 'travel_insight_single_page',
	'type'             	=> 'checkbox',
) );

// Single Page pagination enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[single_pagination_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['single_pagination_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[single_pagination_enable]', array(
	'label'            	=> esc_html__( 'Enable Pagination', 'travel-insight' ),
	'section'          	=> 'travel_insight_single_page',
	'type'             	=> 'checkbox',
) );

