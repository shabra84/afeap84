<?php
/**
 * Theme Palace Theme Customizer.
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

//load upgrade-to-pro section
require get_template_directory() . '/inc/customizer/upgrade-to-pro/class-customize.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function travel_insight_customize_register( $wp_customize ) {
	$options = travel_insight_get_theme_options();

	// Load custom control functions.
	require get_template_directory() . '/inc/customizer/custom-controls.php';

	// Load customize active callback functions.
	require get_template_directory() . '/inc/customizer/active-callback.php';

	// Load validation callback functions.
	require get_template_directory() . '/inc/customizer/validation.php';

	// Load partial callback functions.
	require get_template_directory() . '/inc/customizer/partial.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Add panel for sections options
	$wp_customize->add_panel( 'travel_insight_sections_panel' , array(
	    'title'      => esc_html__( 'Homepage Section','travel-insight' ),
	    'description'=> esc_html__( 'Homepage Section Options.', 'travel-insight' ),
	    'priority'   => 150,
	) );

	// slider
	require get_template_directory() . '/inc/customizer/sections/slider.php';

	// popular destination
	require get_template_directory() . '/inc/customizer/sections/popular-destination.php';

	// about us
	require get_template_directory() . '/inc/customizer/sections/about-us.php';

	// articles
	require get_template_directory() . '/inc/customizer/sections/articles.php';

	// tours
	require get_template_directory() . '/inc/customizer/sections/tours.php';

	// guide
	require get_template_directory() . '/inc/customizer/sections/guide.php';

	// call to action
	require get_template_directory() . '/inc/customizer/sections/call-to-action.php';

	// Add panel for common theme options
	$wp_customize->add_panel( 'travel_insight_theme_options_panel' , array(
	    'title'      => esc_html__( 'Theme Options','travel-insight' ),
	    'description'=> esc_html__( 'Travel Insight Theme Options.', 'travel-insight' ),
	    'priority'   => 150,
	) );

	// header
	require get_template_directory() . '/inc/customizer/theme-options/header.php';

	// load layout
	require get_template_directory() . '/inc/customizer/theme-options/layout.php';

	// load static homepage option
	require get_template_directory() . '/inc/customizer/theme-options/homepage-static.php';

	// load excerpt option
	require get_template_directory() . '/inc/customizer/theme-options/excerpt.php';

	// load breadcrumb option
	require get_template_directory() . '/inc/customizer/theme-options/breadcrumb.php';

	// load pagination option
	require get_template_directory() . '/inc/customizer/theme-options/pagination.php';

	// load single page option
	require get_template_directory() . '/inc/customizer/theme-options/single.php';

	// load blog page option
	require get_template_directory() . '/inc/customizer/theme-options/blog.php';

	// load footer option
	require get_template_directory() . '/inc/customizer/theme-options/footer.php';

	// load 404 option
	require get_template_directory() . '/inc/customizer/theme-options/404.php';

	// load reset option
	require get_template_directory() . '/inc/customizer/theme-options/reset.php';

}
add_action( 'customize_register', 'travel_insight_customize_register' );

/*
 * Load customizer sanitization functions.
 */
require get_template_directory() . '/inc/customizer/sanitize.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function travel_insight_customize_preview_js() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	wp_enqueue_script( 'travel_insight_customizer', get_template_directory_uri() . '/assets/js/customizer' . $min . '.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'travel_insight_customize_preview_js' );


if ( !function_exists( 'travel_insight_reset_options' ) ) :
	/**
	 * Reset all options
	 *
	 * @since Travel Insight 0.1
	 *
	 * @param bool $checked Whether the reset is checked.
	 * @return bool Whether the reset is checked.
	 */
	function travel_insight_reset_options() {
		$options = travel_insight_get_theme_options();
		if ( true === $options['reset_options'] ) {
			// Reset custom theme options.
			set_theme_mod( 'travel_insight_theme_options', array() );
			// Reset custom header and backgrounds.
			remove_theme_mod( 'header_image' );
            remove_theme_mod( 'header_image_data' );
            remove_theme_mod( 'background_image' );
            remove_theme_mod( 'background_color' );
            remove_theme_mod( 'header_textcolor' );
	    }
	  	else {
		    return false;
	  	}
	}
endif;
add_action( 'customize_save_after', 'travel_insight_reset_options' );

if ( !function_exists( 'travel_insight_customize_scripts' ) ) :
	/**
	 * Custom scripts and styles on customize.php
	 *
	 * @since Travel Insight 0.1
	 */
	function travel_insight_customize_scripts() {
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_script( 'travel_insight_custom_customizer', get_template_directory_uri() . '/assets/js/custom-customizer' . $min . '.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '', true );

		$travel_insight_data = array(
			'reset_message' => esc_html__( 'Refresh the customizer page after saving to view reset effects', 'travel-insight' )
		);

		// Send list of color variables as object to custom customizer js
		wp_localize_script( 'travel_insight_custom_customizer', 'travel_insight_data', $travel_insight_data );
	}
endif;
add_action( 'customize_controls_enqueue_scripts', 'travel_insight_customize_scripts');
