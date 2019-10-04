<?php
global $post;

$property_children_args = array(
	'post_type'      => 'property',
	'posts_per_page' => - 1,
	'post_parent'    => get_the_ID(),
);

$child_properties_query = new WP_Query( $property_children_args );
if ( $child_properties_query->have_posts() ) : ?>
    <div class="children-content-wrapper single-property-section">
        <div class="container">
            <div class="rh_property__child_properties">
				<?php
				$child_properties_title = get_option( 'theme_child_properties_title' );
				if ( ! empty( $child_properties_title ) ) {
					?><h4 class="rh_property__heading"><?php echo esc_html( $child_properties_title ); ?></h4><?php
				} ?>

                <div id="rh_property__child_slider" class="rh_property__child_slider clearfix">
                    <div class="flexslider">
                        <ul class="slides">
							<?php while ( $child_properties_query->have_posts() ) : ?>
								<?php $child_properties_query->the_post(); ?>
								<?php get_template_part( 'assets/modern/partials/property/single-fullwidth/child' ); ?>
							<?php endwhile; ?>
                        </ul><!-- /.slides -->
                    </div><!-- /.flexslider loading -->
                </div><!-- /.rh_section__properties -->
				<?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>