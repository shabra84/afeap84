<?php 
/**
 * Articles section
 *
 * This is the template for the content of articles section
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */
if ( ! function_exists( 'travel_insight_add_articles_section' ) ) :
    /**
    * Add articles section
    *
    *@since Travel Insight 0.1
    */
    function travel_insight_add_articles_section() {
        $options = travel_insight_get_theme_options();

        // Check if articles is enabled
        $enable_articles = apply_filters( 'travel_insight_section_status', true, 'articles_enable' );

        if ( true !== $enable_articles ) {
            return false;
        }

        // Get articles section details
        $section_details = array();
        $section_details = apply_filters( 'travel_insight_filter_articles_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return;
        }
        // Render articles section now.
        travel_insight_render_articles_section( $section_details );
    }
endif;
add_action( 'travel_insight_primary_content_action', 'travel_insight_add_articles_section', 40 );


if ( ! function_exists( 'travel_insight_get_articles_section_details' ) ) :
    /**
    * articles section details.
    *
    * @since Travel Insight 0.1
    * @param array $input articles section details.
    */
    function travel_insight_get_articles_section_details( $input ) {
        $options = travel_insight_get_theme_options();

        $content = array();
        $cat_id = '';
            if ( ! empty( $options['articles_content_category'] ) ) {
                $cat_id = $options['articles_content_category'];
            }

        // Bail if no valid pages are selected.
        if ( empty( $cat_id ) ) {
            return $input;
        } else {
            $cat_id = $cat_id;
        }

        $args = array(
            'no_found_rows'  => true,
            'cat'            => $cat_id,
            'post_type'      => 'post',
            'posts_per_page'  => 1,
        );

        $posts = get_posts( $args );
        if ( ! empty( $posts ) ) :
            $i = 1;
            foreach ( $posts as $post ) :
                $post_id = $post->ID;
                $year  = get_the_time( 'Y', $post_id );
                $month = get_the_time( 'm', $post_id );
                $content[$i]['id']          = $post_id;
                $content[$i]['title']       = get_the_title( $post_id );
                $content[$i]['url']         = get_the_permalink( $post_id );
                $content[$i]['date_url']    = get_month_link( $year, $month );
                $content[$i]['date']        = get_the_date( 'd M Y', $post_id );
                $content[$i]['excerpt']     = travel_insight_trim_content( 150, $post );
                $i++;
            endforeach;
        endif;
        // var_dump($content);
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// articles section content details.
add_filter( 'travel_insight_filter_articles_section_details', 'travel_insight_get_articles_section_details' );


if ( ! function_exists( 'travel_insight_render_articles_section' ) ) :
    /**
    * Start articles section
    *
    * @return string articles content
    * @since Travel Insight 0.1
    *
    */
    function travel_insight_render_articles_section( $content_details ) {
        $options = travel_insight_get_theme_options();
        $background_image = ! empty( $options['articles_background'] ) ? $options['articles_background'] : get_template_directory_uri() . '/assets/uploads/background-02.jpg';
      
        if ( empty( $content_details ) ) {
            return;
        }

        $i = 1;
        ?>
        <section id="adventure" class="page-section no-padding-bottom">
            <div class="wrapper">
                <div class="tab-menu">
                    <ul class="nav-tabs clear">
                        <?php if ( ! empty( $options['articles_content_category'] ) ) {
                            $category_list = get_category( $options['articles_content_category'] );
                            ?>
                            <li class="active"><a href="#<?php echo esc_attr( $category_list->slug ); ?>">
                                <?php echo esc_html( $category_list->name ); ?>
                            </a></li>
                        <?php } ?>
                    </ul><!--.tabs-->
                </div><!-- .tab-menu -->
                <div class="tab-content-wrapper">
                    <div id="<?php echo esc_attr( $category_list->slug ); ?>" class="tab-pane <?php echo ( $i == 1 ) ? 'active' : ''; ?>">
                        <div class="tab-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": false, "speed": 800, "dots": false, "arrows":true, "autoplay": true, "fade": false, "draggable":true}'>
                            <?php foreach ( $content_details as $content_detail ) : ?>
                                <div class="tab-slider-item">    
                                    <a href="<?php echo esc_url( $content_detail['date_url'] ); ?>">
                                        <time><?php echo esc_html( $content_detail['date'] ); ?></time>
                                    </a>
                                    <?php  
                                    $tags = get_the_tags( $content_detail['id'] );
                                    if ( ! empty( $tags ) ) : ?>
                                        <div class="article-tags">
                                            <?php foreach ( $tags as $tag ) : ?>
                                                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" rel="tag"><?php echo esc_html( $tag->name ); ?></a>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <header class="entry-header">
                                        <h2 class="entry-title">
                                        <a href="<?php echo esc_url( $content_detail['url'] ); ?>"><?php echo esc_html( $content_detail['title'] ); ?></a></h2>
                                    </header><!-- .entry-header -->

                                    <div class="entry-content">aaa
                                        <p><?php echo esc_html( $content_detail['excerpt'] ); ?></p>
                                    </div><!-- .entry-content -->
                                </div><!-- .tab-slider-item -->
                            <?php endforeach; ?>
                        </div><!-- .tab-slider -->
                    </div><!--.tab-1-->
                </div><!--.tab-content-wrapper-->
            </div><!-- .wrapper -->

            <div class="parallax" style="background-image: url('<?php echo esc_url( $background_image ); ?>">
            </div>
        </section><!-- #adventure -->

    <?php }
endif;