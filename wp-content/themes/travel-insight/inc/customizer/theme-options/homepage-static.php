<?php
/**
* Homepage (Static ) options
*
* @package Theme Palace
* @subpackage Travel Insight
* @since Travel Insight 0.1
*/

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[enable_frontpage_content]', array(
	'sanitize_callback'   => 'travel_insight_sanitize_checkbox',
	'default'             => $options['enable_frontpage_content'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[enable_frontpage_content]', array(
	'label'       	=> esc_html__( 'Enable Content', 'travel-insight' ),
	'description' 	=> esc_html__( 'Check to enable content on static front page only.', 'travel-insight' ),
	'section'     	=> 'static_front_page',
	'type'        	=> 'checkbox',
) );