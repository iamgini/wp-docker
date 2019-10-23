<?php
/*
 * Orange Magazine functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Orange Magazine
*/

// Loads parent theme stylesheet
// Do not delete this
function orange_magazine_scripts()
{
    wp_enqueue_style('infinity-mag', get_template_directory_uri() . '/style.css');
}

add_action('wp_enqueue_scripts', 'orange_magazine_scripts', 20);

// Loads custom stylesheet and js for child. 
// This could override all stylesheets of parent theme and custom js functions
function orange_magazine_custom_scripts()
{
    wp_enqueue_style('orange-magazine', get_stylesheet_directory_uri() . '/custom.css');
}

add_action('wp_enqueue_scripts', 'orange_magazine_custom_scripts', 60);


/**
 * Default theme options.
 *
 * @package infinity-mag
 */

if ( ! function_exists( 'infinity_mag_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function infinity_mag_get_default_theme_options() {

		$defaults = array();

		// Slider Section.
		$defaults['show_slider_section']				= 1;
		$defaults['slider_style_option']				= 'carousel-slider';
		$defaults['slider_layout_option']				= 'full-width';
		$defaults['select_category_for_slider']			= 1;
		
		// ticker Section.
		$defaults['show_ticker_section']				= 1;
		$defaults['number_of_home_ticker']				= 8;
		$defaults['select_category_for_ticker']			= 1;
		
		/*featured news section*/
		$defaults['show_featured_news_section']			= 0;
		$defaults['select_category_for_featured_news']	= 1;
		$defaults['featured_news_title']				= esc_html__('Featured Now','infinity-mag');

		/*layout*/
		$defaults['home_page_content_status']     	= 1;
		$defaults['enable_overlay_option']			= 1;
		$defaults['global_layout']					= 'right-sidebar';
		$defaults['excerpt_length_global']			= 30;
		$defaults['archive_layout']					= 'excerpt-only';
		$defaults['archive_layout_image']			= 'full';
		$defaults['single_post_image_layout']		= 'full';
        $defaults['read_more_button_text'] = esc_html__( 'Continue Reading', 'infinity-mag' );
		$defaults['pagination_type']				= 'default';
		$defaults['copyright_text']					= esc_html__( 'Copyright All right reserved', 'infinity-mag' );
		$defaults['number_of_footer_widget']		= 3;
		$defaults['breadcrumb_type']				= 'simple';
		$defaults['enable_preloader_option']		= 1;

		// Pass through filter.
		$defaults = apply_filters( 'infinity_mag_filter_default_theme_options', $defaults );

		return $defaults;

	}

endif;
