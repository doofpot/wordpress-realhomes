<?php
if ( function_exists( 'ere_social_networks' ) ) {

	$args = array(
		'container'       => 'div',
		'container_class' => 'rh_footer__social',
		'replace_icons'   => array(
			'facebook' => 'fa-facebook-official',
			'linkedin' => 'fa-linkedin-square',
			'youtube'  => 'fa-youtube-play',
		),
	);

	ere_social_networks( $args );
}