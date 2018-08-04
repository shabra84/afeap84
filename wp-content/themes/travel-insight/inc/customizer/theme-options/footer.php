<?php
/**
 * Footer options
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

// Footer Section
$wp_customize->add_section( 'travel_insight_section_footer',
	array(
		'title'      			=> esc_html__( 'Footer Options', 'travel-insight' ),
		'priority'   			=> 900,
		'panel'      			=> 'travel_insight_theme_options_panel',
	)
);

// footer text
$wp_customize->add_setting( 'travel_insight_theme_options[copyright_text]',
	array(
		'default'       		=> $options['copyright_text'],
		'sanitize_callback'		=> 'travel_insight_santize_allow_tag',
		'transport'				=> 'postMessage',
	)
);
$wp_customize->add_control( 'travel_insight_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Footer Text', 'travel-insight' ),
		'section'    			=> 'travel_insight_section_footer',
		'type'		 			=> 'textarea',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'travel_insight_theme_options[copyright_text]', array(
		'selector'            => 'footer#colophon .wrapper .pull-left .site-info p.copyright',
		'settings'            => 'travel_insight_theme_options[copyright_text]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'travel_insight_footer_site_info_copyright',
    ) );
}

// scroll top visible
$wp_customize->add_setting( 'travel_insight_theme_options[scroll_top_visible]',
	array(
		'default'       		=> $options['scroll_top_visible'],
		'sanitize_callback'		=> 'travel_insight_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'travel_insight_theme_options[scroll_top_visible]',
    array(
		'label'      			=> esc_html__( 'Display Scroll Top Button', 'travel-insight' ),
		'section'    			=> 'travel_insight_section_footer',
		'type'		 			=> 'checkbox',
    )
);
