<?php 
/**
 * About Us section
 *
 * This is the template for the content of about_us section
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */
if ( ! function_exists( 'travel_insight_add_about_us_section' ) ) :
    /**
    * Add about_us section
    *
    *@since Travel Insight 0.1
    */
    function travel_insight_add_about_us_section() {
        $options = travel_insight_get_theme_options();

        // Check if about_us is enabled
        $enable_about_us = apply_filters( 'travel_insight_section_status', true, 'about_us_enable' );

        if ( true !== $enable_about_us ) {
            return false;
        }

        // Get about_us section details
        $section_details = array();
        $section_details = apply_filters( 'travel_insight_filter_about_us_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return;
        }
        // Render about_us section now.
        travel_insight_render_about_us_section( $section_details );
    }
endif;
add_action( 'travel_insight_primary_content_action', 'travel_insight_add_about_us_section', 30 );


if ( ! function_exists( 'travel_insight_get_about_us_section_details' ) ) :
    /**
    * about_us section details.
    *
    * @since Travel Insight 0.1
    * @param array $input about_us section details.
    */
    function travel_insight_get_about_us_section_details( $input ) {
        $options = travel_insight_get_theme_options();

        $content = array();
       
        $page_id = '';
        
        if ( ! empty( $options['about_us_content_page'] ) )
            $page_id = absint( $options['about_us_content_page'] );

        // Bail if no valid pages are selected.
        if ( empty( $page_id ) ) {
            return $input;
        }

        $img_array = null;
        if ( has_post_thumbnail( $page_id ) ) {
            $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'post-thumbnail' );
        } 

        if ( isset( $img_array ) ) {
            $content[0]['img_array'] = $img_array;
        }

        $content[0]['title']        = get_the_title( $page_id );
        $content[0]['url']          = get_the_permalink( $page_id );
        $content[0]['excerpt']      = travel_insight_trim_content( 75, get_post( $page_id ) );
        $content[0]['btn_label']    = ! empty( $options['about_us_btn_label'] ) ? $options['about_us_btn_label'] : '';

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// about_us section content details.
add_filter( 'travel_insight_filter_about_us_section_details', 'travel_insight_get_about_us_section_details' );


if ( ! function_exists( 'travel_insight_render_about_us_section' ) ) :
    /**
    * Start about_us section
    *
    * @return string about_us content
    * @since Travel Insight 0.1
    *
    */
    function travel_insight_render_about_us_section( $content_details ) {
        $options = travel_insight_get_theme_options();
        $image_alignment = ! empty( $options['about_us_alignment'] ) ? $options['about_us_alignment'] : 'align-left';

        if ( empty( $content_details ) ) {
            return;
        }

        ?>
        <?php foreach ( $content_details as $content_detail ) : ?>
            <section id="about" class="page-section <?php echo ( ! empty( $content_detail['img_array'] ) ) ? 'col-2' : 'col-1'; ?>">
                <div class="wrapper">
                    <div class="column-wrapper <?php echo esc_attr( $image_alignment ); ?>">
                        <?php if ( ! empty( $content_detail['title'] ) ) : ?>
                            <header class="entry-header">
                                <h2 class="entry-title"><?php echo esc_html( $content_detail['title'] ); ?></h2>
                            </header><!-- .entry-header -->
                        <?php endif; ?>

                        <?php if ( ! empty( $content_detail['excerpt'] ) ) : ?>
                            <div class="entry-content">
                                <p><?php echo wp_kses_post( $content_detail['excerpt'] ); ?></p>
                                <?php if ( ! empty( $content_detail['url'] ) ) : ?>
                                    <a href="<?php echo esc_url( $content_detail['url'] ); ?>" class="btn btn-transparent"><?php echo esc_html( $content_detail['btn_label'] ); ?></a>
                                <?php endif; ?>
                            </div><!-- .entry-content -->
                        <?php endif; ?>
                    </div><!-- .column-wrapper -->

                    <?php if ( ! empty( $content_detail['img_array'] ) ) : ?>
                        <div class="column-wrapper">
                            <div class="hero-banner">
                                <a href="<?php echo esc_url( $content_detail['url'] ); ?>">
                                    <div class="featured-image" style="background-image:url('<?php echo esc_url( $content_detail['img_array'][0] ); ?>');">
                                    </div><!-- .featured-image -->
                                </a>
                            </div><!-- .hero-slider -->
                        </div><!-- .column-wrapper -->
                    <?php endif; ?>
                </div><!-- .wrapper -->
            </section><!-- #about -->
        <?php endforeach; ?>
    <?php }
endif;