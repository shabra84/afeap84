<?php
/**
 * Package options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

$wp_customize->add_section( 'travel_insight_package_archive', array(
	'title'            		=> esc_html__( 'Package Page','travel-insight' ),
	'description'      		=> esc_html__( 'Package single page options.', 'travel-insight' ),
	'panel'            		=> 'travel_insight_theme_options_panel',
) );

// Package archive title setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[package_archive_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> $options['package_archive_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'travel_insight_theme_options[package_archive_title]', array(
	'label'           	=> esc_html__( 'Package Archive Title', 'travel-insight' ),
	'description'       => esc_html__( 'Title to display in package archive page.', 'travel-insight' ),
	'section'        	=> 'travel_insight_package_archive',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'travel_insight_theme_options[package_archive_title]', array(
		'selector'            => '#destinations.page-section .wrapper .entry-header h2.entry-title',
		'settings'            => 'travel_insight_theme_options[about_us_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'travel_insight_package_archive_title',
    ) );
}

// Package archive sub title setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[package_archive_sub_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> $options['package_archive_sub_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'travel_insight_theme_options[package_archive_sub_title]', array(
	'label'           	=> esc_html__( 'Package Archive Sub Title', 'travel-insight' ),
	'description'       => esc_html__( 'Sub title to display in package archive page.', 'travel-insight' ),
	'section'        	=> 'travel_insight_package_archive',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'travel_insight_theme_options[package_archive_sub_title]', array(
		'selector'            => '#destinations.page-section .wrapper .entry-header h3.sub-title',
		'settings'            => 'travel_insight_theme_options[about_us_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'travel_insight_package_archive_sub_title',
    ) );
}

// Package search title setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[package_search_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> $options['package_search_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'travel_insight_theme_options[package_search_title]', array(
	'label'           	=> esc_html__( 'Package Search Title', 'travel-insight' ),
	'description'       => esc_html__( 'Title to display in package search page.', 'travel-insight' ),
	'section'        	=> 'travel_insight_package_archive',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'travel_insight_theme_options[package_search_title]', array(
		'selector'            => '#destinations.page-section .wrapper .entry-header h2.entry-title',
		'settings'            => 'travel_insight_theme_options[about_us_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'travel_insight_package_archive_title',
    ) );
}

// Package search sub title setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[package_search_sub_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> $options['package_search_sub_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'travel_insight_theme_options[package_search_sub_title]', array(
	'label'           	=> esc_html__( 'Package Search Sub Title', 'travel-insight' ),
	'description'       => esc_html__( 'Sub title to display in package search page.', 'travel-insight' ),
	'section'        	=> 'travel_insight_package_archive',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'travel_insight_theme_options[package_search_sub_title]', array(
		'selector'            => '#destinations.page-section .wrapper .entry-header h3.sub-title',
		'settings'            => 'travel_insight_theme_options[about_us_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'travel_insight_package_archive_sub_title',
    ) );
}