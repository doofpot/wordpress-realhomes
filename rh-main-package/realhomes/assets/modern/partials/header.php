<?php
/**
 * Header Template
 *
 * @package    realhomes
 * @subpackage modern
 */
?>

<?php
$get_sticky_header_option = get_option( 'theme_sticky_header', 'false' );

if ( $get_sticky_header_option == 'true' && isset( $get_sticky_header_option ) ) {
	?>
    <div class="rh_mod_sticky_header">
		<?php get_template_part( 'assets/modern/partials/header/sticky-header' ); ?>
    </div>

	<?php
}
?>


    <div id="rh_progress"></div>

    <div class="rh_responsive_header_temp">
		<?php
		get_template_part( 'assets/modern/partials/header-responsive' );

		?>
    </div>
    <div class="rh_long_screen_header_temp">

		<?php
		$get_header_variations = get_option( 'inspiry_header_mod_variation_option', 'one' );

		switch ( $get_header_variations ) {
			case 'one':
				get_template_part( 'assets/modern/partials/header/header-var1' );
				break;
			case 'two':
				get_template_part( 'assets/modern/partials/header/header-var2' );
				break;
			case 'three':
				get_template_part( 'assets/modern/partials/header/header-var3' );
				break;

		}
		?>
    </div>

