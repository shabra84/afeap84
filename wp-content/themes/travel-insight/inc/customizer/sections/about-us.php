<?php
/**
 * About Us Section options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

$wp_customize->add_section( 'travel_insight_about_us', array(
	'title'             => esc_html__( 'About Us','travel-insight' ),
	'description'       => esc_html__( 'About Us Options.', 'travel-insight' ),
	'panel'             => 'travel_insight_sections_panel',
) );

// About Us Section enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[about_us_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['about_us_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[about_us_enable]', array(
	'label'            	=> esc_html__( 'Enable About Us Section', 'travel-insight' ),
	'section'          	=> 'travel_insight_about_us',
	'type'             	=> 'checkbox',
) );

// Show page drop-down setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[about_us_content_page]', array(
	'sanitize_callback' => 'travel_insight_sanitize_page'
) );

$wp_customize->add_control( 'travel_insight_theme_options[about_us_content_page]', array(
	'label'           	=> esc_html__( 'Select Page', 'travel-insight' ),
	'section'        	=> 'travel_insight_about_us',
	'active_callback' 	=> 'travel_insight_is_about_us_enable',
	'type'				=> 'dropdown-pages'
) );

// About Us link setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[about_us_btn_label]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> $options['about_us_btn_label'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'travel_insight_theme_options[about_us_btn_label]', array(
	'label'           	=> esc_html__( 'Button Link Title', 'travel-insight' ),
	'section'        	=> 'travel_insight_about_us',
	'active_callback' 	=> 'travel_insight_is_about_us_enable',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'travel_insight_theme_options[about_us_btn_label]', array(
		'selector'            => '#about .wrapper .entry-content a',
		'settings'            => 'travel_insight_theme_options[about_us_btn_label]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'travel_insight_about_us_btn',
    ) );
}
