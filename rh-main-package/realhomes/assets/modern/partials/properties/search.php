<?php
/**
 * Template: Property Search
 *
 * Property search template.
 *
 * @package    realhomes
 * @subpackage modern
 */

get_header();

// Page Head.
$header_variation = get_option( 'inspiry_search_header_variation' );

if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/header' );
} elseif ( ! empty( $header_variation ) && ( 'banner' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/image' );
}

if ( inspiry_show_header_search_form() ) {
	get_template_part( 'assets/modern/partials/properties/search/advance' );
}

$number_of_properties = intval( get_option( 'theme_properties_on_search' ) );
if ( ! $number_of_properties ) {
	$number_of_properties = 6;
}

global $paged;
if ( is_front_page() ) {
	$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
}

$search_args = array(
	'post_type'      => 'property',
	'posts_per_page' => $number_of_properties,
	'paged'          => $paged,
);

/* Apply Search Filter */
$search_args = apply_filters( 'real_homes_search_parameters', $search_args );

/* Sort Properties */
$search_args = sort_properties( $search_args );

$search_query = new WP_Query( $search_args ); ?>

<?php $rh_section_class = inspiry_is_search_page_map_visible() ? '' : 'rh_wrap--padding rh_wrap--topPadding'; ?>
<section class="rh_section rh_section--flex <?php echo esc_attr( $rh_section_class ); echo ( inspiry_show_search_form_widget() ) ? '' : ' rh_section__map_listing'; ?>">

	<?php if ( inspiry_is_search_page_map_visible() ) : ?>
		<div class="rh_page rh_page__listing_map">
			<?php get_template_part( 'assets/modern/partials/properties/map' ); ?>
		</div><!-- /.rh_page rh_page__listing_map -->
	<?php endif; ?>

	<?php $rh_page_class = inspiry_is_search_page_map_visible() ? 'rh_page__map_properties' : 'rh_page__listing_page rh_page__listing_page-no-map'; ?>
	<div class="rh_page <?php echo esc_attr( $rh_page_class ); ?>">

        <?php
        $get_content_position = get_post_meta( get_the_ID(), 'REAL_HOMES_content_area_above_footer',true );

        if(  $get_content_position !== '1'){

	        if ( have_posts() ) {
		        while ( have_posts() ) {
			        the_post();
			        ?>
                    <div class="rh_content <?php if(get_the_content()){ echo esc_attr('rh_page__content');} ?>">
				        <?php the_content(); ?>
                    </div>
                    <!-- /.rh_content -->
			        <?php

		        }
	        }
        }
        ?>

		<div class="rh_page__head">

			<h2 class="rh_page__title">
				<?php
					$found_properties = $search_query->found_posts;
					$zero_in_format   = ( 0 == $found_properties ) ? 1 : 2;
					$found_properties = sprintf( '%0' . $zero_in_format . 'd', $found_properties );
				?>
				<span class="sub"><?php echo esc_html( $found_properties ); ?></span>
				<span class="title">
					<?php
						if ( 1 < $search_query->found_posts ) {
							esc_html_e( 'Results', 'framework' );
						} else {
							esc_html_e( 'Result', 'framework' );
						}
					?>
	            </span>
			</h2>
			<!-- /.rh_page__title -->

			<div class="rh_page__controls">
				<?php get_template_part( 'assets/modern/partials/properties/sort-controls' ); ?>
			</div>
			<!-- /.rh_page__controls -->

		</div>
		<!-- /.rh_page__head -->

		<?php $rh_page_listing_class = inspiry_is_search_page_map_visible() ? '' : ' rh_page__listing_grid rh_page__listing_grid-three-column'; ?>
		<div class="rh_page__listing<?php echo esc_attr( $rh_page_listing_class ); ?>">

			<?php
				if ( $search_query->have_posts() ) :
					while ( $search_query->have_posts() ) :
						$search_query->the_post();

						 if ( inspiry_is_search_page_map_visible() ){
							 // Display property in list layout.
							 get_template_part( 'assets/modern/partials/properties/half-map-card' );
						 }else{
							 // Display property for grid layout.
							 get_template_part( 'assets/modern/partials/properties/grid-card' );
						 }

					endwhile;
					wp_reset_postdata();
				else :
					?>
					<div class="rh_alert-wrapper">
						<h4 class="no-results"><?php esc_html_e( 'Sorry No Results Found', 'framework' ); ?></h4>
					</div>
					<?php
				endif;
			?>
		</div>
		<!-- /.rh_page__listing -->

		<?php inspiry_theme_pagination( $search_query->max_num_pages ); ?>

	</div>
	<!-- /.rh_page rh_page__map_properties -->

</section>

<?php
if ('1' === $get_content_position ) {

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
            <div class="rh_content <?php if ( get_the_content() ) {echo esc_attr( 'rh_page__content' );} ?>">
				<?php the_content(); ?>
            </div>
            <!-- /.rh_content -->
			<?php

		}
	}
}
?>
<!-- /.rh_section rh_wrap rh_wrap--padding -->

<?php
get_footer();
