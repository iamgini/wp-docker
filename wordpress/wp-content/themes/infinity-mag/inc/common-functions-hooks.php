<?php
if (!function_exists('infinity_mag_the_custom_logo')):
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since infinity-mag 1.0.0
 */
function infinity_mag_the_custom_logo() {
	if (function_exists('the_custom_logo')) {
		the_custom_logo();
	}
}
endif;

if (!function_exists('infinity_mag_body_class')):

/**
 * body class.
 *
 * @since 1.0.0
 */
function infinity_mag_body_class($infinity_mag_body_class) {
	global $post;
	$global_layout       = infinity_mag_get_option('global_layout');
	$input               = '';
	$home_content_status = infinity_mag_get_option('home_page_content_status');
	if (1 != $home_content_status) {
		$input = 'home-content-not-enabled';
	}
	// Check if single.
	if ($post && is_singular()) {
		$post_options = get_post_meta($post->ID, 'infinity-mag-meta-select-layout', true);
		if (empty($post_options)) {
			$global_layout = esc_attr(infinity_mag_get_option('global_layout'));
		} else {
			$global_layout = esc_attr($post_options);
		}
	}
	if ($global_layout == 'left-sidebar') {
		$infinity_mag_body_class[] = 'left-sidebar '.esc_attr($input);
	} elseif ($global_layout == 'no-sidebar') {
		$infinity_mag_body_class[] = 'no-sidebar '.esc_attr($input);
	} else {
		$infinity_mag_body_class[] = 'right-sidebar '.esc_attr($input);

	}
	return $infinity_mag_body_class;
}
endif;

add_action('body_class', 'infinity_mag_body_class');
/**
 * Returns word count of the sentences.
 *
 * @since infinity-mag 1.0.0
 */
if (!function_exists('infinity_mag_words_count')):
function infinity_mag_words_count($length = 25, $infinity_mag_content = null) {
	$length          = absint($length);
	$source_content  = preg_replace('`\[[^\]]*\]`', '', $infinity_mag_content);
	$trimmed_content = wp_trim_words($source_content, $length, '...');
	return $trimmed_content;
}
endif;

if (!function_exists('infinity_mag_simple_breadcrumb')):

/**
 * Simple breadcrumb.
 *
 * @since 1.0.0
 */
function infinity_mag_simple_breadcrumb() {

	if (!function_exists('breadcrumb_trail')) {

		require_once get_template_directory().'/assets/libraries/breadcrumbs/breadcrumbs.php';
	}

	$breadcrumb_args = array(
		'container'   => 'div',
		'show_browse' => false,
	);
	breadcrumb_trail($breadcrumb_args);

}

endif;

if (!function_exists('infinity_mag_custom_posts_navigation')):
/**
 * Posts navigation.
 *
 * @since 1.0.0
 */
function infinity_mag_custom_posts_navigation() {

	$pagination_type = infinity_mag_get_option('pagination_type');

	switch ($pagination_type) {

		case 'default':
			the_posts_navigation();
			break;

		case 'numeric':
			the_posts_pagination();
			break;

		default:
			break;
	}

}
endif;

add_action('infinity_mag_action_posts_navigation', 'infinity_mag_custom_posts_navigation');

if (!function_exists('infinity_mag_excerpt_length') && !is_admin()):

/**
 * Excerpt length
 *
 * @since  infinity-mag 1.0.0
 *
 * @param null
 * @return int
 */
function infinity_mag_excerpt_length($length) {
	$excerpt_length = infinity_mag_get_option('excerpt_length_global');
	if (absint($excerpt_length) > 0) {
		$excerpt_length = absint($excerpt_length);
	}

	return absint($excerpt_length);

}

endif;
add_filter('excerpt_length', 'infinity_mag_excerpt_length', 999);

if (!function_exists('infinity_mag_excerpt_more') && !is_admin()):

/**
 * Implement read more in excerpt.
 *
 * @since 1.0.0
 *
 * @param string $more The string shown within the more link.
 * @return string The excerpt.
 */
function infinity_mag_excerpt_more($more) {

	$flag_apply_excerpt_read_more = apply_filters('infinity_mag_filter_excerpt_read_more', true);
	if (true !== $flag_apply_excerpt_read_more) {
		return $more;
	}

	$output         = $more;
	$read_more_text = esc_html(infinity_mag_get_option('read_more_button_text'));
	if (!empty($read_more_text)) {
		$output = ' <a href="'.esc_url(get_permalink()).'" class="read-more button-fancy -red">'.'<span class="btn-arrow"></span><span class="twp-read-more text">'.esc_html($read_more_text).'</span>'.'</a>';
		$output = apply_filters('infinity_mag_filter_read_more_link', $output);
	}
	return $output;

}

add_filter('excerpt_more', 'infinity_mag_excerpt_more');
endif;

if (!function_exists('infinity_mag_recommended_plugins')):

/**
 * Recommended plugins
 *
 */
function infinity_mag_recommended_plugins() {
	$infinity_mag_plugins = array(
		array(
			'name'     => __('One Click Demo Import', 'infinity-mag'),
			'slug'     => 'one-click-demo-import',
			'required' => false,
		),
		array(
		    'name'     => __('Social Share With Floating Bar', 'infinity-mag'),
		    'slug'     => 'social-share-with-floating-bar',
		    'required' => false,
		),
		array(
		    'name'     => __( 'MailOptin – Popups, Email Optin Forms & Newsletters for MailChimp, Aweber etc.', 'infinity-mag' ),
		    'slug'     => 'mailoptin',
		    'required' => false,
		),
	);
	$infinity_mag_plugins_config = array(
		'dismissable' => true,
	);

	tgmpa($infinity_mag_plugins, $infinity_mag_plugins_config);
}
endif;
add_action('tgmpa_register', 'infinity_mag_recommended_plugins');

function infinity_mag_check_other_plugin() {
	// check for plugin using plugin name
	if (is_plugin_active('one-click-demo-import/one-click-demo-import.php')) {
		// Disable PT branding.
		add_filter('pt-ocdi/disable_pt_branding', '__return_true');
		//plugin is activated
		function ocdi_after_import_setup() {
			// Assign menus to their locations.
			$main_menu   = get_term_by('name', 'Primary Menu', 'nav_menu');
			$footer_menu = get_term_by('name', 'Footer Menu', 'nav_menu');
			$social_menu = get_term_by('name', 'Social Menu', 'nav_menu');

			set_theme_mod('nav_menu_locations', array(
					'primary' => $main_menu->term_id,
					'footer'  => $footer_menu->term_id,
					'social'  => $social_menu->term_id,
				)
			);

			// Assign front page and posts page (blog page).
			$front_page_id = get_page_by_title('Homepage');
			$blog_page_id  = get_page_by_title('Blog');

			update_option('show_on_front', 'page');
			update_option('page_on_front', $front_page_id->ID);
			update_option('page_for_posts', $blog_page_id->ID);

		}
		add_action('pt-ocdi/after_import', 'ocdi_after_import_setup');
	}
}
add_action('admin_init', 'infinity_mag_check_other_plugin');