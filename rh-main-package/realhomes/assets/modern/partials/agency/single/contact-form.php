<?php
/**
 * Agency Contact Form
 *
 * Contact form for the agency.
 *
 * @since    3.5.0
 * @package RH/modern
 */

$agent_email = get_post_meta( get_the_ID(), 'REAL_HOMES_agency_email', true );
$agent_email = is_email( $agent_email );

if ( ! empty( $agent_email ) ) : ?>
	<div class="rh_agent_form">

		<form id="agent-single-form" class="" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">

			<div class="rh_agent_form__field rh_agent_form__text">
				<label for="name"><?php esc_html_e( 'Name', 'framework' ); ?></label>
				<input type="text" name="name" id="name" placeholder="<?php esc_attr_e( 'Your Name', 'framework' ); ?>" class="required" title="<?php esc_attr_e( '* Please provide your name', 'framework' ); ?>">
			</div>
			<!-- /.rh_agent_form__field rh_agent_form__text -->

			<div class="rh_agent_form__field rh_agent_form__text">
				<label for="email"><?php esc_html_e( 'Email', 'framework' ); ?></label>
				<input type="text" name="email" id="email" placeholder="<?php esc_attr_e( 'Your Email', 'framework' ); ?>" class="email required" title="<?php esc_attr_e( '* Please provide valid email address', 'framework' ); ?>">
			</div>
			<!-- /.rh_agent_form__field rh_agent_form__text -->

			<div class="rh_agent_form__field rh_agent_form__text">
				<label for="phone"><?php esc_html_e( 'Phone', 'framework' ); ?></label>
				<input type="text" name="phone" id="phone" placeholder="<?php esc_attr_e( 'Your Phone', 'framework' ); ?>" class="digits required" title="<?php esc_attr_e( '* Please provide valid phone number', 'framework' ); ?>">
			</div>
			<!-- /.rh_agent_form__field rh_agent_form__text -->

			<div class="rh_agent_form__field rh_agent_form__textarea">
				<label for="comment"><?php esc_html_e( 'Message', 'framework' ); ?></label>
				<textarea rows="6" name="message" id="comment" class="required" placeholder="<?php esc_attr_e( 'Your Message', 'framework' ); ?>" title="<?php esc_attr_e( '* Please provide your message', 'framework' ); ?>"></textarea>
			</div>
			<!-- /.rh_agent_form__field rh_agent_form__textarea -->

			<?php

				$is_gdpr_enabled = inspiry_is_gdpr_enabled();

				if ( $is_gdpr_enabled ) {

					$gdpr_agreement_text = inspiry_gdpr_agreement_content();

					if ( ! empty( $gdpr_agreement_text ) ) {
						?>
						<div id="rh_inspiry_gdpr" class="rh_inspiry_gdpr rh_agent_form__field clearfix">
							<?php

								$gdpr_agreement_label   = inspiry_gdpr_agreement_content( 'label' );
								$gdpr_agreement_val_msg = inspiry_gdpr_agreement_content( 'validation-message' );

								if ( ! empty( $gdpr_agreement_label ) ) {
									?>
									<span class="gdpr-checkbox-label"><?php echo esc_html( $gdpr_agreement_label ); ?>
										<span class="required-label">*</span></span>
									<?php
								}

							?>
							<input type="checkbox" id="inspiry-gdpr" class="required" name="gdpr" title="<?php echo esc_attr( $gdpr_agreement_val_msg ); ?>" value="<?php echo strip_tags( $gdpr_agreement_text ); ?>">
							<label for="inspiry-gdpr"><?php echo wp_kses( $gdpr_agreement_text, array(
									'a' => array(
										'id'     => array(),
										'class'  => array(),
										'href'   => array(),
										'target' => array(),
										'title'  => array()
									),
									'em' => array(),
									'strong' => array(),
								) ); ?></label>
						</div>
						<?php
					}
				}

			if ( class_exists( 'Easy_Real_Estate' ) ) {
				if ( ere_is_reCAPTCHA_configured() ) {
					?>
					<div class="inspiry-recaptcha-wrapper clearfix">
						<div class="inspiry-google-recaptcha"></div>
					</div>
					<?php
				}
			}
			?>

			<div class="rh_agent_form__row">
				<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'agent_message_nonce' ) ); ?>"/>
				<input type="hidden" name="target" value="<?php echo esc_attr( antispambot( $agent_email ) ); ?>">
                <input type="hidden" name="agent_id" value="<?php echo esc_attr(get_the_ID()); ?>">
				<input type="hidden" name="form_of" value="agency"/>
				<input type="hidden" name="action" value="send_message_to_agent"/>
				<input type="submit" id="submit-button" value="<?php esc_attr_e( 'Send Message', 'framework' ); ?>" name="submit" class="rh_btn rh_btn--primary">
				<span id="ajax-loader">
        <?php include( INSPIRY_THEME_DIR . '/images/loader.svg' ); ?>
    </span>
			</div>
			<!-- /.rh_agent_form__row -->

			<div class="rh_agent_form__row">
				<div id="error-container"></div>
				<div id="message-container"></div>
			</div>
			<!-- /.rh_agent_form__row -->

		</form>

	</div>    <!-- /.rh_agent_form -->
	<?php
endif;
