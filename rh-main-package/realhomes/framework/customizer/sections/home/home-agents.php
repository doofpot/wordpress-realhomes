<?php
/**
 * Section: Agents
 *
 * Home agents section settings.
 *
 * @since 	3.0.0
 * @package RH
 */

if ( ! function_exists( 'inspiry_home_agents_customizer' ) ) :

	/**
	 * Function to register customizer options
	 * for home agents section
	 *
	 * @param object $wp_customize - Object of WP_Customize_Manager.
	 * @since 3.0.0
	 */
	function inspiry_home_agents_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Home Slogan Section
		 */
		$wp_customize->add_section( 'inspiry_home_agents', array(
			'title' => esc_html__( 'Agents', 'framework' ),
			'panel' => 'inspiry_home_panel',
		) );

		/* Show/Hide Agents on Homepage */
		$wp_customize->add_setting( 'inspiry_show_agents', array(
			'type' 		=> 'option',
			'default' 	=> 'false',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_show_agents', array(
			'label' 	=> esc_html__( 'Agents on Homepage', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_home_agents',
			'choices' 	=> array(
				'true' 	=> esc_html__( 'Show', 'framework' ),
				'false' => esc_html__( 'Hide', 'framework' ),
			),
		) );

		/* Agents Section Text Over Title */
		$wp_customize->add_setting( 'inspiry_home_agents_sub_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> esc_html__( 'Recent', 'framework' ),
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_home_agents_sub_title', array(
			'label' 	=> esc_html__( 'Text Over Title', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_agents',
		) );

		/* Agents Section Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_home_agents_sub_title', array(
				'selector' 				=> '.home .rh_section__agents .rh_section__subtitle',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_home_agents_sub_title_render',
			) );
		}

		/* Agents Section Title */
		$wp_customize->add_setting( 'inspiry_home_agents_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> esc_html__( 'Agents', 'framework' ),
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_home_agents_title', array(
			'label' 	=> esc_html__( 'Section Title', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_agents',
		) );

		/* Agents Section Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_home_agents_title', array(
				'selector' 				=> '.home .rh_section__agents .rh_section__title',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_home_agents_title_render',
			) );
		}

		/* Agents Section Description */
		$wp_customize->add_setting( 'inspiry_home_agents_desc', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> 'Some amazing features of Real Homes theme.',
			'sanitize_callback' => 'wp_kses_data',
		) );
		$wp_customize->add_control( 'inspiry_home_agents_desc', array(
			'label' 	=> esc_html__( 'Section Description', 'framework' ),
			'type' 		=> 'textarea',
			'section' 	=> 'inspiry_home_agents',
		) );

		/* Agents Section Description Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_home_agents_desc', array(
				'selector' 				=> '.home .rh_section__agents .rh_section__desc',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_home_agents_desc_render',
			) );
		}

		/* Number of Properties To Display on Home Page */
		$wp_customize->add_setting( 'inspiry_agents_on_home', array(
			'type' 		=> 'option',
			'default' 	=> '4',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_agents_on_home', array(
			'label' 	=> esc_html__( 'Number of Agents', 'framework' ),
			'type' 		=> 'number',
			'section' 	=> 'inspiry_home_agents',
		) );

	}

	add_action( 'customize_register', 'inspiry_home_agents_customizer' );
endif;

if ( ! function_exists( 'inspiry_home_agents_defaults' ) ) :

	/**
	 * inspiry_home_agents_defaults.
	 *
	 * @since  3.0.0
	 */
	function inspiry_home_agents_defaults( WP_Customize_Manager $wp_customize ) {
		$testimonial_settings_ids = array(
			'inspiry_show_agents',
			'inspiry_home_agents_title',
			'inspiry_home_agents_desc',
			'inspiry_agents_on_home',
		);
		inspiry_initialize_defaults( $wp_customize, $testimonial_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_home_agents_defaults' );
endif;


if ( ! function_exists( 'inspiry_home_agents_sub_title_render' ) ) {
	function inspiry_home_agents_sub_title_render() {
		if ( get_option( 'inspiry_home_agents_sub_title' ) ) {
			echo esc_html( get_option( 'inspiry_home_agents_sub_title' ) );
		}
	}
}


if ( ! function_exists( 'inspiry_home_agents_title_render' ) ) {
	function inspiry_home_agents_title_render() {
		if ( get_option( 'inspiry_home_agents_title' ) ) {
			echo esc_html( get_option( 'inspiry_home_agents_title' ) );
		}
	}
}


if ( ! function_exists( 'inspiry_home_agents_desc_render' ) ) {
	function inspiry_home_agents_desc_render() {
		if ( get_option( 'inspiry_home_agents_desc' ) ) {
			echo get_option( 'inspiry_home_agents_desc' );
		}
	}
}
