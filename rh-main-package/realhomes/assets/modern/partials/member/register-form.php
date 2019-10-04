<?php if ( get_option( 'users_can_register' ) ) : ?>

	<div class="rh_form__register">

		<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" id="rh_modal__register_form"  method="post" enctype="multipart/form-data">

			<div class="rh_form__row">
				<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
					<label class="info-text"><?php esc_html_e( 'Do not have an account? Register here', 'framework' ); ?></label>
				</div>
				<!-- /.rh_form__item -->
			</div>
			<!-- /.rh_form__row -->

			<div class="rh_form__row">
				<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
					<label for="register_username" class="hide"><?php esc_html_e( 'Username','framework' ); ?><span>*</span></label>
					<input id="register_username" name="register_username" type="text" class="required"
					       title="<?php esc_html_e( '* Provide username!', 'framework' ); ?>"
					       placeholder="<?php esc_html_e( 'Username', 'framework' ); ?>" required/>
				</div>
				<!-- /.rh_form__item -->
			</div>
			<!-- /.rh_form__row -->

			<div class="rh_form__row">
				<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
					<label for="register_email" class="hide"><?php esc_html_e( 'Email','framework' ); ?><span>*</span></label>
					<input id="register_email" name="register_email" type="text" class="email required"
					       title="<?php esc_html_e( '* Provide valid email address!', 'framework' ); ?>"
					       placeholder="<?php esc_html_e( 'Email', 'framework' ); ?>" required/>
				</div>
				<!-- /.rh_form__item -->
			</div>
			<!-- /.rh_form__row -->

			<?php

			$user_sync = inspiry_is_user_sync_enabled();
			if ( 'true' == $user_sync ) {
				$user_roles = inspiry_user_sync_roles();
				if ( ! empty( $user_roles ) && is_array( $user_roles ) ) {
					?>
					<div class="rh_user_role">
                        <label for="user-role" class="hide"><?php esc_html_e( 'User Role', 'framework' ); ?><span>*</span></label>
						<select name="user_role" id="user-role">
							<option value=""><?php esc_html_e( 'User Role', 'framework' ); ?></option>
							<?php
							foreach ( $user_roles as $key => $value ) {
								echo '<option value="' . $key . '">' . $value . '</option>';
							}
							?>
						</select>
					</div>
					<?php
				}
			}

			if ( class_exists( 'Easy_Real_Estate' ) ) {
				if ( ere_is_reCAPTCHA_configured() ) :
					?>
					<div class="rh_form__row">
						<div class="rh_form__item rh_form--2-column rh_form--columnAlign">
							<?php get_template_part( 'common/google-reCAPTCHA/google-reCAPTCHA' ) ?>
						</div>
						<!-- /.rh_form__item -->
					</div>
				<?php
				endif;
			}
			?>

			<div class="rh_form__row">
				<div class="rh_form__item rh_input_btn_wrapper rh_form--3-column rh_form--columnAlign">
					<input type="hidden" name="user-cookie" value="1" />
					<input type="hidden" name="action" value="inspiry_ajax_register" />
					<?php
					// Nonce for security.
					wp_nonce_field( 'inspiry-ajax-register-nonce', 'inspiry-secure-register' );
					?>
					<input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>" />
					<input type="submit" id="register-button" name="user-submit" value="<?php esc_html_e( 'Register', 'framework' ); ?>" class="rh_btn rh_btn--secondary" />
				</div>
				<!-- /.rh_form__item -->
			</div>
			<!-- /.rh_form__row -->

			<div class="rh_form__row">
				<div class="rh_form__item rh_form--1-column rh_form--columnAlign rh_form__response">
					<p id="register-message" class="rh_form__msg"></p>
					<p id="register-error" class="rh_form__error"></p>
				</div>
				<!-- /.rh_form__item -->
			</div>
			<!-- /.rh_form__row -->

		</form>

	</div>
	<!-- /.rh_form__register -->

<?php endif; ?>