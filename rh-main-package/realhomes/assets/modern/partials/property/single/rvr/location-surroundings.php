<?php
/**
 * Property location surroundings of single property.
 *
 * @package    realhomes
 * @subpackage modern
 */

global $post;

/* Property Location Surroundings */
$location_surroundings = get_post_meta( get_the_ID(), 'rvr_surrounding', true );
if ( ! empty( $location_surroundings ) ) {
	?>
    <div class="rh_property__features_wrap">
        <h4 class="rh_property__heading"><?php esc_html_e( 'Location Surroundings', 'framework' ); ?></h4>
		<?php
		foreach ( $location_surroundings as $surrounding ) {
			echo '<h5>' . $surrounding['location'] . '</h5>';

			echo '<ul class="rh_property__features arrow-bullet-list no-link-list">';
			foreach ( $surrounding['distance'] as $location ) {
				echo '<li class="rh_property__feature">' . esc_html( $location ) . '</li>';
			}
			echo '</ul>';
		}
		?>
    </div>
	<?php
}