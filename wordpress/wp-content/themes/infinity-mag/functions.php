<?php
/**
 * infinity-mag functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package infinity-mag
 */

if (!function_exists('infinity_mag_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function infinity_mag_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on infinity-mag, use a find and replace
         * to change 'infinity-mag' to the name of your theme in all the template files.
         */
        load_theme_textdomain('infinity-mag', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for custom logo.
         */
        add_theme_support('custom-logo', array(
            'header-text' => array('site-title', 'site-description'),
        ));
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        add_image_size('infinity-mag-400-260', 400, 260, true);
        add_image_size('infinity-mag-725-480', 725, 480, true);


        // Set up the WordPress core custom header feature.
        add_theme_support('custom-header', apply_filters('infinity_mag_custom_header_args', array(
            'width' => 1400,
            'height' => 380,
            'flex-height' => true,
            'header-text' => false,
            'default-text-color' => '000',
            'default-image' => get_template_directory_uri() . '/images/banner-image.jpg',
        )));

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'infinity-mag'),
            'footer' => esc_html__('Footer Menu', 'infinity-mag'),
            'social' => esc_html__('Social Menu', 'infinity-mag'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('infinity_mag_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        /**
         * Load Init for Hook files.
         */
        require get_template_directory() . '/inc/hooks/hooks-init.php';

    }
endif;
add_action('after_setup_theme', 'infinity_mag_setup');


function infinity_mag_ocdi_files() {
    return array(
        array(
            'import_file_name'           =>  esc_html__( 'Demo Content Default', 'infinity-mag' ),
            'import_file_url'            =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/infinity-mag-default/infinity-mag-default.xml',
            'import_widget_file_url'     =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/infinity-mag-default/infinity-mag-default.wie',
            'import_customizer_file_url' =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/infinity-mag-default/infinity-mag-default.dat',
            'import_preview_image_url'   =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/images/infinity-mag-default.png',
        ),
        array(
            'import_file_name'           =>  esc_html__( 'Demo Content Sports', 'infinity-mag' ),
            'import_file_url'            =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/infinity-mag-sports/infinity-mag-sports.xml',
            'import_widget_file_url'     =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/infinity-mag-sports/infinity-mag-sports.wie',
            'import_customizer_file_url' => trailingslashit( get_template_directory_uri() ) . 'demo-content/infinity-mag-sports/infinity-mag-sports.dat',
            'import_preview_image_url'   => trailingslashit( get_template_directory_uri() ) . 'demo-content/images/infinity-mag-sports.png',
        ),
        array(
            'import_file_name'           =>  esc_html__( 'Demo Content Newspaper', 'infinity-mag' ),
            'import_file_url'            =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/infinity-mag-newspaper/infinity-mag-newspaper.xml',
            'import_widget_file_url'     =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/infinity-mag-newspaper/infinity-mag-newspaper.wie',
            'import_customizer_file_url' => trailingslashit( get_template_directory_uri() ) . 'demo-content/infinity-mag-newspaper/infinity-mag-newspaper.dat',
            'import_preview_image_url'   => trailingslashit( get_template_directory_uri() ) . 'demo-content/images/infinity-mag-newspaper.png',
        ),
        array(
            'import_file_name'           =>  esc_html__( 'Demo Content Fashion', 'infinity-mag' ),
            'import_file_url'            =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/infinity-mag-fashion/infinity-mag-fashion.xml',
            'import_widget_file_url'     =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/infinity-mag-fashion/infinity-mag-fashion.wie',
            'import_customizer_file_url' => trailingslashit( get_template_directory_uri() ) . 'demo-content/infinity-mag-fashion/infinity-mag-fashion.dat',
            'import_preview_image_url'   => trailingslashit( get_template_directory_uri() ) . 'demo-content/images/infinity-mag-fashion.png',
        ),
        array(
            'import_file_name'           =>  esc_html__( 'Demo Content Minimal', 'infinity-mag' ),
            'import_file_url'            =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/infinity-mag-minimal/infinity-mag-minimal.xml',
            'import_widget_file_url'     =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/infinity-mag-minimal/infinity-mag-minimal.wie',
            'import_customizer_file_url' => trailingslashit( get_template_directory_uri() ) . 'demo-content/infinity-mag-minimal/infinity-mag-minimal.dat',
            'import_preview_image_url'   => trailingslashit( get_template_directory_uri() ) . 'demo-content/images/infinity-mag-minimal.png',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'infinity_mag_ocdi_files' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function infinity_mag_content_width()
{
    $GLOBALS['content_width'] = apply_filters('infinity_mag_content_width', 640);
}

add_action('after_setup_theme', 'infinity_mag_content_width', 0);

/**
 * function for google fonts
 */
if (!function_exists('infinity_mag_fonts_url')) :

    /**
     * Return fonts URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function infinity_mag_fonts_url()
    {

        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Rubik, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Rubik font: on or off', 'infinity-mag')) {
            $fonts[] = 'Rubik:300,400,500';
        }
        /* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Roboto font: on or off', 'infinity-mag')) {
            $fonts[] = 'Roboto:400,400i,700';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urldecode(implode('|', $fonts)),
                'subset' => urldecode($subsets),
            ), 'https://fonts.googleapis.com/css');
        }
        return $fonts_url;
    }
endif;
/**
 * Enqueue scripts and styles.
 */
function infinity_mag_scripts()
{
    $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    wp_enqueue_style('jquery-slick', get_template_directory_uri() . '/assets/libraries/slick/css/slick' . $min . '.css');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/libraries/font-awesome/css/font-awesome' . $min . '.css');
    wp_enqueue_style('sidr-nav', get_template_directory_uri().'/assets/libraries/sidr/css/jquery.sidr.dark.css');
    wp_enqueue_style('magnific-popup', get_template_directory_uri().'/assets/libraries/magnific-popup/magnific-popup.css');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/libraries/bootstrap/css/bootstrap' . $min . '.css');
    wp_enqueue_style('infinity-mag-style', get_stylesheet_uri());
    /*inline style*/
    wp_add_inline_style('infinity-mag-style', infinity_mag_trigger_custom_css_action());

    $fonts_url = infinity_mag_fonts_url();
    if (!empty($fonts_url)) {
        wp_enqueue_style('infinity-mag-google-fonts', $fonts_url, array(), null);
    }
    wp_enqueue_script('infinity-mag-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);

    wp_enqueue_script('infinity-mag-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    wp_enqueue_script('jquery-slick', get_template_directory_uri() . '/assets/libraries/slick/js/slick' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-bootstrap', get_template_directory_uri() . '/assets/libraries/bootstrap/js/bootstrap' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-sidr', get_template_directory_uri().'/assets/libraries/sidr/js/jquery.sidr'. $min .'.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-magnific-popup', get_template_directory_uri().'/assets/libraries/magnific-popup/jquery.magnific-popup'. $min .'.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-sticky-sidebar', get_template_directory_uri() . '/assets/libraries/theiaStickySidebar/theia-sticky-sidebar.min.js', array('jquery'), '', true);
    wp_enqueue_script('infinity-mag-script', get_template_directory_uri() . '/assets/twp/js/custom-script.js', array('jquery'), '', 1);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'infinity_mag_scripts');

/**
 * Enqueue admin scripts and styles.
 */
function infinity_mag_admin_scripts($hook)
{
    if ('widgets.php' === $hook) {
        wp_enqueue_media();
        wp_enqueue_script('infinity-mag-custom-widgets', get_template_directory_uri() . '/assets/twp/js/widgets.js', array('jquery'), '1.0.0', true);
    }
    wp_enqueue_style('infinity-mag-admin-css', get_template_directory_uri() . '/assets/twp/css/admin.css');


}

add_action('admin_enqueue_scripts', 'infinity_mag_admin_scripts');

/**
 * Load about.
 */
if ( is_admin() ) {
    require_once trailingslashit( get_template_directory() ) . 'inc/about/class.about.php';
    require_once trailingslashit( get_template_directory() ) . 'inc/about/about.php';
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Customizer control scripts and styles.
 *
 * @since 1.0.5
 */
function infinity_mag_customizer_control_scripts()
{

    wp_enqueue_style('infinity-mag-customize-controls', get_template_directory_uri() . '/assets/twp/css/customize-controls.css');

}

add_action('customize_controls_enqueue_scripts', 'infinity_mag_customizer_control_scripts', 0);