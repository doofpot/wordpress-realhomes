<?php
/**
 * Displays contact page template's stuff.
 *
 * @package realhomes
 */

get_header();

get_template_part( 'assets/classic/partials/banners/default' ); ?>

    <!-- Content -->
    <div class="container contents contact-page">
        <div class="row">
            <div class="span9 main-wrap">
                <!-- Main Content -->
                <div class="main">
                    <div class="inner-wrapper">
						<?php
						// Retrieve Page Meta
						$page_meta = get_post_custom( get_the_ID() );

						/*
						 * Page contents
						 */
						$get_content_position = get_post_meta( get_the_ID(), 'REAL_HOMES_content_area_above_footer', true );

						if ( $get_content_position !== '1' ) {
							if ( have_posts() ) :
								while ( have_posts() ) :
									the_post();
									$page_content = get_the_content();
									if ( ! empty( $page_content ) ) {
										?>
                                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
											<?php the_content(); ?>
                                        </article>
										<?php
									}
								endwhile;
							endif;
						}

						/*
						 * Contact Map
						 */
						$show_contact_map = isset( $page_meta['theme_show_contact_map'][0] ) ? $page_meta['theme_show_contact_map'][0] : '';
						if ( $show_contact_map ) {
							?>
                            <!-- Map Container -->
                            <div class="map-container clearfix">
                                <!-- Works for Both Google Maps and Open Street Maps -->
                                <div id="map_canvas"></div>
                            </div>
							<?php
							// Function that renders Open Street Map - inspiry_render_contact_open_street_map()
							// Function that renders Google Map - inspiry_render_contact_google_map()
						}

						/*
						 * Contact Details
						 */
						$show_details = isset( $page_meta['theme_show_details'][0] ) ? $page_meta['theme_show_details'][0] : false;
						if ( $show_details ) {
							$contact_details_title = isset( $page_meta['theme_contact_details_title'][0] ) ? $page_meta['theme_contact_details_title'][0] : '';
							$contact_address       = stripslashes( isset( $page_meta['theme_contact_address'][0] ) ? $page_meta['theme_contact_address'][0] : '' );
							$contact_cell          = isset( $page_meta['theme_contact_cell'][0] ) ? $page_meta['theme_contact_cell'][0] : '';
							$contact_phone         = isset( $page_meta['theme_contact_phone'][0] ) ? $page_meta['theme_contact_phone'][0] : '';
							$contact_fax           = isset( $page_meta['theme_contact_fax'][0] ) ? $page_meta['theme_contact_fax'][0] : '';
							$contact_display_email = isset( $page_meta['theme_contact_display_email'][0] ) ? $page_meta['theme_contact_display_email'][0] : '';
							?>
                            <section class="contact-details clearfix">
								<?php
								if ( ! empty( $contact_details_title ) ) {
									?><h3><?php echo esc_html( $contact_details_title ); ?></h3><?php
								}
								?>
                                <ul class="contacts-list">
									<?php
									if ( ! empty( $contact_phone ) ) {
										?>
                                        <li class="phone">
											<?php
											include INSPIRY_THEME_DIR . '/images/icon-phone.svg';
											esc_html_e( 'Phone', 'framework' );
											?>
                                            : <?php echo '<span class="desktop-version">' . esc_html( $contact_phone ) . '</span>' . '<a class="mobile-version" href="tel://' . esc_attr( $contact_phone ) . '">' . esc_html( $contact_phone ) . '</a>'; ?>
                                        </li>
										<?php
									}


									if ( ! empty( $contact_cell ) ) {
										?>
                                        <li class="mobile">
											<?php
											include INSPIRY_THEME_DIR . '/images/icon-mobile.svg';
											esc_html_e( 'Mobile', 'framework' );
											?>
                                            : <?php echo '<span class="desktop-version">' . esc_html( $contact_cell ) . '</span>' . '<a class="mobile-version" href="tel://' . esc_attr( $contact_cell ) . '">' . esc_html( $contact_cell ) . '</a>'; ?>
                                        </li>
										<?php
									}

									if ( ! empty( $contact_fax ) ) {
										?>
                                        <li class="fax">
											<?php
											include INSPIRY_THEME_DIR . '/images/icon-printer.svg';
											esc_html_e( 'Fax', 'framework' );
											?>
                                            : <a href="fax:<?php echo esc_html( $contact_fax ); ?>"><?php echo esc_html( $contact_fax ); ?></a>
                                        </li>
										<?php
									}

									if ( ! empty( $contact_display_email ) ) {
										?>
                                        <li class="email">
											<?php
											include INSPIRY_THEME_DIR . '/images/icon-mail.svg';
											esc_html_e( 'Email', 'framework' );
											?>
                                            :
                                            <a href="mailto:<?php echo antispambot( $contact_display_email ); ?>"><?php echo antispambot( $contact_display_email ); ?></a>
                                        </li>
										<?php
									}

									if ( ! empty( $contact_address ) ) {
										?>
                                        <li class="address">
											<?php
											include INSPIRY_THEME_DIR . '/images/icon-map.svg';
											esc_html_e( 'Address', 'framework' );
											?>
                                            : <?php echo wp_kses( $contact_address, inspiry_allowed_html() ); ?>
                                        </li>
										<?php
									}
									?>
                                </ul>
                            </section>
							<?php
						}


						/**
						 * Contact Form
						 */

						if ( isset( $page_meta['inspiry_contact_form_shortcode'] ) && ! empty( $page_meta['inspiry_contact_form_shortcode'][0] ) ) {

							/* Contact Form Shortcode */
							echo do_shortcode( $page_meta['inspiry_contact_form_shortcode'][0] );

						} else {

							if ( isset( $page_meta['theme_contact_email'] ) && ! empty( $page_meta['theme_contact_email'][0] ) ) {
								$name_label                 = isset( $page_meta['theme_contact_form_name_label'][0] ) ? $page_meta['theme_contact_form_name_label'][0] : '';
								$email_label                = isset( $page_meta['theme_contact_form_email_label'][0] ) ? $page_meta['theme_contact_form_email_label'][0] : '';
								$number_label               = isset( $page_meta['theme_contact_form_number_label'][0] ) ? $page_meta['theme_contact_form_number_label'][0] : '';
								$message_label              = isset( $page_meta['theme_contact_form_message_label'][0] ) ? $page_meta['theme_contact_form_message_label'][0] : '';
								$contact_form_name_label    = empty( $name_label ) ? esc_html__( 'Name', 'framework' ) : $name_label;
								$contact_form_email_label   = empty( $email_label ) ? esc_html__( 'Email', 'framework' ) : $email_label;
								$contact_form_number_label  = empty( $number_label ) ? esc_html__( 'Phone Number', 'framework' ) : $number_label;
								$contact_form_message_label = empty( $message_label ) ? esc_html__( 'Message', 'framework' ) : $message_label;
								?>
                                <section id="contact-form">
									<?php
									if ( isset( $page_meta['theme_contact_form_heading'] ) && ! empty( $page_meta['theme_contact_form_heading'][0] ) ) {
										?>
                                        <h3 class="form-heading"><?php echo esc_html( $page_meta['theme_contact_form_heading'][0] ); ?></h3><?php
									}
									?>
                                    <form class="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
                                        <p>
                                            <label for="name"><?php echo esc_html( $contact_form_name_label ); ?></label>
                                            <input type="text" name="name" id="name" class="required" title="<?php esc_attr_e( '* Please provide your name', 'framework' ); ?>">
                                        </p>
                                        <p>
                                            <label for="email"><?php echo esc_html( $contact_form_email_label ); ?></label>
                                            <input type="text" name="email" id="email" class="email required" title="<?php esc_attr_e( '* Please provide a valid email address', 'framework' ); ?>">
                                        </p>
                                        <p>
                                            <label for="number"><?php echo esc_html( $contact_form_number_label ); ?></label>
                                            <input type="text" name="number" id="number">
                                        </p>
                                        <p>
                                            <label for="message"><?php echo esc_html( $contact_form_message_label ); ?></label>
                                            <textarea name="message" id="message" class="required" title="<?php esc_attr_e( '* Please provide your message', 'framework' ); ?>"></textarea>
                                        </p>
										<?php
										$is_gdpr_enabled = inspiry_is_gdpr_enabled();
										if ( $is_gdpr_enabled ) {
											$gdpr_agreement_text = inspiry_gdpr_agreement_content();
											if ( ! empty( $gdpr_agreement_text ) ) { ?>
                                                <p class="gdpr-agreement clearfix">
													<?php
													$gdpr_agreement_label   = inspiry_gdpr_agreement_content( 'label' );
													$gdpr_agreement_val_msg = inspiry_gdpr_agreement_content( 'validation-message' );

													if ( ! empty( $gdpr_agreement_label ) ) {
														?>
                                                        <span class="gdpr-checkbox-label"><?php echo esc_html( $gdpr_agreement_label ); ?>
                                                        <span class="required-label">*</span>
                                                        </span><?php
													}
													?>
                                                    <input type="checkbox" id="inspiry-gdpr" class="required" name="gdpr" title="<?php echo esc_attr( $gdpr_agreement_val_msg ); ?>" value="<?php echo strip_tags( $gdpr_agreement_text ); ?>">
                                                    <label for="inspiry-gdpr"><?php echo wp_kses( $gdpr_agreement_text, array(
															'a'      => array(
																'id'     => array(),
																'class'  => array(),
																'href'   => array(),
																'target' => array(),
																'title'  => array()
															),
															'em'     => array(),
															'strong' => array(),
														) ); ?></label>
                                                </p>
												<?php
											}
										}
										?>
                                        <p><?php
											/* Display reCAPTCHA if enabled and configured from customizer settings */
											get_template_part( 'common/google-reCAPTCHA/google-reCAPTCHA' ); ?>
                                        </p>
                                        <p>
                                            <input type="submit" id="submit-button" value="<?php esc_attr_e( 'Send Message', 'framework' ); ?>" class="real-btn" name="submit">
                                            <img src="<?php echo esc_attr( INSPIRY_DIR_URI ); ?>/images/ajax-loader.gif" id="ajax-loader" alt="Loading...">
                                            <input type="hidden" name="action" value="send_message"/>
                                            <input type="hidden" name="the_id" value="<?php echo esc_attr( get_the_ID() ); ?>"/>
                                            <input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'send_message_nonce' ) ); ?>"/>
                                        </p>
                                        <div id="error-container"></div>
                                        <div id="message-container"></div>
                                    </form>
                                </section>
								<?php
							}
						}
						?>
                    </div>
					<?php
					if ( '1' === $get_content_position ) {
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();
								$page_content = get_the_content();
								if ( ! empty( $page_content ) ) {
									?>
                                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
										<?php the_content(); ?>
                                    </article>
									<?php
								}
							endwhile;
						endif;

					}
					?>

                </div><!-- End Main Content -->
            </div><!-- End span9 -->

			<?php get_sidebar( 'contact' ); ?>

        </div><!-- End contents row -->
    </div><!-- End Content -->

<?php get_footer(); ?>