<?php
/**
 * Guide Section options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

$wp_customize->add_section( 'travel_insight_guide', array(
	'title'             => esc_html__( 'Guide','travel-insight' ),
	'description'       => esc_html__( 'Guide Options.', 'travel-insight' ),
	'panel'             => 'travel_insight_sections_panel',
) );

// Guide Section enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[guide_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['guide_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[guide_enable]', array(
	'label'            	=> esc_html__( 'Enable Guide Section', 'travel-insight' ),
	'section'          	=> 'travel_insight_guide',
	'type'             	=> 'checkbox',
) );

// Tour title setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[guide_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> $options['guide_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'travel_insight_theme_options[guide_title]', array(
	'label'           	=> esc_html__( 'Title', 'travel-insight' ),
	'section'        	=> 'travel_insight_guide',
	'active_callback' 	=> 'travel_insight_is_guide_enable',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'travel_insight_theme_options[guide_title]', array(
		'selector'            => '#survival .wrapper .entry-header h2.entry-title',
		'settings'            => 'travel_insight_theme_options[guide_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'travel_insight_guide_title',
    ) );
}

for ( $i = 1; $i <= 6; $i++ ) {

	// Show page drop-down setting and control
	$wp_customize->add_setting( 'travel_insight_theme_options[guide_content_page_'. $i .']', array(
		'sanitize_callback' => 'travel_insight_sanitize_page'
	) );

	$wp_customize->add_control( 'travel_insight_theme_options[guide_content_page_'. $i .']', array(
		'label'           	=> sprintf( esc_html__( 'Select Page %d', 'travel-insight' ), $i ),
		'section'        	=> 'travel_insight_guide',
		'active_callback' 	=> 'travel_insight_is_guide_enable',
		'type'				=> 'dropdown-pages'
	) );

}