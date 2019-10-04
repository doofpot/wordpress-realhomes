<?php
/**
 * Section: `Properties Search Page`
 * Panel:   `Properties Search`
 *
 * @package RH
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_properties_search_page_customizer' ) ) :

	/**
	 * Properties search page section.
	 *
	 * @param  object $wp_customize - Instance of WP_Customize_Manager.
	 * @since  2.6.3
	 */
	function inspiry_properties_search_page_customizer( WP_Customize_Manager $wp_customize ) {

		global $inspiry_pages;

		/**
		 * Search Page
		 */
		$wp_customize->add_section(
			'inspiry_properties_search_page', array(
				'title' => esc_html__( 'Properties Search Page', 'framework' ),
				'panel' => 'inspiry_properties_search_panel',
			)
		);

		/* Inspiry Search Page */
		$wp_customize->add_setting(
			'inspiry_search_page', array(
				'type'  => 'option',
				'sanitize_callback' => 'inspiry_sanitize_select',
			)
		);
		$wp_customize->add_control(
			'inspiry_search_page', array(
				'label'         => esc_html__( 'Select Search Page', 'framework' ),
				'description'   => esc_html__( 'Selected page should have Property Search Template assigned to it. Also, Make sure to Configure Pretty Permalinks.', 'framework' ),
				'type'      => 'select',
				'section'   => 'inspiry_properties_search_page',
				'choices'   => $inspiry_pages,
			)
		);

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			/* Search Results Page Area Below Header */
			$wp_customize->add_setting(
				'theme_search_module', array(
					'type'      => 'option',
					'default'   => 'properties-map',
					'sanitize_callback' => 'inspiry_sanitize_radio',
				)
			);
			$wp_customize->add_control(
				'theme_search_module', array(
					'label'         => esc_html__( 'Search Results Page Header', 'framework' ),
					'description'   => esc_html__( 'What you want to display in area below header on properties search results page ?', 'framework' ),
					'type'      => 'radio',
					'section'   => 'inspiry_properties_search_page',
					'choices'   => array(
						'properties-map'    => esc_html__( 'Map with Properties Markers', 'framework' ),
						'simple-banner'     => esc_html__( 'Image Banner', 'framework' ),
					),
				)
			);
		}

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {

			// Header Variation
			$wp_customize->add_setting(
				'inspiry_search_header_variation', array(
					'type'      => 'option',
					'default'   => 'banner',
					'sanitize_callback' => 'inspiry_sanitize_radio',
				)
			);
			$wp_customize->add_control(
				'inspiry_search_header_variation', array(
					'label'     => esc_html__( 'Header Variation', 'framework' ),
					'description' => esc_html__( 'Header variation to display on Property Detail Page.', 'framework' ),
					'type'      => 'radio',
					'section'   => 'inspiry_properties_search_page',
					'choices'   => array(
						'banner'    => esc_html__( 'Banner', 'framework' ),
						'none'      => esc_html__( 'None', 'framework' ),
					),
				)
			);

			// Search Results Layout
			$wp_customize->add_setting( 'inspiry_search_results_layout', array(
				'type'      => 'option',
				'default'   => 'with_map',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'inspiry_search_results_layout', array(
				'label'     => esc_html__( 'Search Results Layout', 'framework' ),
				'description' => esc_html__( 'Search results page layout.', 'framework' ),
				'type'      => 'radio',
				'section'   => 'inspiry_properties_search_page',
				'choices'   => array(
					'with_map'  => esc_html__( 'With Map', 'framework' ),
					'without_map' => esc_html__( 'Without Map', 'framework' ),
				),
			) );

		}

		$map_type = inspiry_get_maps_type();
		if ( 'google-maps' == $map_type ) {

			/* Google Map Type */
			$wp_customize->add_setting( 'inspiry_search_map_type', array(
				'type'              => 'option',
				'default'           => 'roadmap',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'inspiry_search_map_type', array(
				'label'           => esc_html__( 'Map Type', 'framework' ),
				'description'     => esc_html__( 'Choose Google Map Type', 'framework' ),
				'type'            => 'select',
				'section'         => 'inspiry_properties_search_page',
				'choices'         => array(
					'roadmap'   => esc_html__( 'RoadMap', 'framework' ),
					'satellite' => esc_html__( 'Satellite', 'framework' ),
					'hybrid'    => esc_html__( 'Hybrid', 'framework' ),
					'terrain'   => esc_html__( 'Terrain', 'framework' ),
				),
				'active_callback' => 'inspiry_search_map_enabled',
			) );
		}

		/* Number of Properties To Display on Search Results Page */
		$wp_customize->add_setting(
			'theme_properties_on_search', array(
				'type'      => 'option',
				'default'   => '4',
				'sanitize_callback' => 'inspiry_sanitize_select',
			)
		);
		$wp_customize->add_control(
			'theme_properties_on_search', array(
				'label'         => esc_html__( 'Number of properties to display on a page?', 'framework' ),
				'type'      => 'select',
				'section'   => 'inspiry_properties_search_page',
				'choices'   => array(
					'1'     => 1,
					'2'     => 2,
					'3'     => 3,
					'4'     => 4,
					'5'     => 5,
					'6'     => 6,
					'7'     => 7,
					'8'     => 8,
					'9'     => 9,
					'10'    => 10,
					'11'    => 11,
					'12'    => 12,
					'13'    => 13,
					'14'    => 14,
					'15'    => 15,
					'16'    => 16,
					'17'    => 17,
					'18'    => 18,
					'19'    => 19,
					'20'    => 20,
				),
			)
		);


		// number of properties to display on map
		$wp_customize->add_setting(
			'inspiry_properties_on_search_map',
			array(
				'type'    => 'option',
				'default' => 'all',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			)
		);
		$wp_customize->add_control(
			'inspiry_properties_on_search_map', array(
				'label'       => esc_html__( 'Number of properties to mark on map?', 'framework' ),
				'section'     => 'inspiry_properties_search_page',
				'type'        => 'radio',
				'choices'     => array(
					'all'         => esc_html__( 'All found', 'framework' ),
					'as_on_one_page' => esc_html__( 'As on one page', 'framework' ),
				),
			)
		);


		/* Stick Featured Properties on top of Search Results in default sorting */
		$wp_customize->add_setting(
			'inspiry_featured_properties_on_top', array(
				'type'      => 'option',
				'default'   => 'true',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			)
		);
		$wp_customize->add_control(
			'inspiry_featured_properties_on_top', array(
				'label'         => esc_html__( 'Display featured properties on top in search results?', 'framework' ),
				'description'   => esc_html__( 'This setting will be applied on sorting based on Sort by Date (Old to New and New to Old) only.', 'framework' ),
				'type'      => 'radio',
				'section'   => 'inspiry_properties_search_page',
				'choices'   => array(
					'true'  => esc_html__( 'Yes', 'framework' ),
					'false' => esc_html__( 'No', 'framework' ),
				),
			)
		);

		/* Exclude Statuses */
		$all_statuses   = get_terms( array( 'taxonomy' => 'property-status' ) );
		$status_options = array();
		foreach ( $all_statuses as $status ) {
			$status_options[ $status->term_id ] = $status->name;
		}

		$wp_customize->add_setting( 'inspiry_search_exclude_status', array(
			'type'              => 'option',
			'sanitize_callback' => 'inspiry_sanitize_multiple_checkboxes',
		) );
		$wp_customize->add_control(
			new Inspiry_Multiple_Checkbox_Customize_Control(
				$wp_customize,
				'inspiry_search_exclude_status',
				array(
					'section' => 'inspiry_properties_search_page',
					'label'   => esc_html__( 'Which statuses would you like to exclude ?', 'framework' ),
					'choices' => $status_options
				)
			)
		);

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			/* Search Template Variation */
			$wp_customize->add_setting(
				'inspiry_search_template_variation', array(
					'type'    => 'option',
					'default' => 'two-columns',
					'sanitize_callback' => 'inspiry_sanitize_select',
				)
			);

			$wp_customize->add_control(
				'inspiry_search_template_variation', array(
					'label'       => esc_html__( 'Search Page Variation', 'framework' ),
					'description' => esc_html__( 'Search page variation to display properties.', 'framework' ),
					'type'        => 'select',
					'section'     => 'inspiry_properties_search_page',
					'choices'     => array(
						'one-column'   => esc_html__( 'One Column', 'framework' ),
						'two-columns'  => esc_html__( 'Two Columns', 'framework' ),
						'four-columns' => esc_html__( 'Four Columns', 'framework' ),
					),
				)
			);
		}

		/* Separator */
		$wp_customize->add_setting( 'inspiry_search_url_separator', array( 'sanitize_callback' => 'sanitize_text_field', ) );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_search_url_separator',
				array(
					'section'   => 'inspiry_properties_search_page',
				)
			)
		);

	}

	add_action( 'customize_register', 'inspiry_properties_search_page_customizer' );
