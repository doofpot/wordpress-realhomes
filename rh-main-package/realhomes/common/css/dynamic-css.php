<?php
/**
 * Dynamic CSS File
 *
 * Dynamic css file for handling user options.
 *
 * @since    3.0.0
 * @package RH/modern
 */

add_action( 'wp_head', 'inspiry_generate_common_dynamic_css' );

if ( !function_exists( 'inspiry_generate_common_dynamic_css' ) ) {

	/**
	 * Function: Generate Dynamic CSS.
	 *
	 * @since 3.0.0
	 */
	function inspiry_generate_common_dynamic_css() {

		$theme_currency_switcher_background                = get_option( 'theme_currency_switcher_background' );
		$theme_currency_switcher_selected_text             = get_option( 'theme_currency_switcher_selected_text' );
		$theme_currency_switcher_background_open           = get_option( 'theme_currency_switcher_background_open' );
		$theme_currency_switcher_text_open                 = get_option( 'theme_currency_switcher_text_open' );
		$theme_currency_switcher_background_dropdown       = get_option( 'theme_currency_switcher_background_dropdown' );
		$theme_currency_switcher_text_dropdown             = get_option( 'theme_currency_switcher_text_dropdown' );
		$theme_currency_switcher_background_hover_dropdown = get_option( 'theme_currency_switcher_background_hover_dropdown' );
		$theme_currency_switcher_text_hover_dropdown       = get_option( 'theme_currency_switcher_text_hover_dropdown' );


		$theme_language_switcher_background                = get_option( 'theme_language_switcher_background' );
		$theme_language_switcher_selected_text             = get_option( 'theme_language_switcher_selected_text' );
		$theme_language_switcher_background_open           = get_option( 'theme_language_switcher_background_open' );
		$theme_language_switcher_text_open                 = get_option( 'theme_language_switcher_text_open' );
		$theme_language_switcher_background_dropdown       = get_option( 'theme_language_switcher_background_dropdown' );
		$theme_language_switcher_text_dropdown             = get_option( 'theme_language_switcher_text_dropdown' );
		$theme_language_switcher_background_hover_dropdown = get_option( 'theme_language_switcher_background_hover_dropdown' );
		$theme_language_switcher_text_hover_dropdown       = get_option( 'theme_language_switcher_text_hover_dropdown' );


		$theme_compare_switcher_background             = get_option( 'theme_compare_switcher_background' );
		$theme_compare_switcher_selected_text          = get_option( 'theme_compare_switcher_selected_text' );
		$theme_compare_switcher_background_open        = get_option( 'theme_compare_switcher_background_open' );
		$theme_compare_switcher_text_open              = get_option( 'theme_compare_switcher_text_open' );
		$theme_compare_view_background                 = get_option( 'theme_compare_view_background' );
		$theme_compare_view_title_color                = get_option( 'theme_compare_view_title_color' );
		$theme_compare_view_property_title_color       = get_option( 'theme_compare_view_property_title_color' );
		$theme_compare_view_property_title_hover_color = get_option( 'theme_compare_view_property_title_hover_color' );
		$theme_compare_view_property_button_background = get_option( 'theme_compare_view_property_button_background' );
		$theme_compare_view_property_button_text       = get_option( 'theme_compare_view_property_button_text' );
		$theme_compare_view_property_button_hover      = get_option( 'theme_compare_view_property_button_hover' );
		$theme_compare_view_property_button_text_hover = get_option( 'theme_compare_view_property_button_text_hover' );

		$theme_floating_responsive_background = get_option( 'theme_floating_responsive_background' );
		$inspiry_floating_position            = get_option( 'inspiry_floating_position' );


		$styles = array(


			array(
				'elements' => '#currency-switcher-form',
				'property' => 'background',
				'value'    => $theme_currency_switcher_background,
			),

			array(
				'elements' => '#currency-switcher #selected-currency',
				'property' => 'color',
				'value'    => $theme_currency_switcher_selected_text,
			),


			array(
				'elements' => '#currency-switcher.open #selected-currency',
				'property' => 'background',
				'value'    => $theme_currency_switcher_background_open,
			),

			array(
				'elements' => '.rh_currency_open_full #currency-switcher #selected-currency:hover',
				'property' => 'background',
				'value'    => $theme_currency_switcher_background_open,
			),


			array(
				'elements' => '.rh_currency_open_full #currency-switcher #selected-currency:hover',
				'property' => 'color',
				'value'    => $theme_currency_switcher_text_open,
			),


			array(
				'elements' => '#currency-switcher.open #selected-currency',
				'property' => 'color',
				'value'    => $theme_currency_switcher_text_open,
			),


			array(
				'elements' => '#currency-switcher-list li',
				'property' => 'background',
				'value'    => $theme_currency_switcher_background_dropdown,
			),


			array(
				'elements' => '#currency-switcher-list li',
				'property' => 'color',
				'value'    => $theme_currency_switcher_text_dropdown,
			),


			array(
				'elements' => '#currency-switcher-list li:hover',
				'property' => 'background',
				'value'    => $theme_currency_switcher_background_hover_dropdown,
			),

			array(
				'elements' => '#currency-switcher-list li:hover',
				'property' => 'color',
				'value'    => $theme_currency_switcher_text_hover_dropdown,
			),

			array(
				'elements' => '#currency-switcher ::-webkit-scrollbar',
				'property' => 'background-color',
				'value'    => $theme_currency_switcher_background_dropdown,
			),

			array(
				'elements' => '#currency-switcher ::-webkit-scrollbar-thumb',
				'property' => 'background-color',
				'value'    => $theme_currency_switcher_background_hover_dropdown,
			),


			array(
				'elements' => '.inspiry-language-switcher',
				'property' => 'background',
				'value'    => $theme_language_switcher_background,
			),


			array(
				'elements' => '.inspiry-language-switcher .inspiry-language.current',
				'property' => 'color',
				'value'    => $theme_language_switcher_selected_text,
			),


			array(
				'elements' => '.inspiry-language-switcher > ul > li.open',
				'property' => 'background',
				'value'    => $theme_language_switcher_background_open,
			),

			array(
				'elements' => '.rh_language_open_full .inspiry-language-switcher .inspiry-language.current:hover',
				'property' => 'background',
				'value'    => $theme_language_switcher_background_open,
			),
			array(
				'elements' => '.rh_language_open_full .inspiry-language-switcher .inspiry-language.current:hover:after,
								.rh_language_open_full .inspiry-language-switcher .inspiry-language.current:hover > span',
				'property' => 'color',
				'value'    => $theme_language_switcher_text_open,
			),


			array(
				'elements' => '.inspiry-language-switcher > ul > li.open span',
				'property' => 'color',
				'value'    => $theme_language_switcher_text_open,
			),


			array(
				'elements' => '.inspiry-language-switcher > ul > li > ul',
				'property' => 'background',
				'value'    => $theme_language_switcher_background_dropdown,
			),


			array(
				'elements' => '.inspiry-language-switcher li .rh_languages_available li a span',
				'property' => 'color',
				'value'    => $theme_language_switcher_text_dropdown,
			),


			array(
				'elements' => '.inspiry-language-switcher li a:hover',
				'property' => 'background',
				'value'    => $theme_language_switcher_background_hover_dropdown,
			),

			array(
				'elements' => '.inspiry-language-switcher li .rh_languages_available li a:hover span',
				'property' => 'color',
				'value'    => $theme_language_switcher_text_hover_dropdown,
			),

			array(
				'elements' => '.rh_wrapper_language_switcher parent_open ::-webkit-scrollbar',
				'property' => 'background-color',
				'value'    => $theme_language_switcher_background_dropdown,
			),

			array(
				'elements' => '.rh_wrapper_language_switcher parent_open ::-webkit-scrollbar-thumb',
				'property' => 'background-color',
				'value'    => $theme_language_switcher_background_hover_dropdown,
			),


			array(
				'elements' => '.rh_floating_compare_button',
				'property' => 'background',
				'value'    => $theme_compare_switcher_background,
			),

			array(
				'elements' => '.rh_floating_compare_button',
				'property' => 'color',
				'value'    => $theme_compare_switcher_selected_text,
			),


			array(
				'elements' => '.rh_floating_compare_button svg',
				'property' => 'fill',
				'value'    => $theme_compare_switcher_selected_text,
			),


			array(
				'elements' => '.rh_compare_open .rh_floating_compare_button',
				'property' => 'background',
				'value'    => $theme_compare_switcher_background_open,
			),

			array(
				'elements' => '.rh_floating_compare_button:hover',
				'property' => 'background',
				'value'    => $theme_compare_switcher_background_open,
			),


			array(
				'elements' => '.rh_floating_compare_button:hover',
				'property' => 'color',
				'value'    => $theme_compare_switcher_text_open,
			),

			array(
				'elements' => '.rh_floating_compare_button:hover svg',
				'property' => 'fill',
				'value'    => $theme_compare_switcher_text_open,
			),


			array(
				'elements' => '.rh_compare_open .rh_floating_compare_button',
				'property' => 'color',
				'value'    => $theme_compare_switcher_text_open,
			),
			array(
				'elements' => '.rh_compare_open .rh_floating_compare_button svg',
				'property' => 'fill',
				'value'    => $theme_compare_switcher_text_open,
			),

			array(
				'elements' => '.rh_compare',
				'property' => 'background',
				'value'    => $theme_compare_view_background,
			),

			array(
				'elements' => '.rh_compare .title',
				'property' => 'color',
				'value'    => $theme_compare_view_title_color,
			),
			array(
				'elements' => '.rh_compare__slide_img .rh_compare_view_title',
				'property' => 'color',
				'value'    => $theme_compare_view_property_title_color,
			),

			array(
				'elements' => '.rh_compare__slide_img .rh_compare_view_title:hover,
								.rh_floating_classic .rh_compare__slide_img .rh_compare_view_title:hover',
				'property' => 'color',
				'value'    => $theme_compare_view_property_title_hover_color,
			),

			array(
				'elements' => '.rh_fixed_side_bar_compare .rh_compare__submit',
				'property' => 'background',
				'value'    => $theme_compare_view_property_button_background,
			),

			array(
				'elements' => '.rh_fixed_side_bar_compare .rh_compare__submit',
				'property' => 'color',
				'value'    => $theme_compare_view_property_button_text,
			),
			array(
				'elements' => '.rh_fixed_side_bar_compare .rh_compare__submit:hover',
				'property' => 'background',
				'value'    => $theme_compare_view_property_button_hover,
			),
			array(
				'elements' => '.rh_fixed_side_bar_compare .rh_compare__submit:hover',
				'property' => 'color',
				'value'    => $theme_compare_view_property_button_text_hover,
			),


		);

		$prop_count_cta = count( $styles );

		if ( $prop_count_cta > 0 ) {
			echo "<style id='dynamic-css-cta'>\n\n";
			foreach ( $styles as $css_unit ) {
				if ( !empty( $css_unit['value'] ) ) {
					echo strip_tags( $css_unit['elements'] . " { " . $css_unit['property'] . " : " . $css_unit['value'] . ";" . " }\n" );
				}
			}
			echo '</style>';


		}

		$styles_max_890 = array(
			array(

				'elements' => '.rh_wrapper_floating_features',
				'property' => 'background',
				'value'    => $theme_floating_responsive_background,
			),

		);

		$styles_min_891 = array(
			array(
				'elements' => '.rh_wrapper_floating_features',
				'property' => 'top',
				'value'    => $inspiry_floating_position,
			),
		);

		if ( !empty( $styles_min_891 ) ) {
			echo "<style id='dynamic-css-cta-min-width-891'>\n\n";
			echo "@media ( min-width: 891px ) {\n";
			foreach ( $styles_min_891 as $css_unit ) {
				if ( !empty( $css_unit['value'] ) ) {
					echo strip_tags( $css_unit['elements'] . " { " . $css_unit['property'] . " : " . $css_unit['value'] . ";" . " }\n" );
				}
			}
			echo "}\n";
			echo '</style>';
		}


		if ( !empty( $styles_max_890 ) ) {
			echo "<style id='dynamic-css-cta-max-width-890'>\n\n";
			echo "@media ( max-width: 890px ) {\n";
			foreach ( $styles_max_890 as $css_unit ) {
				if ( !empty( $css_unit['value'] ) ) {
					echo strip_tags( $css_unit['elements'] . " { " . $css_unit['property'] . " : " . $css_unit['value'] . ";" . " }\n" );
				}
			}
			echo "}\n";
			echo '</style>';
		}


		$inspiry_logo_filter_for_print = get_option( 'inspiry_logo_filter_for_print', 'none' );
		if ( 'none' !== $inspiry_logo_filter_for_print ) : ?>

			<style id="dynamic-print-css">
				@media print {
					#logo img,
					.rh_logo img {
						-webkit-filter: <?php echo esc_html( $inspiry_logo_filter_for_print ); ?>(100%);
						filter: <?php echo esc_html( $inspiry_logo_filter_for_print ); ?>(100%);
					}
				}
			</style>
			<?php
		endif;
	}
}
