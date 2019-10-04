<?php
/**
 * Section:	`Home Properties`
 * Panel: 	`Home`
 *
 * @package RH
 */

if ( ! function_exists( 'inspiry_home_page_contents' ) ) {
	function inspiry_home_page_contents(WP_Customize_Manager $wp_customize){
		$wp_customize->add_section( 'inspiry_home_page_contents', array(
			'title' => esc_html__( 'Content Area', 'framework' ),
			'panel' => 'inspiry_home_panel',
		) );

	$wp_customize->add_setting( 'theme_show_home_contents', array(
		'type' 		=> 'option',
		'default' 	=> 'true',
		'sanitize_callback' => 'inspiry_sanitize_radio',
	) );
	$wp_customize->add_control( 'theme_show_home_contents', array(
		'label' 	=> esc_html__( 'Content Area on Homepage', 'framework' ),
		'type' 		=> 'radio',
		'section' 	=> 'inspiry_home_page_contents',
		'choices' 	=> array(
			'true' 	=> esc_html__( 'Show', 'framework' ),
			'false'	=> esc_html__( 'Hide', 'framework' ),
		),
	) );
	}

	add_action( 'customize_register', 'inspiry_home_page_contents' );

}
