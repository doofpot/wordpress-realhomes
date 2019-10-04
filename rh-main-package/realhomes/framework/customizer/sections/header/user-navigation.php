<?php
/**
 * Section:	`User Navigation`
 * Panel: 	`Header`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_user_navigation_customizer' ) ) :

	/**
	 * inspiry_user_navigation_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */

	function inspiry_user_navigation_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * User Navigation
		 */
		$wp_customize->add_section( 'inspiry_header_user_nav', array(
			'title' => esc_html__( 'User Navigation', 'framework' ),
			'panel' => 'inspiry_header_panel',
		) );

		/* Show / Hide Header Navigation for Members */
		$wp_customize->add_setting( 'theme_enable_user_nav', array(
			'type' 		=> 'option',
			'default' 	=> 'true',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'theme_enable_user_nav', array(
			'label' 	=> esc_html__( 'User Login and Register Links Display', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_header_user_nav',
			'choices' 	=> array(
				'true' 	=> esc_html__( 'Show', 'framework' ),
				'false'	=> esc_html__( 'Hide', 'framework' ),
			)
		) );
	}

	add_action( 'customize_register', 'inspiry_user_navigation_customizer' );
endif;


if ( ! function_exists( 'inspiry_user_navigation_defaults' ) ) :

	/**
	 * inspiry_user_navigation_defaults.
	 *
	 * @since  2.6.3
	 */

	function inspiry_user_navigation_defaults( WP_Customize_Manager $wp_customize ) {
		$user_navigation_settings_ids = array(
			'theme_enable_user_nav',
		);
		inspiry_initialize_defaults( $wp_customize, $user_navigation_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_user_navigation_defaults' );
endif;


