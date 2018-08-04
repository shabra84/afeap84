<?php
/**
 * custom helper functions
 *
 * This is the template that includes all the other files for core featured of Travel Insight
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

if( ! function_exists( 'travel_insight_check_enable_status' ) ):
	/**
	 * Check status of content.
	 *
	 * @since Travel Insight 0.1
	 */
  	function travel_insight_check_enable_status( $input, $content_enable ){
		 $options = travel_insight_get_theme_options();

		 // Content status.
		 $content_status = $options[ $content_enable ];

		 if ( ( ! is_home() && is_front_page() ) && ( true === $content_status ) ) {
			$input = true;
		 }
		 else {
			$input = false;
		 }
		 return ( $input );

  	}
endif;
add_filter( 'travel_insight_section_status', 'travel_insight_check_enable_status', 10, 2 );


if ( ! function_exists( 'travel_insight_is_sidebar_enable' ) ) :
	/**
	 * Check if sidebar is enabled in meta box first then in customizer
	 *
	 * @since Travel Insight 0.1
	 */
	function travel_insight_is_sidebar_enable() {
		$options               = travel_insight_get_theme_options();
		$sidebar_position      = $options['sidebar_position'];

		if ( is_home() ) {
			$post_id = get_option( 'page_for_posts' );
			if ( ! empty( $post_id ) )
				$post_sidebar_position = get_post_meta( $post_id, 'travel-insight-sidebar-position', true );
			else
				$post_sidebar_position = '';
		} elseif ( is_archive() || is_search() ) {
			$post_sidebar_position = '';
		} else {
			$post_id = get_the_id();
			$post_sidebar_position = get_post_meta( $post_id, 'travel-insight-sidebar-position', true );
		}

		if ( ( $sidebar_position == 'no-sidebar' && $post_sidebar_position == "" ) || $post_sidebar_position == 'no-sidebar' ) {
			return false;
		} else {
			return true;
		}

	}
endif;


if ( ! function_exists( 'travel_insight_is_frontpage_content_enable' ) ) :
	/**
	 * Check home page ( static ) content status.
	 *
	 *.0
	 *
	 * @param bool $status Home page content status.
	 * @return bool Modified home page content status.
	 */
	function travel_insight_is_frontpage_content_enable( $status ) {
		if ( is_front_page() ) {
			$options = travel_insight_get_theme_options();
			$front_page_content_status = $options['enable_frontpage_content'];
			if ( false === $front_page_content_status ) {
				$status = false;
			}
		}
		return $status;
	}

endif;

add_filter( 'travel_insight_filter_frontpage_content_enable', 'travel_insight_is_frontpage_content_enable' );


add_action( 'travel_insight_simple_breadcrumb', 'travel_insight_simple_breadcrumb' , 10 );
if ( ! function_exists( 'travel_insight_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 *
	 * @param  array $args Arguments
	 */
	function travel_insight_simple_breadcrumb( $args = array() ) {

		/**
		 * Add breadcrumb.
		 *
		 */
		$options = travel_insight_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}

		$args = array(
			'show_on_front'   => false,
			'show_title'      => true,
			'show_browse'     => false,
		);
		breadcrumb_trail( $args );      

		return;
	}

endif;


add_action( 'travel_insight_action_pagination', 'travel_insight_pagination', 10 );
if ( ! function_exists( 'travel_insight_pagination' ) ) :

	/**
	 * pagination.
	 *
	 * @since Travel Insight 0.1
	 */
	function travel_insight_pagination() {
		$options = travel_insight_get_theme_options();
		if ( true == $options['pagination_enable'] ) {
			$pagination = $options['pagination_type'];
			if ( $pagination == 'default' ) :
				the_posts_navigation();
			elseif ( $pagination == 'numeric' || $pagination == 'infinite' ) :
				the_posts_pagination( array(
				    'mid_size' => 4,
				    'prev_text' => '',
				    'next_text' => '',
				) );
			endif;
		}
	}

endif;


add_action( 'travel_insight_action_post_pagination', 'travel_insight_post_pagination', 10 );
if ( ! function_exists( 'travel_insight_post_pagination' ) ) :

	/**
	 * post pagination.
	 *
	 * @since Travel Insight 0.1
	 */
	function travel_insight_post_pagination() {
		$options = travel_insight_get_theme_options();

		if ( false == $options['single_pagination_enable'] ) {
			return;
		}

		the_post_navigation( array(
			'prev_text'                  => esc_html__( 'Previous', 'travel-insight' ),
            'next_text'                  => esc_html__( 'Next', 'travel-insight' ),
			) );
	}
endif;


if ( ! function_exists( 'travel_insight_excerpt_length' ) ) :
	/**
	 * long excerpt
	 * 
	 * @since Travel Insight 0.1
	 * @return long excerpt value
	 */
	function travel_insight_excerpt_length( $length ){
		if ( is_admin() ) {
			return $length;
		}

		$options = travel_insight_get_theme_options();
		$length = $options['long_excerpt_length'];
		return $length;
	}
endif;
add_filter( 'excerpt_length', 'travel_insight_excerpt_length', 999 );


if ( ! function_exists( 'travel_insight_excerpt_more' ) ) :
	// read more
	function travel_insight_excerpt_more( $more ){
		return '...';
	}
endif;
add_filter( 'excerpt_more', 'travel_insight_excerpt_more' );


if ( ! function_exists( 'travel_insight_trim_content' ) ) :
	/**
	 * custom excerpt function
	 * 
	 * @since Travel Insight 0.1
	 * @return  no of words to display
	 */
	function travel_insight_trim_content( $length = 40, $post_obj = null ) {
		global $post;
		if ( is_null( $post_obj ) ) {
			$post_obj = $post;
		}

		$length = absint( $length );
		if ( $length < 1 ) {
			$length = 40;
		}

		$source_content = $post_obj->post_content;
		if ( ! empty( $post_obj->post_excerpt ) ) {
			$source_content = $post_obj->post_excerpt;
		}

		$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );

	   return apply_filters( 'travel_insight_trim_content', $trimmed_content );
	}
