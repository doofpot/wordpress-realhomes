<?php
global $post;

$features_terms = get_the_terms( get_the_ID(), 'property-feature' );

if ( ! empty( $features_terms ) ) : ?>
    <div class="features-content-wrapper single-property-section">
        <div class="container">
            <div class="rh_property__features_wrap">
				<?php
				$property_features_title = get_option( 'theme_property_features_title' );
				if ( ! empty( $property_features_title ) ) {
					?><h4 class="rh_property__heading"><?php echo esc_html( $property_features_title ); ?></h4><?php
				}
				?>
                <ul class="rh_property__features arrow-bullet-list">
					<?php
					foreach ( $features_terms as $fet_trms ) {
						echo '<li class="rh_property__feature" id="rh_property__feature_' . esc_attr( $fet_trms->term_id ) . '">';
						echo '<a href="' . esc_attr( get_term_link( $fet_trms->slug, 'property-feature' ) ) . '">';
						echo esc_html( $fet_trms->name );
						echo '</a>';
						echo '</li>';
					}
					?>
                </ul>
            </div>
			<?php
			/**
			 * Display RVR related contents if it's enabled.
			 */
			if ( inspiry_is_rvr_enabled() ) {
				/*
				 * RVR - Property Outdoor Features.
				 */
				get_template_part( 'assets/modern/partials/property/single/rvr/outdoor-features' );

				/*
				 * RVR - Property Optional Services.
				 */
				get_template_part( 'assets/modern/partials/property/single/rvr/optional-services' );

				/*
				 * RVR - Property Privacy Policies.
				 */
				get_template_part( 'assets/modern/partials/property/single/rvr/privacy-policies' );

				/*
				 * RVR - Property Location Surroundings.
				 */
				get_template_part( 'assets/modern/partials/property/single/rvr/location-surroundings' );
			}

			// Property Attachments.
			get_template_part( 'assets/modern/partials/property/single/attachments' );
			?>
        </div>
    </div>
<?php endif; ?>