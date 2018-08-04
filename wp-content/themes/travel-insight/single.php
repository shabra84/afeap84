<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

get_header(); 
?>
<div class="wrapper page-section no-padding-bottom">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );

			/**
			* Hook travel_insight_action_post_pagination
			*  
			* @hooked travel_insight_post_pagination 
			*/
			do_action( 'travel_insight_action_post_pagination' );

			/**
			* Hook travel_insight_author_profile
			*  
			* @hooked travel_insight_get_author_profile 
			*/
			do_action( 'travel_insight_author_profile' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	if ( travel_insight_is_sidebar_enable() ) {
		get_sidebar();
	}
	?>
</div><!-- end .wrapper -->
<?php
get_footer();
