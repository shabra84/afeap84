<?php
/**
 * Blog options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

$wp_customize->add_section( 'travel_insight_blog', array(
	'title'            		=> esc_html__( 'Blog Page','travel-insight' ),
	'description'      		=> esc_html__( 'Blog Page Options.', 'travel-insight' ),
	'panel'            		=> 'travel_insight_theme_options_panel',
) );

// Image enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[blog_img_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['blog_img_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[blog_img_enable]', array(
	'label'            	=> esc_html__( 'Enable Featured Image', 'travel-insight' ),
	'description'       => esc_html__( 'Note: This setting will trigger Blog, Archive & Search Page.', 'travel-insight' ),
	'section'          	=> 'travel_insight_blog',
	'type'             	=> 'checkbox',
) );

// date enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[blog_date_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['blog_date_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[blog_date_enable]', array(
	'label'            	=> esc_html__( 'Enable Post Date', 'travel-insight' ),
	'description'       => esc_html__( 'Note: This setting will trigger Blog, Archive & Search Page.', 'travel-insight' ),
	'section'          	=> 'travel_insight_blog',
	'type'             	=> 'checkbox',
) );

// category enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[blog_category_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['blog_category_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[blog_category_enable]', array(
	'label'            	=> esc_html__( 'Enable Post Categories', 'travel-insight' ),
	'description'       => esc_html__( 'Note: This setting will trigger Blog, Archive & Search Page.', 'travel-insight' ),
	'section'          	=> 'travel_insight_blog',
	'type'             	=> 'checkbox',
) );

// Blog exclude category setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[blog_exclude_categories]', array(
	'sanitize_callback' => 'travel_insight_sanitize_category_list'
) );

$wp_customize->add_control( new Travel_Insight_Dropdown_Category_Control( $wp_customize, 'travel_insight_theme_options[blog_exclude_categories]', array(
	'label'           => esc_html__( 'Select Categories to Exclude', 'travel-insight' ),
	'section'         => 'travel_insight_blog',
	'type'			  => 'dropdown-categories',
) ) );
