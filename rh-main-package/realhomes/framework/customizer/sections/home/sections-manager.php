<?php
/**
 * Section:	`Sections Manager`
 * Panel: 	`Home`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_sections_manager_customizer' ) ) :

	/**
	 * inspiry_sections_manager_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */

	function inspiry_sections_manager_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Sections Manager
		 */
		$wp_customize->add_section( 'inspiry_home_sections_manager', array(
			'title' => esc_html__( 'Sections Manager', 'framework' ),
			'panel'	=> 'inspiry_home_panel',
		) );


		$wp_customize->add_setting( 'inspiry_home_sections_order_default', array(
			'default'           => 'default',
			'sanitize_callback' => 'sanitize_text_field'
		) );


		$wp_customize->add_control( 'inspiry_home_sections_order_default', array(
			'label'    => esc_html__( 'Order Settings', 'framework' ),
			'type'     => 'radio',
			'section'  => 'inspiry_home_sections_manager',
			'settings' => 'inspiry_home_sections_order_default',
			'choices'  => array(
				'default' => esc_html__( 'Default', 'framework' ),
				'custom'  => esc_html__( 'Custom', 'framework' ),
			),
		) );





		$defaults = '';
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ){
			$defaults = 'home-properties,features-section,featured-properties,blog-posts';
		}elseif('modern' === INSPIRY_DESIGN_VARIATION){
			$defaults = 'content,latest-properties,featured-properties,testimonial,cta,agents,features,partners,news,cta-contact';
		}

        // Homepage Sections Order
        $wp_customize->add_setting( 'inspiry_home_sections_order', array(
            'type' 				=> 'option',
            'default' 			=> $defaults,
            'sanitize_callback'	=> 'sanitize_text_field'
        ) );

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_control( new Inspiry_Dragdrop_Control(
				$wp_customize,
				'inspiry_home_sections_order',
				array(
					'label'    => esc_html__( 'Sections Order', 'framework' ),
					'description' => esc_html__( 'Select Custom Order Settings to apply these changes.', 'framework' ),
					'section'  => 'inspiry_home_sections_manager',
					'settings' => 'inspiry_home_sections_order',
					'choices'  => array(
						'home-properties'     => esc_html__( 'Home Properties', 'framework' ),
						'features-section'    => esc_html__( 'Features Section', 'framework' ),
						'featured-properties' => esc_html__( 'Featured Properties', 'framework' ),
						'blog-posts'          => esc_html__( 'News/Blog Posts', 'framework' )
					)
				)
			) );
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {

			$wp_customize->add_setting( 'inspiry_home_sections_order_mod', array(
				'type' 				=> 'option',
				'default' 			=> $defaults,
				'sanitize_callback'	=> 'sanitize_text_field'
			) );

			$wp_customize->add_control( new Inspiry_Dragdrop_Control(
				$wp_customize,
				'inspiry_home_sections_order_mod',
				array(
					'label'    => esc_html__( 'Sections Order', 'framework' ),
					'description' => esc_html__( 'Select Custom Order Settings to apply these changes.', 'framework' ),
					'section'  => 'inspiry_home_sections_manager',
					'settings' => 'inspiry_home_sections_order_mod',
					'choices' => array(
						'content'   => esc_html__( 'Content Area', 'framework' ),
						'latest-properties'   => esc_html__( 'Latest Properties', 'framework' ),
						'featured-properties' => esc_html__( 'Featured Properties', 'framework' ),
						'testimonial'         => esc_html__( 'Testimonials', 'framework' ),
						'cta'                 => esc_html__( 'Call to Action', 'framework' ),
						'agents'              => esc_html__( 'Agents', 'framework' ),
						'features'            => esc_html__( 'Features', 'framework' ),
						'partners'            => esc_html__( 'Partners', 'framework' ),
						'news'                => esc_html__( 'News & Updates', 'framework' ),
						'cta-contact'         => esc_html__( 'Call to Action -- Contact', 'framework' ),
					)
				)
			) );
		}

	}

	add_action( 'customize_register', 'inspiry_sections_manager_customizer' );
endif;


if ( ! function_exists( 'inspiry_sections_manager_defaults' ) ) :

	/**
	 * inspiry_sections_manager_defaults.
	 *
	 * @since  2.6.3
	 */

	function inspiry_sections_manager_defaults( WP_Customize_Manager $wp_customize ) {
		$sections_manager_settings_ids = array(
			'inspiry_home_sections_order'
		);
		inspiry_initialize_defaults( $wp_customize, $sections_manager_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_sections_manager_defaults' );
endif;
