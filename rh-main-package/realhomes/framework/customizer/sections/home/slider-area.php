<?php
/**
 * Section:	`Slider Area`
 * Panel: 	`Home`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_slider_area_customizer' ) ) :

	/**
	 * inspiry_slider_area_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */

	function inspiry_slider_area_customizer( WP_Customize_Manager $wp_customize ) {

		// Get design variation.
		$rh_design_variation = INSPIRY_DESIGN_VARIATION;

		/**
		 * Slider Section
		 */
		$wp_customize->add_section( 'inspiry_home_slider_area', array(
			'title' => esc_html__( 'Slider Area', 'framework' ),
			'panel'	=> 'inspiry_home_panel',
		) );

		/* What to display below header */
		$wp_customize->add_setting( 'theme_homepage_module', array(
			'type' 		=> 'option',
			'default' 	=> 'simple-banner',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );

		if ( 'classic' === $rh_design_variation ) {
			$wp_customize->add_control( 'theme_homepage_module', array(
				'label' 	=> esc_html__( 'What to Display Below Header on Home Page ?', 'framework' ),
				'type' 		=> 'radio',
				'section' 	=> 'inspiry_home_slider_area',
				'choices'	=> array(
					'none' 			            => esc_html__( 'None', 'framework' ),
					'properties-slider' 		=> esc_html__( 'Slider Based on Properties Custom Post Type', 'framework' ),
					'search-form-over-image'	=> esc_html__( 'Search Form Over an Image / Video', 'framework' ),
					'properties-map' 			=> esc_html__( 'Map with Properties Markers', 'framework' ),
					'simple-banner' 			=> esc_html__( 'Image Based Banner', 'framework' ),
					'revolution-slider' 		=> esc_html__( 'Slider Based on Revolution Slider Plugin.', 'framework' ),
					'slides-slider' 			=> esc_html__( 'Slider Based on Slides Custom Post Type', 'framework' ),
				),
			) );
		} elseif ( 'modern' === $rh_design_variation ) {
			$wp_customize->add_control( 'theme_homepage_module', array(
				'label' 	=> esc_html__( 'What to Display Below Header on Home Page ?', 'framework' ),
				'type' 		=> 'radio',
				'section' 	=> 'inspiry_home_slider_area',
				'choices'	=> array(
					'none' 			            => esc_html__( 'None', 'framework' ),
					'properties-slider' 		=> esc_html__( 'Slider Based on Properties Custom Post Type', 'framework' ),
					'properties-map' 			=> esc_html__( 'Map with Properties Markers', 'framework' ),
					'simple-banner' 			=> esc_html__( 'Image Based Banner', 'framework' ),
					'revolution-slider' 		=> esc_html__( 'Slider Based on Revolution Slider Plugin.', 'framework' ),
					'slides-slider' 			=> esc_html__( 'Slider Based on Slides Custom Post Type', 'framework' ),
				),
			) );
		}

		$map_type = inspiry_get_maps_type();
		if ( 'google-maps' == $map_type ) {

			/* Google Map Type */
			$wp_customize->add_setting( 'inspiry_home_map_type', array(
				'type'              => 'option',
				'default'           => 'roadmap',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'inspiry_home_map_type', array(
				'label'           => esc_html__( 'Map Type', 'framework' ),
				'description'     => esc_html__( 'Choose Google Map Type', 'framework' ),
				'type'            => 'select',
				'section'         => 'inspiry_home_slider_area',
				'choices'         => array(
					'roadmap'   => esc_html__( 'RoadMap', 'framework' ),
					'satellite' => esc_html__( 'Satellite', 'framework' ),
					'hybrid'    => esc_html__( 'Hybrid', 'framework' ),
					'terrain'   => esc_html__( 'Terrain', 'framework' ),
				),
				'active_callback' => 'inspiry_home_map_enabled',
			) );
		}

		/* Number of Slides for Properties */
		$wp_customize->add_setting( 'theme_number_of_slides', array(
			'type' 		=> 'option',
			'default'	=> '3',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'theme_number_of_slides', array(
			'label'				=> esc_html__( 'Maximum Number of Slides to Display in Slider Based on Properties', 'framework' ),
			'type' 				=> 'select',
			'section' 			=> 'inspiry_home_slider_area',
			'active_callback'	=> 'inspiry_properties_slider_enabled',
			'choices'	=> array(
				'1' 	=> 1,
				'2' 	=> 2,
				'3' 	=> 3,
				'4' 	=> 4,
				'5' 	=> 5,
				'6' 	=> 6,
				'7' 	=> 7,
				'8' 	=> 8,
				'9' 	=> 9,
				'10' 	=> 10,
			),
		) );

		/**
		 * Background Image for Search Form
		 */
		$wp_customize->add_setting( 'inspiry_home_search_bg_img', array(
			'type' 				=> 'option',
			'sanitize_callback'	=> 'esc_url_raw',
		) );
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'inspiry_home_search_bg_img',
				array(
					'label' 			=> esc_html__( 'Background Image for Homepage Search Form', 'framework' ),
					'description' 		=> esc_html__( 'Required minimum height is 1000px and minimum width is 2000px.', 'framework' ),
					'section' 			=> 'inspiry_home_slider_area',
					'active_callback'	=> 'inspiry_search_form_over_image',
				)
			)
		);

		/* Background Video for Search Form ( Revolution Slider Alias ) */
		$wp_customize->add_setting( 'inspiry_home_search_bg_video', array(
			'type' 				=> 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_home_search_bg_video', array(
			'label' 			=> esc_html__( 'Background Video for Homepage Search Form ( Revolution Slider Alias )', 'framework' ),
			'description' 		=> esc_html__( 'If you want to display Video as Background, provide its Revolution Slider alias here.', 'framework' ),
			'type' 				=> 'text',
			'section'			=> 'inspiry_home_slider_area',
			'active_callback'	=> 'inspiry_search_form_over_image',
		) );

		/* Background Image Overlay Color */
		$wp_customize->add_setting( 'inspiry_SFOI_overlay_color', array(
			'type' 				=> 'option',
			'default' 			=> '#000000',
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'inspiry_SFOI_overlay_color',
				array(
					'label' 			=> esc_html__( 'Background Image Overlay Color', 'framework' ),
					'section' 			=> 'inspiry_home_slider_area',
					'active_callback'	=> 'inspiry_search_form_over_image',
				)
			)
		);

		/* Background Image Overlay Opacity */
		$wp_customize->add_setting( 'inspiry_SFOI_overlay_opacity', array(
			'type' 				=> 'option',
			'default' 			=> 0.3,
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_SFOI_overlay_opacity', array(
			'label' 			=> esc_html__( 'Background Image Overlay Opacity', 'framework' ),
			'description' 		=> esc_html__( 'You can set background image overlay opacity from 0 to 1 and between in points e.g: 0.3', 'framework' ),
			'type' 				=> 'text',
			'active_callback'	=> 'inspiry_search_form_over_image',
			'section' 			=> 'inspiry_home_slider_area',
		) );

		/**
		 * SFOI = Search form over image
		 *
		 * SFOI Title
		 */
		$wp_customize->add_setting( 'inspiry_SFOI_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_SFOI_title', array(
			'label' 			=> esc_html__( 'Title for Search Form Over Image', 'framework' ),
			'type' 				=> 'text',
			'active_callback'	=> 'inspiry_search_form_over_image',
			'section' 			=> 'inspiry_home_slider_area',
		) );

		/* SFOI Title Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_SFOI_title', array(
				'selector' 				=> '.SFOI .SFOI__content h2.SFOI__title',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_SFOI_title_render',
			) );
		}

		/* SFOI Title Color Setting */
		$wp_customize->add_setting( 'inspiry_SFOI_title_color', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default' 			=> '#ffffff',
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'inspiry_SFOI_title_color',
				array(
					'label' 			=> esc_html__( 'Title Color', 'framework' ),
					'section' 			=> 'inspiry_home_slider_area',
					'active_callback'	=> 'inspiry_search_form_over_image',
				)
			)
		);

		/**
		 * SFOI Description
		 */
		$wp_customize->add_setting( 'inspiry_SFOI_description', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_SFOI_description', array(
			'label' 			=> esc_html__( 'Description for Search Form Over Image', 'framework' ),
			'type' 				=> 'text',
			'active_callback'	=> 'inspiry_search_form_over_image',
			'section' 			=> 'inspiry_home_slider_area',
		) );

		/* SFOI Description Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_SFOI_description', array(
				'selector' 				=> '.SFOI .SFOI__content p.SFOI__description',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_SFOI_desc_render',
			) );
		}

		$wp_customize->add_setting( 'inspiry_SFOI_description_color', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default' 			=> '#ffffff',
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'inspiry_SFOI_description_color',
				array(
					'label' 			=> esc_html__( 'Description Color', 'framework' ),
					'section' 			=> 'inspiry_home_slider_area',
					'active_callback'	=> 'inspiry_search_form_over_image',
				)
			)
		);
		
		/* Number of Slides for Custom Slides */
		$wp_customize->add_setting( 'theme_number_custom_slides', array(
			'type' 		=> 'option',
			'default'	=> '3',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'theme_number_custom_slides', array(
			'label' 			=> esc_html__( 'Maximum Number of Slides to Display in Slider Based on Slides Custom Post Type', 'framework' ),
			'type' 				=> 'select',
			'section' 			=> 'inspiry_home_slider_area',
			'active_callback'	=> 'inspiry_custom_slider_enabled',
			'choices' 	=> array(
				'1' 	=> 1,
				'2' 	=> 2,
				'3' 	=> 3,
				'4' 	=> 4,
				'5' 	=> 5,
				'6' 	=> 6,
				'7' 	=> 7,
				'8' 	=> 8,
				'9' 	=> 9,
				'10' 	=> 10,
			),
		) );

		/* Revolution Slider Alias */
		$wp_customize->add_setting( 'theme_rev_alias', array(
			'type' 				=> 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_rev_alias', array(
			'label' 			=> esc_html__( 'Revolution Slider Alias', 'framework' ),
			'description' 		=> esc_html__( 'If you want to display Revolution Slider then provide its alias here.', 'framework' ),
			'type' 				=> 'text',
			'active_callback' 	=> 'inspiry_revolution_slider_enabled',
			'section'			=> 'inspiry_home_slider_area',
		) );
	}

	add_action( 'customize_register', 'inspiry_slider_area_customizer' );
