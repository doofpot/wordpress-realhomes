<?php
/* Currency Switcher for Header */
if ( class_exists( 'WP_Currencies' ) ) {
	$supported_currencies = inspiry_supported_currencies();

	$open_class = '';
	if ( 'full' == get_theme_mod( 'inspiry_default_floating_button', 'half' ) ) {
		$open_class = 'rh_currency_open_full';
	}

	if ( 0 < count( $supported_currencies ) ) {
		echo '<div class="rh_wrapper_currency_switcher ' . esc_attr($open_class) . '">';
		echo '<form id="currency-switcher-form" method="post" action="' . admin_url( 'admin-ajax.php' ) . '" >';

		echo '<div id="currency-switcher">';

		$current_currency = inspiry_get_current_currency();

		echo '<div id="selected-currency"><i class="currency-flag currency-flag-' . esc_attr(strtolower( $current_currency )) . '"></i><span class="currency_text">' . esc_html($current_currency) . '</span></div>';

		echo '<ul id="currency-switcher-list">';
		foreach ( $supported_currencies as $currency_code ) {
			echo '<li data-currency-code="' . esc_attr($currency_code) . '"><i class="currency-flag currency-flag-' . esc_attr(strtolower( $currency_code )) . '"></i><span class="currency_text">' . esc_html($currency_code) . '</span></li>';
		}
		echo '</ul>';

		echo '</div>';

		echo '<input type="hidden" id="switch-to-currency" name="switch_to_currency" value="' . esc_attr($current_currency) . '" />';
		echo '<input type="hidden" name="action" value="switch_currency" />';
		echo '<input type="hidden" name="nonce" value="' . wp_create_nonce( 'switch_currency_nonce' ) . '"/>';

		echo '</form>';
		echo '</div>';

	}
}
?>