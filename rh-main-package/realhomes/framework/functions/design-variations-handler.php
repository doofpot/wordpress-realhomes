<?php
/**
 * Design variation related functions
 *
 * This file contains all the functions related to design
 * variations of this theme.
 *
 * @package realhomes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'inspiry_enqueue_theme_styles' ) ) {
	/**
	 * Load Required CSS Styles
	 */
	function inspiry_enqueue_theme_styles() {
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			inspiry_enqueue_classic_styles();
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			inspiry_enqueue_modern_styles();
		}

		inspiry_enqueue_common_styles();
	}

	add_action( 'wp_enqueue_scripts', 'inspiry_enqueue_theme_styles' );
}


if ( ! function_exists( 'inspiry_enqueue_theme_scripts' ) ) {
	/**
	 * Enqueue JavaScripts required for this theme
	 */
	function inspiry_enqueue_theme_scripts() {
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			inspiry_enqueue_classic_scripts();
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			inspiry_enqueue_modern_scripts();
		}

		inspiry_enqueue_common_scripts();
	}

	add_action( 'wp_enqueue_scripts', 'inspiry_enqueue_theme_scripts' );
}


if ( ! function_exists( 'inspiry_enqueue_classic_styles' ) ) {
	/**
	 * Function to load classic styles.
	 *
	 * @since 2.7.0
	 */
	function inspiry_enqueue_classic_styles() {
		if ( ! is_admin() ) {
			/**
			 * Settings for CSS optimisation
			 */
			$inspiry_optimise_css = get_option( 'inspiry_optimise_css' );

			/*
			 * Google Fonts
			 */
			wp_enqueue_style(
				'inspiry-google-fonts',
				inspiry_google_fonts(),
				array(),
				INSPIRY_THEME_VERSION
			);

			/*
			 * Register Default and Custom Styles
			 */
			wp_register_style(
				'parent-default',
				get_stylesheet_uri(),
				array(),
				INSPIRY_THEME_VERSION,
				'all'
			);

			// Flex Slider
			wp_dequeue_style( 'flexslider' );       // dequeue flexslider if it registered by a plugin.
			wp_deregister_style( 'flexslider' );    // deregister flexslider if it registered by a plugin.
			wp_enqueue_style(
				'flexslider',
				INSPIRY_DIR_URI . '/scripts/vendors/flexslider/flexslider.css',
				array(),
				'2.6.0',
				'all'
			);

			// Pretty photo.
			wp_enqueue_style(
				'pretty-photo-css',
				INSPIRY_DIR_URI . '/scripts/vendors/prettyphoto/css/prettyPhoto.css',
				array(),
				'3.1.6',
				'all'
			);

			// Swipe Box.
			wp_enqueue_style(
				'swipebox',
				INSPIRY_DIR_URI . '/scripts/vendors/swipebox/css/swipebox.min.css',
				array(),
				'1.4.4',
				'all'
			);

			// Select2.
			wp_enqueue_style(
				'select2',
				INSPIRY_DIR_URI . '/scripts/vendors/select2/select2.css',
				array(),
				'4.0.2',
				'all'
			);

			/*
			 * Main CSS
			 */
			if ( 'true' === $inspiry_optimise_css ) {
				wp_enqueue_style(
					'main-css',
					INSPIRY_DIR_URI . '/styles/css/main.min.css',
					array(),
					INSPIRY_THEME_VERSION,
					'all'
				);
			} else {
				wp_enqueue_style(
					'main-css',
					INSPIRY_DIR_URI . '/styles/css/main.css',
					array(),
					INSPIRY_THEME_VERSION,
					'all'
				);
			}

			/*
			 * RTL Styles
			 */
			if ( is_rtl() ) {
				if ( 'true' === $inspiry_optimise_css ) {
					wp_enqueue_style(
						'rtl-main-css',
						INSPIRY_DIR_URI . '/styles/css/rtl-main.min.css',
						array(),
						INSPIRY_THEME_VERSION,
						'all'
					);
				} else {
					wp_enqueue_style(
						'rtl-main-css',
						INSPIRY_DIR_URI . '/styles/css/rtl-main.css',
						array(),
						INSPIRY_THEME_VERSION,
						'all'
					);
				}
			}

			/*
			 * IF Visual Composer Plugins installed and activated
			 */
			if ( class_exists( 'Vc_Manager' ) ) {
				if ( 'true' === $inspiry_optimise_css ) {
					wp_enqueue_style(
						'vc-css',
						INSPIRY_DIR_URI . '/styles/css/visual-composer.min.css',
						array(),
						INSPIRY_THEME_VERSION,
						'all'
					);
				} else {
					wp_enqueue_style(
						'vc-css',
						INSPIRY_DIR_URI . '/styles/css/visual-composer.css',
						array(),
						INSPIRY_THEME_VERSION,
						'all'
					);
				}
			}

			// default css.
			wp_enqueue_style( 'parent-default' );

		}
	}
}


