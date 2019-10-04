<?php

$header_email = get_option( 'theme_header_email' );
if ( ! empty( $header_email ) ) {
	?>
	<div class="rh_menu__user_email">
		<?php include INSPIRY_THEME_DIR . '/images/icons/icon-mail.svg'; ?>
		<a href="mailto:<?php echo esc_attr( $header_email ); ?>" class="contact-email"><?php echo esc_html( $header_email ); ?></a>
	</div><!-- /.rh_menu__user_email -->
	<?php
}
?>

