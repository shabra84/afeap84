<?php
/**
 * Theme Palace basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

$options = travel_insight_get_theme_options();


if ( ! function_exists( 'travel_insight_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since Travel Insight 0.1
	 */
	function travel_insight_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;

add_action( 'travel_insight_doctype', 'travel_insight_doctype', 10 );


if ( ! function_exists( 'travel_insight_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Travel Insight 0.1
	 *
	 */
	function travel_insight_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif;
	}
endif;
add_action( 'travel_insight_before_wp_head', 'travel_insight_head', 10 );

if ( ! function_exists( 'travel_insight_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since Travel Insight 0.1
	 *
	 */
	function travel_insight_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'travel-insight' ); ?></a>

		<?php
	}
endif;

add_action( 'travel_insight_page_start_action', 'travel_insight_page_start', 10 );

if ( ! function_exists( 'travel_insight_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since Travel Insight 0.1
	 *
	 */
	function travel_insight_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'travel_insight_page_end_action', 'travel_insight_page_end', 10 );

if ( ! function_exists( 'travel_insight_header_start' ) ) :
	/**
	 * Header start html codes
	 *
	 * @since Travel Insight 0.1
	 *
	 */
	function travel_insight_header_start() {
		?>
		<header id="masthead" class="site-header" role="banner">
		<?php
	}
endif;
add_action( 'travel_insight_header_action', 'travel_insight_header_start', 10 );

if ( ! function_exists( 'travel_insight_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since Travel Insight 0.1
	 *
	 */
	function travel_insight_site_branding() {
		$options = travel_insight_get_theme_options();
		?>
		<div class="wrapper">
			<div class="site-branding">
				<?php if ( has_custom_logo() && true === $options['site_logo_enable'] ) : ?>
					<div class="site-logo">
			        	<?php the_custom_logo(); ?>
	          		</div><!-- end .site-logo -->
			    <?php endif; 

			    if ( true === $options['site_title_enable'] || true === $options['site_description_enable'] ) : ?>
					<div id="site-header">
						<?php
						if ( true === $options['site_title_enable'] ) :
							if ( is_front_page() && is_home() ) : ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else : ?>
								<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
							endif;
						endif;

						if ( true === $options['site_description_enable'] ) :
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
							<?php
							endif; 
						endif; ?>
					</div>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<?php if ( true === $options['header_social_enable'] ) : 
				wp_nav_menu( array( 
	                'theme_location' => 'social', 
	                'menu_id'        => 'social-menu', 
	                'menu_class'     => 'social-icons', 
	                'fallback_cb'    => false,
	                'depth'    		 => 1,
	                'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>' . travel_insight_get_svg( array( 'icon' => 'chain' ) ),
	            ) ); 
            endif; ?>

		</div>
		<?php
	}
endif;
add_action( 'travel_insight_header_action', 'travel_insight_site_branding', 20 );

if ( ! function_exists( 'travel_insight_site_navigation' ) ) :
	/**
	 * Site navigation codes
	 *
	 * @since Travel Insight 0.1
	 *
	 */
	function travel_insight_site_navigation() {
		$options = travel_insight_get_theme_options();
		$menu_label_class = ( true === $options['menu_label_enable'] ) ? '' : 'no-menu-label';
		?>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle <?php echo esc_attr( $menu_label_class ); ?>" aria-controls="primary-menu" aria-expanded="false">
			<?php if ( true === $options['menu_label_enable'] ) : ?>
				<span class="menu-label"><?php esc_html_e( 'Menu', 'travel-insight' ); ?></span>
			<?php endif; 
				echo travel_insight_get_svg( array( 'icon' => 'menu-bar' ) ); 
				echo travel_insight_get_svg( array( 'icon' => 'close' ) ); 
				?>
			</button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
		<?php
	}
endif;
add_action( 'travel_insight_header_action', 'travel_insight_site_navigation', 30 );


if ( ! function_exists( 'travel_insight_header_end' ) ) :
	/**
	 * Header end html codes
	 *
	 * @since Travel Insight 0.1
	 *
	 */
	function travel_insight_header_end() {
		?>
		</header><!-- #masthead -->
		<?php
	}
endif;

add_action( 'travel_insight_header_action', 'travel_insight_header_end', 50 );

if ( ! function_exists( 'travel_insight_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Travel Insight 0.1
	 *
	 */
	function travel_insight_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'travel_insight_content_start_action', 'travel_insight_content_start', 10 );

if ( ! function_exists( 'travel_insight_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Travel Insight 0.1
	 *
	 */
	function travel_insight_content_end() {
		?>
		</div><!-- #content -->
		<?php
	}
endif;
add_action( 'travel_insight_content_end_action', 'travel_insight_content_end', 10 );

if ( ! function_exists( 'travel_insight_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since Travel Insight 0.1
	 */
	function travel_insight_add_breadcrumb() {
		$options = travel_insight_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		// Bail if Home Page.
		if ( is_front_page() || is_home() ) {
			return;
		}

		echo '<div id="breadcrumb-list" class="os-animation" data-os-animation="fadeInUp">
			<div class="container">';
				/**
				 * travel_insight_simple_breadcrumb hook
				 *
				 * @hooked travel_insight_simple_breadcrumb -  10
				 *
				 */
				do_action( 'travel_insight_simple_breadcrumb' );
		echo '</div><!-- .container -->
			</div><!-- #breadcrumb-list -->';
		return;
	}

endif;
add_action( 'travel_insight_add_breadcrumb', 'travel_insight_add_breadcrumb' , 20 );

if ( ! function_exists( 'travel_insight_footer_widget' ) ) :
	/**
	 * Site footer widgets
	 *
	 * @since Travel Insight 0.1
	 *
	 */
	function travel_insight_footer_widget() {
		$options = travel_insight_get_theme_options();
		$footer_sidebar_data = travel_insight_footer_sidebar_class();
		$footer_sidebar 	 = $footer_sidebar_data['active_sidebar'];
		$footer_class 		 = $footer_sidebar_data['class'];
		if ( empty( $footer_sidebar ) ) {
			return;
		} ?>
		<div class="wrapper">
        	<div class="<?php echo esc_attr( $footer_class ); ?>">
		      	<?php foreach( $footer_sidebar as $active_widget ) : ?>
					<div class="column-wrapper">
			      		<?php 
			      		if ( is_active_sidebar( esc_html( $active_widget ) ) ){
			      			dynamic_sidebar( esc_html( $active_widget ) );
			      		}
			      		?>
			      	</div>
		      	<?php endforeach; ?>
        	</div><!-- .footer-widget-area -->
      	</div><!-- .wrapper -->  
		<?php
	}
endif;
add_action( 'travel_insight_footer', 'travel_insight_footer_widget', 10 );

if ( ! function_exists( 'travel_insight_footer_site_info' ) ) :
	/**
	 * Site footer widgets
	 *
	 * @since Travel Insight 0.1
	 *
	 */
	function travel_insight_footer_site_info() {
		$options = travel_insight_get_theme_options();
		$search = array( '[the-year]', '[site-link]' );

        $replace = array( date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_html( get_bloginfo( 'name', 'display' ) ) . '</a>' );

        $options['copyright_text'] = str_replace( $search, $replace, $options['copyright_text'] );

		$copyright_text = $options['copyright_text'];
		?>
		<div class="bottom-footer">
			<div class="wrapper">
				<div class="pull-left">
					
					<div class="footer-menu">
						<section id="nav_menu-4" class="widget_nav_menu">
							<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'menu', 'fallback_cb' => false ) ); ?>
						</section>
					</div><!-- .bottom-footer-->

					<div class="site-info">
						<p>
							<?php echo travel_insight_santize_allow_tag( $options['copyright_text'] ); ?>
							<!--<span> <?php esc_html_e( ' | ', 'travel-insight' ); ?> </span>
							<?php
							printf( esc_html__( '%1$s by %2$s', 'travel-insight' ), 'Travel Insight', '<a href="' . esc_url( 'https://www.themepalace.com/' ) . '" rel="designer" target="_blank">Theme Palace</a>' ); 
							if ( function_exists( 'the_privacy_policy_link' ) ) {
								the_privacy_policy_link( '<span> | </span>', '' );
							}
							?>
						</p>
       </div>--><!-- .site-info -->
				</div><!-- .pull-left -->

				<div class="pull-right">
					<?php wp_nav_menu( array( 
					'theme_location' => 'social', 
					'menu_class' 	 => 'social-icons', 
					'fallback_cb'    => false,
	                'depth'    		 => 1,
	                'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>' . travel_insight_get_svg( array( 'icon' => 'chain' ) ),
					) ); ?>
				</div><!-- .pull-right -->

			</div><!-- .wrapper -->
		</div><!-- .bottom-footer -->

		<?php if ( true === $options['scroll_top_visible'] ) : ?>
			<div class="backtotop"><?php echo travel_insight_get_svg( array( 'icon' => 'angle-down' ) ); ?></div>
		<?php endif;
	}
endif;
add_action( 'travel_insight_footer', 'travel_insight_footer_site_info', 20 );
