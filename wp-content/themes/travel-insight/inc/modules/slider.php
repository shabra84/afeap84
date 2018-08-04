<?php 
/**
 * Slider section
 *
 * This is the template for the content of slider section
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */
if ( ! function_exists( 'travel_insight_add_slider_section' ) ) :
    /**
    * Add slider section
    *
    *@since Travel Insight 0.1
    */
    function travel_insight_add_slider_section() {
        $options = travel_insight_get_theme_options();

        // Check if slider is enabled
        $enable_slider = apply_filters( 'travel_insight_section_status', true, 'slider_enable' );

        if ( true !== $enable_slider ) {
            return false;
        }

        // Get slider section details
        $section_details = array();
        $section_details = apply_filters( 'travel_insight_filter_slider_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return;
        }
        // Render slider section now.
        travel_insight_render_slider_section( $section_details );
    }
endif;
add_action( 'travel_insight_primary_content_action', 'travel_insight_add_slider_section', 10 );


if ( ! function_exists( 'travel_insight_get_slider_section_details' ) ) :
    /**
    * slider section details.
    *
    * @since Travel Insight 0.1
    * @param array $input slider section details.
    */
    function travel_insight_get_slider_section_details( $input ) {
        $options = travel_insight_get_theme_options();

        $ids = array();
        $content = array();

        for ( $i = 1; $i <= 5; $i++ ) {
            $id = null;
            if ( isset( $options[ 'slider_content_page_'.$i ] ) ) {
                $id = $options[ 'slider_content_page_'.$i ];
            }
            if ( ! empty( $id ) ) {
                $ids[] = absint( $id );
            }
        }

        // Bail if no valid pages are selected.
        if ( empty( $ids ) ) {
            return $input;
        }

        $args = array(
            'no_found_rows'  => true,
            'orderby'        => 'post__in',
            'post_type'      => 'page',
            'post__in'       => $ids,
            'posts_per_page' => 5,
        );
            
            $posts = get_posts( $args );
            if ( ! empty( $posts ) ) :
                $i = 1;
                foreach ( $posts as $post ) :
                    $post_id = $post->ID;
                    $content[$i]['title']       = get_the_title( $post_id );
                    $content[$i]['url']         = get_the_permalink( $post_id );
                    $i++;
                endforeach;
            endif;

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// slider section content details.
add_filter( 'travel_insight_filter_slider_section_details', 'travel_insight_get_slider_section_details' );


if ( ! function_exists( 'travel_insight_render_slider_section' ) ) :
    /**
    * Start slider section
    *
    * @return string slider content
    * @since Travel Insight 0.1
    *
    */
    function travel_insight_render_slider_section( $content_details ) {
        $options = travel_insight_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        }

        $slider_background = ! empty( $options['slider_background'] ) ? $options['slider_background'] : get_template_directory_uri() . '/assets/uploads/slider-01.jpg';
        ?>
        <section id="main-slider-section" class="slide-text-only" style="background-image: url('<?php echo esc_url( $slider_background ); ?>');">
            <div class="main-slider">
                <div class="regular" data-effect="linear" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 1000, "dots": false, "arrows":true, "autoplay": true, "fade": true, "draggable": false, "pauseOnHover": true }'>
                    <?php foreach( $content_details as $content_detail ) : ?>
                        <div class="slider-item">
                            <?php if ( true === $options['slider_caption_enable'] ) : ?>
                                <div class="main-slider-contents">
                                    <h2><a href="<?php echo esc_url( $content_detail['url'] ); ?>"><?php echo esc_html( $content_detail['title'] ); ?></a></h2>
                                </div><!-- .main-slider-contents -->
                            <?php endif; ?>
                        </div><!-- .slider-item -->
                    <?php endforeach; ?>
                </div><!-- .regular -->
                <?php if ( true === $options['slider_search_enable'] ) : ?>
                    <div id="search">
                        <?php get_search_form(); ?>
                    </div>
                <?php endif; ?>
            </div><!-- #main-slider -->
      </section><!-- #video-background -->
    <?php }
endif;