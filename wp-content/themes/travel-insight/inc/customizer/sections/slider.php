<?php
/**
 * Slider Section options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

$wp_customize->add_section( 'travel_insight_slider', array(
	'title'             => esc_html__( 'Featured Slider','travel-insight' ),
	'description'       => esc_html__( 'Slider Section Options.', 'travel-insight' ),
	'panel'             => 'travel_insight_sections_panel',
) );

// Slider Section enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[slider_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['slider_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[slider_enable]', array(
	'label'            	=> esc_html__( 'Enable Slider Section', 'travel-insight' ),
	'section'          	=> 'travel_insight_slider',
	'type'             	=> 'checkbox',
) );

// Slider caption enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[slider_caption_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['slider_caption_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[slider_caption_enable]', array(
	'label'            	=> esc_html__( 'Enable Slider Caption', 'travel-insight' ),
	'section'          	=> 'travel_insight_slider',
	'type'             	=> 'checkbox',
	'active_callback' 	=> 'travel_insight_is_slider_enable',
) );

// Slider Search enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[slider_search_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['slider_search_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[slider_search_enable]', array(
	'label'            	=> esc_html__( 'Enable Search Field', 'travel-insight' ),
	'section'          	=> 'travel_insight_slider',
	'type'             	=> 'checkbox',
	'active_callback' 	=> 'travel_insight_is_slider_enable',
) );


// Slider post hr setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[slider_hr]', array(
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new Travel_Insight_Customize_Horizontal_Line( $wp_customize, 'travel_insight_theme_options[slider_hr]',
	array(
		'section'         => 'travel_insight_slider',
		'active_callback' => 'travel_insight_is_slider_enable',
		'type'			  => 'hr'
) ) );


// Slider Section background setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[slider_background]', array(
	'sanitize_callback' => 'travel_insight_sanitize_image'
) );

$wp_customize->add_control(
	new WP_Customize_Image_Control( $wp_customize, 'travel_insight_theme_options[slider_background]',
		array(
		'label'       		=> esc_html__( 'Select Slider Background', 'travel-insight' ),
		'description' 		=> sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx ', 'travel-insight' ), 1700, 750 ),
		'section'     		=> 'travel_insight_slider',
		'active_callback'	=> 'travel_insight_is_slider_enable',
) ) );

for ( $i = 1; $i <= 5; $i++ ) {
	// Show page drop-down setting and control
	$wp_customize->add_setting( 'travel_insight_theme_options[slider_content_page_'.$i.']', array(
		'sanitize_callback' => 'travel_insight_sanitize_page'
	) );

	$wp_customize->add_control( 'travel_insight_theme_options[slider_content_page_'.$i.']', array(
		'label'           	=> sprintf( esc_html__( 'Select Page %d', 'travel-insight' ), $i ),
		'section'        	=> 'travel_insight_slider',
		'active_callback' 	=> 'travel_insight_is_slider_enable',
		'type'				=> 'dropdown-pages'
	) );
}
