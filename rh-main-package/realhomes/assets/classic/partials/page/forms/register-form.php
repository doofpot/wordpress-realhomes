<?php
if ( get_option( 'users_can_register' ) ) {
	?>
	<p class="info-text"><?php esc_html_e( 'Do not have an account? Register here','framework' ); ?></p>
	<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" id="register-form"  method="post" enctype="multipart/form-data">

		<div class="form-option">
			<label for="register_username" class="hide"><?php esc_html_e( 'Username','framework' ); ?><span>*</span></label>
			<input id="register_username" name="register_username" type="text" class="required"
			       title="<?php esc_html_e( '* Provide username!', 'framework' ); ?>"
			       placeholder="<?php esc_html_e( 'Username', 'framework' ); ?>" required/>
		</div>
		<div class="form-option">
			<label for="register_email" class="hide"><?php esc_html_e( 'Email','framework' ); ?><span>*</span></label>
			<input id="register_email" name="register_email" type="text" class="email required"
			       title="<?php esc_html_e( '* Provide valid email address!', 'framework' ); ?>"
			       placeholder="<?php esc_html_e( 'Email', 'framework' ); ?>" required/>
		</div>
		<?php
		$user_sync = inspiry_is_user_sync_enabled();
		if ( 'true' == $user_sync ) {
			$user_roles = inspiry_user_sync_roles();
			if ( ! empty( $user_roles ) && is_array( $user_roles ) ) {
				?>
				<div class="form-option">
					<label for="user-role" class="hide"><?php esc_html_e( 'User Role', 'framework' ); ?><span>*</span></label>
					<span class="selectwrap">
                                                <select name="user_role" id="user-role" class="search-select">
													<?php
													foreach ( $user_roles as $key => $value ) {
														echo '<option value="' . $key . '">' . $value . '</option>';
													}
													?>
                                                </select>
                                                </span>
				</div>
				<?php
			}
		}

		if ( class_exists( 'Easy_Real_Estate' ) ) {
			if ( ere_is_reCAPTCHA_configured() ) {
				?>
				<div class="form-option">
					<?php get_template_part( 'common/google-reCAPTCHA/google-reCAPTCHA' ); ?>
				</div>
				<?php
			}
		}
		?>
		<input type="hidden" name="user-cookie" value="1" />
		<input type="submit" id="register-button" name="user-submit" value="<?php esc_html_e( 'Register','framework' ); ?>" class="real-btn register-btn" />
		<img id="register-loader" class="modal-loader" src="<?php echo esc_attr( INSPIRY_DIR_URI ); ?>/images/ajax-loader.gif" alt="Working...">
		<input type="hidden" name="action" value="inspiry_ajax_register" />
		<?php
		// Nonce for security.
		wp_nonce_field( 'inspiry-ajax-register-nonce', 'inspiry-secure-register' );
		?>
		<input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>" />

		<div>
			<div id="register-message" class="modal-message"></div>
			<div id="register-error" class="modal-error"></div>
		</div>
	</form>
	<?php
}
?>