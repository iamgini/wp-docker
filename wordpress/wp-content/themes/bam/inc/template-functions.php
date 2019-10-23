<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Bam
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bam_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Site Layout.
	$bam_site_layout = get_theme_mod( 'bam_site_layout', 'boxed-layout' );
	$classes[] = $bam_site_layout;

	// Get sidebar alignment class.
	$classes[] = bam_get_layout();

	// Content Layout.
	$bam_content_layout = get_theme_mod( 'bam_content_layout', 'one-container' );
	$classes[] = $bam_content_layout;

	return $classes;
}
add_filter( 'body_class', 'bam_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function bam_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'bam_pingback_header' );


/**
 * Add a custom excerpt length.
 */
function bam_excerpt_length( $length ) {
	if( is_admin() ) {
		return $length;
	}
	$custom_length = get_theme_mod( 'bam_excerpt_length', 25 );
	return absint( $custom_length );
}
add_filter( 'excerpt_length', 'bam_excerpt_length', 999 );

/**
 * Changes the excerpt more text.
 */
function bam_excerpt_more( $more ) {

	if ( is_admin() ) {
		return $more;
	}

	return ' &hellip; ';
}
add_filter( 'excerpt_more', 'bam_excerpt_more' );

/**
 * Changes tag font size.
 */
function bam_tag_cloud_sizes($args) {
	$args['smallest']	= 10;
	$args['largest'] 	= 10;
	return $args; 
}
add_filter('widget_tag_cloud_args','bam_tag_cloud_sizes');