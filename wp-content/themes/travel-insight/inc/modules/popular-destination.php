<?php 
/**
 * Popular Destination section
 *
 * This is the template for the content of popular_destination section
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */
if ( ! function_exists( 'travel_insight_add_popular_destination_section' ) ) :
    /**
    * Add popular_destination section
    *
    *@since Travel Insight 0.1
    */
    function travel_insight_add_popular_destination_section() {
        $options = travel_insight_get_theme_options();

        // Check if popular_destination is enabled
        $enable_popular_destination = apply_filters( 'travel_insight_section_status', true, 'popular_destination_enable' );

        if ( true !== $enable_popular_destination ) {
            return false;
        }

        // Get popular_destination section details
        $section_details = array();
        $section_details = apply_filters( 'travel_insight_filter_popular_destination_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return;
        }
        // Render popular_destination section now.
        travel_insight_render_popular_destination_section( $section_details );
    }
endif;
add_action( 'travel_insight_primary_content_action', 'travel_insight_add_popular_destination_section', 20 );


if ( ! function_exists( 'travel_insight_get_popular_destination_section_details' ) ) :
    /**
    * popular_destination section details.
    *
    * @since Travel Insight 0.1
    * @param array $input popular_destination section details.
    */
    function travel_insight_get_popular_destination_section_details( $input ) {
        $options = travel_insight_get_theme_options();

        $content = array();
        $cat_id = '';
        if ( ! empty( $options['popular_destination_content_category'] ) ) {
            $cat_id = $options['popular_destination_content_category'];
        }

        // Bail if no valid pages are selected.
        if ( empty( $cat_id ) ) {
            return $input;
        }else{
            $cat_id = absint( $cat_id );
        }

        $args = array(
            'no_found_rows'  => true,
            'cat'            => $cat_id,
            'post_type'      => 'post',
            'posts_per_page'  => absint( $options['no_of_popular_destination'] ),
        );
            
        $posts = get_posts( $args );
        if ( ! empty( $posts ) ) :
            $i = 1;
            foreach ( $posts as $post ) :
                $post_id = $post->ID;
                $img_array = null;
                if ( has_post_thumbnail( $post_id ) ) {
                    $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
                } else {
                    $img_array[0] =  get_template_directory_uri().'/assets/uploads/no-featured-image-500x500.jpg';
                }

                if ( isset( $img_array ) ) {
                    $content[$i]['img_array'] = $img_array;
                }

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
// popular_destination section content details.
add_filter( 'travel_insight_filter_popular_destination_section_details', 'travel_insight_get_popular_destination_section_details' );


if ( ! function_exists( 'travel_insight_render_popular_destination_section' ) ) :
    /**
    * Start popular_destination section
    *
    * @return string popular_destination content
    * @since Travel Insight 0.1
    *
    */
    function travel_insight_render_popular_destination_section( $content_details ) {
        $options = travel_insight_get_theme_options();
        $title = ! empty( $options['popular_destination_title'] ) ? $options['popular_destination_title'] : '';
        $category_link  = get_category_link( $options['popular_destination_content_category'] );
        $cat_name       = get_the_category_by_ID( $options['popular_destination_content_category'] );
        

        if ( empty( $content_details ) ) {
            return;
        }

        ?>
        <section id="popular-destinations" class="page-section text-center">
            <div class="wrapper">

                <?php if ( ! empty( $title ) ) : ?>
                    <header class="entry-header">
                        <h2 class="entry-title"><?php echo esc_html( $title ); ?></h2>
                    </header><!-- .entry-header-->
                <?php endif; ?>

                <div class="entry-content col-3 gallery-popup">
                    <div class="popular-place clear">
                        <div class="grid <?php echo ( count( $content_details ) === 6 ) ? 'grid-6' : ''; ?> ">
                            <?php foreach( $content_details as $content_detail ) : ?>
                                <div class="grid-item" >
                                    <div class="featured-image" style="background-image: url('<?php echo esc_url( $content_detail['img_array'][0] ) ?>');">
                                    </div><!-- .featured-image -->

                                    <div class="popular-content">
                                        <a href="<?php echo esc_url( $content_detail['img_array'][0] ) ?>" class="popup"><?php echo travel_insight_get_svg( array( 'icon' => 'zoom-in') ); ?></a>
                                        <h4><a href="<?php echo esc_url( $content_detail['url'] ) ?>"><?php echo esc_html( $content_detail['title'] ) ?></a></h4>
                                    </div><!-- .popular-content -->
                                </div><!-- .featured-image -->
                            <?php endforeach; ?>
                        </div><!-- .grid -->
                    </div><!-- .popular-place -->

                    <?php if ( ! empty( $category_link ) ) : ?>
                        <div class="text-center">
                            <a href="<?php echo esc_url( $category_link ); ?>" class="more-link"><?php printf( '%s ' . esc_html( $cat_name ), esc_html__( 'See More', 'travel-insight' ) ); ?><?php echo travel_insight_get_svg( array( 'icon' => 'angle-arrow-pointing-to-right') ); ?></a>
                        </div>
                    <?php endif; ?>
                </div><!-- .entry-content-->
            </div><!-- .wrapper -->
        </section><!-- #destinations -->
    <?php }
endif;