endif;


if ( ! function_exists( 'travel_insight_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since Travel Insight 0.1
	 */
	function travel_insight_custom_content_width() {

		global $content_width;
		$sidebar_position = travel_insight_layout();
		switch ( $sidebar_position ) {

		  case 'no-sidebar':
		    $content_width = 1170;
		    break;

		  case 'left-sidebar':
		  case 'right-sidebar':
		    $content_width = 819;
		    break;

		  default:
		    break;
		}
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$content_width = 1170;
		}

	}
endif;
add_action( 'template_redirect', 'travel_insight_custom_content_width' );


if ( ! function_exists( 'travel_insight_layout' ) ) :
	/**
	 * Check home page layout option
	 *
	 * @since Travel Insight 0.1
	 *
	 * @return string Theme Palace layout value
	 */
	function travel_insight_layout() {
		$options = travel_insight_get_theme_options();

		$sidebar_position = $options['sidebar_position'];
		$sidebar_position = apply_filters( 'travel_insight_sidebar_position', $sidebar_position );
		// Check if single and static blog page
		if ( is_singular() || is_home() ) {
			if ( is_home() ) {
				$post_sidebar_position = get_post_meta( get_option( 'page_for_posts' ), 'travel-insight-sidebar-position', true );
			} else {
				$post_sidebar_position = get_post_meta( get_the_ID(), 'travel-insight-sidebar-position', true );
			}
			if ( isset( $post_sidebar_position ) && ! empty( $post_sidebar_position ) ) {
				$sidebar_position = $post_sidebar_position;
			}
		}
		return $sidebar_position;
	}
endif;

if ( ! function_exists( 'travel_insight_footer_sidebar_class' ) ) :
	/**
	 * Count the number of footer sidebars to enable dynamic classes for the footer
	 *
	 * @since Travel Insight 0.1
	 */
	function travel_insight_footer_sidebar_class() {
		$data = array();
		$active_sidebar = array();
	   	$count = 0;

	   	if ( is_active_sidebar( 'travel-insight-footer-widget-area' ) ) {
	   		$active_sidebar[] 	= 'travel-insight-footer-widget-area';
	      	$count++;
	   	}

	   	if ( is_active_sidebar( 'travel-insight-footer-widget-area-2' ) ){
	   		$active_sidebar[] 	= 'travel-insight-footer-widget-area-2';
	      	$count++;
		}

	   	if ( is_active_sidebar( 'travel-insight-footer-widget-area-3' ) ){
	   		$active_sidebar[] 	= 'travel-insight-footer-widget-area-3';
	      	$count++;
	   	}

	   	if ( is_active_sidebar( 'travel-insight-footer-widget-area-4' ) ){
	   		$active_sidebar[] 	= 'travel-insight-footer-widget-area-4';
	      	$count++;
	   	}

	   	$class = '';

	   	switch ( $count ) {
        	case '1':
            $class = 'col-1';
            break;
        	case '2':
            $class = 'col-2';
            break;
        	case '3':
            $class = 'col-3';
            break;
            case '4':
            $class = 'col-4';
            break;
	   	}

		$data['active_sidebar'] = $active_sidebar;
		$data['class']     		= $class;

	   	return $data;
	}
endif;

if ( ! function_exists( 'travel_insight_header_image_meta_option' ) ) :
	/**
	 * Check header image option meta
	 *
	 * @since Travel Insight 0.1
	 *
	 * @return string Header image meta option
	 */
	function travel_insight_header_image_meta_option() {

		$header_image = get_header_image();
		if ( ! is_front_page() && ! is_404() ) :		
			if ( is_archive() || is_search() ) {
				if ( ! empty( $header_image ) )
					return $header_image;
				else
					return get_template_directory_uri() . '/assets/uploads/banner.jpg';
			} else {
				global $post;
				if( is_object( $post ) )
					$post_id = $post->ID;
				else
					$post_id = '';

				$header_image_meta = get_post_meta( $post_id, 'travel-insight-header-image', true );

				if ( 'enable' == $header_image_meta && has_post_thumbnail( $post_id ) ) {
					return wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
				}elseif ( 'default' == $header_image_meta ) {
					if ( ! empty( $header_image ) )
						return $header_image;
					else
						return get_template_directory_uri() . '/assets/uploads/banner.jpg';
				} elseif ( 'disable' == $header_image_meta ) {
					return false;
				} elseif ( 'show-both' == $header_image_meta ) {
					if ( ! empty( $header_image ) )
						$header_img = $header_image;
					else
						$header_img = get_template_directory_uri() . '/assets/uploads/banner.jpg';

					$header_image_both_flag = array( $header_img, 'show-both' );
					return $header_image_both_flag;
				} else {
					if ( ! empty( $header_image ) )
						return $header_image;
					else
						return get_template_directory_uri() . '/assets/uploads/banner.jpg';
				}
			}
		endif;
	}
endif;

if ( ! function_exists( 'travel_insight_title_as_per_template' ) ) :
	/**
	 * Return title as per template rendered
	 *
	 * @since Travel Insight 0.1
	 *
	 * @return string Template title
	 */
	function travel_insight_title_as_per_template() {
		if ( is_singular() ) {
			the_title();
		} elseif( is_404() ) {
			esc_html_e( '404', 'travel-insight' );
		} elseif( is_search() ){
			printf( esc_html__( 'Search Result for: %s', 'travel-insight' ), get_search_query() );
		} elseif ( is_archive() ) {
			if ( class_exists( 'WooCommerce' ) && is_shop() )
				woocommerce_page_title();
			else
				the_archive_title();
		} elseif ( is_home() ) {
			$blog_page = get_option( 'page_for_posts' );
			if ( ! empty( $blog_page ) ) :
				echo wp_kses_post( get_the_title( $blog_page ) );
			else :
				esc_html_e( 'Blogs', 'travel-insight' );
			endif;
		}
	}
endif;

if( !function_exists( 'travel_insight_get_author_profile' ) ) :
	/*
	 * Function to get author profile
	 */           
	function travel_insight_get_author_profile(){
		$options 			= travel_insight_get_theme_options();
		$author_id          = get_the_author_meta( 'ID' );
		$author_description = get_the_author_meta( 'description');

		if ( false === $options['author_box_enable'] ) {
			return;
		}
	    ?>
		<div id="about-author">
			<div class="entry-content">
				<div class="author-image">
					<?php echo get_avatar( $author_id, 100 );  ?>
					<div class="author-name">
						<h6><?php the_author_posts_link(); ?></h6>
						<span class="author"><?php esc_html_e( 'Author','travel-insight' ); ?></span>
					</div><!--.author-name-->
				</div><!-- .author-image -->
				<?php if( !empty( $author_description ) ) : ?>
					<div class="author-content">
						<p><?php echo esc_html( $author_description ); ?></p>
					</div><!-- .author-content -->
				<?php endif; ?>
			</div><!-- .entry-content -->
		</div><!-- .about-author -->
	    <?php
	}
endif;
add_action( 'travel_insight_author_profile', 'travel_insight_get_author_profile' );

if ( ! function_exists( 'travel_insight_blog_pre_post' ) ) :
	/**
	 * Pre get posts for blog page
	 *
	 * @since Travel Insight 0.1
	 */
	function travel_insight_blog_pre_post( $query ) {
		
		$options = travel_insight_get_theme_options(); // get theme options
		$exclude_category = ! empty( $options['blog_exclude_categories'] ) ? ( array ) $options['blog_exclude_categories'] : array();

		if ( is_home() ){
			if ( ! is_admin() && $query->is_main_query() )
				$query->set( 'category__not_in', $exclude_category );
		}
	}
endif;
add_action( 'pre_get_posts', 'travel_insight_blog_pre_post' );
