<?php
/**
 * Template for Single Property Fullwidth
 */

get_header();

$get_header_variations = get_option( 'inspiry_header_mod_variation_option', 'one' );
?>
    <div class="selected-header-variation-<?php echo esc_attr( $get_header_variations ); ?>">
		<?php
		if ( inspiry_show_header_search_form() ) {
			get_template_part( 'assets/modern/partials/properties/search/advance' );
		}
		?>
    </div>

    <div class="single-property-fullwidth">
		<?php
		// Property detail page sections
		$sortable_property_sections = array(
			'content'                   => 'true',
			'additional-details'        => 'true',
			'common-note'               => get_option( 'theme_display_common_note', 'true' ),
			'features'                  => 'true',
			'attachments'               => get_option( 'theme_display_attachments', 'true' ),
			'floor-plans'               => 'true',
			'video'                     => get_option( 'theme_display_video', 'true' ),
			'virtual-tour'              => get_option( 'inspiry_display_virtual_tour', 'false' ),
			'map'                       => get_option( 'theme_display_google_map', 'true' ),
			'children'                  => 'true',
			'agent'                     => get_option( 'theme_display_agent_info', 'true' ),
			'energy-performance'        => get_option( 'inspiry_display_energy_performance', 'true' ),
			'rvr/availability-calendar' => get_option( 'inspiry_display_availability_calendar', 'true' )
		);

		$property_sections_order = array_keys( $sortable_property_sections );
		$order_settings          = get_theme_mod( 'inspiry_property_sections_order_default', 'default' );
		if ( 'custom' === $order_settings ) {
			$property_sections_order = get_option( 'inspiry_property_sections_order_mod' );
			$property_sections_order = explode( ',', $property_sections_order );
		}

		if ( have_posts() ):

			while ( have_posts() ): the_post();

				if ( ! post_password_required() ) :

					global $post;

					/**
					 * Property Slider.
					 */
					get_template_part( 'assets/modern/partials/property/single-fullwidth/slider' ); ?>

                    <div id="primary" class="content-area rh_property">
	                    <?php

	                    // Display the login form if login is required and user is not logged in
	                    $prop_detail_login = inspiry_prop_detail_login();
	                    if ( 'yes' == $prop_detail_login && ! is_user_logged_in() ) {
		                    ?>
                            <div class="content-wrapper single-property-section">
                                <div class="container">
                                    <div class="rh_form rh_form__login_wrap rh_property_detail_login">
		                                <?php get_template_part( 'assets/modern/partials/member/login-form' ); ?>
		                                <?php get_template_part( 'assets/modern/partials/member/register-form' ); ?>
                                    </div>
                                </div>
                            </div>
		                    <?php
	                    } else if ( ! empty( $property_sections_order ) && is_array( $property_sections_order ) ) {
		                    // Display sections according to their order
		                    foreach ( $property_sections_order as $section ) {
			                    if ( isset( $sortable_property_sections[ $section ] ) && 'true' === $sortable_property_sections[ $section ] ) {
				                    get_template_part( 'assets/modern/partials/property/single-fullwidth/' . $section );
			                    }
		                    }
	                    }

						/**
						 * Similar Properties.
						 */
						get_template_part( 'assets/modern/partials/property/single-fullwidth/similar-properties' );

						/**
						 * Comments
						 * If comments are open or we have at least one comment, load up the comment template.
						 */
						if ( comments_open() || get_comments_number() ) :?>
                            <div class="comments-content-wrapper single-property-section">
                                <div class="container">
									<?php comments_template(); ?>
                                </div>
                            </div>
						<?php endif; ?>
                    </div><!-- /.content-area -->
				<?php else: ?>
                    <div id="primary" class="content-area">
						<?php echo get_the_password_form(); ?>
                    </div><!-- /.content-area -->
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>
    </div><!-- /.single-property-fullwidth -->
<?php
get_footer();