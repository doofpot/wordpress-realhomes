<?php
/**
 * This file contains functions related to property submit and property edit
 */

if ( ! function_exists( 'generate_posts_list' ) ) {
	/**
	 * Generates options list for given post arguments
	 *
	 * @param $post_args
	 * @param int $selected
	 */
	function generate_posts_list( $post_args, $selected = 0 ) {

		$defaults = array( 'posts_per_page' => -1, 'suppress_filters' => true );

		if ( is_array( $post_args ) ) {
			$post_args = wp_parse_args( $post_args, $defaults );
		} else {
			$post_args = wp_parse_args( array( 'post_type' => $post_args ), $defaults );
		}

		$posts = get_posts( $post_args );

		if ( isset( $selected ) && is_array( $selected ) ) {
			foreach ( $posts as $post ) :
				?><option value="<?php echo esc_attr( $post->ID ); ?>" <?php if ( in_array( $post->ID, $selected ) ) { echo "selected"; } ?>><?php echo esc_html( $post->post_title ); ?></option><?php
			endforeach;
		} else {
			foreach ( $posts as $post ) :
				?><option value="<?php echo esc_attr( $post->ID ); ?>" <?php if ( isset( $selected ) && ( $selected == $post->ID ) ) { echo "selected"; } ?>><?php echo esc_html( $post->post_title ); ?></option><?php
			endforeach;
		}
	}
}

if ( ! function_exists( 'inspiry_is_edit_property' ) ) :
	/**
	 * Checks if edit property parameter is send
	 * @return bool
	 */
	function inspiry_is_edit_property() {
		if ( isset( $_GET[ 'edit_property' ] ) && ! empty( $_GET[ 'edit_property' ] ) ) {
			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'inspiry_get_submit_fields' ) ) :
	/**
	 * Get submit fields array
	 */
	function inspiry_get_submit_fields() {
		$inspiry_submit_property_fields = get_option( 'inspiry_submit_property_fields' );
		if ( !empty( $inspiry_submit_property_fields ) && is_array( $inspiry_submit_property_fields ) ) {
			return $inspiry_submit_property_fields;
		} else {
			// All fields - To handle the case where related setting is not saved after theme update
			return array(
				'title',
				'description',
				'property-type',
				'property-status',
				'locations',
				'bedrooms',
				'bathrooms',
				'garages',
				'property-id',
				'price',
				'price-postfix',
				'area',
				'area-postfix',
				'lot-size',
				'lot-size-postfix',
				'video',
				'images',
				'address-and-map',
				'additional-details',
				'featured',
				'features',
				'agent',
				'parent',
				'reviewer-message',
				'floor-plans',
			);
		}
	}
endif;

