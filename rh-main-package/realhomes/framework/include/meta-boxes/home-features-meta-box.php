<?php
if ( ! function_exists( 'rh_home_features_meta_boxes' ) ) :
	/**
	 * Contains home features' meta box declaration
	 *
	 * @param $meta_boxes
	 *
	 * @return array
	 */
	function rh_home_features_meta_boxes( $meta_boxes ) {

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {

			$meta_boxes[] = array(
				'id'         => 'inspiry-home-meta-box',
				'title'      => esc_html__( 'Home Page Settings', 'framework' ),
				'post_types' => array( 'page' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'show'       => array(
					'template' => array(
						'templates/home.php',
					),
				),
				'tabs'       => array(
					'inspiry_features_tab' => array(
						'label' => esc_html__( 'Features', 'framework' ),
						'icon'  => 'dashicons-admin-users',
					),
				),
				'tab_style'  => 'left',
				'fields'     => array(
					array(
						'id'      => 'inspiry_features',
						'type'    => 'group',
						'columns' => 12,
						'clone'   => true,
						'tab'     => 'inspiry_features_tab',
						'fields'  => array(
							array(
								'name'    => esc_html__( 'Feature Name', 'framework' ),
								'id'      => 'inspiry_feature_name',
								'desc'    => esc_html__( 'Example: Perfect Backend', 'framework' ),
								'type'    => 'text',
								'columns' => 6,
							),
							array(
								'name'    => esc_html__( 'Feature URL', 'framework' ),
								'id'      => 'inspiry_feature_link',
								'desc'    => esc_html__( 'Example: https://themeforest.net/user/inspirythemes/portfolio', 'framework' ),
								'type'    => 'text',
								'columns' => 6,
							),
							array(
								'name'             => esc_html__( 'Feature Icon', 'framework' ),
								'id'               => 'inspiry_feature_icon',
								'desc'             => esc_html__( 'Icon should have minimum width of 150px and minimum height of 150px.', 'framework' ),
								'type'             => 'image_advanced',
								'max_file_uploads' => 1,
								'columns'          => 6,
							),
							array(
								'name'    => esc_html__( 'Feature Description', 'framework' ),
								'id'      => 'inspiry_feature_desc',
								'type'    => 'textarea',
								'rows'    => 7,
								'cols'    => 60,
								'columns' => 6,
							),
						),
					),
				),
			);

		}

		return $meta_boxes;

	}

	add_filter( 'rwmb_meta_boxes', 'rh_home_features_meta_boxes' );

endif;