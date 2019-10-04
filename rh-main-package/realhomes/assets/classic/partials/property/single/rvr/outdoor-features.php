<?php

/* Outdoor Features */
$outdoor_features = get_post_meta( get_the_ID(), 'rvr_features', true );
if ( ! empty( $outdoor_features ) ) {
	?>
    <div class="features nolink-list">
        <h4 class="title"><?php esc_html_e( 'Outdoor Features', 'framework' ); ?></h4>
        <ul class="arrow-bullet-list clearfix">
			<?php
			foreach ( $outdoor_features as $outdoor_feature ) {
				echo '<li>' . esc_html( $outdoor_feature ) . '</li>';
			}
			?>
        </ul>
    </div>
	<?php
}