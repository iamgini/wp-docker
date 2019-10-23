<?php
/**
 * Bam functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bam
 */

// Core Constants
define( 'BAM_DIR_PATH', get_template_directory() );
define( 'BAM_DIR_URI', get_template_directory_uri() );

final class Bam_Theme {

	/**
	 * Returns the instance.
	 * 
	 * @since	1.0.0
	 * @access	public
	 * @return	void
	 */
	public static function get_instance() {
		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->includes();
			$instance->setup_actions();
		}
	}

	/**
	 * Theme include files
	 * 
	 * @since	1.0.0
	 * @access 	private
	 * @return	void
	 */
	private function includes() {

		$dir = BAM_DIR_PATH . '/inc/';

		require_once( $dir . 'class-meta-boxes.php' );
		require_once( $dir . 'helpers.php' );
		require_once( $dir . 'custom-header.php' );
		require_once( $dir . 'template-tags.php' );
		require_once( $dir . 'template-functions.php' );
		require_once( $dir . 'customizer/custom-controls/fonts/fonts.php' );
		require_once( $dir . 'customizer/customizer.php' );
		require_once( $dir . 'customizer/section-pro/class-upsell-customize.php' );
		require_once( $dir . 'class-bam-admin.php' );
		require_once( $dir . 'theme-info-page.php' );
		require_once( $dir . 'class-bam-gutenberg.php' );
		require_once( $dir . 'widgets/class-tabs-widget.php' );
		require_once( $dir . 'widgets/class-sidebar-posts.php' );

		if ( defined( 'JETPACK__VERSION' ) ) {
			require_once( $dir . 'jetpack.php' );
		}

	}

	/**
	 * Setup initial actions.
	 * 
	 * @since	1.0.0
	 * @access 	private
	 * @return	void
	 */
	private function setup_actions() {
		add_action( 'wp_enqueue_scripts', array( &$this, 'register_scripts') );
		add_action( 'after_setup_theme', array( &$this, 'theme_setup' ) );
		add_action( 'widgets_init', array( &$this, 'register_sidebars' ) );
		add_action( 'wp_head', array( &$this, 'custom_css' ), 9999 );
	}
	
	/**
	 * Initial theme setup
	 * 
	 * @since	1.0.0
	 * @access	public
	 * @return	void		
	 */
	public function theme_setup() {

		// Get globals
		global $content_width;

		if ( ! isset( $content_width ) ) {
			$content_width = 1200;
		}

		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Bam, use a find and replace
		* to change 'bam' to the name of your theme in all the template files.
		*/
		load_theme_textdomain( 'bam', BAM_DIR_PATH . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

		/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'bam-large', 1400, 800, true );
		add_image_size( 'bam-featured', 890, 530, true );
		add_image_size( 'bam-list', 700, 465, true );
		add_image_size( 'bam-thumb', 445, 265, true );
		add_image_size( 'bam-small', 120, 85, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Main Menu', 'bam' ),
			'menu-2' => esc_html__( 'Top Bar Menu', 'bam' )
		) );

		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'bam_custom_background_args', array(
			'default-color' => '#ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 80,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}



	/**
	 * Register widget area.
	 */
	public function register_sidebars() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'bam' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'bam' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Header Sidebar', 'bam' ),
			'id'            => 'header-sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'bam' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 1', 'bam' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'bam' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 2', 'bam' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'bam' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 3', 'bam' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'bam' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 4', 'bam' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here.', 'bam' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

	}

	/**
	 * Enqueue scripts and styles.
	 * 
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */ 
	public function register_scripts() {

		$dir_uri = BAM_DIR_URI . '/assets/';

		// Remove font awesome style from plugins
		wp_deregister_style( 'font-awesome' );
		wp_deregister_style( 'fontawesome' );

		// Load font awesome style
		wp_enqueue_style( 'font-awesome', $dir_uri .'css/font-awesome.min.css', false, '4.7.0' );

		wp_enqueue_style( 'bam-style', get_stylesheet_uri() );

		wp_style_add_data( 'bam-style', 'rtl', 'replace' );

		wp_enqueue_script( 'bam-scripts', $dir_uri . 'js/scripts.js', array( 'jquery' ), '', true );

		wp_enqueue_script( 'bam-main-navigation', $dir_uri . 'js/main-navigation.js', array( 'jquery' ), '', true );

		wp_enqueue_script( 'bam-skip-link-focus-fix', $dir_uri . 'js/skip-link-focus-fix.js', array(), '20151215', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
	}

	/**
	 * All theme functions hook into the bam_head_css filter for this function.
	 *
	 * @since 1.0.0
	 */
	public static function custom_css( $output = NULL ) {
			    
	    // Add filter for adding custom css via other functions
		$output = apply_filters( 'bam_head_css', $output ); ?>

		<style type="text/css" id="theme-custom-css">
			<?php echo wp_strip_all_tags( $output ); ?>
		</style>

	<?php

	}

}

/**
 * Gets the instance of the 'Bam_Theme' class.
 * 
 * @since  1.0.0
 * @access public
 * @return object
 */
function bam_theme() {
	Bam_Theme::get_instance();
}

bam_theme();