if ( ! function_exists( 'inspiry_render_floor_plans') ) :
	/**
	 * Prints floor plans
	 * @param array|string $floor_plans
	 */
	function inspiry_render_floor_plans( $floor_plans = array() ) {
		if ( ! empty( $floor_plans ) ) :
			foreach ( $floor_plans as $key => $floor_plan ) : ?>
                <div class="inspiry-clone inspiry-group-clone" data-floor-plan="<?php echo esc_attr( $key ); ?>">
                    <div class="inspiry-row">
                        <div class="inspiry-column-md-6">
                            <div class="inspiry-field">
                                <label for="inspiry_floor_plan_name_<?php echo esc_attr( $key ); ?>"><?php esc_html_e('Floor Name', 'framework'); ?></label>
                                <input type="text" id="inspiry_floor_plan_name_<?php echo esc_attr( $key ); ?>" name="inspiry_floor_plans[<?php echo esc_attr( $key ); ?>][inspiry_floor_plan_name]" value="<?php echo esc_attr( $floor_plan['inspiry_floor_plan_name'] ); ?>">
                            </div>
                            <div class="inspiry-field">
                                <label for="inspiry_floor_plan_descr_<?php echo esc_attr( $key ); ?>"><?php esc_html_e('Description', 'framework'); ?></label>
                                <textarea id="inspiry_floor_plan_descr_<?php echo esc_attr( $key ); ?>" class="inspiry-textarea" name="inspiry_floor_plans[<?php echo esc_attr( $key ); ?>][inspiry_floor_plan_descr]"><?php echo esc_attr( $floor_plan['inspiry_floor_plan_descr'] ); ?></textarea>
                            </div>
                        </div>
                        <div class="inspiry-column-md-6">
                            <div class="inspiry-row">
                                <div class="inspiry-column-6">
                                    <div class="inspiry-field">
                                        <label for="inspiry_floor_plan_price_<?php echo esc_attr( $key ); ?>"><?php esc_html_e('Floor Price ( Only digits )', 'framework'); ?></label>
                                        <input type="text" id="inspiry_floor_plan_price_<?php echo esc_attr( $key ); ?>" name="inspiry_floor_plans[<?php echo esc_attr( $key ); ?>][inspiry_floor_plan_price]" value="<?php echo esc_attr( $floor_plan['inspiry_floor_plan_price'] ); ?>">
                                    </div>
                                </div>
                                <div class="inspiry-column-6">
                                    <div class="inspiry-field">
                                        <label for="inspiry_floor_plan_price_postfix"><?php esc_html_e('Price Postfix', 'framework'); ?></label>
                                        <input type="text" id="inspiry_floor_plan_price_postfix" name="inspiry_floor_plans[<?php echo esc_attr( $key ); ?>][inspiry_floor_plan_price_postfix]" value="<?php echo esc_attr( $floor_plan['inspiry_floor_plan_price_postfix'] ); ?>">
                                    </div>
                                </div>
                                <div class="inspiry-column-6">
                                    <div class="inspiry-field">
                                        <label for="inspiry_floor_plan_size_<?php echo esc_attr( $key ); ?>"><?php esc_html_e('Floor Size ( Only digits )', 'framework'); ?></label>
                                        <input type="text" id="inspiry_floor_plan_size_<?php echo esc_attr( $key ); ?>" name="inspiry_floor_plans[<?php echo esc_attr( $key ); ?>][inspiry_floor_plan_size]" value="<?php echo esc_attr( $floor_plan['inspiry_floor_plan_size'] ); ?>">
                                    </div>
                                </div>
                                <div class="inspiry-column-6">
                                    <div class="inspiry-field">
                                        <label for="inspiry_floor_plan_size_postfix_<?php echo esc_attr( $key ); ?>"><?php esc_html_e('Size Postfix', 'framework'); ?></label>
                                        <input type="text" id="inspiry_floor_plan_size_postfix_<?php echo esc_attr( $key ); ?>" name="inspiry_floor_plans[<?php echo esc_attr( $key ); ?>][inspiry_floor_plan_size_postfix]" value="<?php echo esc_attr( $floor_plan['inspiry_floor_plan_size_postfix'] ); ?>">
                                    </div>
                                </div>
                                <div class="inspiry-column-6">
                                    <div class="inspiry-field">
                                        <label for="inspiry_floor_plan_bedrooms_<?php echo esc_attr( $key ); ?>"><?php esc_html_e('Bedrooms', 'framework'); ?></label>
                                        <input type="text" id="inspiry_floor_plan_bedrooms_<?php echo esc_attr( $key ); ?>" name="inspiry_floor_plans[<?php echo esc_attr( $key ); ?>][inspiry_floor_plan_bedrooms]" value="<?php echo esc_attr( $floor_plan['inspiry_floor_plan_bedrooms'] ); ?>">
                                    </div>
                                </div>
                                <div class="inspiry-column-6">
                                    <div class="inspiry-field">
                                        <label for="inspiry_floor_plan_bathrooms_<?php echo esc_attr( $key ); ?>"><?php esc_html_e('Bathrooms', 'framework'); ?></label>
                                        <input type="text" id="inspiry_floor_plan_bathrooms_<?php echo esc_attr( $key ); ?>" name="inspiry_floor_plans[<?php echo esc_attr( $key ); ?>][inspiry_floor_plan_bathrooms]" value="<?php echo esc_attr( $floor_plan['inspiry_floor_plan_bathrooms'] ); ?>">
                                    </div>
                                </div>
                                <div class="inspiry-column-12">
                                    <div class="inspiry-field inspiry-file-input-wrapper">
                                        <label><?php esc_html_e('Floor Plan Image', 'framework'); ?></label>
	                                    <?php
	                                    $inspiry_show_remove_btn = '';
	                                    $inspiry_file_remove_button_class = 'hidden';
                                        if ( isset( $floor_plan['inspiry_floor_plan_image'] ) && ! empty( $floor_plan['inspiry_floor_plan_image'] ) ) {
	                                        $inspiry_show_remove_btn = 'show-remove-btn';
	                                        $inspiry_file_remove_button_class = '';
                                        }
	                                    ?>
                                        <div class="inspiry-btn-group clearfix <?php echo esc_attr( $inspiry_show_remove_btn ); ?>">
                                            <input type="text" class="inspiry-file-input" name="inspiry_floor_plans[<?php echo esc_attr( $key ); ?>][inspiry_floor_plan_image]" value="<?php echo esc_attr( $floor_plan['inspiry_floor_plan_image'] ); ?>">
                                            <a href="#" id="inspiry-file-select-<?php echo esc_attr( $key ); ?>" class="inspiry-file-select real-btn"><?php esc_html_e( 'Select Image', 'framework' ); ?></a>
                                            <a href="#" id="inspiry-file-remove-<?php echo esc_attr( $key ); ?>" class="inspiry-file-remove real-btn <?php echo esc_attr( $inspiry_file_remove_button_class ); ?>"><?php esc_html_e( 'Remove', 'framework' ); ?></a>
                                        </div>
                                        <p class="description"><?php esc_html_e('The recommended minimum width is 770px and height is flexible.', 'framework'); ?></p>
                                        <div class="errors-log"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="inspiry-remove-clone"><i class="dashicons dashicons-minus"></i></a>
                </div>
			<?php endforeach; ?>
		<?php else : ?>
            <div class="inspiry-clone inspiry-group-clone" data-floor-plan="0">
                <div class="inspiry-row">
                    <div class="inspiry-column-md-6">
                        <div class="inspiry-field">
                            <label for="inspiry_floor_plan_name_0"><?php esc_html_e('Floor Name', 'framework'); ?></label>
                            <input type="text" id="inspiry_floor_plan_name_0" name="inspiry_floor_plans[0][inspiry_floor_plan_name]">
                        </div>
                        <div class="inspiry-field">
                            <label for="inspiry_floor_plan_descr_0"><?php esc_html_e('Description', 'framework'); ?></label>
                            <textarea id="inspiry_floor_plan_descr_0" class="inspiry-textarea" name="inspiry_floor_plans[0][inspiry_floor_plan_descr]"></textarea>
                        </div>
                    </div>
                    <div class="inspiry-column-md-6">
                        <div class="inspiry-row">
                            <div class="inspiry-column-6">
                                <div class="inspiry-field">
                                    <label for="inspiry_floor_plan_price_0"><?php esc_html_e('Floor Price ( Only digits )', 'framework'); ?></label>
                                    <input type="text" id="inspiry_floor_plan_price_0" name="inspiry_floor_plans[0][inspiry_floor_plan_price]">
                                </div>
                            </div>
                            <div class="inspiry-column-6">
                                <div class="inspiry-field">
                                    <label for="inspiry_floor_plan_price_postfix_0"><?php esc_html_e('Price Postfix', 'framework'); ?></label>
                                    <input type="text" id="inspiry_floor_plan_price_postfix_0" name="inspiry_floor_plans[0][inspiry_floor_plan_price_postfix]">
                                </div>
                            </div>
                            <div class="inspiry-column-6">
                                <div class="inspiry-field">
                                    <label for="inspiry_floor_plan_size_0"><?php esc_html_e('Floor Size ( Only digits )', 'framework'); ?></label>
                                    <input type="text" id="inspiry_floor_plan_size_0" name="inspiry_floor_plans[0][inspiry_floor_plan_size]">
                                </div>
                            </div>
                            <div class="inspiry-column-6">
                                <div class="inspiry-field">
                                    <label for="inspiry_floor_plan_size_postfix_0"><?php esc_html_e('Size Postfix', 'framework'); ?></label>
                                    <input type="text" id="inspiry_floor_plan_size_postfix_0" name="inspiry_floor_plans[0][inspiry_floor_plan_size_postfix]">
                                </div>
                            </div>
                            <div class="inspiry-column-6">
                                <div class="inspiry-field">
                                    <label for="inspiry_floor_plan_bedrooms_0"><?php esc_html_e('Bedrooms', 'framework'); ?></label>
                                    <input type="text" id="inspiry_floor_plan_bedrooms_0" name="inspiry_floor_plans[0][inspiry_floor_plan_bedrooms]">
                                </div>
                            </div>
                            <div class="inspiry-column-6">
                                <div class="inspiry-field">
                                    <label for="inspiry_floor_plan_bathrooms_0"><?php esc_html_e('Bathrooms', 'framework'); ?></label>
                                    <input type="text" id="inspiry_floor_plan_bathrooms_0" name="inspiry_floor_plans[0][inspiry_floor_plan_bathrooms]">
                                </div>
                            </div>
                            <div class="inspiry-column-12">
                                <div class="inspiry-field inspiry-file-input-wrapper">
                                    <label><?php esc_html_e('Floor Plan Image', 'framework'); ?></label>
                                    <div class="inspiry-btn-group clearfix">
                                        <input type="text" class="inspiry-file-input" name="inspiry_floor_plans[0][inspiry_floor_plan_image]">
                                        <a href="#" id="inspiry-file-select-0" class="inspiry-file-select real-btn"><?php esc_html_e('Select Image', 'framework'); ?></a>
                                        <a href="#" id="inspiry-file-remove-0" class="inspiry-file-remove real-btn hidden"><?php esc_html_e('Remove', 'framework'); ?></a>
                                    </div>
                                    <p class="description"><?php esc_html_e('The recommended minimum width is 770px and height is flexible.', 'framework'); ?></p>
                                    <div class="errors-log"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		<?php
		endif;
	}
