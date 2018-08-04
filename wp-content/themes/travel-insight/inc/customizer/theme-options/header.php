<?php
/**
 * Header options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

// Header Section
$wp_customize->add_section( 'travel_insight_section_header',
	array(
		'title'      			=> esc_html__( 'Header Options', 'travel-insight' ),
		'priority'   			=> 100,
		'panel'      			=> 'travel_insight_theme_options_panel',
	)
);

// site title enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[site_title_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['site_title_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[site_title_enable]', array(
	'label'            	=> esc_html__( 'Enable Site Title', 'travel-insight' ),
	'section'          	=> 'title_tagline',
	'type'             	=> 'checkbox',
) );

// site description enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[site_description_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['site_description_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[site_description_enable]', array(
	'label'            	=> esc_html__( 'Enable Site Description', 'travel-insight' ),
	'section'          	=> 'title_tagline',
	'type'             	=> 'checkbox',
) );

// site logo enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[site_logo_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['site_logo_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[site_logo_enable]', array(
	'label'            	=> esc_html__( 'Enable Site Logo', 'travel-insight' ),
	'section'          	=> 'title_tagline',
	'type'             	=> 'checkbox',
) );

// header social menu enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[header_social_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['header_social_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[header_social_enable]', array(
	'label'            	=> esc_html__( 'Enable Social Menu', 'travel-insight' ),
	'section'          	=> 'travel_insight_section_header',
	'type'             	=> 'checkbox',
) );

// header menu sticky enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[menu_label_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['menu_label_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[menu_label_enable]', array(
	'label'            	=> esc_html__( 'Enable Menu label in responsive view', 'travel-insight' ),
	'section'          	=> 'travel_insight_section_header',
	'type'             	=> 'checkbox',
) );
