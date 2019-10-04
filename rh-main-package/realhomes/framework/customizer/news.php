<?php
/**
 * Blog/News Customizer
 *
 * @package RH
 */


if ( ! function_exists( 'inspiry_news_customizer' ) ) :
	function inspiry_news_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Pages Panel
		 */
		$wp_customize->add_panel( 'inspiry_various_pages', array(
			'title' => esc_html__( 'Various Pages', 'framework' ),
			'priority' => 126,
		) );

		/**
		 * News Section
		 */
		$wp_customize->add_section( 'inspiry_news_section', array(
			'title' => esc_html__( 'News/Blog Page', 'framework' ),
			'panel' => 'inspiry_various_pages',
		) );

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Header Variation */
			$wp_customize->add_setting( 'inspiry_news_header_variation', array(
				'type'		=> 'option',
				'default' 	=> 'banner',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );

			$wp_customize->add_control( 'inspiry_news_header_variation', array(
				'label' 	=> esc_html__( 'Header Variation', 'framework' ),
				'description' => esc_html__( 'Header variation to display on News Page.', 'framework' ),
				'type' 		=> 'radio',
				'section'	=> 'inspiry_news_section',
				'choices' 	=> array(
					'banner'	=> esc_html__( 'Banner', 'framework' ),
					'none'		=> esc_html__( 'None', 'framework' ),
				),
			) );
		}

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {

			/* News/Blog Page Banner Title and Sub Title Display */
			$wp_customize->add_setting( 'inspiry_news_page_banner_title_display', array(
				'type'    => 'option',
				'default' => 'true',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'inspiry_news_page_banner_title_display', array(
				'label'   => esc_html__( 'Banner Title and Sub Title Display', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_news_section',
				'choices' => array(
					'true'  => esc_html__( 'Show', 'framework' ),
					'false' => esc_html__( 'Hide', 'framework' ),
				),
			) );
		}

		/* News Banner Title */
		$wp_customize->add_setting( 'theme_news_banner_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default' 			=> esc_html__( 'News', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_news_banner_title', array(
			'label' 	=> esc_html__( 'Banner Title', 'framework' ),
			'type' 		=> 'text',
			'section' 	=> 'inspiry_news_section',
		) );

		$theme_news_banner_title_selector = '.blog .page-head .wrap .page-title';
		$container_inclusive = true;

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$theme_news_banner_title_selector = '.blog .rh_banner .rh_banner__title';
			$container_inclusive = false;
		}
		/* News Banner Title Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_news_banner_title', array(
				'selector' 				=> $theme_news_banner_title_selector,
				'container_inclusive'	=> $container_inclusive,
				'render_callback' 		=> 'inspiry_news_banner_title_render',
			) );
		}

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			/* News Banner Sub Title */
			$wp_customize->add_setting( 'theme_news_banner_sub_title', array(
				'type' 				=> 'option',
				'transport'			=> 'postMessage',
				'default' 			=> esc_html__( 'Check out market updates', 'framework' ),
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'theme_news_banner_sub_title', array(
				'label' 	=> esc_html__( 'Banner Sub Title', 'framework' ),
				'type' 		=> 'text',
				'section' 	=> 'inspiry_news_section',
			) );

			/* News Banner Sub Title Selective Refresh */
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial( 'theme_news_banner_sub_title', array(
					'selector' 				=> '.blog .page-head .wrap .page-title +',
					'container_inclusive'	=> true,
					'render_callback' 		=> 'inspiry_news_banner_sub_title_render',
				) );
			}

			/* Link to Previous and Next Post */
			$wp_customize->add_setting( 'inspiry_post_prev_next_link', array(
				'type' => 'option',
				'default' => 'true',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'inspiry_post_prev_next_link', array(
				'label' => esc_html__( 'Link to Previous and Next Post', 'framework' ),
				'type' => 'radio',
				'section' => 'inspiry_news_section',
				'choices' => array(
					'true' => esc_html__( 'Enable', 'framework' ),
					'false' => esc_html__( 'Disable', 'framework' ),
				),
			) );
		}

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/**
			 * Pages Section
			 */
			$wp_customize->add_section( 'inspiry_pages_section', array(
				'title' => esc_html__( 'Pages', 'framework' ),
				'panel' => 'inspiry_various_pages',
			) );

			/* Header Variation */
			$wp_customize->add_setting( 'inspiry_pages_header_variation', array(
				'type'		=> 'option',
				'default' 	=> 'banner',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );

			$wp_customize->add_control( 'inspiry_pages_header_variation', array(
				'label' 	=> esc_html__( 'Header Variation', 'framework' ),
				'description' => esc_html__( 'Header variation to display on Pages.', 'framework' ),
				'type' 		=> 'radio',
				'section'	=> 'inspiry_pages_section',
				'choices' 	=> array(
					'banner'	=> esc_html__( 'Banner', 'framework' ),
					'none'		=> esc_html__( 'None', 'framework' ),
				),
			) );

			/* Explode Listing Title */
			$wp_customize->add_setting( 'inspiry_explode_listing_title', array(
				'type'    => 'option',
				'default' => 'yes',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );

			$wp_customize->add_control( 'inspiry_explode_listing_title', array(
				'label'       => esc_html__( 'Explode Title', 'framework' ),
				'description' => esc_html__( 'Explode page title into sub-title and title.', 'framework' ),
				'type'        => 'select',
				'section'     => 'inspiry_pages_section',
				'choices'     => array(
					'yes' => esc_html__( 'Yes', 'framework' ),
					'no'  => esc_html__( 'No', 'framework' ),
				),
			) );
		}

	}

	add_action( 'customize_register', 'inspiry_news_customizer' );
endif;


if ( ! function_exists( 'inspiry_news_defaults' ) ) :
	/**
	 * Set default values for news settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_news_defaults( WP_Customize_Manager $wp_customize ) {
		$news_settings_ids = array(
			'inspiry_news_header_variation',
			'theme_news_banner_title',
			'theme_news_banner_sub_title',
			'inspiry_post_prev_next_link',
			'inspiry_pages_header_variation',
			'inspiry_news_page_banner_title_display',
		);
		inspiry_initialize_defaults( $wp_customize, $news_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_news_defaults' );
endif;


if ( ! function_exists( 'inspiry_news_banner_title_render' ) ) {
	function inspiry_news_banner_title_render() {
		$banner_title = get_option( 'theme_news_banner_title' );
		if ( ! empty( $banner_title ) ) {
			if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
				echo esc_html( $banner_title );
			} elseif ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
				if ( is_single() ) :
					?><h2 class="page-title"><span><?php echo esc_html( $banner_title ); ?></span></h2><?php
				else :
					?><h1 class="page-title"><span><?php echo esc_html( $banner_title ); ?></span></h1><?php
				endif;
			}
		}
	}
}


if ( ! function_exists( 'inspiry_news_banner_sub_title_render' ) ) {
	function inspiry_news_banner_sub_title_render() {
		if ( get_option( 'theme_news_banner_sub_title' ) ) {
			echo '<p>' . get_option( 'theme_news_banner_sub_title' ) . '</p>';
		}
	}
}
