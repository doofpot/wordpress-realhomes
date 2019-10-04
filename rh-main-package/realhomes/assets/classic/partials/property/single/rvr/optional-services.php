<?php

/* Optional Services */
$services_inc     = get_post_meta( get_the_ID(), 'rvr_services_inc', true );
$services_not_inc = get_post_meta( get_the_ID(), 'rvr_services_not_inc', true );
if ( ! empty( $services_inc ) || ! empty( $services_not_inc ) ) {
	?>
    <div class="features nolink-list rvr-inc-exc">
        <h4 class="title"><?php esc_html_e( 'Optional Services', 'framework' ); ?></h4>
		<?php

		if ( ! empty( $services_inc ) ) {
			?>
            <h5><?php esc_html_e( 'Included', 'framework' ); ?></h5>
            <ul class="arrow-bullet-list clearfix">
				<?php
				foreach ( $services_inc as $service_inc ) {
					echo '<li>' . esc_html( $service_inc ) . '</li>';
				}
				?>
            </ul>
			<?php
		}

		if ( ! empty( $services_not_inc ) ) {
			?>
            <h5><?php esc_html_e( 'Not Included', 'framework' ); ?></h5>
            <ul class="arrow-bullet-list clearfix">
				<?php
				foreach ( $services_not_inc as $service_not_inc ) {
					echo '<li>' . esc_html( $service_not_inc ) . '</li>';
				}
				?>
            </ul>
			<?php
		}
		?>
    </div>
	<?php
}