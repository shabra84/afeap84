<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

// Add excerpt section
$wp_customize->add_section( 'travel_insight_excerpt_section', array(
	'title'             => esc_html__( 'Excerpt','travel-insight' ),
	'description'       => esc_html__( 'Excerpt section options.', 'travel-insight' ),
	'panel'             => 'travel_insight_theme_options_panel',
) );


// long Excerpt length setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[long_excerpt_length]', array(
	'sanitize_callback' => 'travel_insight_sanitize_number_range',
	'validate_callback' => 'travel_insight_validate_long_excerpt',
	'default'			=> $options['long_excerpt_length'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[long_excerpt_length]', array(
	'label'       => esc_html__( 'Blog Page Excerpt Length', 'travel-insight' ),
	'description' => esc_html__( 'Total words to be displayed in archive page/search page.', 'travel-insight' ),
	'section'     => 'travel_insight_excerpt_section',
	'type'        => 'number',
	'input_attrs' => array(
		'style'       => 'width: 80px;',
		'max'         => 100,
		'min'         => 5,
	),
) );
