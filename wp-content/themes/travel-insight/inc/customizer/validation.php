<?php
/**
* Customizer validation functions
*
* @package Theme Palace
* @subpackage Travel Insight
* @since Travel Insight 0.1
*/

if ( ! function_exists( 'travel_insight_validate_long_excerpt' ) ) :
  function travel_insight_validate_long_excerpt( $validity, $value ){
         $value = intval( $value );
     if ( empty( $value ) || ! is_numeric( $value ) ) {
         $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'travel-insight' ) );
     } elseif ( $value < 5 ) {
         $validity->add( 'min_no_of_words', esc_html__( 'Minimum no of words is 5', 'travel-insight' ) );
     } elseif ( $value > 100 ) {
         $validity->add( 'max_no_of_words', esc_html__( 'Maximum no of words is 100', 'travel-insight' ) );
     }
     return $validity;
  }
endif;

if ( ! function_exists( 'travel_insight_validate_popular_destination_count' ) ) :
  function travel_insight_validate_popular_destination_count( $validity, $value ){
         $value = intval( $value );
     if ( empty( $value ) || ! is_numeric( $value ) ) {
         $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'travel-insight' ) );
     } elseif ( $value < 1 ) {
         $validity->add( 'min_no_of_destination', esc_html__( 'Minimum no of destinations is 1', 'travel-insight' ) );
     } elseif ( $value > 7 ) {
         $validity->add( 'max_no_of_destination', esc_html__( 'Maximum no of destinations is 7', 'travel-insight' ) );
     }
     return $validity;
  }
endif;
