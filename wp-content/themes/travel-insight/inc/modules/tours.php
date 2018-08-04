<?php 
/**
 * Tours section
 *
 * This is the template for the content of tours section
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */
if ( ! function_exists( 'travel_insight_add_tours_section' ) ) :
    /**
    * Add tours section
    *
    *@since Travel Insight 0.1
    */
    function travel_insight_add_tours_section() {
        $options = travel_insight_get_theme_options();

        // Check if tours is enabled
        $enable_tours = apply_filters( 'travel_insight_section_status', true, 'tours_enable' );

        if ( true !== $enable_tours ) {
            return false;
        }

        // Get tours section details
        $section_details = array();
        $section_details = apply_filters( 'travel_insight_filter_tours_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return;
        }
        // Render tours section now.
        travel_insight_render_tours_section( $section_details );
    }
endif;
add_action( 'travel_insight_primary_content_action', 'travel_insight_add_tours_section', 60 );


if ( ! function_exists( 'travel_insight_get_tours_section_details' ) ) :
    /**
    * tours section details.
    *
    * @since Travel Insight 0.1
    * @param array $input tours section details.
    */
    function travel_insight_get_tours_section_details( $input ) {
        $options = travel_insight_get_theme_options();

        $content = array();
        $cat_ids = ! empty( $options['tours_content_category'] ) ? $options['tours_content_category'] : array();

        // Bail if no valid pages are selected.
        if ( empty( $cat_ids ) ) {
            return $input;
        } else {
            $cat_ids = ( array ) $cat_ids;
        }

        $i = 1;
        foreach ( $cat_ids as $cat_id ) {
            $cat_meta   = get_option( "taxonomy_$cat_id" );
            $content[$i]['title']   = get_the_category_by_ID( $cat_id );
            $content[$i]['icon']    = isset( $cat_meta['custom_term_meta'] ) ? $cat_meta['custom_term_meta'] : 'travel';
            $content[$i]['url']     = get_category_link( $cat_id );
            $i++;
        }


        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// tours section content details.
add_filter( 'travel_insight_filter_tours_section_details', 'travel_insight_get_tours_section_details' );


if ( ! function_exists( 'travel_insight_render_tours_section' ) ) :
    /**
    * Start tours section
    *
    * @return string tours content
    * @since Travel Insight 0.1
    *
    */
    function travel_insight_render_tours_section( $content_details ) {
        $options = travel_insight_get_theme_options();
        $title  = ! empty( $options['tours_title'] ) ? $options['tours_title'] : '';

        if ( empty( $content_details ) ) {
            return;
        }

        ?>
        <section id="tour">
            <div class="wrapper">
                <div class="tour-details">
                    <?php if ( ! empty( $title ) ) : ?>
                        <header class="entry-header">
                            <h2 class="entry-title"><?php echo esc_html( $title ); ?></h2>
                        </header><!-- .entry-header-->
                    <?php endif; ?>

                    <div class="tour-slider" data-slick='{"slidesToShow": 5, "slidesToScroll": 1, "infinite": true, "speed": 1000, "dots": false, "arrows":true, "autoplay": true, "fade": false, "draggable":false }'>
                        <?php foreach( $content_details as $content_detail ) : ?>
                            <div class="slider-item">
                                <a href="<?php echo esc_url( $content_detail['url'] ) ?>">
                                    <?php 
                                    if ( ! empty( $content_detail['icon'] ) ) {
                                        echo travel_insight_get_svg( array( 'icon' => esc_attr( $content_detail['icon'] ) ) );
                                    }
                                    ?>
                                    <span><?php echo esc_html( $content_detail['title'] ); ?></span>
                                </a>
                            </div><!-- .slider-item -->
                        <?php endforeach; ?>
                    </div><!-- .tour-slider -->
                </div><!-- .tour-details -->
            </div><!-- .wrapper -->
        </section><!-- #tour -->
    <?php }
endif;