<?php
/**
 * This file includes helper functions used throughout the theme
 */

/**
 * Selects header template
 */
if ( ! function_exists( 'bam_header_template' ) ) {
    function bam_header_template() {
        get_template_part( 'partials/header/layout' );
    }
    add_action( 'bam_header', 'bam_header_template' );
}

/**
 * Top bar template.
 */
if ( ! function_exists( 'bam_top_bar_template' ) ) {

	function bam_top_bar_template() {

		if ( false == get_theme_mod( 'bam_enable_topbar', true ) ) {
			return;
		}

		get_template_part( 'partials/topbar/layout' );
	}
	add_action( 'bam_top_bar', 'bam_top_bar_template' );

}

/**
 * Returns the header style.
 */
if ( ! function_exists( 'bam_header_style' ) ) {
    function bam_header_style() {
        return get_theme_mod( 'bam_header_style', 'default-style' );
    }
}

/**
 * Returns the header image position.
 */
if ( ! function_exists( 'bam_header_image_location' ) ) {
    function bam_header_image_location() {
        return get_theme_mod( 'bam_header_image_location', 'before-navigation' );
    }
}

/**
 * Returns the style of the blog.
 */
if ( ! function_exists( 'bam_blog_style' ) ) {
	function bam_blog_style() {
		return get_theme_mod( 'bam_blog_style', 'grid-style' );
	}
}

/**
 * Returns the layout of the blog.
 */
if ( ! function_exists( 'bam_blog_layout' ) ) {
	function bam_blog_layout() {
		return get_theme_mod( 'bam_blog_layout', 'right-sidebar' );
	}
}

/**
 * Returns the number of columns defined.
 */
if ( ! function_exists( 'bam_cols_per_row' ) ) {
	function bam_cols_per_row() {
		return get_theme_mod( 'bam_cols_per_row', '2' );
	}
}

/**
 * Returns the thumbnail size based on the selected layout.
 */
if ( ! function_exists( 'bam_thumbnail_size' ) ) {
	function bam_thumbnail_size() {
		
		$bam_blog_style = bam_blog_style();

		if ( 'grid-style' == $bam_blog_style ) {
			return 'bam-featured';
		} elseif ( 'list-style' == $bam_blog_style ) {
			return 'bam-list';
		} elseif ( 'large-style' == $bam_blog_style ) {
			return 'bam-large';
		}

		return 'full';

	}
}

/**
 * Returns the blog entry classes.
 */
if ( ! function_exists( 'bam_blog_article_classes' ) ) {
	
	function bam_blog_article_classes() {
		
		$classes = array();

		$classes[] = 'bam-entry';
		$classes[] = 'clearfix';

		$blog_style = bam_blog_style();

		if ( $blog_style == 'grid-style' ) {
			$classes[] = 'grid-entry';
		} elseif ( $blog_style == 'list-style' ) {
			$classes[] = 'list-entry';
		} elseif ( $blog_style == 'large-style' ) {
			$classes[] = 'large-entry';
		}

		global $bam_post_count;

		if ( $blog_style == 'grid-style' ) {
			$classes[] = 'th-col-' . $bam_post_count;
		}

		return $classes;

	}
}

/**
 * Returns the classes of blog wrapper div.
 */
if ( ! function_exists( 'bam_blog_wrapper_classes' ) ) {

	function bam_blog_wrapper_classes() {

		$classes = array( 'blog-wrap', 'clearfix' );

		$layout = bam_blog_style();

		$classes[] = $layout;

		if ( 'grid-style' == $layout ) {

			$classes[] = 'th-grid-' . bam_cols_per_row();

		}

		// turn classes into space separated string.
		if ( is_array( $classes ) ) {
			$classes = implode( ' ', $classes );
		}

		echo esc_attr( $classes );

	}
}

