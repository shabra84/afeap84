<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php travel_insight_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; 
	    $header_image_meta = travel_insight_header_image_meta_option();
		if ( is_array( $header_image_meta ) ) {
			$header_image_meta = $header_image_meta[1];
		} 
		if ( 'show-both' == $header_image_meta ) { 
			if ( has_post_thumbnail() ) : ?>
				<figure class="featured-image">
					<?php the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
				</figure>
			<?php endif; 
		} ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'travel-insight' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'travel-insight' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php travel_insight_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