endif;


if ( ! function_exists( 'inspiry_properties_search_page_defaults' ) ) :

	/**
	 * inspiry_properties_search_page_defaults.
	 *
	 * @since  2.6.3
	 */

	function inspiry_properties_search_page_defaults( WP_Customize_Manager $wp_customize ) {
		$properties_search_page_settings_ids = array(
			'inspiry_search_header_variation',
			'theme_search_module',
			'theme_properties_on_search',
			'inspiry_featured_properties_on_top',
			'inspiry_search_results_layout',
			'inspiry_search_template_variation',
		);
		inspiry_initialize_defaults( $wp_customize, $properties_search_page_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_properties_search_page_defaults' );
endif;

if ( ! function_exists( 'inspiry_search_map_enabled' ) ) {
	/**
	 * Check if Search page map is enabled
	 *
	 * @param $control
	 *
	 * @return bool
	 */
	function inspiry_search_map_enabled( $control ) {

		if ( 'classic' === INSPIRY_DESIGN_VARIATION && ( 'properties-map' === $control->manager->get_setting( 'theme_search_module' )->value() ) ) {
			return true;
		} else if ( 'modern' === INSPIRY_DESIGN_VARIATION && ( 'with_map' === $control->manager->get_setting( 'inspiry_search_results_layout' )->value() ) ) {
			return true;
		}

		return false;
	}
}