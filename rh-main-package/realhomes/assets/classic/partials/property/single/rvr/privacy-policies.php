<?php

/* Privacy Policies */
$privacy_policies = get_post_meta( get_the_ID(), 'rvr_policies', true );
if ( ! empty( $privacy_policies ) ) {
	?>
    <div class="rvr-privacy-policies">
        <h4 class="additional-title"><?php esc_html_e( 'Privacy Policies', 'framework' ); ?></h4>
        <ul class="additional-details clearfix">
			<?php
			foreach ( $privacy_policies as $privacy_policy ) {
				echo '<li>' . esc_html( $privacy_policy ) . '</li>';
			}
			?>
        </ul>
    </div>
	<?php
}