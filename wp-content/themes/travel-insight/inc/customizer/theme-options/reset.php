<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'travel_insight_reset_section', array(
	'title'             => esc_html__('Reset all settings','travel-insight'),
	'description'       => esc_html__( 'Caution: All customizer settings will be reset to default. Refresh the page after clicking Save & Publish.', 'travel-insight' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[reset_options]', array(
	'default'           => $options['reset_options'],
	'sanitize_callback' => 'travel_insight_sanitize_checkbox',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'travel_insight_theme_options[reset_options]', array(
	'label'             => esc_html__( 'Check to reset all settings', 'travel-insight' ),
	'section'           => 'travel_insight_reset_section',
	'type'              => 'checkbox',
) );