endif;

if ( ! function_exists( 'inspiry_render_floor_plan_group_labels') ) :
	/**
	 * Prints floor plans group labels for clone fields
	 */
	function inspiry_render_floor_plan_group_labels() { ?>
        <div id="floor-plan-group-labels"
             data-name="<?php esc_html_e( 'Floor Name', 'framework' ); ?>"
             data-description="<?php esc_html_e( 'Description', 'framework' ); ?>"
             data-price="<?php esc_html_e( 'Floor Price ( Only digits )', 'framework' ); ?>"
             data-price-postfix="<?php esc_html_e( 'Price Postfix', 'framework' ); ?>"
             data-size="<?php esc_html_e( 'Floor Size ( Only digits )', 'framework' ); ?>"
             data-size-postfix="<?php esc_html_e( 'Size Postfix', 'framework' ); ?>"
             data-bedrooms="<?php esc_html_e( 'Bedrooms', 'framework' ); ?>"
             data-bathrooms="<?php esc_html_e( 'Bathrooms', 'framework' ); ?>"
             data-image="<?php esc_html_e( 'Floor Plan Image', 'framework' ); ?>"
             data-select-button="<?php esc_html_e( 'Select Image', 'framework' ); ?>"
             data-remove-button="<?php esc_html_e( 'Remove', 'framework' ); ?>"
             data-image-description="<?php esc_html_e( 'The recommended minimum width is 770px and height is flexible.', 'framework' ); ?>"></div>
		<?php
	}
