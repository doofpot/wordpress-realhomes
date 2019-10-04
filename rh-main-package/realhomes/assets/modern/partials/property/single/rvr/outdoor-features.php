<?php
/**
 * Property outdoor features of single property.
 *
 * @package    realhomes
 * @subpackage modern
 */

global $post;

/* Property Outdoor Features */
$outdoor_features = get_post_meta( get_the_ID(), 'rvr_features', true );
if ( ! empty( $outdoor_features ) ) {
	?>
    <div class="rh_property__features_wrap">
        <h4 class="rh_property__heading"><?php esc_html_e( 'Outdoor Features', 'framework' ); ?></h4>
        <ul class="rh_property__features arrow-bullet-list no-link-list">
			<?php
			foreach ( $outdoor_features as $outdoor_feature ) {
				echo '<li class="rh_property__feature">' . esc_html( $outdoor_feature ) . '</li>';
			}
			?>
        </ul>
    </div>
	<?php
}