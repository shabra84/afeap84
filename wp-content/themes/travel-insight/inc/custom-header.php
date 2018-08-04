<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses travel_insight_header_style()
 */
function travel_insight_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'travel_insight_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/assets/uploads/banner.jpg',
		'default-text-color'     => '303c48',
		'width'                  => 1700,
		'height'                 => 750,
		'flex-height'            => true,
		'wp-head-callback'       => 'travel_insight_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'travel_insight_custom_header_setup' );

if ( ! function_exists( 'travel_insight_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see travel_insight_custom_header_setup().
	 */
	function travel_insight_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
			// Has the text been hidden?
		if ( ! display_header_text() ) :
			$css = ".site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}";
		// If the user has set a custom color for the text use that.
		else :
			$css = ".site-title a,
			.site-description {
				color: #" . esc_attr( $header_text_color ) . "}";
		endif; 

		wp_add_inline_style( 'travel-insight-style', $css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'travel_insight_header_style', 10 );

if ( ! function_exists( 'travel_insight_inline_css' ) ) :
	/**
	 * Custom Header Codes
	 *
	 * @since Travel Insight 0.1
	 *
	 */
	function travel_insight_inline_css() {
		$options = travel_insight_get_theme_options();
		$css = '';

		$pagination_type = isset( $options['pagination_type'] ) ? $options['pagination_type'] : 'default';
		if ( $pagination_type == 'infinite' ) {
			$css .= '
			.site-main nav.pagination.navigation {
				display:none;
			}';
		}

		wp_add_inline_style( 'travel-insight-style', $css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'travel_insight_inline_css', 20 );

if ( ! function_exists( 'travel_insight_custom_header' ) ) :
	/**
	 * Custom Header Codes
	 *
	 * @since Travel Insight 0.1
	 *
	 */
	function travel_insight_custom_header() {
		
		/**
		 * header image
		 *
		 * @since Travel Insight 0.1
		 *
		 */
		$header_image_meta = travel_insight_header_image_meta_option();
		
		if ( ( '' == $header_image_meta && ! get_header_image() ) || ! $header_image_meta ) {
			return;
		}

		if ( is_array( $header_image_meta ) ) {
			$header_image = $header_image_meta[0];
		} else {
			$header_image = $header_image_meta;
		}
		?>
<!-- elimino el banner
		<section id="banner-image" class="page-section" style="background-image:url('<?php echo esc_url( $header_image ); ?>')">
            <div class="wrapper">
                <div class="banner-title">
                    <header class="page-header">
                        <h1 class="page-title"><?php travel_insight_title_as_per_template(); ?></h1>
                    </header><!-- .page-header -->

                    <?php
					/**
				     * travel_insight_add_breadcrumb hook
				     *
				     * @hooked travel_insight_add_breadcrumb -  10
				     *
				     */
				    do_action( 'travel_insight_add_breadcrumb' );
				    ?>
                </div><!-- .page-detail -->
            </div><!-- .wrapper -->
        </section><!-- #header-featured-image  -->
	<?php
	}
endif;
add_action( 'travel_insight_content_start_action', 'travel_insight_custom_header', 20 );
