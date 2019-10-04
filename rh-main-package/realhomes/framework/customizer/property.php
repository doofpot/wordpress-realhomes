<?php
/**
 * Property Customizer
 */
if ( ! function_exists( 'inspiry_property_customizer' ) ) :
	function inspiry_property_customizer( WP_Customize_Manager $wp_customize ) {
		/**
		 * Property Panel
		 */
		$wp_customize->add_panel( 'inspiry_property_panel', array(
			'title'    => esc_html__( 'Property Detail Page', 'framework' ),
			'priority' => 126,
		) );
	}

	add_action( 'customize_register', 'inspiry_property_customizer' );
endif;

/**
 * Sections Manager
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/sections-manager.php' );


/**
 * Breadcrumbs
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/breadcrumbs.php' );


/**
 * Basics
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/basics.php' );


/**
 * Common Note
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/common-note.php' );

/**
 * Property Floor Plan
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/floor-plan.php' );

/**
 * Property Video
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/video.php' );

/**
 * Property Virtual Tour
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/virtual-tour.php' );


/**
 * Property Map
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/map.php' );


/**
 * Attachments
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/attachments.php' );


/**
 * Agent
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/agent.php' );
/**
 * Energy Performance
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/energy-performance.php' );

/**
 * Availability Calendar
 */
if ( inspiry_is_rvr_enabled() ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/availability-calendar.php' );
}

/**
 * Similar Properties
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/similar-properties.php' );