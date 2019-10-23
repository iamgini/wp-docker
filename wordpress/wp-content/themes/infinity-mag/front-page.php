<?php
/**
 * The template for displaying home page.
 * @package infinity-mag
 */

get_header();
if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
    } else {

	/**
	 * infinity_mag_action_sidebar_section hook
	 * @since Infinity Mag 0.0.1
	 *
	 * @hooked infinity_mag_action_sidebar_section -  20
	 * @sub_hooked infinity_mag_action_sidebar_section -  20
	 */
    do_action('infinity_mag_action_sidebar_section');
    
		if (infinity_mag_get_option('home_page_content_status') == 1) {
			?>
			<section class="section-block recent-blog">
				<div class="col-left">
				<?php
				while ( have_posts() ) : the_post();
					the_title('<h2 class="widget-title">', '</h2>');
					get_template_part( 'template-parts/content', 'page' );

				endwhile; // End of the loop.
				?>
				</div><!-- #primary -->
				<div class="col-right">
					<?php get_sidebar(); ?>
				</div>
			</section>
	<?php }
	}
get_footer();