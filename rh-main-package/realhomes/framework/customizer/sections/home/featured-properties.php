<?php
/**
 * Section:	`Featured Properties`
 * Panel: 	`Home`
 *
 * @since 2.6.3
 * @package  RH
 */

if ( ! function_exists( 'inspiry_featured_properties_customizer' ) ) :

	/**
	 * Home Featured Properties section settings.
	 *
	 * @param  object $wp_customize - Instance of WP_Customize_Manager.
	 * @since  2.6.3
	 */
	function inspiry_featured_properties_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Home Featured Properties Section
		 */
		$wp_customize->add_section( 'inspiry_home_featured_properties', array(
			'title' => esc_html__( 'Featured Properties', 'framework' ),
			'panel' => 'inspiry_home_panel',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );

		/* Show/Hide Featured Properties on Homepage */
		$wp_customize->add_setting( 'theme_show_featured_properties', array(
			'type' 		=> 'option',
			'default' 	=> 'true',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'theme_show_featured_properties', array(
			'label' 	=> esc_html__( 'Featured Properties on Homepage', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_home_featured_properties',
			'choices' 	=> array(
				'true' 	=> esc_html__( 'Show', 'framework' ),
				'false' => esc_html__( 'Hide', 'framework' ),
			),
		) );

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Text Over Title */
			$wp_customize->add_setting( 'inspiry_featured_prop_sub_title', array(
				'type' 				=> 'option',
				'transport'			=> 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'inspiry_featured_prop_sub_title', array(
				'label' 	=> esc_html__( 'Text Over Title', 'framework' ),
				'type' 		=> 'text',
				'section' 	=> 'inspiry_home_featured_properties',
			) );

			// Partial Refresh.
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial( 'inspiry_featured_prop_sub_title', array(
					'selector' 				=> '.home .rh_section--featured .rh_section__subtitle',
					'container_inclusive'	=> false,
					'render_callback' 		=> 'inspiry_featured_prop_sub_title_render',
				) );
			}
		}

		/* Title */
		$wp_customize->add_setting( 'theme_featured_prop_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_featured_prop_title', array(
			'label' 	=> esc_html__( 'Section Title', 'framework' ),
			'type' 		=> 'text',
			'section' 	=> 'inspiry_home_featured_properties',
		) );

		/* Featured Properties Title Selective Refresh */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$featured_title_selector = '.featured-properties-carousel .narrative h3, #rh_featured_properties .narrative h3';
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$featured_title_selector = '.home .rh_section--featured .rh_section__title';
		}
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_featured_prop_title', array(
				'selector' 				=> $featured_title_selector,
				'container_inclusive'	=> false,
				'render_callback' 		=> 'theme_featured_prop_title_render',
			) );
		}

		/* Text */
		$wp_customize->add_setting( 'theme_featured_prop_text', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'wp_kses_data',
		) );
		$wp_customize->add_control( 'theme_featured_prop_text', array(
			'label' 	=> esc_html__( 'Section Description', 'framework' ),
			'type' 		=> 'textarea',
			'section'	=> 'inspiry_home_featured_properties',
		) );

		/* Featured Properties Description Selective Refresh */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$featured_desc_selector = '.featured-properties-carousel .narrative p, #rh_featured_properties .narrative p';
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$featured_desc_selector = '.home .rh_section--featured .rh_section__desc';
		}
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_featured_prop_text', array(
				'selector' 				=> $featured_desc_selector,
				'container_inclusive'	=> false,
				'render_callback' 		=> 'theme_featured_prop_text_render',
			) );
		}

		/* Exclude Featured Properties from Properties on Homepage */
		$wp_customize->add_setting( 'theme_exclude_featured_properties', array(
			'type' 		=> 'option',
			'default' 	=> 'false',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'theme_exclude_featured_properties', array(
			'label' 	=> esc_html__( 'Exclude or Include Featured Properties from Recent Properties on Homepage', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_home_featured_properties',
			'choices' 	=> array(
				'true' 	=> 'Exclude',
				'false'	=> 'Include',
			),
		) );

		/* Exclude Statuses */
		$all_statuses   = get_terms( array( 'taxonomy' => 'property-status' ) );
		$status_options = array();
		foreach ( $all_statuses as $status ) {
			$status_options[ $status->term_id ] = $status->name;
		}

		$wp_customize->add_setting( 'inspiry_featured_properties_exclude_status', array(
			'type'              => 'option',
			'sanitize_callback' => 'inspiry_sanitize_multiple_checkboxes',
		) );
		$wp_customize->add_control(
			new Inspiry_Multiple_Checkbox_Customize_Control(
				$wp_customize,
				'inspiry_featured_properties_exclude_status',
				array(
					'section' => 'inspiry_home_featured_properties',
					'label'   => esc_html__( 'Which statuses would you like to exclude ?', 'framework' ),
					'choices' => $status_options
				)
			)
		);

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			/* Featured Properties Variation */
			$wp_customize->add_setting( 'inspiry_featured_properties_variation', array(
				'type' 		=> 'option',
				'default' 	=> 'default',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'inspiry_featured_properties_variation', array(
				'label' 	=> esc_html__( 'Select Featured Properties Variation', 'framework' ),
				'type' 		=> 'radio',
				'section' 	=> 'inspiry_home_featured_properties',
				'choices' 	=> array(
					'default' 				=> 'Default',
					'one_property_slide'	=> 'Slide with single property',
				),
			) );
		}

	}

	add_action( 'customize_register', 'inspiry_featured_properties_customizer' );
endif;


if ( ! function_exists( 'inspiry_featured_properties_defaults' ) ) :

	/**
	 * inspiry_featured_properties_defaults.
	 *
	 * @since  2.6.3
	 */

	function inspiry_featured_properties_defaults( WP_Customize_Manager $wp_customize ) {
		$featured_properties_settings_ids = array(
			'theme_show_featured_properties',
			'theme_exclude_featured_properties',
			'inspiry_featured_properties_variation',
		);
		inspiry_initialize_defaults( $wp_customize, $featured_properties_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_featured_properties_defaults' );
endif;


if ( ! function_exists( 'inspiry_featured_prop_sub_title_render' ) ) {
	function inspiry_featured_prop_sub_title_render() {
		if ( get_option( 'inspiry_featured_prop_sub_title' ) ) {
			echo esc_html( get_option( 'inspiry_featured_prop_sub_title' ) );
		}
	}
}


if ( ! function_exists( 'theme_featured_prop_title_render' ) ) {
	function theme_featured_prop_title_render() {
		if ( get_option( 'theme_featured_prop_title' ) ) {
			echo esc_html( get_option( 'theme_featured_prop_title' ) );
		}
	}
}


if ( ! function_exists( 'theme_featured_prop_text_render' ) ) {
	function theme_featured_prop_text_render() {
		if ( get_option( 'theme_featured_prop_text' ) ) {
			echo get_option( 'theme_featured_prop_text' );
		}
	}
}
