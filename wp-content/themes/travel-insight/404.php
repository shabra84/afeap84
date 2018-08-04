<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

get_header(); 

$options = travel_insight_get_theme_options();
$image_404 = ! empty( $options['404_image'] ) ? $options['404_image'] : get_template_directory_uri() . '/assets/uploads/404.png';
?>
<div class="wrapper page-section">

	<section class="error-404 not-found">
		<header class="page-header">
			<img src="<?php echo esc_url( $image_404 ); ?>" alt="<?php esc_attr_e( '404', 'travel-insight' ); ?>">
			<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'travel-insight' ); ?></h1>
		</header><!-- .page-header -->

		<div class="page-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'travel-insight' ); ?></p>

			<?php get_search_form(); ?>
		</div><!-- .page-content -->
	</section><!-- .error-404 -->

</div><!-- .wrapper -->
<?php
get_footer();
