<?php
/**
 * Template for Single Property or Property Detail Page
 *
 * @package    realhomes
 * @subpackage modern
 */

get_header();

// Page Head.
$header_variation = get_option( 'inspiry_property_detail_header_variation' );

if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/header' );
} elseif ( ! empty( $header_variation ) && ( 'banner' === $header_variation ) ) {
	// Banner Image.
	$banner_image_path = '';
	$banner_image_id   = get_post_meta( $post->ID, 'REAL_HOMES_page_banner_image', true );
	if ( $banner_image_id ) {
		$banner_image_path = wp_get_attachment_url( $banner_image_id );
	} else {
		$banner_image_path = get_default_banner();
	}
	?>
    <section class="rh_banner rh_banner__image"
             style="background-repeat: no-repeat;background-position: center top;background-image: url('<?php echo esc_url( $banner_image_path ); ?>'); background-size: cover; ">

        <div class="rh_banner__cover"></div><!-- /.rh_banner__cover -->

        <div class="rh_banner__wrap">

            <h2 class="rh_banner__title test">
				<?php echo esc_html( get_the_title() ); ?>
            </h2><!-- /.rh_banner__title -->

        </div><!-- /.rh_banner__wrap -->

    </section><!-- /.rh_banner -->
	<?php
}

if ( inspiry_show_header_search_form() ) {
	get_template_part( 'assets/modern/partials/properties/search/advance' );
}

$theme_property_detail_variation = get_option( 'theme_property_detail_variation', 'default' );

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
	'agent'                     => ( 'default' === $theme_property_detail_variation && get_option( 'theme_display_agent_info', 'true' ) ) ? 'true' : 'false',
	'energy-performance'        => get_option( 'inspiry_display_energy_performance', 'true' ),
	'rvr/availability-calendar' => get_option( 'inspiry_display_availability_calendar', 'true' )
);

