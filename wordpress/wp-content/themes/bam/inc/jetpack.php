<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Bam
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function bam_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'type'		=> 'click',
		'container' => 'main',
		'render'    => 'bam_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

}
add_action( 'after_setup_theme', 'bam_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function bam_infinite_scroll_render() { ?>

	<div id="blog-entries" class="<?php bam_blog_wrapper_classes(); ?>">

	<?php
		while ( have_posts() ) {
			the_post();

			if ( is_search() ) :
				get_template_part( 'partials/content', 'search' );
			else :
				get_template_part( 'partials/content', get_post_type() );
			endif;
		} 
	?>

	</div><!-- #blog-entries -->

	<?php
}