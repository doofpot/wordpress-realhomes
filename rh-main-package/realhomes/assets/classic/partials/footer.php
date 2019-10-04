<?php
/**
 * Footer Template
 *
 * @package    realhomes
 * @subpackage classic
 */

get_template_part( 'assets/classic/partials/footer/partners' ); ?>

<!-- Start Footer -->
<footer id="footer-wrapper">

	<div id="footer" class="container">

		<div class="row">
			<?php

				$footer_columns = get_option( 'inspiry_footer_columns', '4' );

				switch ( $footer_columns ) {
					case '1' :
						$column_class = 'span12';
						break;
					case '2' :
						$column_class = 'span6';
						break;
					case '3' :
						$column_class = 'span4';
						break;
					default:
						$column_class = 'span3';
				}
			?>
			<div class="<?php echo esc_attr( $column_class ); ?>">
				<?php
				if ( is_active_sidebar( 'footer-first-column' ) ) {
					dynamic_sidebar( 'footer-first-column' );
				}
                ?>
			</div>
			<?php
				if ( intval( $footer_columns ) >= 2 ) {
					?>
					<div class="<?php echo esc_attr( $column_class ); ?>">
						<?php
						if ( is_active_sidebar( 'footer-second-column' ) ) {
							dynamic_sidebar( 'footer-second-column' );
						}
						?>
					</div>
					<?php
				}

				if ( intval( $footer_columns ) >= 3 ) {
					?>
					<div class="clearfix visible-tablet"></div>
					<div class="<?php echo esc_attr( $column_class ); ?>">
						<?php
						if ( is_active_sidebar( 'footer-third-column' ) ) {
							dynamic_sidebar( 'footer-third-column' );
						}
						?>
					</div>
					<?php
				}

				if ( intval( $footer_columns ) == 4 ) {
					?>
					<div class="<?php echo esc_attr( $column_class ); ?>">
						<?php
						if ( is_active_sidebar( 'footer-fourth-column' ) ) {
							dynamic_sidebar( 'footer-fourth-column' );
						}
						?>
					</div>
					<?php
				}
			?>
		</div>

	</div>

	<div id="footer-bottom" class="container">
		<div class="row">
			<div class="span6">
				<?php
				$copyright_text = get_option( 'theme_copyright_text' );
				if ( !empty( $copyright_text ) ) {
				    ?><p class="copyright"><?php echo wp_kses( $copyright_text, inspiry_allowed_html() ); ?></p><?php
				}
				?>
			</div>
			<div class="span6">
				<?php
				$designed_by_text = get_option( 'theme_designed_by_text' );
				if ( !empty( $designed_by_text ) ) {
				    ?><p class="designed-by"><?php echo wp_kses( $designed_by_text, inspiry_allowed_html() ); ?></p><?php
                }
				?>
			</div>
		</div>
	</div>

</footer>

<?php
/**
 * Include modal login if login & register page URL is not configured
 */
if ( ! is_user_logged_in() ) {
	$theme_login_url   = inspiry_get_login_register_url();
	$prop_detail_login = inspiry_prop_detail_login();
	$skip_prop_single  = ( 'yes' == $prop_detail_login && ! is_user_logged_in() && is_singular( 'property' ) );

	if (
		empty( $theme_login_url ) &&
		( ! is_page_template( 'templates/login-register.php' ) ) &&
		! $skip_prop_single
	) {
		get_template_part( 'assets/classic/partials/footer/modal-login' );
	}
}
?>