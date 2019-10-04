<?php
/**
 * Section: News
 *
 * Home News section settings.
 *
 * @since    3.0.0
 * @package RH
 */

if ( ! function_exists( 'inspiry_home_news_customizer' ) ) {

	function inspiry_home_news_customizer( WP_Customize_Manager $wp_customize ) {
		/**
		 * Home News Section
		 */
		$wp_customize->add_section( 'inspiry_home_news_modern', array(
			'title' => esc_html__( 'News', 'framework' ),
			'panel' => 'inspiry_home_panel',
		) );

		/* Show/Hide Testimonial on Homepage */
		$wp_customize->add_setting( 'inspiry_show_home_news_modern', array(
			'type'    => 'option',
			'default' => 'true',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_show_home_news_modern', array(
				'label'   => esc_html__( 'News on Homepage', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_home_news_modern',
				'choices' => array(
					'true'  => esc_html__( 'Show', 'framework' ),
					'false' => esc_html__( 'Hide', 'framework' ),
				),
			)
		);


		$wp_customize->add_setting( 'inspiry_home_news_sub_title', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( 'Recent', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_home_news_sub_title', array(
			'label'   => esc_html__( 'Text Over Title', 'framework' ),
			'type'    => 'text',
			'section' => 'inspiry_home_news_modern',
		) );

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_home_news_sub_title', array(
				'selector' 				=> '.home .rh_section__news .rh_section__subtitle',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_home_news_sub_title_render',
			) );
		}

		$wp_customize->add_setting( 'inspiry_home_news_title', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( 'News & Updates', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_home_news_title', array(
			'label'   => esc_html__( 'Section Title', 'framework' ),
			'type'    => 'text',
			'section' => 'inspiry_home_news_modern',
		) );

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_home_news_title', array(
				'selector' 				=> '.home .rh_section__news .rh_section__title',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_home_news_title_render',
			) );
		}

		$wp_customize->add_setting( 'inspiry_home_news_desc', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( 'Some recent news & updates of Real Homes theme.', 'framework' ),
			'sanitize_callback' => 'wp_kses_data',
		) );
		$wp_customize->add_control( 'inspiry_home_news_desc', array(
			'label'   => esc_html__( 'Section Description', 'framework' ),
			'type'    => 'textarea',
			'section' => 'inspiry_home_news_modern',
		) );

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_home_news_desc', array(
				'selector' 				=> '.home .rh_section__news .rh_section__desc',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_home_news_desc_render',
			) );
		}


	}

	add_action( 'customize_register', 'inspiry_home_news_customizer' );

}


if ( ! function_exists( 'inspiry_home_news_sub_title_render' ) ) {
	function inspiry_home_news_sub_title_render() {
		if ( get_option( 'inspiry_home_news_sub_title' ) ) {
			echo esc_html( get_option( 'inspiry_home_news_sub_title' ) );
		}
	}
}


if ( ! function_exists( 'inspiry_home_news_title_render' ) ) {
	function inspiry_home_news_title_render() {
		if ( get_option( 'inspiry_home_news_title' ) ) {
			echo esc_html( get_option( 'inspiry_home_news_title' ) );
		}
	}
}

if ( ! function_exists( 'inspiry_home_news_desc_render' ) ) {
	function inspiry_home_news_desc_render() {
		if ( get_option( 'inspiry_home_news_desc' ) ) {
			echo esc_html( get_option( 'inspiry_home_news_desc' ) );
		}
	}
}
