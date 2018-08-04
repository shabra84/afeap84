<?php
/**
 * option functions
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */


if ( ! function_exists( 'travel_insight_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function travel_insight_site_layout() {
        $travel_insight_site_layout = array(
            'wide'  => esc_html__( 'Wide', 'travel-insight' ),
            'boxed' => esc_html__( 'Boxed', 'travel-insight' ),
        );

        $output = apply_filters( 'travel_insight_site_layout', $travel_insight_site_layout );

        return $output;
    }
endif;


if ( ! function_exists( 'travel_insight_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidbar positions
     */
    function travel_insight_sidebar_position() {
        $travel_insight_sidebar_position = array(
            'right-sidebar' => esc_html__( 'Right', 'travel-insight' ),
            'no-sidebar'    => esc_html__( 'No Sidebar', 'travel-insight' ),
        );

        $output = apply_filters( 'travel_insight_sidebar_position', $travel_insight_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'travel_insight_pagination_options' ) ) :
    /**
     * Pagination
     * @return array site pagination options
     */
    function travel_insight_pagination_options() {
        $travel_insight_pagination_options = array(
            'default'   => esc_html__( 'Default(Older/Newer)', 'travel-insight' ),
            'numeric'   => esc_html__( 'Numeric', 'travel-insight' ),
        );

        $output = apply_filters( 'travel_insight_pagination_options', $travel_insight_pagination_options );

        return $output;
    }
endif;

if ( ! function_exists( 'travel_insight_icons_options' ) ) :
    /**
     * Pagination
     * @return array site pagination options
     */
    function travel_insight_icons_options() {
        $travel_insight_icons_options = array(
        'drop'                      => esc_html__( 'Drop', 'travel-insight' ),
        'behance'                   => esc_html__( 'Behance', 'travel-insight' ),
        'deviantart'                => esc_html__( 'Deviantart', 'travel-insight' ),
        'medium'                    => esc_html__( 'Medium', 'travel-insight' ),
        'slideshare'                => esc_html__( 'Slideshare', 'travel-insight' ),
        'snapchat-ghost'            => esc_html__( 'Snapchat Ghost', 'travel-insight' ),
        'yelp'                      => esc_html__( 'Yelp', 'travel-insight' ),
        'vine'                      => esc_html__( 'Vine', 'travel-insight' ),
        'vk'                        => esc_html__( 'VK', 'travel-insight' ),
        'search'                    => esc_html__( 'Search', 'travel-insight' ),
        'envelope-o'                => esc_html__( 'Envelope O', 'travel-insight' ),
        'close'                     => esc_html__( 'Close', 'travel-insight' ),
        'angle-down'                => esc_html__( 'Angle Down', 'travel-insight' ),
        'folder-open'               => esc_html__( 'Folder Open', 'travel-insight' ),
        'twitter'                   => esc_html__( 'Twitter', 'travel-insight' ),
        'facebook'                  => esc_html__( 'Facebook', 'travel-insight' ),
        'github'                    => esc_html__( 'Github', 'travel-insight' ),
        'bars'                      => esc_html__( 'Bars', 'travel-insight' ),
        'google-plus'               => esc_html__( 'Google Plus', 'travel-insight' ),
        'linkedin'                  => esc_html__( 'Linkedin', 'travel-insight' ),
        'quote-right'               => esc_html__( 'Quote Right', 'travel-insight' ),
        'mail-reply'                => esc_html__( 'Mail Reply', 'travel-insight' ),
        'youtube'                   => esc_html__( 'Youtube', 'travel-insight' ),
        'dropbox'                   => esc_html__( 'Dropbox', 'travel-insight' ),
        'instagram'                 => esc_html__( 'Instagram', 'travel-insight' ),
        'flickr'                    => esc_html__( 'Flickr', 'travel-insight' ),
        'tumblr'                    => esc_html__( 'Tumblr', 'travel-insight' ),
        'dribbble'                  => esc_html__( 'Dribbble', 'travel-insight' ),
        'skype'                     => esc_html__( 'Skype', 'travel-insight' ),
        'foursquare'                => esc_html__( 'Foursquare', 'travel-insight' ),
        'wordpress'                 => esc_html__( 'WordPress', 'travel-insight' ),
        'stumbleupon'               => esc_html__( 'Stumbleupon', 'travel-insight' ),
        'digg'                      => esc_html__( 'Digg', 'travel-insight' ),
        'spotify'                   => esc_html__( 'Spotify', 'travel-insight' ),
        'soundcloud'                => esc_html__( 'Soundcloud', 'travel-insight' ),
        'codepen'                   => esc_html__( 'Codepen', 'travel-insight' ),
        'twitch'                    => esc_html__( 'Twitch', 'travel-insight' ),
        'meanpath'                  => esc_html__( 'Meanpath', 'travel-insight' ),
        'pinterest-p'               => esc_html__( 'Pinterest', 'travel-insight' ),
        'get-pocket'                => esc_html__( 'Get Pocket', 'travel-insight' ),
        'vimeo'                     => esc_html__( 'Vimeo', 'travel-insight' ),
        'reddit-alien'              => esc_html__( 'Reddit Alien', 'travel-insight' ),
        'hashtag'                   => esc_html__( 'Hashtag', 'travel-insight' ),
        'chain'                     => esc_html__( 'Chain', 'travel-insight' ),
        'thumb-tack'                => esc_html__( 'Thumb Tack', 'travel-insight' ),
        'arrow-left'                => esc_html__( 'Arrow Left', 'travel-insight' ),
        'arrow-right'               => esc_html__( 'Arrow Right', 'travel-insight' ),
        'play'                      => esc_html__( 'Play', 'travel-insight' ),
        'pause'                     => esc_html__( 'Pause', 'travel-insight' ),
        'tripadvisor'               => esc_html__( 'Tripadvisor', 'travel-insight' ),
        'notebook'                  => esc_html__( 'Notebook', 'travel-insight' ),
        'phone-call'                => esc_html__( 'Phone Call', 'travel-insight' ),
        'ambulance'                 => esc_html__( 'Ambulance', 'travel-insight' ),
        'mountain'                  => esc_html__( 'Mountain', 'travel-insight' ),
        'mountain-1'                => esc_html__( 'Mountain 1', 'travel-insight' ),
        'mountain-2'                => esc_html__( 'Mountain 2', 'travel-insight' ),
        'mountain-3'                => esc_html__( 'Mountain 3', 'travel-insight' ),
        'mountain-4'                => esc_html__( 'Mountain 4', 'travel-insight' ),
        'mountain-5'                => esc_html__( 'Mountain 5', 'travel-insight' ),
        'mountain-6'                => esc_html__( 'Mountain 6', 'travel-insight' ),
        'pills'                     => esc_html__( 'Pills', 'travel-insight' ),
        'pills-1'                   => esc_html__( 'Pills 1', 'travel-insight' ),
        'stethoscope'               => esc_html__( 'Stethoscope', 'travel-insight' ),
        'medical-result'            => esc_html__( 'Medical Result', 'travel-insight' ),
        'calendar-1'                => esc_html__( 'Calendar 1', 'travel-insight' ),
        'calendar-2'                => esc_html__( 'Calendar 2', 'travel-insight' ),
        'calendar-3'                => esc_html__( 'Calendar 3', 'travel-insight' ),
        'calendar-4'                => esc_html__( 'Calendar 4', 'travel-insight' ),
        'calendar-5'                => esc_html__( 'Calendar 5', 'travel-insight' ),
        'mountains'                 => esc_html__( 'Mountains', 'travel-insight' ),
        'mountains-1'               => esc_html__( 'Mountains 1', 'travel-insight' ),
        'goal'                      => esc_html__( 'Goal', 'travel-insight' ),
        'fish'                      => esc_html__( 'Fish', 'travel-insight' ),
        'fish-1'                    => esc_html__( 'Fish 1', 'travel-insight' ),
        'fish-2'                    => esc_html__( 'Fish 2', 'travel-insight' ),
        'lighthouse'                => esc_html__( 'Lighthouse', 'travel-insight' ),
        'lighthouse-1'              => esc_html__( 'Lighthouse 1', 'travel-insight' ),
        'transport'                 => esc_html__( 'Transport', 'travel-insight' ),
        'transport-1'               => esc_html__( 'Transport 1', 'travel-insight' ),
        'transport-2'               => esc_html__( 'Transport 2', 'travel-insight' ),
        'transport-3'               => esc_html__( 'Transport 3', 'travel-insight' ),
        'transport-4'               => esc_html__( 'Transport 4', 'travel-insight' ),
        'transport-5'               => esc_html__( 'Transport 5', 'travel-insight' ),
        'transport-6'               => esc_html__( 'Transport 6', 'travel-insight' ),
        'transport-7'               => esc_html__( 'Transport 7', 'travel-insight' ),
        'transport-8'               => esc_html__( 'Transport 8', 'travel-insight' ),
        'coffee-cup'                => esc_html__( 'Coffee Cup', 'travel-insight' ),
        'coffee-cup-1'              => esc_html__( 'Coffee Cup 1', 'travel-insight' ),
        'coffee-cup-2'              => esc_html__( 'Coffee Cup 2', 'travel-insight' ),
        'ferry-facing-right'        => esc_html__( 'Ferry Facing Right', 'travel-insight' ),
        'aeroplane'                 => esc_html__( 'Aeroplane', 'travel-insight' ),
        'aeroplane-1'               => esc_html__( 'Aeroplane 1', 'travel-insight' ),
        'tea'                       => esc_html__( 'Tea', 'travel-insight' ),
        'nature'                    => esc_html__( 'Nature', 'travel-insight' ),
        'nature-1'                  => esc_html__( 'Nature 1', 'travel-insight' ),
        'sun'                       => esc_html__( 'Sun', 'travel-insight' ),
        'tree-with-many-leaves'     => esc_html__( 'Tree With Many Leaves', 'travel-insight' ),
        'umbrella'                  => esc_html__( 'Umbrella', 'travel-insight' ),
        'rain'                      => esc_html__( 'Rain', 'travel-insight' ),
        'ballons'                   => esc_html__( 'Ballons', 'travel-insight' ),
        'cloud-1'                   => esc_html__( 'Cloud 1', 'travel-insight' ),
        'travel'                    => esc_html__( 'Travel', 'travel-insight' ),
        'car'                       => esc_html__( 'Car', 'travel-insight' ),
        'double-bed'                => esc_html__( 'Double Bed', 'travel-insight' ),
        'angle-arrow-pointing-to-right' => esc_html__( 'Angle Arrow Pointing To Right', 'travel-insight' ),
        'star'                      => esc_html__( 'Star', 'travel-insight' ),
        'man-user'                  => esc_html__( 'Man User', 'travel-insight' ),
        'flag'                      => esc_html__( 'Flag', 'travel-insight' ),
        'chat'                      => esc_html__( 'Chat', 'travel-insight' ),
        'commenting'                => esc_html__( 'Commenting', 'travel-insight' ),
        'eye-open'                  => esc_html__( 'Eye Open', 'travel-insight' ),
        'forest'                    => esc_html__( 'Forest', 'travel-insight' ),
        'sunbed'                    => esc_html__( 'Sunbed', 'travel-insight' ),
        'angle-arrow-down'          => esc_html__( 'Angle Arrow Down', 'travel-insight' ),
        'up-arrow'                  => esc_html__( 'Up Arrow', 'travel-insight' ),
        'wallet-filled-money-tool'  => esc_html__( 'Wallet Filled Money Tool', 'travel-insight' ),
        'cloud'                     => esc_html__( 'Cloud', 'travel-insight' ),
        'calendar'                  => esc_html__( 'Calendar', 'travel-insight' ),
        'deer'                      => esc_html__( 'Deer', 'travel-insight' ),
        'hiking-sticks'             => esc_html__( 'Hiking Sticks', 'travel-insight' ),
        'ship'                      => esc_html__( 'Ship', 'travel-insight' ),
        'balloon-flying'            => esc_html__( 'Balloon Flying', 'travel-insight' ),
        'zoom-in'                   => esc_html__( 'Zoom In', 'travel-insight' ),
        'magnifying-glass'          => esc_html__( 'Magnifying Glass', 'travel-insight' ),
        'passport'                  => esc_html__( 'Passport', 'travel-insight' ),
        'menu-bar'                  => esc_html__( 'Menu Bar', 'travel-insight' ),
      );

      $output = apply_filters( 'travel_insight_icons_options', $travel_insight_icons_options );

      return $output;
    }
endif;

if ( ! function_exists( 'travel_insight_selected_sidebar' ) ) :
    /**
     * Sidebar selected
     * @return array Sidbar selected
     */
    function travel_insight_selected_sidebar() {
        $travel_insight_selected_sidebar = array(
            'sidebar-1'                          => esc_html__( 'Primary Sidebar', 'travel-insight' ),
            'travel-insight-optional-sidebar'    => esc_html__( 'Optional Sidebar 1', 'travel-insight' ),
        );

        $output = apply_filters( 'travel_insight_selected_sidebar', $travel_insight_selected_sidebar );

        return $output;
    }
endif;

if ( ! function_exists( 'travel_insight_header_image' ) ) :
    /**
     * Header image options
     * @return array Header image options
     */
    function travel_insight_header_image() {
        $travel_insight_header_image = array(
            'show-both' => esc_html__( 'Show Both( Featured and Header Image )', 'travel-insight' ),
            'enable'    => esc_html__( 'Enable( Featured Image )', 'travel-insight' ),
            'default'   => esc_html__( 'Default ( Customizer Header Image )', 'travel-insight' ),
        );

        $output = apply_filters( 'travel_insight_header_image', $travel_insight_header_image );

        return $output;
    }
endif;

if ( ! function_exists( 'travel_insight_single_content_width' ) ) :
    /**
     * content width
     * @return array content width
     */
    function travel_insight_single_content_width() {
        $travel_insight_single_content_width = array(
            'content-width' => esc_html__( 'Content Width', 'travel-insight' ),
            'full-width'    => esc_html__( 'Full Width', 'travel-insight' ),
        );

        $output = apply_filters( 'travel_insight_single_content_width', $travel_insight_single_content_width );

        return $output;
    }
endif;
