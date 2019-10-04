<?php

$header_phone = get_option( 'theme_header_phone' );
if ( ! empty( $header_phone ) ) {
	$header_phone_icon = get_option( 'theme_header_phone_icon', 'phone' );
	?>
	<div class="rh_menu__user_phone">
		<?php include INSPIRY_THEME_DIR . '/images/icons/icon-' . $header_phone_icon . '.svg'; ?>
		<a href="tel:<?php echo esc_attr( $header_phone ); ?>" class="contact-number"><?php echo esc_html( $header_phone ); ?></a>
	</div>						<!-- /.rh_menu__user_phone -->
	<?php
}
?>

