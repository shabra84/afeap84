<?php 
/**
 * Call to action section
 *
 * This is the template for the content of call_to_action section
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */
if ( ! function_exists( 'travel_insight_add_call_to_action_section' ) ) :
    /**
    * Add call_to_action section
    *
    *@since Travel Insight 0.1
    */
    function travel_insight_add_call_to_action_section() {
        $options = travel_insight_get_theme_options();

        // Check if call_to_action is enabled
        $enable_call_to_action = apply_filters( 'travel_insight_section_status', true, 'call_to_action_enable' );

        if ( true !== $enable_call_to_action ) {
            return false;
        }

        // Get call_to_action section details
        $section_details = array();
        $section_details = apply_filters( 'travel_insight_filter_call_to_action_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return;
        }
        // Render call_to_action section now.
        travel_insight_render_call_to_action_section( $section_details );
    }
endif;
add_action( 'travel_insight_primary_content_action', 'travel_insight_add_call_to_action_section', 80 );


if ( ! function_exists( 'travel_insight_get_call_to_action_section_details' ) ) :
    /**
    * call_to_action section details.
    *
    * @since Travel Insight 0.1
    * @param array $input call_to_action section details.
    */
    function travel_insight_get_call_to_action_section_details( $input ) {
        $options = travel_insight_get_theme_options();

        $content = array();
       
        $page_id = '';
        
        if ( ! empty( $options['call_to_action_content_page'] ) )
            $page_id = absint( $options['call_to_action_content_page'] );

        // Bail if no valid pages are selected.
        if ( empty( $page_id ) ) {
            return $input;
        }

        $img_array = null;
        if ( has_post_thumbnail( $page_id ) ) {
            $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'full' );
        } else {
            $img_array[0] = get_template_directory_uri() . '/assets/uploads/no-featured-image-1920x1080.jpg';
        }

        if ( isset( $img_array ) ) {
            $content[0]['img_array'] = $img_array;
        }

        $content[0]['title']        = get_the_title( $page_id );
        $content[0]['url']          = get_the_permalink( $page_id );
        $content[0]['excerpt']      = travel_insight_trim_content( 25, get_post( $page_id ) );
        $content[0]['btn_label']    = ! empty( $options['call_to_action_btn_label'] ) ? $options['call_to_action_btn_label'] : '';


        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// call_to_action section content details.
add_filter( 'travel_insight_filter_call_to_action_section_details', 'travel_insight_get_call_to_action_section_details' );


if ( ! function_exists( 'travel_insight_render_call_to_action_section' ) ) :
    /**
    * Start call_to_action section
    *
    * @return string call_to_action content
    * @since Travel Insight 0.1
    *
    */
    function travel_insight_render_call_to_action_section( $content_details ) {
        $options = travel_insight_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        }

        ?>
        <?php foreach ( $content_details as $content_detail ) : ?>
        <section id="call-to-action" class="parallax page-section" style="background-image:url('<?php echo esc_url( $content_detail['img_array'][0] ); ?>')" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="-300">
            <div class="blue-overlay"></div>
            <div class="wrapper">
                <?php if ( ! empty( $content_detail['title'] ) ) : ?>
                    <header class="entry-header text-center">
                        <h2 class="entry-title"><?php echo esc_html( $content_detail['title'] ); ?></h2>
                    </header><!-- .entry-header -->
                <?php endif; 

                if ( ! empty( $content_detail['excerpt'] ) ) : ?>
                    <div class="entry-content">
                        <p><?php echo wp_kses_post( $content_detail['excerpt'] ); ?></p>
                    </div><!-- .entry-content -->
                <?php endif; 

                if ( ! empty( $content_detail['btn_label'] ) ) : ?>
                    <div class="view-more">
                        <a href="<?php echo esc_url( $content_detail['url'] ); ?>" class="btn btn-transparent"><?php echo esc_html( $content_detail['btn_label'] ); ?></a>
                    </div>
                <?php endif; ?>
            </div><!-- .wrapper -->
        </section><!-- #booking-form -->
        <?php endforeach; ?>
    <?php }
endif;