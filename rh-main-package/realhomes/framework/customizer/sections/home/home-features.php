<?php
/**
 * Section: Features
 *
 * Home features section settings.
 *
 * @since 	3.0.0
 * @package RH
 */

if ( ! function_exists( 'inspiry_home_features_customizer' ) ) :

	/**
	 * Function to register customizer options
	 * for home features section
	 *
	 * @param object $wp_customize - Object of WP_Customize_Manager.
	 * @since 3.0.0
	 */
	function inspiry_home_features_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Home Slogan Section
		 */
		$wp_customize->add_section( 'inspiry_home_features', array(
			'title' => esc_html__( 'Features', 'framework' ),
			'panel' => 'inspiry_home_panel',
		) );

		/* Show/Hide Features Section on Homepage */
		$wp_customize->add_setting( 'inspiry_show_home_features', array(
			'type' 		=> 'option',
			'default' 	=> 'true',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_show_home_features', array(
			'label' 	=> esc_html__( 'Features on Homepage', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_home_features',
			'choices' 	=> array(
				'true' 	=> esc_html__( 'Show', 'framework' ),
				'false' => esc_html__( 'Hide', 'framework' ),
			),
		) );

		/* Features Section Text Over Title */
		$wp_customize->add_setting( 'inspiry_home_features_sub_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> esc_html__( 'Amazing', 'framework' ),
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_home_features_sub_title', array(
			'label' 	=> esc_html__( 'Text Over Title', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_features',
		) );

		/* Features Section Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_home_features_sub_title', array(
				'selector' 				=> '.home .rh_section__features .rh_section__subtitle',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_home_features_sub_title_render',
			) );
		}

		/* Features Section Title */
		$wp_customize->add_setting( 'inspiry_home_features_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> esc_html__( 'Features', 'framework' ),
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_home_features_title', array(
			'label' 	=> esc_html__( 'Section Title', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_features',
		) );

		/* Features Section Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_home_features_title', array(
				'selector' 				=> '.home .rh_section__features .rh_section__title',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_home_features_title_render',
			) );
		}

		/* Features Section Description */
		$wp_customize->add_setting( 'inspiry_home_features_desc', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> 'Some amazing features of Real Homes theme.',
			'sanitize_callback' => 'wp_kses_data',
		) );
		$wp_customize->add_control( 'inspiry_home_features_desc', array(
			'label' 	=> esc_html__( 'Section Description', 'framework' ),
			'type' 		=> 'textarea',
			'section' 	=> 'inspiry_home_features',
		) );

		/* Home Features Intro */
		$wp_customize->add_setting( 'inspiry_home_features_intro', array( 'sanitize_callback' => 'sanitize_text_field', ) );
		$wp_customize->add_control(
			new Inspiry_Intro_Customize_Control(
				$wp_customize,
				'inspiry_home_features_intro',
				array(
					'section' => 'inspiry_home_features',
					'label' => esc_html__( 'How to add homepage features?', 'framework' ),
					'description' => esc_html__( 'Simply edit homepage and add features using meta boxes. You can get in touch with our support team in case of any confusion. Thanks!', 'framework' ),
				)
			)
		);

		/* Features Section Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_home_features_desc', array(
				'selector' 				=> '.home .rh_section__features .rh_section__desc',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_home_features_desc_render',
			) );
		}


	}

	add_action( 'customize_register', 'inspiry_home_features_customizer' );
endif;

if ( ! function_exists( 'inspiry_home_agents_defaults' ) ) :

	/**
	 * inspiry_home_agents_defaults.
	 *
	 * @since  3.0.0
	 */
	function inspiry_home_agents_defaults( WP_Customize_Manager $wp_customize ) {
		$testimonial_settings_ids = array(
			'inspiry_show_home_features',
			'inspiry_home_features_title',
			'inspiry_home_features_desc',
		);
		inspiry_initialize_defaults( $wp_customize, $testimonial_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_home_agents_defaults' );
endif;


if ( ! function_exists( 'inspiry_home_features_sub_title_render' ) ) {
	function inspiry_home_features_sub_title_render() {
		if ( get_option( 'inspiry_home_features_sub_title' ) ) {
			echo esc_html( get_option( 'inspiry_home_features_sub_title' ) );
		}
	}
}


if ( ! function_exists( 'inspiry_home_features_title_render' ) ) {
	function inspiry_home_features_title_render() {
		if ( get_option( 'inspiry_home_features_title' ) ) {
			echo esc_html( get_option( 'inspiry_home_features_title' ) );
		}
	}
}


if ( ! function_exists( 'inspiry_home_features_desc_render' ) ) {
	function inspiry_home_features_desc_render() {
		if ( get_option( 'inspiry_home_features_desc' ) ) {
			echo get_option( 'inspiry_home_features_desc' );
		}
	}
}
