<?php
/**
 * Functions related to demo import
 */

if ( ! function_exists( 'inspiry_demo_import_files' ) ) {

	/**
	 * Files for importing demo.
	 *
	 * @return array
	 * @since  3.0.0
	 */
	function inspiry_demo_import_files() {
		return array(
			array(
				'import_file_name'             => 'Modern - Elementor Based Homepage',
				'local_import_file'            => trailingslashit( get_template_directory() )  . 'framework/demos/elementor-modern/contents.xml',
				'local_import_widget_file'     => trailingslashit( get_template_directory() )  . 'framework/demos/elementor-modern/widgets.wie',
				'local_import_customizer_file' => trailingslashit( get_template_directory() )  . 'framework/demos/elementor-modern/customizer.dat',
				'import_preview_image_url'     => get_template_directory_uri() . '/framework/demos/elementor-modern/demo.jpg',
				'preview_url'                  => 'http://elementor-modern-min.realhomes.io/',
			),
			array(
				'import_file_name'             => 'Classic - Elementor Based Homepage',
				'local_import_file'            => trailingslashit( get_template_directory() )  . 'framework/demos/elementor-classic/contents.xml',
				'local_import_widget_file'     => trailingslashit( get_template_directory() )  . 'framework/demos/elementor-classic/widgets.wie',
				'local_import_customizer_file' => trailingslashit( get_template_directory() )  . 'framework/demos/elementor-classic/customizer.dat',
				'import_preview_image_url'     => get_template_directory_uri() . '/framework/demos/elementor-classic/demo.jpg',
				'preview_url'                  => 'http://elementor-classic-min.realhomes.io/',
			),
			array(
				'import_file_name'             => 'Modern',
				'local_import_file'            => trailingslashit( get_template_directory() )  . 'framework/demos/modern/contents.xml',
				'local_import_widget_file'     => trailingslashit( get_template_directory() )  . 'framework/demos/modern/widgets.wie',
				'local_import_customizer_file' => trailingslashit( get_template_directory() )  . 'framework/demos/modern/customizer.dat',
				'import_preview_image_url'     => get_template_directory_uri() . '/framework/demos/modern/demo.jpg',
				'preview_url'                  => 'http://modern.realhomes.io/',
			),
			array(
				'import_file_name'             => 'Classic',
				'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demos/classic/contents.xml',
				'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demos/classic/widgets.wie',
				'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demos/classic/customizer.dat',
				'import_preview_image_url'     => get_template_directory_uri() . '/framework/demos/classic/demo.jpg',
				'preview_url'                  => 'http://classic.realhomes.io/',
			),
		);
	}
	add_filter( 'pt-ocdi/import_files', 'inspiry_demo_import_files' );
}


if ( ! function_exists( 'inspiry_settings_after_content_import' ) ) {
	/**
	 * Required settings after demo import.
	 */
	function inspiry_settings_after_content_import( $selected_import ) {

		// Update design setting
		if ( 'Classic' == $selected_import[ 'import_file_name' ] || 'Classic - Elementor Based Homepage' == $selected_import[ 'import_file_name' ] ) {
			update_option( 'inspiry_design_variation', 'classic' );
		} elseif ( 'Modern' == $selected_import[ 'import_file_name' ] || 'Modern - Elementor Based Homepage' == $selected_import[ 'import_file_name' ] ) {
			update_option( 'inspiry_design_variation', 'modern' );
		}

		// Assign menu to right location
		$locations = get_theme_mod( 'nav_menu_locations' );
		if ( ! empty( $locations ) and is_array( $locations ) ) {
			foreach ( $locations as $locationId => $menuValue ) {
				$menu = null;
				switch ( $locationId ) {
					case 'main-menu':
						$menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
						break;

					case 'responsive-menu':
						$menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
						break;
				}
				if ( !empty( $menu ) ) {
					$locations[ $locationId ] = $menu->term_id;
				}
			}
			set_theme_mod( 'nav_menu_locations', $locations );
		}

		// Set homepage as front page and blog page as posts page
		$home_page = get_page_by_title( 'Home' );

		$blog_page = get_page_by_title( 'News' );
		if ( $home_page || $blog_page ) {
			update_option( 'show_on_front', 'page' );
		}

		if ( $home_page ) {
			update_option( 'page_on_front', $home_page->ID );
		}

		if ( $blog_page ) {
			update_option( 'page_for_posts', $blog_page->ID );
			update_option( 'posts_per_page', 4 );
		}
	}

	add_action( 'pt-ocdi/after_import', 'inspiry_settings_after_content_import' );

}


// Disable branding notice at the end of import.
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
