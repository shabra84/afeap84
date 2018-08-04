<?php
/**
 * Call To Action Section options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

$wp_customize->add_section( 'travel_insight_call_to_action', array(
	'title'             => esc_html__( 'Call To Action','travel-insight' ),
	'description'       => esc_html__( 'Call To Action Options.', 'travel-insight' ),
	'panel'             => 'travel_insight_sections_panel',
) );

// Call To Action Section enable setting and control.
$wp_customize->add_setting( 'travel_insight_theme_options[call_to_action_enable]', array(
	'sanitize_callback'	=> 'travel_insight_sanitize_checkbox',
	'default'          	=> $options['call_to_action_enable'],
) );

$wp_customize->add_control( 'travel_insight_theme_options[call_to_action_enable]', array(
	'label'            	=> esc_html__( 'Enable Call To Action Section', 'travel-insight' ),
	'section'          	=> 'travel_insight_call_to_action',
	'type'             	=> 'checkbox',
) );

// Show page drop-down setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[call_to_action_content_page]', array(
	'sanitize_callback' => 'travel_insight_sanitize_page'
) );

$wp_customize->add_control( 'travel_insight_theme_options[call_to_action_content_page]', array(
	'label'           	=> esc_html__( 'Select Page', 'travel-insight' ),
	'section'        	=> 'travel_insight_call_to_action',
	'active_callback' 	=> 'travel_insight_is_call_to_action_enable',
	'type'				=> 'dropdown-pages'
) );

// Call to action btn label setting and control
$wp_customize->add_setting( 'travel_insight_theme_options[call_to_action_btn_label]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> $options['call_to_action_btn_label'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'travel_insight_theme_options[call_to_action_btn_label]', array(
	'label'           	=> esc_html__( 'Button Label', 'travel-insight' ),
	'section'        	=> 'travel_insight_call_to_action',
	'active_callback' 	=> 'travel_insight_is_call_to_action_enable',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'travel_insight_theme_options[call_to_action_btn_label]', array(
		'selector'            => '#call-to-action .wrapper .view-more a',
		'settings'            => 'travel_insight_theme_options[call_to_action_btn_label]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'travel_insight_call_to_action_btn_label',
    ) );
}
