<?php
/**
 * Homepage Template
 *
 * @package realhomes
 * @subpackage modern
 */

get_header();

/* Theme Home Page Module */
$theme_homepage_module = get_option( 'theme_homepage_module' );

switch ( $theme_homepage_module ) {
	case 'properties-slider':
		get_template_part( 'assets/modern/partials/home/slider/property' );
		break;

	case 'properties-map':
		get_template_part( 'assets/modern/partials/home/slider/map' );
		break;

	case 'slides-slider':
		get_template_part( 'assets/modern/partials/home/slider/slides' );
		break;

	case 'revolution-slider':
		$rev_slider_alias = trim( get_option( 'theme_rev_alias' ) );
		if ( function_exists( 'putRevSlider' ) && ( ! empty( $rev_slider_alias ) ) ) {
			putRevSlider( $rev_slider_alias );
		} else {
			get_template_part( 'assets/modern/partials/banner/header' );
		}
		break;

	case 'simple-banner':
		get_template_part( 'assets/modern/partials/banner/image' );
		break;

	default:
		get_template_part( 'assets/modern/partials/banner/header' );
		break;
}
//home-properties,featured-properties,testimonials,cta,agents,features,partners,cta-contact

// Show sections options.
$inspiry_show_home_search = get_option( 'theme_show_home_search' );            // Advance Search.


if ( is_active_sidebar( 'home-search-area' ) ) : ?>
    <div class="rh_prop_search rh_wrap--padding">
		<?php dynamic_sidebar( 'home-search-area' ); ?>
    </div>
    <!-- /.rh_prop_search -->
<?php
elseif ( ! empty( $inspiry_show_home_search ) && 'true' === $inspiry_show_home_search ) :
	get_template_part( 'assets/modern/partials/properties/search/advance' );
endif;


$sections                        = array();
$sections['content']             = get_option( 'theme_show_home_contents', 'true' ); // Home Contents.
$sections['latest-properties']   = get_option( 'theme_show_home_properties', 'true' ); // Home properties.
$sections['featured-properties'] = get_option( 'theme_show_featured_properties' );    // Featured Properties.
$sections['testimonial']         = get_option( 'inspiry_show_testimonial' );            // Testimonial.
$sections['cta']                 = get_option( 'inspiry_show_cta' );                    // Call to Action.
$sections['agents']              = get_option( 'inspiry_show_agents' );                // Agents.
$sections['features']            = get_option( 'inspiry_show_home_features' );        // Features.
$sections['partners']            = get_option( 'inspiry_show_home_partners' );        // Partners.
$sections['news']                = get_option( 'inspiry_show_home_news_modern', 'true' );     // News.
$sections['cta-contact']         = get_option( 'inspiry_show_home_cta_contact' );     // CTA Contact.


/**
 * Get the order in which sections are to be displayed
 */

$section_ordering = get_theme_mod( 'inspiry_home_sections_order_default', 'default' );


if ( ! empty( $section_ordering ) && $section_ordering == 'default' ) {
	$home_sections = 'content,latest-properties,featured-properties,testimonial,cta,agents,features,partners,news,cta-contact';
	$home_sections = explode( ',', $home_sections );
} else {
	$home_sections = get_option( 'inspiry_home_sections_order_mod' );
	$home_sections = ( ! empty( $home_sections ) ) ? $home_sections : 'content,latest-properties,featured-properties,testimonial,cta,agents,features,partners,news,cta-contact';
	$home_sections = explode( ',', $home_sections );
}
/**
 * Display sections according to their order
 */
if ( ! empty( $home_sections ) && is_array( $home_sections ) ) {

	$get_border_type = get_option( 'inspiry_home_sections_border', 'diagonal-border' );

	if ( is_rtl() && $get_border_type == 'diagonal-border' ) {
		$border_class = 'diagonal-mod-wrapper diagonal-rtl';
	} elseif ( $get_border_type == 'diagonal-border' ) {
		$border_class = 'diagonal-mod-wrapper';
	} else {
		$border_class = '';
	}


	?>
    <div class="wrapper-home-sections <?php echo esc_attr( $border_class ); ?>">
		<?php
//				get_template_part( 'assets/modern/partials/home/section/content' );

		foreach ( $home_sections as $home_section ) {
			if ( isset($sections[ $home_section ]) && 'true' === $sections[ $home_section ]) {
				get_template_part( 'assets/modern/partials/home/section/' . $home_section );
			}
		}
		?>
    </div>
	<?php
}

get_footer();
