<?php
/**
 * The template for displaying search form
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url('/') ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'travel-insight' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search', 'travel-insight' ) ?>" value="<?php echo get_search_query(); ?>" name="s">
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php esc_html_e( 'Search', 'travel-insight' ); ?></span><?php echo travel_insight_get_svg( array( 'icon' => 'magnifying-glass') ); ?></button>
</form><!--.search-form-->