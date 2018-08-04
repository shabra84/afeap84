<?php
/**
 * Articles Section options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

$wp_customize->add_section( 'travel_insight_articles', array(
	'title'             => esc_html__( 'Articles','travel-insight' ),
	'description'       => esc_html__( 'Articles Options.', 'travel-insight' ),
	'panel'             => 'travel_insight_sections_panel',
) );

// Articles Section enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[articles_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['articles_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[articles_enable]', array(
	'label'            	=> esc_html__( 'Enable Articles Section', 'travel-insight' ),
	'section'          	=> 'travel_insight_articles',
	'type'             	=> 'checkbox',
) );

// Articles Section background setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[articles_background]', array(
	'sanitize_callback' => 'travel_insight_sanitize_image',
	'default'			=> $options['articles_background'],
) );

$wp_customize->add_control(
	new WP_Customize_Image_Control( $wp_customize, 'travel_insight_theme_options[articles_background]',
		array(
		'label'       		=> esc_html__( 'Select Background Image', 'travel-insight' ),
		'description' 		=> sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx ', 'travel-insight' ), 1920, 1080 ),
		'section'     		=> 'travel_insight_articles',
		'active_callback'	=> 'travel_insight_is_articles_enable',
) ) );

// Popular Destination category setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[articles_content_category]', array(
	'sanitize_callback' => 'travel_insight_sanitize_single_category'
) );

$wp_customize->add_control( new Travel_Insight_Dropdown_Taxonomies_Control( $wp_customize, 'travel_insight_theme_options[articles_content_category]', array(
	'label'           => esc_html__( 'Select Category', 'travel-insight' ),
	'description'     => esc_html__( 'Latest one post from selected category will be shown.', 'travel-insight' ),
	'section'         => 'travel_insight_articles',
	'type'			  => 'dropdown-category',
	'active_callback' => 'travel_insight_is_articles_enable',
) ) );
