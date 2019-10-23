<?php
/**
 * About setup
 *
 * @package Infinity Mag
 */

if ( ! function_exists( 'infinity_mag_about_setup' ) ) :

	/**
	 * About setup.
	 *
	 * @since 1.0.0
	 */
	function infinity_mag_about_setup() {

		$config = array(

			// Welcome content.
			'welcome_content' => sprintf( esc_html__( ' First off, We’d like to extend a warm welcome and thank you for choosing %1$s. %1$s is now installed and ready to use. We want to make sure you have the best experience using the theme and that is why we gathered here all the necessary information for you. Again, Thanks for using our theme!', 'infinity-mag' ), 'Infinity Mag' ),

			// Tabs.
			'tabs' => array(
				'getting-started' => esc_html__( 'Getting Started', 'infinity-mag' ),
				'support'         => esc_html__( 'Support', 'infinity-mag' ),
				'useful-plugins'  => esc_html__( 'Useful Plugins', 'infinity-mag' ),
				'demo-content'    => esc_html__( 'Demo Content', 'infinity-mag' ),
				),

			// Quick links.
			'quick_links' => array(
				'theme_url' => array(
					'text' => esc_html__( 'Theme Details', 'infinity-mag' ),
					'url'  => 'https://themeinwp.com/theme/infinity-mag/',
					),
				'demo_url' => array(
					'text' => esc_html__( 'View Demo', 'infinity-mag' ),
					'url'  => 'https://themeinwp.com/theme-demos/?demo=infinity-mag',
					),
				'documentation_url' => array(
					'text'   => esc_html__( 'View Documentation', 'infinity-mag' ),
					'url'    => 'https://docs.themeinwp.com/themes/infinity-mag/',
					'button' => 'primary',
					),
				),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__( 'Theme Documentation', 'infinity-mag' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'infinity-mag' ),
					'button_text' => esc_html__( 'View Documentation', 'infinity-mag' ),
					'button_url'  => 'https://docs.themeinwp.com/themes/infinity-mag/',
					'button_type' => 'primary',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Static Front Page', 'infinity-mag' ),
					'icon'        => 'dashicons dashicons-admin-generic',
					'description' => esc_html__( 'To achieve custom home page other than blog listing, you need to create and set static front page.', 'infinity-mag' ),
					'button_text' => esc_html__( 'Static Front Page', 'infinity-mag' ),
					'button_url'  => admin_url( 'customize.php?autofocus[section]=static_front_page' ),
					'button_type' => 'primary',
					),
				'three' => array(
					'title'       => esc_html__( 'Theme Options', 'infinity-mag' ),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'infinity-mag' ),
					'button_text' => esc_html__( 'Customize', 'infinity-mag' ),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
					),
				'four' => array(
					'title'       => esc_html__( 'Widget Ready', 'infinity-mag' ),
					'icon'        => 'dashicons dashicons-admin-settings',
					'description' => esc_html__( 'Infinity Mag is widget based Theme. Infinity Mag has 7 predesigned custome additional layout.', 'infinity-mag' ),
					'button_text' => esc_html__( 'View Widgets', 'infinity-mag' ),
					'button_url'  => admin_url( 'widgets.php' ),
					'button_type' => 'secondary',
					),
				'five' => array(
					'title'       => esc_html__( 'Demo Content', 'infinity-mag' ),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf( esc_html__( '%1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'infinity-mag' ), esc_html__( 'One Click Demo Import', 'infinity-mag' ) ),
					'button_text' => esc_html__( 'Demo Content', 'infinity-mag' ),
					'button_url'  => admin_url( 'themes.php?page=infinity-mag-about&tab=demo-content' ),
					'button_type' => 'secondary',
					),
				'six' => array(
					'title'       => esc_html__( 'Theme Preview', 'infinity-mag' ),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__( 'You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized.', 'infinity-mag' ),
					'button_text' => esc_html__( 'View Demo', 'infinity-mag' ),
					'button_url'  => 'https://themeinwp.com/theme-demos/?demo=infinity-mag',
					'button_type' => 'secondary',
					'is_new_tab'  => true,
					),
				),

			// Support.
			'support' => array(
				'one' => array(
					'title'       => esc_html__( 'Contact Support', 'infinity-mag' ),
					'icon'        => 'dashicons dashicons-sos',
					'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'infinity-mag' ),
					'button_text' => esc_html__( 'Contact Support', 'infinity-mag' ),
					'button_url'  => 'https://wordpress.org/support/theme/infinity-mag/',
					'button_type' => 'secondary',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Theme Documentation', 'infinity-mag' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'infinity-mag' ),
					'button_text' => esc_html__( 'View Documentation', 'infinity-mag' ),
					'button_url'  => 'https://docs.themeinwp.com/themes/infinity-mag/',
					'button_type' => 'secondary',
					'is_new_tab'  => true,
					),
				'three' => array(
					'title'       => esc_html__( 'Child Theme', 'infinity-mag' ),
					'icon'        => 'dashicons dashicons-admin-tools',
					'description' => esc_html__( 'For advanced theme customization, it is recommended to use child theme rather than modifying the theme file itself.', 'infinity-mag' ),
					'button_text' => esc_html__( 'Learn More', 'infinity-mag' ),
					'button_url'  => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
					'button_type' => 'secondary',
					'is_new_tab'  => true,
					),
				),

			// Useful plugins.
			'useful_plugins' => array(
				'description' => esc_html__( 'Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'infinity-mag' ),
				),

			// Demo content.
			'demo_content' => array(
				'description' => sprintf( esc_html__( 'To import demo content for this theme, %1$s plugin is needed. Please make sure plugin is installed and activated. After plugin is activated, you will see Import Demo Data menu under Appearance.', 'infinity-mag' ), '<a href="https://wordpress.org/plugins/one-click-demo-import/" target="_blank">' . esc_html__( 'One Click Demo Import', 'infinity-mag' ) . '</a>' ),
				),

			// Upgrade to pro.
			'upgrade_to_pro' => array(
				'description' => esc_html__( 'You can upgrade to pro version of the theme for more exciting features.', 'infinity-mag' ),
				'button_text' => esc_html__( 'Upgrade to Pro','infinity-mag' ),
				'button_url'  => 'https://themeinwp.com/theme/infinity-mag/',
				'button_type' => 'primary',
				'is_new_tab'  => true,
				),
			);

		Infinity_Mag_About::init( $config );
	}

endif;

add_action( 'after_setup_theme', 'infinity_mag_about_setup' );
