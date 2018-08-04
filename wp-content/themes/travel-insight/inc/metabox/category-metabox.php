<?php
/**
 * Travel Insight category metabox file.
 *
 * This is the template that includes all the other files for metaboxes of Travel Insight theme
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

/**
 * Add meta box to the new category page.
 */
// Add term page
function travel_insight_taxonomy_add_new_meta_field() {
    // this will add the custom meta field to the add new term page
    ?>
    <div class="form-field">
        <label for="term_meta[custom_term_meta]"><?php esc_html_e( 'Select Icon', 'travel-insight' ); ?></label>
        <select name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]">
            <?php $icon_options = travel_insight_icons_options();
            foreach ( $icon_options as $field => $value ) : ?>
                <option value="<?php echo esc_attr( $field ); ?>">
                    <?php echo esc_html( $value ); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php esc_html_e( 'Select appropriate icon for the category.', 'travel-insight' ); ?></p>
    </div>
<?php
}
add_action( 'category_add_form_fields', 'travel_insight_taxonomy_add_new_meta_field', 10, 2 );


/**
 * Edit meta box to the term category page.
 */
function travel_insight_taxonomy_edit_meta_field($term) {
 
    // put the term ID into a variable
    $t_id = $term->term_id;
 
    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option( "taxonomy_$t_id" ); 
    $selected = isset( $term_meta['custom_term_meta'] ) ? $term_meta['custom_term_meta'] : '';
    ?>
    <tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php esc_html_e( 'Icon', 'travel-insight' ); ?></label></th>
        <td>
            <select name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]">
                <?php $icon_options = travel_insight_icons_options();
                foreach ( $icon_options as $field => $value ) : ?>
                    <option value="<?php echo esc_attr( $field ); ?>" <?php selected( $selected, $field, true ) ?>><?php echo esc_html( $value ); ?></option>
                <?php endforeach; ?>
            </select>
            <p class="description"><?php esc_html_e( 'Select appropriate icon for the category.', 'travel-insight' ); ?></p>
        </td>
    </tr>
<?php
}
add_action( 'category_edit_form_fields', 'travel_insight_taxonomy_edit_meta_field', 10, 2 );

/**
 * Save meta data callback function.
 */
function travel_insight_save_taxonomy_custom_meta( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        $cat_keys = array_keys( $_POST['term_meta'] );
        foreach ( $cat_keys as $key ) {
            if ( isset ( $_POST['term_meta'][$key] ) ) {
                $term_meta[$key] = sanitize_text_field( $_POST['term_meta'][$key] );
            }
        }
        // Save the option array.
        update_option( "taxonomy_$t_id", $term_meta );
    }
}  

add_action( 'edited_category', 'travel_insight_save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_category', 'travel_insight_save_taxonomy_custom_meta', 10, 2 );

if ( class_exists( 'TP_Travel_Package' ) ) :
    add_action( 'tp-package-category_add_form_fields', 'travel_insight_taxonomy_add_new_meta_field', 10, 2 );
    add_action( 'tp-package-category_edit_form_fields', 'travel_insight_taxonomy_edit_meta_field', 10, 2 );
    add_action( 'edited_tp-package-category', 'travel_insight_save_taxonomy_custom_meta', 10, 2 );  
    add_action( 'create_tp-package-category', 'travel_insight_save_taxonomy_custom_meta', 10, 2 );
endif;
