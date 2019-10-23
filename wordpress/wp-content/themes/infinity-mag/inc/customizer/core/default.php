<?php
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
		$defaults['slider_style_option']				= 'single-slider';
		$defaults['slider_layout_option']				= 'boxed';
		$defaults['select_category_for_slider']			= 1;
		
		// ticker Section.
		$defaults['show_ticker_section']				= 0;
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