$property_sections_order = array_keys( $sortable_property_sections );
$order_settings          = get_theme_mod( 'inspiry_property_sections_order_default', 'default' );
if ( 'custom' === $order_settings ) {
	$property_sections_order = get_option( 'inspiry_property_sections_order_mod' );
	$property_sections_order = explode( ',', $property_sections_order );
}
?>
    <section class="rh_section rh_wrap--padding rh_wrap--topPadding">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : ?>

				<?php the_post(); ?>

				<?php if ( ! post_password_required() ) : ?>

                    <div class="rh_page rh_page--fullWidth">

						<?php get_template_part( 'assets/modern/partials/property/single/head' ); ?>

                        <div class="rh_property">
							<?php
							/**
							 * Property Slider
							 */
							get_template_part( 'assets/modern/partials/property/single/slider' );
							?>

                            <div class="rh_property__wrap rh_property--padding">
                                <div class="rh_property__main">

                                    <div class="rh_property__content clearfix">

										<?php
										// Display the login form if login is required and user is not logged in
										$prop_detail_login = inspiry_prop_detail_login();
										if ( 'yes' == $prop_detail_login && ! is_user_logged_in() ) {
											?>
                                            <div class="rh_form rh_property_detail_login">
												<?php get_template_part( 'assets/modern/partials/member/login-form' ); ?>
												<?php get_template_part( 'assets/modern/partials/member/register-form' ); ?>
                                            </div>
											<?php
										} else {

											global $post;

											$property_id                  = get_post_meta( get_the_ID(), 'REAL_HOMES_property_id', true );
											$prop_id_field_label          = get_option( 'inspiry_prop_id_field_label' );
											$inspiry_share_property_label = get_option( 'inspiry_share_property_label' );
											$inspiry_print_property_label = get_option( 'inspiry_print_property_label' );

											?>
                                            <div class="rh_property__row rh_property__meta rh_property--borderBottom">

                                                <div class="rh_property__id">
                                                    <p class="title">
														<?php if ( $prop_id_field_label ) {
															echo esc_html( $prop_id_field_label );
														} else {
															esc_html_e( 'Property ID', 'framework' );
														} ?>
                                                        :</p>
													<?php if ( ! empty( $property_id ) ) { ?>
                                                        <p class="id">&nbsp;<?php echo esc_html( $property_id ); ?></p>
													<?php } else { ?>
                                                        <p class="id">
                                                            &nbsp;<?php esc_html_e( 'None', 'framework' ); ?></p>
													<?php } ?>
                                                </div>

                                                <div class="rh_property__print">

                                                    <a href="#" class="share" id="social-share">
														<?php include INSPIRY_THEME_DIR . '/images/icons/icon-share-2.svg'; ?>
                                                        <span class="rh_tooltip">
                                                        <p class="label">
                                                            <?php
                                                            if ( $inspiry_share_property_label ) {
	                                                            echo esc_html( $inspiry_share_property_label );
                                                            } else {
	                                                            esc_html_e( 'Share', 'framework' );
                                                            }
                                                            ?>
                                                        </p>
                                                    </span>
                                                    </a>
                                                    <div class="share-this" data-check-mobile="<?php if ( wp_is_mobile() ) {
														echo esc_html( 'mobile' );
													} ?>" data-property-name="<?php the_title(); ?>"
                                                         data-property-permalink="<?php the_permalink(); ?>">
                                                    </div>

													<?php
													// Display add to favorite button
													inspiry_favorite_button( get_the_ID(), true );

													$compare_properties_module = get_option( 'theme_compare_properties_module' );
													$inspiry_compare_page      = get_option( 'inspiry_compare_page' );
													if ( ( 'enable' === $compare_properties_module ) && ( $inspiry_compare_page ) ) {
														?>
                                                        <span class="rh_single_compare_button add-to-compare-span"
                                                              data-button-id="<?php the_ID(); ?>"
                                                              data-button-title="<?php echo get_the_title( get_the_ID() ); ?>"
                                                              data-button-url="<?php echo get_the_permalink( get_the_ID() ); ?>">
                                                        <?php
                                                        $property_id = get_the_ID();
                                                        if ( inspiry_is_added_to_compare( $property_id ) ) {
	                                                        ?>
                                                            <span class="compare-placeholder highlight"
                                                                  data-tooltip="<?php esc_attr_e( 'Added to compare', 'framework' ); ?>">
                                                                <?php include( INSPIRY_THEME_DIR . '/images/icons/icon-compare.svg' ); ?>
                                                            </span>
                                                            <a class="rh_trigger_compare add-to-compare hide"
                                                               data-tooltip="<?php esc_attr_e( 'Add to compare', 'framework' ); ?>"
                                                               data-property-id="<?php the_ID(); ?>"
                                                               href="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>">
                                                                <?php include( INSPIRY_THEME_DIR . '/images/icons/icon-compare.svg' ); ?>
                                                            </a>
	                                                        <?php
                                                        } else {
	                                                        ?>
                                                            <span class="compare-placeholder highlight hide"
                                                                  data-tooltip="<?php esc_attr_e( 'Added to compare', 'framework' ); ?>">
                                                                <?php include( INSPIRY_THEME_DIR . '/images/icons/icon-compare.svg' ); ?>
                                                            </span>
                                                            <a class="rh_trigger_compare add-to-compare"
                                                               data-tooltip="<?php esc_attr_e( 'Add to compare', 'framework' ); ?>"
                                                               data-property-id="<?php the_ID(); ?>"
                                                               href="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>">
                                                                <?php include( INSPIRY_THEME_DIR . '/images/icons/icon-compare.svg' ); ?>
                                                            </a>
	                                                        <?php
                                                        }
                                                        ?>
                                                    </span>
														<?php
													}
													?>

                                                    <a href="javascript:window.print()" class="print">
														<?php include INSPIRY_THEME_DIR . '/images/icons/icon-printer.svg'; ?>
                                                        <span class="rh_tooltip">
                                                        <p class="label">
                                                            <?php
                                                            if ( $inspiry_print_property_label ) {
	                                                            echo esc_html( $inspiry_print_property_label );
                                                            } else {
	                                                            esc_html_e( 'Print', 'framework' );
                                                            }
                                                            ?>
                                                        </p>
                                                    </span>
                                                    </a>
                                                </div>
                                            </div>

											<?php
											// Property meta information.
											get_template_part( 'assets/modern/partials/property/single/meta' );

											// Display sections according to their order
											if ( ! empty( $property_sections_order ) && is_array( $property_sections_order ) ) {
												foreach ( $property_sections_order as $section ) {
													if ( isset( $sortable_property_sections[ $section ] ) && 'true' === $sortable_property_sections[ $section ] ) {
														get_template_part( 'assets/modern/partials/property/single/' . $section );
													}
												}
											}
											?>
											<?php
										}
										?>
                                    </div>

									<?php get_template_part( 'assets/modern/partials/property/single/similar-properties' ); ?>

                                    <section class="rh_property__comments">
										<?php
										/**
										 * Comments
										 *
										 * If comments are open or we have at least one comment, load up the comment template.
										 */
										if ( comments_open() || get_comments_number() ) {
											?>
                                            <div class="property-comments">
												<?php comments_template(); ?>
                                            </div>
											<?php
										}
										?>
                                    </section>

                                </div>
                                <!-- /.rh_property__main -->

                                <div class="rh_property__sidebar">
									<?php
									if ( 'agent-in-sidebar' === $theme_property_detail_variation ) {
										?>
                                        <aside class="rh_sidebar">
											<?php
											get_template_part( 'assets/modern/partials/property/single/agent-for-sidebar' );

											if ( is_active_sidebar( 'property-sidebar' ) ) {
												dynamic_sidebar( 'property-sidebar' );
											}
											?>
                                        </aside>
										<?php
									} else {
										get_sidebar( 'property' );
									}
									?>
                                </div>
                                <!-- /.rh_property__sidebar -->
                            </div>
                            <!-- /.rh_property__wrap -->
                        </div>
                        <!-- /.rh_property -->

                    </div>
                    <!-- /.rh_page -->

				<?php else : ?>

                    <div class="rh_page rh_page--fullWidth">

						<?php echo get_the_password_form(); ?>

                    </div>
                    <!-- /.rh_page -->

				<?php endif; ?>

			<?php endwhile; ?>

		<?php endif; ?>

    </section>

<?php
get_footer();