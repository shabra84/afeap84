<?php
/**
 * Breadcrumb options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

$wp_customize->add_section( 'travel_insight_breadcrumb', array(
	'title'             => esc_html__( 'Breadcrumb','travel-insight' ),
	'description'       => esc_html__( 'Breadcrumb section options.', 'travel-insight' ),
	'panel'             => 'travel_insight_theme_options_panel',
) );

// Breadcrumb enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[breadcrumb_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['breadcrumb_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[breadcrumb_enable]', array(
	'label'            	=> esc_html__( 'Enable Breadcrumb', 'travel-insight' ),
	'section'          	=> 'travel_insight_breadcrumb',
	'type'             	=> 'checkbox',
) );