if ( ! function_exists( 'bam_get_layout' ) ) :
	/**
	 * Returns the selected sidebar alignment for the page.
	 *
	 * @return string
	 */
	function bam_get_layout() {
	
		global $post;
	
		$layout = 'right-sidebar';
	
		if ( is_home() || is_archive() || is_search() ) {
			$blog_layout = get_theme_mod( 'bam_blog_layout', 'right-sidebar' );
			$layout = $blog_layout;
		}
	
		if ( is_single() ) {
			$post_specific_layout = get_post_meta( $post->ID, '_bam_layout_meta', true );
			if ( empty( $post_specific_layout ) || $post_specific_layout == 'default-layout' ) {
				$layout = get_theme_mod( 'bam_single_post_layout', 'right-sidebar' );
			} else {
				$layout = $post_specific_layout;
			}
		}

		if ( is_page() ) {
			$page_specific_layout = get_post_meta( $post->ID, '_bam_layout_meta', true );
			if ( empty( $page_specific_layout ) || $page_specific_layout == 'default-layout' ) {
				$layout = get_theme_mod( 'bam_page_layout', 'right-sidebar' );
			} else {
				$layout = $page_specific_layout;
			}	
		}
	
		return $layout;
	
	}
	
endif;


/**
 * Returns array of social options.
 */
if ( ! function_exists( 'bam_social_options' ) ) {
	function bam_social_options() {
		return apply_filters( 'bam_social_options', array(
			'facebook' => array(
				'label'			=> esc_html__( 'Facebook', 'bam' ),
				'icon_class'	=> 'fa fa-facebook'
			),
			'youtube' => array(
				'label'			=> esc_html__( 'Youtube', 'bam' ),
				'icon_class'	=> 'fa fa-youtube-play'
			),
			'twitter' => array(
				'label'			=> esc_html__( 'Twitter', 'bam' ),
				'icon_class'	=> 'fa fa-twitter'
			),
			'pinterest' => array(
				'label'			=> esc_html__( 'Pinterest', 'bam' ),
				'icon_class'	=> 'fa fa-pinterest'
			),
			'instagram' => array(
				'label'			=> esc_html__( 'Instagram', 'bam' ),
				'icon_class'	=> 'fa fa-instagram'
			),
			'linkedin' => array(
				'label'			=> esc_html__( 'LinkedIn', 'bam' ),
				'icon_class'	=> 'fa fa-linkedin'
			),
			'skype' => array(
				'label'			=> esc_html__( 'Skype', 'bam' ),
				'icon_class'	=> 'fa fa-skype'
			),
			'dribbble' => array(
				'label'			=> esc_html__( 'Dribbble', 'bam' ),
				'icon_class'	=> 'fa fa-dribbble'
			),
			'vk' => array(
				'label'			=> esc_html__( 'VK', 'bam' ),
				'icon_class'	=> 'fa fa-vk'
			),
			'tumblr' => array(
				'label'			=> esc_html__( 'Tumblr', 'bam' ),
				'icon_class'	=> 'fa fa-tumblr'
			),
			'github' => array(
				'label'			=> esc_html__( 'Github', 'bam' ),
				'icon_class'	=> 'fa fa-github'
			),
			'flickr' => array(
				'label'			=> esc_html__( 'Flickr', 'bam' ),
				'icon_class'	=> 'fa fa-flickr'
			),
			'vimeo' => array(
				'label'			=> esc_html__( 'Vimeo', 'bam' ),
				'icon_class'	=> 'fa fa-vimeo'
			),
			'vine' => array(
				'label'			=> esc_html__( 'Vine', 'bam' ),
				'icon_class'	=> 'fa fa-vine'
			),
			'yelp' => array(
				'label'			=> esc_html__( 'Yelp', 'bam' ),
				'icon_class'	=> 'fa fa-yelp'
			),
			'tripadvisor' => array(
				'label'			=> esc_html__( 'Trip Advisor', 'bam' ),
				'icon_class'	=> 'fa fa-tripadvisor'
			),
			'rss' => array(
				'label'			=> esc_html__( 'RSS', 'bam' ),
				'icon_class'	=> 'fa fa-rss'
			),
			'email' => array(
				'label'			=> esc_html__( 'Email', 'bam' ),
				'icon_class'	=> 'fa fa-envelope'
			),
		) );
	}
}