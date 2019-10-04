<?php
/**
 * User Sync Customizer Settings
 *
 * @package RH
 */

if ( ! function_exists( 'inspiry_user_sync_customizer' ) ) :
	function inspiry_user_sync_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Payments Section
		 */
		$wp_customize->add_section( 'inspiry_members_user_sync', array(
			'title' => esc_html__( 'User & Agent/Agency Sync', 'framework' ),
			'panel' => 'inspiry_members_panel',
		) );

		/* Enable/Disable User Sync with Agents/Agencies */
		$wp_customize->add_setting( 'inspiry_user_sync', array(
			'type'              => 'option',
			'default'           => 'false',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_user_sync', array(
			'label'   => esc_html__( 'Enable User Synchronisation with Agent/Agency', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_members_user_sync',
			'choices' => array(
				'true'  => esc_html__( 'Yes', 'framework' ),
				'false' => esc_html__( 'No', 'framework' ),
			),
		) );
	}

	add_action( 'customize_register', 'inspiry_user_sync_customizer' );
endif;