<?php
/**
 * Section:	`Basic`
 * Panel: 	`Styles`
 *
 * @package RH
 * @since 3.0.0
 */


if ( ! function_exists( 'inspiry_styles_basic_customizer' ) ) :
	/**
	 * inspiry_styles_basic_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize - Instance of WP_Customize_Manager.
	 * @since  3.0.0
	 */
	function inspiry_styles_basic_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Basic Section
		 */
		$wp_customize->add_section( 'inspiry_styles_basic', array(
			'title' => esc_html__( 'Quick CSS (DEPRECATED)', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );

		/* Quick CSS */
		$wp_customize->add_setting( 'theme_quick_css', array(
			'type' => 'option',
			'transport' => 'postMessage',
			'sanitize_callback' => 'strip_tags',
		) );
		$wp_customize->add_control( 'theme_quick_css', array(
			'label' => esc_html__( 'Quick CSS (DEPRECATED)', 'framework' ),
			'description' => esc_html__( 'Quick CSS will be removed in future updates. So, Please move your CSS from here to Additional CSS under main panel.', 'framework' ),
			'type' => 'textarea',
			'section' => 'inspiry_styles_basic',
		) );

	}

	add_action( 'customize_register', 'inspiry_styles_basic_customizer' );
endif;


if ( ! function_exists( 'inspiry_styles_basic_defaults' ) ) :

	/**
	 * inspiry_styles_basic_defaults.
	 *
	 * @param  WP_Customize_Manager $wp_customize - Instance of WP_Customize_Manager.
	 * @since  3.0.0
	 */
	function inspiry_styles_basic_defaults( WP_Customize_Manager $wp_customize ) {
		$styles_basic_settings_ids = array();
		inspiry_initialize_defaults( $wp_customize, $styles_basic_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_styles_basic_defaults' );
endif;


if ( ! function_exists( 'inspiry_quick_css_notice' ) ) {
	/**
	 * Notify to switch CSS to additional CSS
	 */
	function inspiry_quick_css_notice() {
		$quick_css = stripslashes( get_option( 'theme_quick_css' ) );
		if ( ! empty( $quick_css ) ) {
			add_action( 'admin_notices', function () {
				?>
				<div class="notice notice-warning is-dismissible">
					<p><strong><?php echo esc_html_x( 'Styles > Quick CSS option in customizer has been DEPRECATED in favour of Additional CSS by WordPress!', 'Admin Notice', 'framework' ); ?></strong></p>
					<p><?php echo esc_html_x( 'So move your CSS from Styles > Quick CSS to Additional CSS under main panel. As it will be removed in future updates.', 'Admin Notice', 'framework' ); ?></p>
				</div>
				<?php
			} );
		}
	}
	add_action( 'admin_init', 'inspiry_quick_css_notice' );
}
