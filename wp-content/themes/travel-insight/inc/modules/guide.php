<?php 
/**
 * Guide section
 *
 * This is the template for the content of guide section
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */
if ( ! function_exists( 'travel_insight_add_guide_section' ) ) :
    /**
    * Add guide section
    *
    *@since Travel Insight 0.1
    */
    function travel_insight_add_guide_section() {
        $options = travel_insight_get_theme_options();

        // Check if guide is enabled
        $enable_guide = apply_filters( 'travel_insight_section_status', true, 'guide_enable' );

        if ( true !== $enable_guide ) {
            return false;
        }

        // Get guide section details
        $section_details = array();
        $section_details = apply_filters( 'travel_insight_filter_guide_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return;
        }
        // Render guide section now.
        travel_insight_render_guide_section( $section_details );
    }
endif;
add_action( 'travel_insight_primary_content_action', 'travel_insight_add_guide_section', 70 );


if ( ! function_exists( 'travel_insight_get_guide_section_details' ) ) :
    /**
    * guide section details.
    *
    * @since Travel Insight 0.1
    * @param array $input guide section details.
    */
    function travel_insight_get_guide_section_details( $input ) {
        $options = travel_insight_get_theme_options();

        $content = array();
        
        $ids = array();

        for ( $i = 1; $i <= 6; $i++ ) {
            $id = null;
            if ( isset( $options[ 'guide_content_page_'.$i ] ) ) {
                $id = $options[ 'guide_content_page_'.$i ];
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
            'posts_per_page' => 6,
        );
            

        $posts = get_posts( $args );
        if ( ! empty( $posts ) ) :
            $i = 1;
            foreach ( $posts as $post ) :
                $post_id = $post->ID;
                $icon = get_post_meta( $post_id, 'travel-insight-post-icon', true );
                $content[$i]['title']       = get_the_title( $post_id );
                $content[$i]['icon']        = ! empty( $icon ) ? $icon : 'drop';
                $content[$i]['url']         = get_the_permalink( $post_id );
                $content[$i]['excerpt']     = travel_insight_trim_content( 8, $post );
                $i++;
            endforeach;
        endif;

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// guide section content details.
add_filter( 'travel_insight_filter_guide_section_details', 'travel_insight_get_guide_section_details' );


if ( ! function_exists( 'travel_insight_render_guide_section' ) ) :
    /**
    * Start guide section
    *
    * @return string guide content
    * @since Travel Insight 0.1
    *
    */
    function travel_insight_render_guide_section( $content_details ) {
        $options = travel_insight_get_theme_options();
        $title = ! empty( $options['guide_title'] ) ? $options['guide_title'] : '';  
       
        if ( empty( $content_details ) ) {
            return;
        }
        ?>
        <section id="survival" class="page-section col-3">
            <div class="wrapper">
                <?php if ( ! empty( $title ) ) : ?>
                    <header class="entry-header text-center">
                        <h2 class="entry-title"><?php echo esc_html( $title ); ?></h2>
                    </header><!-- .entry-header -->
                <?php endif; ?>

                <div class="entry-content">
                    <?php foreach ( $content_details as $content_detail ) : ?>
                        <div class="column-wrapper">
                            <div class="survival-guide">
                                <div class="icon-wrapper">
                                    <a href="<?php echo esc_url( $content_detail['url'] ); ?>"><?php echo travel_insight_get_svg( array( 'icon' => esc_attr( $content_detail['icon'] ) ) ); ?></a>
                                </div><!-- .icon-wrapper -->
                                <div class="survival-text">
                                    <h4><a href="<?php echo esc_url( $content_detail['url'] ); ?>"><?php echo esc_html( $content_detail['title'] ); ?></a></h4>
                                    <p><?php echo wp_kses_post( $content_detail['excerpt'] ); ?></p>
                                </div><!-- .survival-text -->
                            </div><!-- .survival-guide -->
                        </div><!-- .column-wrapper -->
                    <?php endforeach; ?>
                </div><!-- .entry-content -->
            </div><!-- .wrapper -->
        </section><!-- #survival -->
    <?php }
endif;