endif;

if ( ! function_exists( 'inspiry_floor_plans') ) :
	/**
	 * Prints floor plans
	 */
	function inspiry_floor_plans() { ?>
        <div class="form-option inspiry-floor-plans-group-wrapper">
            <label><?php esc_html_e( 'Floor Plans', 'framework' ); ?></label>
            <div id="inspiry-floor-plans-container">
				<?php
				if ( inspiry_is_edit_property() ) {
					global $target_property;
					$floor_plans = get_post_meta( $target_property->ID, 'inspiry_floor_plans', true );
					inspiry_render_floor_plans( $floor_plans );
				} else {
					inspiry_render_floor_plans();
				}
				?>
            </div>
            <div class="inspiry-add-clone-container">
                <a href="#" id="inspiry-add-clone" class="inspiry-add-clone"><?php esc_html_e( '+ Add More', 'framework' ); ?></a>
            </div>
			<?php inspiry_render_floor_plan_group_labels(); ?>
        </div><!-- end of floor plans fields wrapper -->
		<?php
	}
endif;

if ( ! function_exists( 'inspiry_submit_floor_plans') ) :
	/**
	 * Attach floor plans details with property
	 * @param $property_id
	 * @param $inspiry_floor_plans
	 */
	function inspiry_submit_floor_plans($property_id, $inspiry_floor_plans ) {

		if ( is_array( $inspiry_floor_plans ) ) {

			foreach ( $inspiry_floor_plans as $floor_plan => $values ){

				// remove empty values before adding to database
				$r = array_filter( $values, 'strlen' );
				if ( empty( $r ) ){
					unset($inspiry_floor_plans[$floor_plan]);
				}
			}

			$inspiry_floor_plans = inspiry_sanitize_floor_plans( $inspiry_floor_plans );

			update_post_meta( $property_id, 'inspiry_floor_plans', $inspiry_floor_plans );
		}
	}
endif;

if ( ! function_exists( 'inspiry_sanitize_floor_plans' ) ) :
	/**
	 * A custom function to sanitize floor plans.
	 *
	 * @since    3.7.1
	 * @param    array $floor_plans The floor plans input.
	 * @return   array $sanitized_floor_plans  The sanitized floor plans.
	 */
	function inspiry_sanitize_floor_plans( $floor_plans ) {

		// Initialize the new array that will hold the sanitize values
		$sanitized_floor_plans = array();

		foreach ( $floor_plans as $index => $floor_plan ) {

			// Loop through the floor plan and sanitize each of its values
			foreach ( $floor_plan as $key => $value ) {

				switch ( $key ) {

					case 'inspiry_floor_plan_image' === $key:
						$sanitized_floor_plans[ $index ][ $key ] = esc_url_raw( $value );
						break;

					case 'inspiry_floor_plan_descr' === $key:
						$sanitized_floor_plans[ $index ][ $key ] = sanitize_textarea_field( $value );
						break;

					default:
						$sanitized_floor_plans[ $index ][ $key ] = sanitize_text_field( $value );
				}
			}
		}

		return $sanitized_floor_plans;
	}
endif;