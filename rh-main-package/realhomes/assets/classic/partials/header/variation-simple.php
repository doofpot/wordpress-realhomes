<?php
/**
 * Header Variation: Simple
 *
 * @package    realhomes
 * @subpackage classic
 */

?>

<header id="header" class="clearfix">

	<div id="header-top" class="clearfix">
		<?php
		// Header email.
		$header_email = get_option( 'theme_header_email' );
		if ( ! empty( $header_email ) ) {
			?>
			<div id="contact-email">
				<?php include INSPIRY_THEME_DIR . '/images/icon-mail.svg';

				$email_label = get_option( 'inspiry_header_email_label', esc_html__( 'Email us at', 'framework' ) );
				echo esc_html( $email_label );

				?> :
				<a href="mailto:<?php echo esc_attr( antispambot( $header_email ) ); ?>"><?php echo esc_html( antispambot( $header_email ) ); ?></a>
			</div>
			<?php

		}
		?>

		<!-- Social Navigation -->
		<?php get_template_part( 'assets/classic/partials/header/social-nav' ); ?>

		<!-- User Navigation -->
		<?php get_template_part( 'assets/classic/partials/header/user-nav' ); ?>

	</div>

	<!-- Logo -->
	<div id="logo">
        <?php get_template_part( 'assets/classic/partials/header/logo' ); ?>
	</div>


	<div class="menu-and-contact-wrap">
		<?php get_template_part( 'assets/classic/partials/header/phone-number' ); ?>

		<!-- Start Main Menu-->
		<nav class="main-menu">
			<div class="rh_menu__hamburger hamburger hamburger--squeeze">
				<div class="hamburger-box">
					<div class="hamburger-inner"></div>
				</div>
				<p><?php esc_html_e( 'Menu', 'framework' ); ?></p>
			</div>
			<?php
			if ( has_nav_menu( 'main-menu' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'main-menu',
					'walker'         => new RH_Walker_Nav_Menu(),
					'menu_class'     => 'rh_menu__main_menu clearfix',
					'fallback_cb'    => false // Do not fall back to wp_page_menu()
				) );
			}
			if ( has_nav_menu( 'responsive-menu' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'responsive-menu',
					'walker'         => new RH_Walker_Nav_Menu(),
					'menu_class'     => 'rh_menu__responsive clearfix',
					'fallback_cb'    => false // Do not fall back to wp_page_menu()
				) );
			} else {
				// Assign main menu as fallback.
				$locations = get_theme_mod( 'nav_menu_locations' );
				$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
				if ( ! empty( $main_menu ) ) {
					$locations['responsive-menu'] = $main_menu->term_id;
					set_theme_mod( 'nav_menu_locations', $locations );

					if ( has_nav_menu( 'responsive-menu' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'responsive-menu',
							'walker'         => new RH_Walker_Nav_Menu(),
							'menu_class'     => 'rh_menu__responsive clearfix',
							'fallback_cb'    => false // Do not fall back to wp_page_menu()
						) );
					}
				}
			}
			?>
		</nav>
		<!-- End Main Menu -->
	</div>

</header>
