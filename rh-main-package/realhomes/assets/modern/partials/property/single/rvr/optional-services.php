<?php
/**
 * Property optional services of single property.
 *
 * @package    realhomes
 * @subpackage modern
 */

global $post;

/* Property Optional Services */
$services_inc     = get_post_meta( get_the_ID(), 'rvr_services_inc', true );
$services_not_inc = get_post_meta( get_the_ID(), 'rvr_services_not_inc', true );
if ( ! empty( $services_inc ) || ! empty( $services_not_inc ) ) {
	?>
    <div class="rh_property__features_wrap">
        <h4 class="rh_property__heading"><?php esc_html_e( 'Optional Services', 'framework' ); ?></h4>
		<?php
		if ( ! empty( $services_inc ) ) {
			?>
            <h5><?php esc_html_e( 'Included', 'framework' ); ?></h5>
            <ul class="rh_property__features arrow-bullet-list no-link-list">
				<?php
				foreach ( $services_inc as $service_inc ) {
					echo '<li class="rh_property__feature">' . esc_html( $service_inc ) . '</li>';
				}
				?>
            </ul>
			<?php
		}

		if ( ! empty( $services_not_inc ) ) {
			?>
            <h5><?php esc_html_e( 'Not Included', 'framework' ); ?></h5>
            <ul class="rh_property__features arrow-bullet-list no-link-list icon-cross">
				<?php
				foreach ( $services_not_inc as $service_not_inc ) {
					echo '<li class="rh_property__feature">' . esc_html( $service_not_inc ) . '</li>';
				}
				?>
            </ul>
			<?php
		}
		?>
    </div>
	<?php
}