endif;


if ( ! function_exists( 'inspiry_slider_area_defaults' ) ) :

	/**
	 * inspiry_slider_area_defaults.
	 *
	 * @since  2.6.3
	 */
	function inspiry_slider_area_defaults( WP_Customize_Manager $wp_customize ) {
		$slider_area_settings_ids = array(
			'theme_homepage_module',
			'theme_number_of_slides',
			'inspiry_SFOI_top_margin',
			'theme_number_custom_slides',
		);
		inspiry_initialize_defaults( $wp_customize, $slider_area_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_slider_area_defaults' );
endif;

if ( ! function_exists( 'inspiry_home_map_enabled' ) ) {
	/**
	 * Check if Homepage map is enabled
	 *
	 * @param $control
	 *
	 * @return bool
	 */
	function inspiry_home_map_enabled( $control ) {
		if ( 'properties-map' === $control->manager->get_setting( 'theme_homepage_module' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'inspiry_properties_slider_enabled' ) ) {
	/**
	 * Checks if properties slider is enabled or not
	 *
	 * @return true|false
	 */
	function inspiry_properties_slider_enabled() {
		$theme_homepage_module = get_option( 'theme_homepage_module' );
		if ( 'properties-slider' == $theme_homepage_module ) {
			return true;
		}
		return false;
	}
}


if ( ! function_exists( 'inspiry_search_form_over_image' ) ) {
	/**
	 * Checks if search form over image is enabled or not
	 *
	 * @return true|false
	 */
	function inspiry_search_form_over_image() {
		$theme_homepage_module = get_option( 'theme_homepage_module' );
		if ( 'search-form-over-image' == $theme_homepage_module ) {
			return true;
		}
		return false;
	}
}

if ( ! function_exists( 'inspiry_optima_express_search_form' ) ) {
	/**
	 * Checks if optima express slider search is enabled or not
	 *
	 * @return true|false
	 */
	function inspiry_optima_express_search_form() {
		$theme_homepage_module = get_option( 'theme_homepage_module' );
		if ( 'optima-slider' == $theme_homepage_module ) {
			return true;
		}
		return false;
	}
}


if ( ! function_exists( 'inspiry_custom_slider_enabled' ) ) {
	/**
	 * Checks if slides CPT based slider is enabled or not
	 *
	 * @return true|false
	 */
	function inspiry_custom_slider_enabled() {
		$theme_homepage_module = get_option( 'theme_homepage_module' );
		if ( 'slides-slider' == $theme_homepage_module ) {
			return true;
		}
		return false;
	}
}


if ( ! function_exists( 'inspiry_revolution_slider_enabled' ) ) {
	/**
	 * Checks if revolution slider is enabled or not
	 *
	 * @return true|false
	 */
	function inspiry_revolution_slider_enabled() {
		$theme_homepage_module = get_option( 'theme_homepage_module' );
		if ( 'revolution-slider' == $theme_homepage_module ) {
			return true;
		}
		return false;
	}
}


if ( ! function_exists( 'inspiry_SFOI_title_render' ) ) {
	function inspiry_SFOI_title_render() {
		if ( get_option( 'inspiry_SFOI_title' ) ) {
			echo get_option( 'inspiry_SFOI_title' );
		}
	}
}


if ( ! function_exists( 'inspiry_SFOI_desc_render' ) ) {
	function inspiry_SFOI_desc_render() {
		if ( get_option( 'inspiry_SFOI_description' ) ) {
			echo get_option( 'inspiry_SFOI_description' );
		}
	}
}
