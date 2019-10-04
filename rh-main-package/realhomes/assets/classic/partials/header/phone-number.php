<?php
/**
 * Header Partial: Phone Number
 *
 * @since 2.6.2
 */
$header_phone = get_option( 'theme_header_phone' );
if ( !empty( $header_phone ) ) {
	$header_phone_icon = get_option( 'theme_header_phone_icon', 'phone' );
	?>
    <h2 class="contact-number"><i class="fa fa-<?php echo esc_attr( $header_phone_icon ); ?>"></i>
        <span class="desktop-version"><?php echo esc_html( $header_phone ); ?></span>
        <a class="mobile-version" href="tel://<?php echo esc_attr( $header_phone ); ?>"
           title="<?php esc_attr_e( 'Make a Call', 'framework' ); ?>"><?php echo esc_html( $header_phone ); ?></a>
        <span class="outer-strip"></span>
    </h2>
	<?php
}
?>