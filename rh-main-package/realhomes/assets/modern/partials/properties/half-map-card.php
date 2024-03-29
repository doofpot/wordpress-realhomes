<?php
/**
 * Property card for half map layout.
 *
 * @package    realhomes
 * @subpackage modern
 */

global $post;
$property_size      = get_post_meta( get_the_ID(), 'REAL_HOMES_property_size', true );
$size_postfix       = get_post_meta( get_the_ID(), 'REAL_HOMES_property_size_postfix', true );
$property_bedrooms  = get_post_meta( get_the_ID(), 'REAL_HOMES_property_bedrooms', true );
$property_bathrooms = get_post_meta( get_the_ID(), 'REAL_HOMES_property_bathrooms', true );
$property_address   = get_post_meta( get_the_ID(), 'REAL_HOMES_property_address', true );
$is_featured        = get_post_meta( get_the_ID(), 'REAL_HOMES_featured', true );

?>

<article <?php post_class( 'rh_list_card' ); ?>>

	<div class="rh_list_card__wrap">

		<figure class="rh_list_card__map_thumbnail">
			<?php if ( $is_featured ) : ?>
				<div class="rh_label rh_label__list">
					<div class="rh_label__wrap">
						<?php esc_html_e( 'Featured', 'framework' ); ?>
						<span></span>
					</div>
				</div>
				<!-- /.rh_label -->
			<?php endif; ?>

			<a href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>
					<?php $post_thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'property-listing-image' ); ?>
					<div class="post_thumbnail" style="background: url('<?php echo esc_url( $post_thumbnail_url ); ?>') 50% 50% no-repeat; background-size: cover;"></div>
					<!-- /.post_thumbnail -->
				<?php else : ?>
					<?php $post_thumbnail_url = get_inspiry_image_placeholder_url( 'modern-property-child-slider' ); ?>
					<div class="post_thumbnail" style="background: url('<?php echo esc_url( $post_thumbnail_url ); ?>') 50% 50% no-repeat; background-size: cover;"></div>
					<!-- /.post_thumbnail -->
				<?php endif; ?>
			</a>

			<div class="rh_overlay"></div>
			<div class="rh_overlay__contents rh_overlay__fadeIn-bottom">
				<a href="<?php the_permalink(); ?>"><?php inspiry_property_detail_page_link_text(); ?></a>
			</div>

			<?php inspiry_display_property_label( get_the_ID() ); ?>
			<!-- /.rh_overlay__contents -->

			<div class="rh_list_card__btns">
				<?php
				inspiry_favorite_button();
				$compare_properties_module = get_option( 'theme_compare_properties_module' );
				$inspiry_compare_page      = get_option( 'inspiry_compare_page' );
				if ( ( 'enable' === $compare_properties_module ) && ( $inspiry_compare_page ) ) {
					get_template_part( 'assets/modern/partials/properties/compare/button' );
				}
				?>
			</div>
			<!-- /.rh_list_card__btns -->
		</figure>
		<!-- /.rh_list_card__thumbnail -->

		<div class="rh_list_card__map_wrap">

			<div class="rh_list_card__map_details">

				<h3>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>

				<div class="rh_list_card__meta_wrap">

					<?php if ( ! empty( $property_bedrooms ) ) : ?>
						<div class="rh_list_card__meta">
							<div>
								<?php include INSPIRY_THEME_DIR . '/images/icons/icon-bed.svg'; ?>
								<span class="figure"><?php echo esc_html( $property_bedrooms ); ?></span>
							</div>
						</div>
						<!-- /.rh_list_card__meta -->
					<?php endif; ?>

					<?php if ( ! empty( $property_bathrooms ) ) : ?>
						<div class="rh_list_card__meta">
							<div>
								<?php include INSPIRY_THEME_DIR . '/images/icons/icon-shower.svg'; ?>
								<span class="figure"><?php echo esc_html( $property_bathrooms ); ?></span>
							</div>
						</div>
						<!-- /.rh_list_card__meta -->
					<?php endif; ?>

					<?php if ( ! empty( $property_size ) ) : ?>
						<div class="rh_list_card__meta">
							<div>
								<?php include INSPIRY_THEME_DIR . '/images/icons/icon-area.svg'; ?>
								<span class="figure">
									<?php echo esc_html( $property_size ); ?>
								</span>
								<?php if ( ! empty( $size_postfix ) ) : ?>
									<span class="label">
										<?php echo esc_html( $size_postfix ); ?>
									</span>
								<?php endif; ?>
							</div>
						</div>
						<!-- /.rh_list_card__meta -->
					<?php endif; ?>

				</div>
				<!-- /.rh_list_card__meta_wrap -->

				<div class="rh_list_card__priceLabel">

					<div class="rh_list_card__price">
						<span class="status">
							<?php echo esc_html( display_property_status( get_the_ID() ) ); ?>
						</span>
						<!-- /.rh_prop_card__type -->

						<p class="price">
							<?php
                            if ( function_exists( 'ere_property_price' ) ) {
	                            ere_property_price();
                            }
                            ?>
						</p>
						<!-- /.price -->
					</div>
					<!-- /.rh_list_card__price -->

				</div>
				<!-- /.rh_list_card__priceLabel -->

			</div>
			<!-- /.rh_list_card__map_details -->

		</div>
		<!-- /.rh_list_card__map_wrap -->

	</div>
	<!-- /.rh_list_card__wrap -->

</article>
<!-- /.rh_list_card -->
