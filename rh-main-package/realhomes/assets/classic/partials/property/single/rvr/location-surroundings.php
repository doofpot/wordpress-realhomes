<?php

/* Location Surroundings */
$location_surroundings = get_post_meta( get_the_ID(), 'rvr_surrounding', true );
if ( ! empty( $location_surroundings ) ) {
	?>
    <div class="rvr-location-surrounding">
        <h4 class="additional-title"><?php esc_html_e( 'Location Surroundings', 'framework' ); ?></h4>
        <ul class="additional-details clearfix">
			<?php
			foreach ( $location_surroundings as $surrounding ) {
				echo '<li><h6>' . $surrounding['location'] . '</h6></li>';

				echo '<ul class="additional-details clearfix">';
				foreach ( $surrounding['distance'] as $location ) {
					echo '<li>' . esc_html( $location ) . '</li>';
				}
				echo '</ul>';
			}
			?>
        </ul>
    </div>
	<?php
}