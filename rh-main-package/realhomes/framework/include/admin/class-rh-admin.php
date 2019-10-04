<?php
/**
 * RealHomes Admin Class.
 *
 * @author  InspiryThemes
 * @package RH
 * @since   3.8.4
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * RealHomes Admin Class.
 */
class RH_Admin {

	private $tabs_path = INSPIRY_FRAMEWORK . 'include/admin/tabs/';

	protected $tgmpa;

	public static $_instance;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {

	    // Admin menu.
		add_action( 'admin_menu', array( $this, 'real_homes_menu' ) );
		add_action( 'admin_menu', array( $this, 're_arrange_menu' ) );

		// Current menu when clicked on a tab.
		add_action( 'admin_footer', array( $this, 'open_menu' ) );

		// Add demo import page to Real Homes Menu.
		if ( class_exists( 'OCDI_Plugin' ) ) {
			add_filter( 'pt-ocdi/plugin_page_setup', array( $this, 'move_import_demo_data' ), 10, 1 );
		}

		// Enqueue admin styles.
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ), 10, 1 );

		// Enqueue admin scripts.
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ), 10, 1 );

        // Stops Elementor redirection after activation.
		add_action( 'admin_init', function() {
			if ( did_action( 'elementor/loaded' ) ) {
				remove_action( 'admin_init', [ \Elementor\Plugin::$instance->admin, 'maybe_redirect_to_getting_started' ] );
			}
		}, 1 );

		// TGMPA.
		if ( file_exists( INSPIRY_FRAMEWORK . '/include/tgm/class-tgm-plugin-activation.php' ) && inspiry_is_realhomes_registered() ) {
			require_once INSPIRY_FRAMEWORK . '/include/tgm/class-tgm-plugin-activation.php';
		    add_filter( 'tgmpa_load', array( $this, 'inspiry_load_tgmpa' ), 10, 1 );
			add_action( 'tgmpa_register', array( $this, 'inspiry_plugins_tgmpa_register' ) );
			$this->tgmpa = isset( $GLOBALS['tgmpa'] ) ? $GLOBALS['tgmpa'] : TGM_Plugin_Activation::get_instance();
        }

		add_action( 'wp_ajax_inspiry_activate_deactivate_plugin', array( $this, 'inspiry_activate_deactivate_plugin' ) );
        add_action( 'wp_ajax_inspiry_send_feedback', array( $this, 'inspiry_send_feedback') );
	}

	public function real_homes_menu() {

		add_menu_page(
			esc_html__( 'Real Homes', 'framework' ),
			esc_html__( 'Real Homes', 'framework' ),
			'manage_options',
			'real_homes',
			'',
			get_template_directory_uri() . '/framework/include/admin/images/rh-menu-icon.svg',
			'7'
		);

		// Add all sub menus.
		$sub_menus = [];

		$sub_menus = $this->tabs_menu( $sub_menus );

		// Filter $_SERVER array.
		$server_array          = filter_input_array( INPUT_SERVER );

		$customize_settings_slug = 'customize.php';
		if ( isset( $server_array['REQUEST_URI'] ) ) {
            $customize_settings_slug = add_query_arg( 'return', rawurlencode( remove_query_arg( wp_removable_query_args(), wp_unslash( $server_array['REQUEST_URI'] ) ) ), 'customize.php' );
        }

		$sub_menus['settings'] = array(
			'real_homes',
			esc_html__( 'Customize Settings', 'framework' ),
			esc_html__( 'Customize Settings', 'framework' ),
			'manage_options',
            $customize_settings_slug
		);

		// Add demo page if one click demo import plugin exists.
		if ( class_exists( 'OCDI_Plugin' ) && inspiry_is_realhomes_registered() ) {
			$sub_menus['demoimport'] = array(
				'real_homes',
				esc_html__( 'Demo Import', 'framework' ),
				esc_html__( 'Demo Import', 'framework' ),
				'manage_options',
				'admin.php?page=pt-one-click-demo-import',
			);
		}

		// Third-party can add more sub_menus.
		$sub_menus = apply_filters( 'real_homes_sub_menus', $sub_menus, 20 );

		if ( $sub_menus ) {
			foreach ( $sub_menus as $sub_menu ) {
				call_user_func_array( 'add_submenu_page', $sub_menu );
			}
		}
	}

	public function re_arrange_menu() {
		global $submenu;
		unset( $submenu['real_homes'][0] );
	}

	public function open_menu() {
		// Get Current Screen.
		$screen = get_current_screen();

		$menu_list = array(
			'admin_page_pt-one-click-demo-import'
		);

		$menu_arr = apply_filters( 'real_homes_open_menus_slugs', $menu_list );

		// Check if the current screen's ID has any of the above menu array items.
		if ( isset( $screen->id ) && in_array( $screen->id, $menu_arr ) ) {

			// Filter $_GET array for security.
			$get_array    = filter_input_array( INPUT_GET );
			$current_menu = '';

			if ( isset( $get_array['page'] ) && ( 'pt-one-click-demo-import' === $get_array['page'] ) ) {
				$current_menu = 'page=pt-one-click-demo-import';
			}

			if ( isset( $get_array['page'] ) && ( 'rvr-settings' === $get_array['page'] ) ) {
				$current_menu = 'page=rvr-settings';
			}

			if ( ! empty( $current_menu ) ) {
				?>
                <script type="text/javascript">
                    jQuery("body").removeClass("sticky-menu");
                    jQuery("#toplevel_page_real_homes").addClass('wp-has-current-submenu wp-menu-open').removeClass('wp-not-current-submenu');
                    jQuery("#toplevel_page_real_homes > a").addClass('wp-has-current-submenu wp-menu-open').removeClass('wp-not-current-submenu');
                    $(document).ready(function () {
                        if ('<?php echo esc_html( $current_menu ); ?>') {
                            const anchors = $('#toplevel_page_real_homes ul').find('li').children('a');
                            anchors.each(function () {
                                if (this.href.indexOf('<?php echo esc_html( $current_menu ); ?>') >= 0) {
                                    $(this).parent('li').addClass("current");
                                }
                            });
                        }
                    });
                </script>
				<?php
			}
		}
	}

	public function move_import_demo_data( $args ) {

		// Check the args.
		if ( empty( $args ) || ! is_array( $args ) ) {
			return $args;
		}

		$args = array(
			'parent_slug' => 'edit.php?post_type=property',
			'page_title'  => esc_html__( 'One Click Demo Import', 'framework' ),
			'menu_title'  => esc_html__( 'Demo Import', 'framework' ),
			'capability'  => 'import',
			'menu_slug'   => 'pt-one-click-demo-import',
		);

		return $args;
	}

	public function header( $tab = 'design' ) {
		?>
        <div class="wrap">
            <h1 class="screen-reader-text"><?php esc_html_e( 'Real Homes', 'framework' ); ?></h1>
            <div class="inspiry-page-wrap">
                <header class="inspiry-page-header">
                    <h2 class="title">
                        <span class="theme-title"><?php esc_html_e( 'Real Homes', 'framework' ); ?></span>
                        <?php printf( '<span class="theme-current-version">%s</span>', esc_html( INSPIRY_THEME_VERSION ) ); ?>
                    </h2>
                    <p class="credit">
                        <a href="<?php echo esc_url('https://themeforest.net/user/inspirythemes/portfolio?order_by=sales'); ?>" target="_blank"><span class="inspiry-logo"></span><?php esc_html_e( 'Inspiry Themes', 'framework' ); ?></a>
                    </p>
                </header>
                <div class="inspiry-page-description">
                    <p><?php esc_html_e( 'Welcome to Real Homes!', 'framework' ); ?></p>
                </div>
                <?php $this->tabs_nav( $tab ); ?>
		<?php
	}

	public function footer() {
		?>
                <footer class="inspiry-page-footer">
                    <p><?php printf(
                            'Thank you for choosing <a href="%1$s" target="_blank">Real Homes</a> theme by <a href="%2$s" target="_blank">Inspiry Themes</a>.',
                            esc_url('https://themeforest.net/item/real-homes-wordpress-real-estate-theme/5373914'),
		                    esc_url('https://themeforest.net/user/inspirythemes/portfolio?order_by=sales')
                        ); ?></p>
                </footer>
            </div><!-- /.inspiry-page-wrap -->
        </div><!-- /.wrap -->
		<?php
	}

	public function tabs() {
		$tabs = array(
			'design'   => esc_html__( 'Design', 'framework' ),
			'plugins'  => esc_html__( 'Plugins', 'framework' ),
			'feedback' => esc_html__( 'Feedback', 'framework' ),
			'help'     => esc_html__( 'Help', 'framework' ),
		);

		return $tabs;
	}

	public function tabs_nav( $current_tab ) {
		$tabs = $this->tabs();
		?>
        <div id="inspiry-tabs" class="inspiry-tabs">
			<?php
			if ( ! empty( $tabs ) && is_array( $tabs ) ) {
				foreach ( $tabs as $slug => $title ) {
					if ( file_exists( $this->tabs_path . $slug . '.php' ) ) {
						$active_tab = ( $current_tab === $slug ) ? ' inspiry-is-active-tab' : '';
						$admin_url =  ( $current_tab === $slug ) ? '#' : admin_url( 'admin.php?page=realhomes-' . $slug );
						echo '<a class="inspiry-tab ' . esc_attr( $active_tab ) . '" href="' . esc_url_raw( $admin_url ) . '" data-tab="' . esc_attr( $slug ) . '">' . esc_html( $title ) . '</a>';
					}
				}
			}
			?>
        </div>
		<?php
	}

	public function tabs_menu( $sub_menus ) {
		$tabs = $this->tabs();
		if ( ! empty( $tabs ) && is_array( $tabs ) ) {
			foreach ( $tabs as $slug => $title ) {
				if ( file_exists( $this->tabs_path . $slug . '.php' ) ) {
					$sub_menus[$slug] = array( 'real_homes', $title, $title, 'manage_options', 'realhomes-' . $slug, array( $this, $slug . '_tab' ) );
				}
			}
		}
		return $sub_menus;
	}

	public function design_tab() {
		require_once $this->tabs_path . 'design.php';
	}

	public function plugins_tab() {
		require_once $this->tabs_path . 'plugins.php';
	}

	public function feedback_tab() {
		require_once $this->tabs_path . 'feedback.php';
	}

	public function help_tab() {
		require_once $this->tabs_path . 'help.php';
	}

	public function admin_styles() {

		wp_enqueue_style( 'inspiry-admin',
			get_template_directory_uri() . '/framework/include/admin/css/admin.css',
			array(),
			INSPIRY_THEME_VERSION,
			'all'
		);
	}

	public function admin_scripts() {

		wp_enqueue_script(
			'inspiry-admin-js',
			get_template_directory_uri() . '/framework/include/admin/js/admin.js',
			array( 'jquery' ),
			INSPIRY_THEME_VERSION,
			true
		);
	}

	public function inspiry_load_tgmpa( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}

	public function inspiry_plugins_tgmpa_register() {
		tgmpa( $this->inspiry_plugins() );
	}

	public function inspiry_plugins() {
		$inspiry_plugins = array(

			// Easy Real Estate
			array(
				'name'              => 'Easy Real Estate',
				'slug'              => 'easy-real-estate',
				'file_path'         => 'easy-real-estate/easy-real-estate.php',
				'version'           => '0.3.2',
				'source'            => 'https://inspiry-plugins.s3.us-east-2.amazonaws.com/easy-real-estate.zip',
				'required'          => true,
				'author'            => 'Inspiry Themes',
				'author_url'        => 'https://themeforest.net/user/inspirythemes/portfolio?order_by=sales',
				'short_description' => 'Provides real estate functionality for Real Homes theme.',
			),

			// Elementor Page Builder
			array(
				'name'              => 'Elementor Page Builder',
				'slug'              => 'elementor',
				'file_path'         => 'elementor/elementor.php',
				'version'           => '',
				'required'          => true,
				'author'            => 'Elementor.com',
				'author_url'        => 'https://elementor.com/?utm_source=wp-plugins&utm_campaign=author-uri&utm_medium=wp-dash',
				'short_description' => 'The most advanced frontend drag & drop page builder. Create high-end, pixel perfect websites at record speeds. Any theme, any page, any design.',
				'icons'             => 'https://ps.w.org/elementor/assets/icon.svg',
			),

			// RealHomes Elementor Addon
			array(
				'name'              => 'RealHomes Elementor Addon',
				'slug'              => 'realhomes-elementor-addon',
				'file_path'         => 'realhomes-elementor-addon/realhomes-elementor-addon.php',
				'version'           => '0.4.0',
				'source'            => 'https://inspiry-plugins.s3.us-east-2.amazonaws.com/realhomes-elementor-addon.zip',
				'required'          => true,
				'author'            => 'Inspiry Themes',
				'author_url'        => 'https://themeforest.net/user/inspirythemes/portfolio?order_by=sales',
				'short_description' => 'Provides RealHomes based Elementor widgets.',
			),

			// Real Estate CRM
			array(
				'name'              => 'Real Estate CRM',
				'slug'              => 'real-estate-crm',
				'file_path'         => 'real-estate-crm/real-estate-crm.php',
				'version'           => '0.0.3',
				'source'            => 'https://inspiry-plugins.s3.us-east-2.amazonaws.com/real-estate-crm.zip',
				'required'          => false,
				'author'            => 'Inspiry Themes',
				'author_url'        => 'https://themeforest.net/user/inspirythemes/portfolio?order_by=sales',
				'short_description' => 'Provides CRM functionality for Real Homes theme.',
			),

			// Mortgage calculator
			array(
				'name'              => 'Mortgage Calculator',
				'slug'              => 'mortgage-calculator',
				'file_path'         => 'mortgage-calculator/mortgage-calculator.php',
				'version'           => '',
				'required'          => true,
				'author'            => 'Inspiry Themes',
				'author_url'        => 'https://themeforest.net/user/inspirythemes/portfolio?order_by=sales',
				'short_description' => 'It provides an easy to use mortgage calculator widget.',
				'icons'             => 'https://ps.w.org/mortgage-calculator/assets/icon-256x256.png',
			),

			// Quick and Easy FAQs
			array(
				'name'              => 'Quick and Easy FAQs',
				'slug'              => 'quick-and-easy-faqs',
				'file_path'         => 'quick-and-easy-faqs/quick-and-easy-faqs.php',
				'version'           => '',
				'required'          => false,
				'author'            => 'Inspiry Themes',
				'author_url'        => 'https://themeforest.net/user/inspirythemes/portfolio?order_by=sales',
				'short_description' => 'A quick and easy way to add FAQs to your site.',
				'icons'             => 'https://ps.w.org/quick-and-easy-faqs/assets/icon-256x256.png',
			),

			// Quick and Easy Testimonials
			array(
				'name'              => 'Quick and Easy Testimonials',
				'slug'              => 'quick-and-easy-testimonials',
				'file_path'         => 'quick-and-easy-testimonials/quick-and-easy-testimonials.php',
				'version'           => '',
				'required'          => false,
				'author'            => 'Inspiry Themes',
				'author_url'        => 'https://themeforest.net/user/inspirythemes/portfolio?order_by=sales',
				'short_description' => 'This plugin provides a quick and easy way to add testimonials to your site.',
				'icons'             => 'https://ps.w.org/quick-and-easy-testimonials/assets/icon-256x256.png',
			),

			// One Click Demo Import.
			array(
				'name'              => 'One Click Demo Import',
				'slug'              => 'one-click-demo-import',
				'file_path'         => 'one-click-demo-import/one-click-demo-import.php',
				'version'           => '',
				'required'          => false,
				'author'            => 'ProteusThemes',
				'author_url'        => 'http://www.proteusthemes.com',
				'short_description' => 'Import your demo content, widgets and theme settings with one click. Theme authors! Enable simple demo import for your theme demo data.',
				'icons'             => 'https://ps.w.org/one-click-demo-import/assets/icon-256x256.png',
			),
		);

		return $inspiry_plugins;
	}

	public function inspiry_is_active_plugin( $plugin ){
		return in_array( $plugin, (array) get_option( 'active_plugins', array() ) ) || is_plugin_active_for_network( $plugin );
	}

	public function inspiry_activate_deactivate_plugin() {

		if ( isset( $_GET['rh_action'] ) && ( 'rh-activate-plugin' === $_GET['rh_action'] || 'rh-deactivate-plugin' === $_GET['rh_action'] ) ) {

			check_admin_referer( 'rh_plugin_nonce', 'rh_nonce' );

			$result = '';
			$response = array();
			$rh_action = $_GET['rh_action'];
			$rh_plugin = $_GET['rh_plugin'];

			if ( 'rh-activate-plugin' === $rh_action ) {
				$result = activate_plugin( $rh_plugin );
			}

			if ( 'rh-deactivate-plugin' === $rh_action ) {
				deactivate_plugins( $rh_plugin );
			}

			if ( is_wp_error( $result ) ) {
				$response['message'] = $result->get_error_message();
				$response['error']   = true;
			} else {
				$response['error'] = false;
			}

			echo json_encode( $response );

			wp_die();
		}
	}

	protected function inspiry_get_plugin_action_links( $plugin ) {

		if ( current_user_can( 'install_plugins' ) || current_user_can( 'update_plugins' ) ) {
			$installed_plugins = get_plugins();
			$tgm_plugin_menu   = $this->tgmpa->menu;
			$plugin_version    = $plugin['version'];
			$plugin_exist      = false;
			$plugin_file       = $plugin['file_path'];
			$plugin_slug       = $plugin['slug'];
			$actions           = array();

			if ( ! $plugin_version ) {
				$plugin_version = $this->tgmpa->does_plugin_have_update( $plugin_slug );
			}

			$valid = validate_plugin( $plugin_file );
			if ( ! is_wp_error( $valid ) ) {
				$plugin_exist = true;
			}

			if( isset($plugin['download-link']) && ! empty( $plugin['download-link'] && ! $plugin_exist ) ){

                $actions[] = '<a href="' . esc_url( $plugin['download-link'] ) . '" class="button download-link" data-plugin="' . $plugin_file . '">' . esc_attr__( 'Download Now', 'framework' ) . '</a>';

			}elseif ( ! isset( $installed_plugins[ $plugin_file ] ) ) {

                $install_now_arg = add_query_arg(
					array(
						'page'          => rawurlencode( $tgm_plugin_menu ),
						'plugin'        => rawurlencode( $plugin_slug ),
						'tgmpa-install' => 'install-plugin',
						'return_url'    => 'realhomes-plugins',
					),
					$this->tgmpa->get_tgmpa_url()
				);
				$url = wp_nonce_url( $install_now_arg, 'tgmpa-install', 'tgmpa-nonce' );
				$nonce = wp_create_nonce( 'tgmpa-install' );
				$actions[] = '<a href="' . esc_url( $url ) . '" class="button install-now" data-plugin="' . $plugin_file . '" data-page="' . rawurlencode( $tgm_plugin_menu ) . '" data-nonce="' . $nonce . '">' . esc_attr__( 'Install Now', 'framework' ) . '</a>';

			} elseif ( version_compare( $installed_plugins[ $plugin_file ]['Version'], $plugin_version, '<' ) ) {

			    $update_now_arg = add_query_arg(
					array(
						'page'         => rawurlencode( $tgm_plugin_menu ),
						'plugin'       => rawurlencode( $plugin_slug ),
						'tgmpa-update' => 'update-plugin',
						'version'      => rawurlencode( $plugin_version ),
						'return_url'   => 'realhomes-plugins',
					),
					$this->tgmpa->get_tgmpa_url()
				);
			    $url = wp_nonce_url( $update_now_arg, 'tgmpa-update', 'tgmpa-nonce' );
				$nonce = wp_create_nonce( 'tgmpa-update' );
				$actions[] = '<a href="' . esc_url( $url ) . '" class="button update-now" data-plugin="' . $plugin_file . '" data-page="' . rawurlencode( $tgm_plugin_menu ) . '" data-nonce="' . $nonce . '">' . esc_attr__( 'Update Now', 'framework' ) . '</a>';

			} elseif ( $this->inspiry_is_active_plugin( $plugin_file ) || is_plugin_inactive( $plugin_file ) ) {

			    $nonce = wp_create_nonce( 'rh_plugin_nonce' );
			    if ( is_plugin_inactive( $plugin_file ) ) {
					$actions[] = '<a href="#" class="button activate-now" data-plugin="' . $plugin_file . '" data-nonce="' . $nonce . '">' . esc_attr__( 'Activate', 'framework' ) . '</a>';
				} elseif ( $this->inspiry_is_active_plugin( $plugin_file ) ) {
					$actions[] = '<a href="#" class="button button-primary deactivate-now" data-plugin="' . $plugin_file . '" data-nonce="' . $nonce . '">' . esc_attr__( 'Deactivate', 'framework' ) . '</a>';
				}
			}

			return $actions;
		}
	}

	public function inspiry_send_feedback() {

		if ( isset( $_POST['inspiry_feedback_form_email'] ) ) {

			// Verify Nonce
			if ( !isset( $_POST['inspiry_feedback_form_nonce'] ) || !wp_verify_nonce( $_POST['inspiry_feedback_form_nonce'], 'inspiry_feedback_form_action' ) ) {
				echo json_encode( array(
					'success' => false,
					'message' => esc_html__( 'Unverified Nonce!', 'framework' ),
				) );
				die;
			}

			$to_email     = is_email( 'info@inspirythemes.com' );
			$current_user = wp_get_current_user();
			$site_url     = network_site_url( '/' );
			$website      = get_bloginfo( 'name' );
			$from_name    = $current_user->display_name;
			$feedback     = stripslashes( $_POST['inspiry_feedback_form_textarea'] );
			$from_email   = sanitize_email( $_POST['inspiry_feedback_form_email'] );
			$from_email   = is_email( $from_email );

			if ( !$from_email ) {
				echo json_encode( array(
					'success' => false,
					'message' => esc_html__( 'Provided Email address is invalid!', 'framework' ),
				) );
				die;
			}

			// Email Subject
			$email_subject = esc_html__( 'Feedback received by', 'framework' ) . ' ' . $from_name . ' ' . esc_html__( ' from', 'framework' ) . ' ' . $website;

			// Email Body
			$email_body = esc_html__( "You have received a feedback from: ", 'framework' ) . $from_name . " <br/>";
			if ( !empty( $website ) ) {
				$email_body .= esc_html__( "Website : ", 'framework' ) . '<a href="' . esc_url( $site_url ) . '" target="_blank">' . $website . "</a><br/><br/>";
			}
			$email_body .= esc_html__( "Their feedback is as follows.", 'framework' ) . " <br/>";
			$email_body .= wpautop( $feedback ) . " <br/>";
			$email_body .= esc_html__( "You can contact ", 'framework' ) . $from_name . esc_html__( " via email, ", 'framework' ) . $from_email;

			// Email Headers ( Reply To and Content Type )
			$headers   = array();
			$headers[] = "Reply-To: $from_name <$from_email>";
			$headers[] = "Content-Type: text/html; charset=UTF-8";
			$headers   = apply_filters( "inspiry_feedback_form_mail_header", $headers ); // just in case if you want to modify the header in child theme

			if ( function_exists( 'ere_mail_wrapper' ) ) {
				if ( ere_mail_wrapper( $to_email, $email_subject, $email_body, $headers ) ) {
					echo json_encode( array(
						'success' => true,
						'message' => esc_html__( "Thank you for your feedback!", 'framework' ),
					) );
				} else {
					echo json_encode( array(
						'success' => false,
						'message' => "Server Error: WordPress mail function failed, please try again!",
						// Error messages should not be translated
					) );
				}
			} else {
				echo json_encode( array(
					'success' => false,
					'message' => "Easy Real Estate Plugin Missing!", // Error messages should not be translated
				) );
			}

		} else {
			echo json_encode( array(
					'success' => false,
					'message' => "Invalid Request!", // Error messages should not be translated
				)
			);
		}

		do_action( 'inspiry_after_feedback_form_submit' );

		wp_die();
	}

	protected function inspiry_postbox_posts( $posts = array(), $heading = "" ) {
		if ( isset( $heading ) && ! empty( $heading ) ) : ?>
            <h3 class="inspiry-postbox-heading"><?php echo esc_html( $heading ); ?></h3>
		<?php endif; ?>
		<?php if ( ! empty( $posts ) && is_array( $posts ) ) : ?>
            <ul class="inspiry-postbox-posts">
				<?php foreach ( $posts as $post ) : ?>
                    <li>
				        <?php if (  isset( $post['link'] ) && ! empty( $post['link'] ) ) : ?>
                            <a href="<?php echo esc_url( $post['link'] ); ?>" target="_blank"><?php echo esc_html( $post['title'] ); ?></a>
				        <?php endif; ?>
						<?php if (  isset( $post['description'] ) && ! empty( $heading ) ) : ?>
                            <p class="inspiry-postbox-post-description">​<?php echo wp_kses( $post['description'], inspiry_allowed_html() ); ?></p>
						<?php endif; ?>
                    </li>
				<?php endforeach; ?>
            </ul>
			<?php
		endif;
	}

    protected function inspiry_quick_links( $links = array(), $target = "_blank" ) {
		if ( ! empty( $links ) && is_array( $links ) ) : ?>
            <ul class="inspiry-quick-links">
				<?php foreach ( $links as $link ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $link['link'] ); ?>" <?php echo empty( $target ) ? '' : sprintf( 'target="%s"', esc_attr( $target ) ); ?>>
							<?php echo esc_html( $link['title'] ); ?>
                            <span aria-hidden="true" class="dashicons dashicons-external"></span>
                        </a>
                    </li>
				<?php endforeach; ?>
            </ul>
			<?php
		endif;
	}
}

/**
 * Initialize RH admin class.
 */
function inspiry_rh_admin() {
	return RH_Admin::instance();
}

inspiry_rh_admin();