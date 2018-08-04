<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */


/**
 * travel_insight_content_end_action hook
 *
 * @hooked travel_insight_content_end -  10
 *
 */
do_action( 'travel_insight_content_end_action' );
?>
<footer id="colophon" class="site-footer page-section no-padding-bottom" style="">
	<?php 
	/**
	 * travel_insight_footer hook
	 *
	 * @hooked travel_insight_footer_widget -  10
	 * @hooked travel_insight_footer_site_info -  20
	 *
	 */
	do_action( 'travel_insight_footer' ); 
	?>
</footer><!-- #colophon -->
	
<?php
/**
 * travel_insight_page_end_action hook
 *
 * @hooked travel_insight_page_end -  10
 *
 */
do_action( 'travel_insight_page_end_action' ); 
?>

<?php wp_footer(); ?>

</body>
</html>
