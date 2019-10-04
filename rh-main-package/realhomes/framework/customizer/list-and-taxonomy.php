<?php
/**
 * Properties List Template and Taxonomy Archive Pages Settings
 *
 * @package RH
 */

if ( ! function_exists( 'inspiry_list_taxonomy_customizer' ) ) :
	function inspiry_list_taxonomy_customizer( WP_Customize_Manager $wp_customize ) {

		global $inspiry_pages;

		/**
		 * Properties List Templates and Taxonomy Archives Section
		 */
		$wp_customize->add_section( 'inspiry_list_and_taxonomy', array(
			'title' => esc_html__( 'List Templates & Taxonomy Archives', 'framework' ),
			'panel' => 'inspiry_various_pages',
		) );

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Header Variation */
			$wp_customize->add_setting( 'inspiry_listing_header_variation', array(
				'type'		=> 'option',
				'default' 	=> 'banner',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );

			$wp_customize->add_control( 'inspiry_listing_header_variation', array(
				'label' 	=> esc_html__( 'Header Variation', 'framework' ),
				'description' => esc_html__( 'Header variation to display on Properties List Templates and Taxonomy Archive pages.', 'framework' ),
				'type' 		=> 'radio',
				'section'	=> 'inspiry_list_and_taxonomy',
				'choices' 	=> array(
					'banner'	=> esc_html__( 'Banner', 'framework' ),
					'none'		=> esc_html__( 'None', 'framework' ),
				),
			) );
		}

		/* Module Below Header  */
		$wp_customize->add_setting( 'theme_listing_module', array(
			'type' => 'option',
			'default' => 'simple-banner',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_control( 'theme_listing_module', array(
				'label' => esc_html__( 'Module Below Header', 'framework' ),
				'description' => esc_html__( 'What to display in area below header on Properties List Templates and Taxonomy Archive pages ?', 'framework' ),
				'type' => 'radio',
				'section' => 'inspiry_list_and_taxonomy',
				'choices' => array(
					'properties-map' => esc_html__( 'Map With Properties Markers', 'framework' ),
					'simple-banner' => esc_html__( 'Image Banner', 'framework' ),
				),
			) );
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_control( 'theme_listing_module', array(
				'label' 	=> esc_html__( 'Module Below Header', 'framework' ),
				'description' => esc_html__( 'What to display in area below header on Properties List Templates and Taxonomy Archive pages ?', 'framework' ),
				'type' 		=> 'radio',
				'section'	=> 'inspiry_list_and_taxonomy',
				'choices' 	=> array(
					'properties-map'	=> esc_html__( 'Map With Properties Markers', 'framework' ),
					'simple-banner'		=> esc_html__( 'None', 'framework' ),
				),
			) );
		}

		$map_type = inspiry_get_maps_type();
		if ( 'google-maps' == $map_type ) {

			/* Google Map Type */
			$wp_customize->add_setting( 'inspiry_list_tax_map_type', array(
				'type'              => 'option',
				'default'           => 'roadmap',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'inspiry_list_tax_map_type', array(
				'label'           => esc_html__( 'Map Type', 'framework' ),
				'description'     => esc_html__( 'Choose Google Map Type', 'framework' ),
				'type'            => 'select',
				'section'         => 'inspiry_list_and_taxonomy',
				'choices'         => array(
					'roadmap'   => esc_html__( 'RoadMap', 'framework' ),
					'satellite' => esc_html__( 'Satellite', 'framework' ),
					'hybrid'    => esc_html__( 'Hybrid', 'framework' ),
					'terrain'   => esc_html__( 'Terrain', 'framework' ),
				),
				'active_callback' => 'inspiry_listing_map_enabled',
			) );
		}

		/* Layout  */
		$wp_customize->add_setting( 'theme_listing_layout', array(
			'type' => 'option',
			'default' => 'list',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'theme_listing_layout', array(
			'label' => esc_html__( 'Default Layout', 'framework' ),
			'description' => esc_html__( 'Select the default layout for taxonomy archive pages.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_list_and_taxonomy',
			'choices' => array(
				'list' => esc_html__( 'List Layout', 'framework' ),
				'grid' => esc_html__( 'Grid Layout', 'framework' ),
			),
		) );

		/* Number of Properties  */
		$wp_customize->add_setting( 'theme_number_of_properties', array(
			'type' => 'option',
			'default' => '3',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'theme_number_of_properties', array(
			'label' => esc_html__( 'Number of Properties', 'framework' ),
			'description' => esc_html__( 'Select the maximum number of properties to display on a page.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_list_and_taxonomy',
			'choices' => array(
				'1' => 1,
				'2' => 2,
				'3' => 3,
				'4' => 4,
				'5' => 5,
				'6' => 6,
				'7' => 7,
				'8' => 8,
				'9' => 9,
				'10' => 10,
				'11' => 11,
				'12' => 12,
				'13' => 13,
				'14' => 14,
				'15' => 15,
				'16' => 16,
				'17' => 17,
				'18' => 18,
				'19' => 19,
				'20' => 20,
			),
		) );

		// Skip Sticky Properties Option.
		$wp_customize->add_setting( 'inspiry_listing_skip_sticky', array(
			'type'		=> 'option',
			'default'	=> false,
			'sanitize_callback' => 'inspiry_sanitize_checkbox',
		) );
		$wp_customize->add_control( 'inspiry_listing_skip_sticky', array(
			'label' 	=> esc_html__( 'Skip Sticky Properties','framework' ),
			'description' => esc_html__( 'Check to skip sticky properties on listing page.','framework' ),
			'section' 	=> 'inspiry_list_and_taxonomy',
			'type'      => 'checkbox',
		) );

		/* Default Sort Order  */
		$wp_customize->add_setting( 'theme_listing_default_sort', array(
			'type' => 'option',
			'default' => 'date-desc',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'theme_listing_default_sort', array(
			'label' => esc_html__( 'Default Sort Order', 'framework' ),
			'description' => esc_html__( 'Select the default sort order for Search Results, List Templates and Taxonomy Archive pages.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_list_and_taxonomy',
			'choices' => array(
				'price-asc' => esc_html__( 'Price - Low to High', 'framework' ),
				'price-desc' => esc_html__( 'Price - High to Low', 'framework' ),
				'date-asc' => esc_html__( 'Date - Old to New', 'framework' ),
				'date-desc' => esc_html__( 'Date - New to Old', 'framework' ),
			),
		) );

	}

	add_action( 'customize_register', 'inspiry_list_taxonomy_customizer' );
endif;


if ( ! function_exists( 'inspiry_list_taxonomy_defaults' ) ) :
	/**
	 * Set default values for list and taxonomy settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_list_taxonomy_defaults( WP_Customize_Manager $wp_customize ) {
		$list_taxonomy_settings_ids = array(
			'inspiry_listing_header_variation',
			'theme_listing_module',
			'theme_listing_layout',
			'theme_number_of_properties',
			'theme_listing_default_sort',
		);
		inspiry_initialize_defaults( $wp_customize, $list_taxonomy_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_list_taxonomy_defaults' );
endif;

if ( ! function_exists( 'inspiry_listing_map_enabled' ) ) {
	/**
	 * Check if Listing & Taxonomy pages map is enabled
	 *
	 * @param $control
	 *
	 * @return bool
	 */
	function inspiry_listing_map_enabled( $control ) {
		if ( 'properties-map' === $control->manager->get_setting( 'theme_listing_module' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
}