if ( ! function_exists( 'inspiry_enqueue_classic_scripts' ) ) {
	/**
	 * Function to load classic scripts.
	 *
	 * @since 2.7.0
	 */
	function inspiry_enqueue_classic_scripts() {
		if ( ! is_admin() ) {

			$js_directory_uri = INSPIRY_DIR_URI . '/scripts/';

			/**
			 * Registering of Scripts
			 */

			// flexslider
			wp_dequeue_script( 'flexslider' );      // dequeue flexslider if it is enqueue by some plugin.
            
			wp_register_script(
				'flexslider',
				$js_directory_uri . 'vendors/flexslider/jquery.flexslider-min.js',
				array( 'jquery' ),
				'2.6.0',
				false
			);

			// jQuery Easing.
			wp_register_script(
				'jquery-easing',
				$js_directory_uri . 'vendors/jquery.easing.min.js',
				array( 'jquery' ),
				'1.4.1',
				false
			);

			// elasti slide.
			wp_register_script(
				'elastislide',
				$js_directory_uri . 'vendors/elastislide/jquery.elastislide.js',
				array( 'jquery' ),
				false
			);

			// pretty photo.
			wp_register_script(
				'pretty-photo',
				$js_directory_uri . 'vendors/prettyphoto/jquery.prettyPhoto.js',
				array( 'jquery' ),
				'3.1.6',
				false
			);

			// isotope.
			wp_register_script(
				'isotope',
				$js_directory_uri . 'vendors/isotope.pkgd.min.js',
				array( 'jquery' ),
				'2.1.1',
				false
			);

			// jcarousel.
			wp_register_script(
				'jcarousel',
				$js_directory_uri . 'vendors/jquery.jcarousel.min.js',
				array( 'jquery' ),
				'0.2.9',
				false
			);

			// jQuery Validate.
			wp_register_script(
				'jqvalidate',
				$js_directory_uri . 'vendors/jquery.validate.min.js',
				array( 'jquery' ),
				'1.11.1',
				false
			);

			// jQuery Form.
			wp_register_script(
				'jqform',
				$js_directory_uri . 'vendors/jquery.form.js',
				array( 'jquery' ),
				'3.40',
				false
			);

			// select2.
			wp_register_script(
				'select2',
				$js_directory_uri . 'vendors/select2/select2.full.min.js',
				array( 'jquery' ),
				'4.0.2',
				false
			);

			// jQuery Transit.
			wp_register_script(
				'jqtransit',
				$js_directory_uri . 'vendors/jquery.transit.min.js',
				array( 'jquery' ),
				'0.9.9',
				false
			);

			// Bootstrap.
			wp_register_script(
				'bootstrap',
				$js_directory_uri . 'vendors/bootstrap.min.js',
				array( 'jquery' ),
				false
			);

			// Swipebox.
			wp_register_script(
				'swipebox',
				$js_directory_uri . 'vendors/swipebox/js/jquery.swipebox.min.js',
				array( 'jquery' ),
				'1.4.4',
				false
			);

			// Sticky-kit.
			wp_register_script(
				'sticky-kit',
				$js_directory_uri . 'vendors/sticky-kit/sticky-kit.min.js',
				array( 'jquery' ),
				'1.1.2',
				false
			);

			// Search form script.
			wp_register_script(
				'inspiry-search',
				$js_directory_uri . 'js/inspiry-search-form.js',
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);

			// Theme's main script.
			wp_register_script(
				'custom',
				$js_directory_uri . 'js/custom.js',
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);

			/**
			 * Enqueue Scripts that are needed on all the pages
			 */
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-autocomplete' );

			/**
			 * If enabled include a single common script file to improve performance
			 */
			if ( 'true' === get_option( 'inspiry_optimise_js' ) && ! class_exists( 'iHomefinderAdmin' ) ) {

				wp_enqueue_script(
					'realhomes-common-scripts',
					$js_directory_uri . 'vendors/realhomes-common-scripts.js',
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					false
				);

			} else {
				wp_enqueue_script( 'flexslider' );
				wp_enqueue_script( 'jquery-easing' );
				wp_enqueue_script( 'elastislide' );
				wp_enqueue_script( 'swipebox' );
				wp_enqueue_script( 'pretty-photo' );
				wp_enqueue_script( 'sticky-kit' );
				wp_enqueue_script( 'isotope' );
				wp_enqueue_script( 'jcarousel' );
				wp_enqueue_script( 'jqvalidate' );
				wp_enqueue_script( 'jqform' );
				wp_enqueue_script( 'select2' );
				wp_enqueue_script( 'jqtransit' );

				if ( ! class_exists( 'iHomefinderAdmin' ) ) {
					wp_enqueue_script( 'bootstrap' );
				}
			}

			/**
			 * Maps Script
			 */
			$map_type = inspiry_get_maps_type();
			if ( 'google-maps' == $map_type ) {
				inspiry_enqueue_google_maps();
			} else {
				inspiry_enqueue_open_street_map();
			}

			/**
			 * Property Submit and Edit page
			 */
			if ( is_page_template( 'templates/submit-property.php' ) ) {

				// For image upload.
				wp_enqueue_script( 'plupload' );

				// For sortable additional details.
				wp_enqueue_script( 'jquery-ui-sortable' );

				// Property Submit Script.
				wp_register_script(
					'property-submit',
					$js_directory_uri . 'js/property-submit.js',
					array( 'jquery', 'jquery-ui-sortable', 'plupload' ),
					INSPIRY_THEME_VERSION,
					true
				);

				// Data to print in JavaScript format above property submit script tag in HTML.
				$property_submit_data = array(
					'ajaxURL'       => admin_url( 'admin-ajax.php' ),
					'uploadNonce'   => wp_create_nonce( 'inspiry_allow_upload' ),
					'fileTypeTitle' => esc_html__( 'Valid file formats', 'framework' ),
				);

				wp_localize_script( 'property-submit', 'propertySubmit', $property_submit_data );
				wp_enqueue_script( 'property-submit' );

			}

			/**
			 * Edit profile template
			 */
			if ( is_page_template( 'templates/edit-profile.php' ) ) {

				// For image upload.
				wp_enqueue_script( 'plupload' );

				wp_register_script(
					'edit-profile',
					$js_directory_uri . 'js/edit-profile.js',
					array( 'jquery', 'plupload' ),
					INSPIRY_THEME_VERSION,
					true
				);

				// Data to print in JavaScript format above edit profile script tag in HTML.
				$edit_profile_data = array(
					'ajaxURL'       => admin_url( 'admin-ajax.php' ),
					'uploadNonce'   => wp_create_nonce( 'inspiry_allow_upload' ),
					'fileTypeTitle' => esc_html__( 'Valid file formats', 'framework' ),
				);

				wp_localize_script( 'edit-profile', 'editProfile', $edit_profile_data );
				wp_enqueue_script( 'edit-profile' );
			}

			/**
			 * Script for comments reply
			 */
			if ( is_singular( 'post' ) || is_page() || is_singular( 'property' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			/**
			 * Login, Register and Forgot Password Script
			 */
			if ( ! is_user_logged_in() ) {
				wp_enqueue_script(
					'inspiry-login-register',
					$js_directory_uri . 'js/inspiry-login-register.js',
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					true
				);
			}

			/* Print select status for rent to switch prices in properties search form */
			$rent_slug               = get_option( 'theme_status_for_rent' );
			$localized_search_params = array();
			if ( ! empty( $rent_slug ) ) {
				$localized_search_params['rent_slug'] = $rent_slug;
			}

			/* localize search parameters */
			wp_localize_script( 'inspiry-search', 'localizedSearchParams', $localized_search_params );

			/* Inspiry search form script */
			wp_enqueue_script( 'inspiry-search' );

			/*
			 * Google reCaptcha
			 */
			if ( class_exists( 'Easy_Real_Estate' ) ) {
				if ( ere_is_reCAPTCHA_configured() ) {

					$inspiry_contact_form_shortcode = get_option( 'inspiry_contact_form_shortcode' );

					$recaptcha_src = esc_url_raw( add_query_arg( array(
						'render' => 'explicit',
						'onload' => 'loadInspiryReCAPTCHA',
					), '//www.google.com/recaptcha/api.js' ) );

					if ( ! is_page_template( 'templates/contact.php' ) ) {
						// Enqueue google reCAPTCHA API.
						wp_enqueue_script(
							'rh-google-recaptcha',
							$recaptcha_src,
							array(),
							INSPIRY_THEME_VERSION,
							true
						);
					} elseif ( empty( $inspiry_contact_form_shortcode ) ) {
						// Enqueue google reCAPTCHA API.
						wp_enqueue_script(
							'rh-google-recaptcha',
							$recaptcha_src,
							array(),
							INSPIRY_THEME_VERSION,
							true
						);
					}
				}
			}

			/* custom js localization */
			$localized_array = array(
				'nav_title'          => esc_html__( 'Go to...', 'framework' ),
				'more_search_fields' => esc_html__( 'More fields', 'framework' ),
				'less_search_fields' => esc_html__( 'Less fields', 'framework' )
			);
			wp_localize_script( 'custom', 'localized', $localized_array );

			// Data to print in JavaScript format above custom js script tag in HTML.
			$custom_data = array(
				'video_width'  => get_option( 'inpsiry_property_video_popup_width', 1778 ),
				'video_height' => get_option( 'inspiry_property_video_popup_height', 1000 ),
			);
			wp_localize_script( 'custom', 'customData', $custom_data );
			/* Finally enqueue theme's main script */
			wp_enqueue_script( 'custom' );

		}
	}

}


if ( ! function_exists( 'inspiry_enqueue_modern_styles' ) ) {
	/**
	 * Function to load modern styles.
	 *
	 * @since 3.0.0
	 */
	function inspiry_enqueue_modern_styles() {

		if ( ! is_admin() ) {

			/**
			 * Settings for CSS optimisation
			 */
			$inspiry_optimise_css = get_option( 'inspiry_optimise_css' );

			/**
			 * Google Fonts
			 */
			wp_enqueue_style(
				'inspiry-google-fonts',
				inspiry_google_fonts(),
				array(),
				INSPIRY_THEME_VERSION
			);

			/**
			 * Rubik Google Font
			 */
			wp_enqueue_style(
				'realhomes-rubik-font',
				modern_fonts_url(),
				array(),
				INSPIRY_THEME_VERSION
			);

			/**
			 * Register Default and Custom Styles
			 */
			wp_register_style(
				'parent-default',
				get_stylesheet_uri(),
				array(),
				INSPIRY_THEME_VERSION,
				'all'
			);

			// Flex Slider
			wp_dequeue_style( 'flexslider' );       // dequeue flexslider if it registered by a plugin.
			wp_deregister_style( 'flexslider' );    // deregister flexslider if it registered by a plugin.
			wp_enqueue_style(
				'flexslider',
				INSPIRY_DIR_URI . '/scripts/vendors/flexslider/flexslider.css',
				array(),
				'2.6.0',
				'all'
			);

			// Select2.
			wp_enqueue_style(
				'select2',
				INSPIRY_DIR_URI . '/scripts/vendors/select2/select2.css',
				array(),
				'4.0.2',
				'all'
			);

			// Swipe Box.
			wp_enqueue_style(
				'swipebox',
				INSPIRY_DIR_URI . '/scripts/vendors/swipebox/css/swipebox.min.css',
				array(),
				'1.4.4',
				'all'
			);

			// Pretty photo.
			wp_enqueue_style(
				'pretty-photo-css',
				INSPIRY_DIR_URI . '/scripts/vendors/prettyphoto/css/prettyPhoto.css',
				array(),
				'3.1.6',
				'all'
			);

			if ( is_singular( 'property' ) ) {

				// entypo fonts.
				wp_enqueue_style(
					'entypo-fonts',
					INSPIRY_DIR_URI . '/styles/css/entypo.min.css',
					array(),
					INSPIRY_THEME_VERSION,
					'all'
				);
			}

			/**
			 * Main CSS
			 */
			if ( 'true' === $inspiry_optimise_css ) {
				wp_enqueue_style(
					'main-css',
					INSPIRY_DIR_URI . '/styles/css/main.min.css',
					array(),
					INSPIRY_THEME_VERSION,
					'all'
				);
			} else {
				wp_enqueue_style(
					'main-css',
					INSPIRY_DIR_URI . '/styles/css/main.css',
					array(),
					INSPIRY_THEME_VERSION,
					'all'
				);
			}

			/**
			 * RTL Styles
			 */
			if ( is_rtl() ) {
				if ( 'true' === $inspiry_optimise_css ) {
					wp_enqueue_style(
						'rtl-main-css',
						INSPIRY_DIR_URI . '/styles/css/rtl-main.min.css',
						array(),
						INSPIRY_THEME_VERSION,
						'all'
					);
				} else {
					wp_enqueue_style(
						'rtl-main-css',
						INSPIRY_DIR_URI . '/styles/css/rtl-main.css',
						array(),
						INSPIRY_THEME_VERSION,
						'all'
					);
				}
			}

			// default css.
			wp_enqueue_style( 'parent-default' );

		}
	}
}


if ( ! function_exists( 'inspiry_enqueue_modern_scripts' ) ) {
	/**
	 * Function to load modern scripts.
	 *
	 * @since 3.0.0
	 */
	function inspiry_enqueue_modern_scripts() {

		if ( ! is_admin() ) {

			$js_directory_uri = INSPIRY_DIR_URI . '/scripts/';

			// Flexslider.
			wp_dequeue_script( 'flexslider' );      // dequeue flexslider if it is enqueue by some plugin.
			wp_register_script(
				'flexslider',
				$js_directory_uri . 'vendors/flexslider/jquery.flexslider-min.js',
				array( 'jquery' ),
				'2.6.0',
				false
			);

			// jQuery Validate.
			wp_register_script(
				'jqvalidate',
				$js_directory_uri . 'vendors/jquery.validate.min.js',
				array( 'jquery' ),
				'1.11.1',
				false
			);

			// jQuery Form.
			wp_register_script(
				'jqform',
				$js_directory_uri . 'vendors/jquery.form.js',
				array( 'jquery' ),
				'3.40',
				false
			);

			// select2.
			wp_register_script(
				'select2',
				$js_directory_uri . 'vendors/select2/select2.full.min.js',
				array( 'jquery' ),
				'4.0.3',
				false
			);

			// Swipebox.
			wp_register_script(
				'swipebox',
				$js_directory_uri . 'vendors/swipebox/js/jquery.swipebox.min.js',
				array( 'jquery' ),
				'1.4.4',
				false
			);

			// pretty photo.
			wp_register_script(
				'pretty-photo',
				$js_directory_uri . 'vendors/prettyphoto/jquery.prettyPhoto.js',
				array( 'jquery' ),
				'3.1.6',
				false
			);

			// Progress bar.
			wp_register_script(
				'progress-bar',
				$js_directory_uri . 'vendors/progressbar/dist/progressbar.min.js',
				array( 'jquery' ),
				'1.0.1',
				false
			);

			// Sticky-kit.
			wp_register_script(
				'sticky-kit',
				$js_directory_uri . 'vendors/sticky-kit/sticky-kit.min.js',
				array( 'jquery' ),
				'1.1.2',
				false
			);

			/**
			 * Edit profile template
			 */
			if ( is_page_template( 'templates/2-columns-gallery.php' ) ||
			     is_page_template( 'templates/3-columns-gallery.php' ) ||
			     is_page_template( 'templates/4-columns-gallery.php' )
			) {
				// isotope.
				wp_register_script(
					'isotope',
					$js_directory_uri . 'vendors/isotope.pkgd.min.js',
					array( 'jquery' ),
					'2.1.1',
					false
				);
				wp_enqueue_script( 'isotope' );
			}

			/**
			 * If enabled include a single common script file to improve performance
			 */
			if ( 'true' === get_option( 'inspiry_optimise_js' ) && ! class_exists( 'iHomefinderAdmin' ) ) {

				wp_enqueue_script(
					'realhomes-common-scripts',
					$js_directory_uri . 'vendors/realhomes-common-scripts.js',
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					false
				);

			} else {
				wp_enqueue_script( 'flexslider' );
				wp_enqueue_script( 'progress-bar' );
				wp_enqueue_script( 'swipebox' );
				wp_enqueue_script( 'pretty-photo' );
				wp_enqueue_script( 'sticky-kit' );
				wp_enqueue_script( 'isotope' );
				wp_enqueue_script( 'jqvalidate' );
				wp_enqueue_script( 'jqform' );
				wp_enqueue_script( 'select2' );
			}

			/**
			 * Maps Script
			 */
			$map_type = inspiry_get_maps_type();
			if ( 'google-maps' == $map_type ) {
				inspiry_enqueue_google_maps();
			} else {
				inspiry_enqueue_open_street_map();
			}

			/**
			 * Login Script
			 */
			if ( ! is_user_logged_in() ) {
				wp_enqueue_script(
					'inspiry-login',
					$js_directory_uri . 'js/inspiry-login.js',
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					true
				);
			}

			// Search form script.
			wp_register_script(
				'inspiry-search',
				$js_directory_uri . 'js/inspiry-search-form.js',
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);

			// Theme's main script.
			wp_register_script(
				'custom',
				$js_directory_uri . 'js/custom.js',
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);

			/**
			 * Edit profile template
			 */
			if ( is_page_template( 'templates/edit-profile.php' ) ) {

				// For image upload.
				wp_enqueue_script( 'plupload' );

				wp_register_script(
					'edit-profile',
					$js_directory_uri . 'js/edit-profile.js',
					array( 'jquery', 'plupload' ),
					INSPIRY_THEME_VERSION,
					true
				);

				// Data to print in JavaScript format above edit profile script tag in HTML.
				$edit_profile_data = array(
					'ajaxURL'       => admin_url( 'admin-ajax.php' ),
					'uploadNonce'   => wp_create_nonce( 'inspiry_allow_upload' ),
					'fileTypeTitle' => esc_html__( 'Valid file formats', 'framework' ),
				);

				wp_localize_script( 'edit-profile', 'editProfile', $edit_profile_data );
				wp_enqueue_script( 'edit-profile' );
			}

			/**
			 * Memberships template
			 */
			if ( is_page_template( 'templates/membership-plans.php' ) ) {

				wp_register_script(
					'rh-memberships',
					$js_directory_uri . 'js/rh-memberships.js',
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					true
				);
				wp_enqueue_script( 'rh-memberships' );
			}

			/**
			 * My Properties Template
			 */
			if ( is_page_template( 'templates/my-properties.php' ) ) {
				wp_register_script(
					'my-properties',
					$js_directory_uri . 'js/my-properties.js',
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					true
				);
				wp_enqueue_script( 'my-properties' );
			}

			/**
			 * Property Submit and Edit page
			 */
			if ( is_page_template( 'templates/submit-property.php' ) ) {

				// For image upload.
				wp_enqueue_script( 'plupload' );

				// For sortable additional details.
				wp_enqueue_script( 'jquery-ui-sortable' );

				// Property Submit Script.
				wp_register_script(
					'property-submit',
					$js_directory_uri . 'js/property-submit.js',
					array( 'jquery', 'jquery-ui-sortable', 'plupload' ),
					INSPIRY_THEME_VERSION,
					true
				);

				// Data to print in JavaScript format above property submit script tag in HTML.
				$property_submit_data = array(
					'ajaxURL'       => admin_url( 'admin-ajax.php' ),
					'uploadNonce'   => wp_create_nonce( 'inspiry_allow_upload' ),
					'fileTypeTitle' => esc_html__( 'Valid file formats', 'framework' ),
				);

				wp_localize_script( 'property-submit', 'propertySubmit', $property_submit_data );
				wp_enqueue_script( 'property-submit' );

			}

			if ( is_singular( 'property' ) ) {

				wp_enqueue_script(
					'share-js',
					$js_directory_uri . 'vendors/share.min.js',
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					true
				);

				wp_enqueue_script(
					'property-share',
					$js_directory_uri . 'js/property-share.js',
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					true
				);
			}

			/**
			 * Script for comments reply
			 */
			if ( is_singular( 'post' ) || is_page() || is_singular( 'property' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			/* Print select status for rent to switch prices in properties search form */
			$rent_slug               = get_option( 'theme_status_for_rent' );
			$localized_search_params = array();
			if ( ! empty( $rent_slug ) ) {
				$localized_search_params['rent_slug'] = $rent_slug;
			}

			/* localize search parameters */
			wp_localize_script( 'inspiry-search', 'localizedSearchParams', $localized_search_params );

			/* Inspiry search form script */
			wp_enqueue_script( 'inspiry-search' );

			/**
			 * Google reCaptcha
			 */
			if ( class_exists( 'Easy_Real_Estate' ) ) {
				if ( ere_is_reCAPTCHA_configured() ) {

					$inspiry_contact_form_shortcode = get_option( 'inspiry_contact_form_shortcode' );

					$modern_recaptcha_src = esc_url_raw( add_query_arg( array(
						'render' => 'explicit',
						'onload' => 'loadInspiryReCAPTCHA',
					), '//www.google.com/recaptcha/api.js' ) );

					if ( ! is_page_template( 'templates/contact.php' ) ) {
						// Enqueue google reCAPTCHA API.
						wp_enqueue_script(
							'inspiry-google-recaptcha',
							$modern_recaptcha_src,
							array(),
							INSPIRY_THEME_VERSION,
							true
						);
					} elseif ( empty( $inspiry_contact_form_shortcode ) ) {
						// Enqueue google reCAPTCHA API.
						wp_enqueue_script(
							'inspiry-google-recaptcha',
							$modern_recaptcha_src,
							array(),
							INSPIRY_THEME_VERSION,
							true
						);
					} else {
						remove_action( 'wp_footer', 'ere_recaptcha_callback_generator' );
					}
				}
			}

			// Data to print in JavaScript format above custom js script tag in HTML.
			$custom_data = array(
				'video_width'  => get_option( 'inpsiry_property_video_popup_width', 1778 ),
				'video_height' => get_option( 'inspiry_property_video_popup_height', 1000 ),
			);
			wp_localize_script( 'custom', 'customData', $custom_data );
			wp_enqueue_script( 'custom' );

		}
	}
}


if ( ! function_exists( 'inspiry_enqueue_common_styles' ) ) {

	/**
	 * Function to load common styles.
	 *
	 * @since  3.0.2
	 */
	function inspiry_enqueue_common_styles() {

		// Font awesome css.
		wp_enqueue_style(
			'rh-font-awesome',
			INSPIRY_COMMON_URI . 'font-awesome/css/font-awesome.min.css',
			array(),
			'4.7.0',
			'all'
		);

		// Font awesome stars.
		if ( is_singular( 'property' ) ) {
			wp_enqueue_style(
				'rh-font-awesome-stars',
				INSPIRY_COMMON_URI . 'font-awesome/css/fontawesome-stars.css',
				array(),
				'1.0.0',
				'all'
			);
		}

		// Owl carousel.
		wp_enqueue_style(
			'owl-carousel-main',
			INSPIRY_COMMON_URI . 'js/owl-carousel/assets/owl.carousel.min.css',
			array(),
			'2.3.4',
			'all'
		);

		// Owl carousel default theme.
		wp_enqueue_style(
			'owl-carousel-default',
			INSPIRY_COMMON_URI . 'js/owl-carousel/assets/owl.theme.default.min.css',
			array(),
			'2.3.4',
			'all'
		);

		// VenoBox - Just another responsive jQuery lightbox plugin.
		wp_enqueue_style(
			'venobox',
			INSPIRY_COMMON_URI . 'js/venobox/venobox.css',
			array(),
			'1.8.5',
			'all'
		);

		// parent theme custom css
		wp_enqueue_style(
			'parent-custom',
			INSPIRY_DIR_URI . '/styles/css/custom.css',
			array(),
			INSPIRY_THEME_VERSION,
			'all'
		);
	}
}


if ( ! function_exists( 'inspiry_enqueue_common_scripts' ) ) {

	/**
	 * Function to load common scripts.
	 *
	 * @since  3.0.2
	 */
	function inspiry_enqueue_common_scripts() {

		// Retina JS.
		wp_enqueue_script(
			'retina-js',
			INSPIRY_COMMON_URI . 'js/retina.min.js',
			array( 'jquery' ),
			INSPIRY_THEME_VERSION,
			true
		);

		// BarRating JS.
		$property_ratings = get_option( 'inspiry_property_ratings', 'false' );
		if ( 'true' === $property_ratings && is_singular( 'property' ) ) {
			// jQuery Bar Rating.
			wp_enqueue_script(
				'rh-jquery-bar-rating',
				INSPIRY_COMMON_URI . 'js/jquery.barrating.min.js',
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);
		}

		if ( inspiry_is_rvr_enabled() ) {
			// Availability Calendar
			wp_enqueue_script(
				'availability-calendar',
				INSPIRY_COMMON_URI . 'js/availability-calendar.min.js',
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				false
			);
		}

		// Common FrontEnd JS.
		wp_enqueue_script(
			'frontend-js',
			INSPIRY_COMMON_URI . 'js/frontend-script.js',
			array( 'jquery' ),
			INSPIRY_THEME_VERSION,
			true
		);

		if ( ( 'enable' === get_option( 'theme_compare_properties_module' ) && get_option( 'inspiry_compare_page' ) ) ) {
			wp_enqueue_script(
				'compare-js',
				INSPIRY_COMMON_URI . 'js/compare-properties.js',
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);
		}

		// Owl Carousel.
		wp_enqueue_script(
			'owl-carousel',
			INSPIRY_COMMON_URI . 'js/owl-carousel/owl.carousel.min.js',
			array( 'jquery' ),
			'2.3.4',
			true
		);

		// VenoBox - Just another responsive jQuery lightbox plugin.
		wp_enqueue_script(
			'venobox-js',
			INSPIRY_COMMON_URI . 'js/venobox/venobox.min.js',
			array( 'jquery' ),
			'1.8.5',
			true
		);

		// Common Custom.
		wp_enqueue_script(
			'common-custom',
			INSPIRY_COMMON_URI . 'js/common-custom.js',
			array( 'jquery' ),
			INSPIRY_THEME_VERSION,
			true
		);
	}
}


/**
 * Register modern custom font.
 */
function modern_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Rubik, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$rubik = _x( 'on', 'Rubik font: on or off', 'framework' );

	if ( 'off' !== $rubik ) {
		$font_families = array();

		$font_families[] = 'Rubik:400,400i,500,500i,700,700i';

		$query_args = array(
			'family' => rawurlencode( implode( '|', $font_families ) ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}


