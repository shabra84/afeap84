<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package travel_insight
	 */

	/**
	 * travel_insight_doctype hook
	 *
	 * @hooked travel_insight_doctype -  10
	 *
	 */
	do_action( 'travel_insight_doctype' );
?>
<head>
<?php
	/**
	 * travel_insight_before_wp_head hook
	 *
	 * @hooked travel_insight_head -  10
	 *
	 */
	do_action( 'travel_insight_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>
<?php
	/**
	 * travel_insight_page_start_action hook
	 *
	 * @hooked travel_insight_page_start -  10
	 *
	 */
	do_action( 'travel_insight_page_start_action' ); 

	/**
	 * travel_insight_before_header hook
	 *
	 * @hooked travel_insight_add_breadcrumb -  20
	 *
	 */
	do_action( 'travel_insight_before_header' );

	/**
	 * travel_insight_header_action hook
	 *
	 * @hooked travel_insight_header_start -  10
	 * @hooked travel_insight_site_branding -  20
	 * @hooked travel_insight_site_navigation -  30
	 * @hooked travel_insight_header_end -  50
	 *
	 */
	do_action( 'travel_insight_header_action' );

	/**
	 * travel_insight_content_start_action hook
	 *
	 * @hooked travel_insight_content_start -  10
	 *
	 */
	do_action( 'travel_insight_content_start_action' );
	
	/**
	 * travel_insight_primary_content_action hook
	 *
	 * @hooked travel_insight_add_slider_section -  10
	 * @hooked travel_insight_add_popular_destination_section -  20
	 * @hooked travel_insight_add_about_us_section -  30
	 * @hooked travel_insight_add_articles_section -  40
	 * @hooked travel_insight_add_tours_section -  60
	 * @hooked travel_insight_add_guide_section -  70
	 * @hooked travel_insight_add_call_to_action_section -  80
	 */
	do_action( 'travel_insight_primary_content_action' );
