<?php
/**
 * Core file.
 *
 * This is the template that includes all the other files for core featured of Theme Palace
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

/**
 * Include options function.
 */
require get_template_directory() . '/inc/options.php';


// Load customizer defaults values
require get_template_directory() . '/inc/customizer/defaults.php';


/**
 * Merge values from default options array and values from customizer
 *
 * @return array Values returned from customizer
 * @since Travel Insight 0.1
 */
function travel_insight_get_theme_options() {
  $travel_insight_default_options = travel_insight_get_default_theme_options();

  return array_merge( $travel_insight_default_options , get_theme_mod( 'travel_insight_theme_options', $travel_insight_default_options ) ) ;
}


/**
  * Write message for featured image upload
  *
  * @return array Values returned from customizer
  * @since Travel Insight 0.1
*/
function travel_insight_slider_image_instruction( $content, $post_id ) {
  $allowed = array( 'page' );
  if ( in_array( get_post_type( $post_id ), $allowed ) ) {
      return $content .= '<p><b>' . esc_html__( 'Note', 'travel-insight' ) . ':</b>' . esc_html__( ' The recommended size for image is 1700px by 750px while using it for slider', 'travel-insight' ) . '</p>';
  }
  return $content;
}
add_filter( 'admin_post_thumbnail_html', 'travel_insight_slider_image_instruction', 10, 2);

/**
 * Add breadcrumb functions.
 */
require get_template_directory() . '/inc/breadcrumb-class.php';

/**
 * Add helper functions.
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Add structural hooks.
 */
require get_template_directory() . '/inc/structure.php';

/**
 * Add metabox
 */
require get_template_directory() . '/inc/metabox/metabox.php';
require get_template_directory() . '/inc/metabox/category-metabox.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/modules/sections.php';

/**
 * Custom widget additions.
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/*
 * Icon Function
 */
require get_template_directory() . '/inc/icon-function.php';

