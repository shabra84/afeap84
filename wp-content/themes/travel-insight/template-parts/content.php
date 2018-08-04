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
$options = travel_insight_get_theme_options();
$sidebar_enable = travel_insight_is_sidebar_enable();
$img_size = ( false == $sidebar_enable ) ? 'travel-insight-blog' : 'large';
$img_enable_class = ( false == $options['blog_img_enable'] ) ? 'no-img-article' : '';
?>
<footer id="colophon" class="site-footer page-section no-padding-bottom">
<!--<article id="post-<?php the_ID(); ?>" <?php post_class( 'column-wrapper ' . $img_enable_class ); ?>>
-->
	<!--<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php travel_insight_posted_on(); ?>
		</div>
	<?php endif; 

	if ( true === $options['blog_img_enable'] ) :
		if ( has_post_thumbnail() ) : ?> 
			<div class="featured-image">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( $img_size, $attr = array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
				</a>
			</div>
		<?php endif; 
	endif; ?>-->

	<div class="blog-content">
		<header class="entry-header">
			<!--<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; 
			?>-->
		</header><!-- .entry-header -->

		<div class="entry-content">
                    
                    <i style="font-size:84px;margin:0 auto;display:table;margin-top:100px;" class="fas fa-home"></i>
                    
                    
			<p>
				<?php
					the_excerpt();
				?>
			</p>
			<!--<div class="entry-meta">
				<span class="comments-link">
					<?php 
					$comment_display = travel_insight_get_svg( array( 'icon' => 'commenting') ) .  get_comments_number();
					comments_popup_link( $comment_display, $comment_display, $comment_display, 'comments' );

					travel_insight_entry_footer();
					?>
				</span>
			</div>--><!-- .entry-meta -->
		</div><!-- .entry-content -->
	</div><!--.blog-content-->

</article><!-- #post-## -->
