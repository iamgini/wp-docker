<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bam
 */

get_header();
?>

	<?php do_action( 'bam_before_primary' ); ?>

	<div id="primary" class="content-area">

		<?php do_action( 'bam_before_main' ); ?>

		<main id="main" class="site-main">

			<?php do_action( 'bam_before_content_while' ); ?>

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'partials/single/content' );

				if ( true == get_theme_mod( 'bam_single_show_post_nav', true ) ) {
					// Previous/next post navigation.
					the_post_navigation(
						array(
							'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next Post', 'bam' ) . '</span> ' .
								'<span class="screen-reader-text">' . __( 'Next post:', 'bam' ) . '</span> <br/>' .
								'<span class="post-title">%title</span>',
							'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous Post', 'bam' ) . '</span> ' .
								'<span class="screen-reader-text">' . __( 'Previous post:', 'bam' ) . '</span> <br/>' .
								'<span class="post-title">%title</span>',
						)
					);
				}

				// Author Box.
				if ( true == get_theme_mod( 'bam_show_authorbox', true ) ) {
					get_template_part( 'partials/single/authorbox' );
				}

				// Related Posts.
				if ( true == get_theme_mod( 'bam_show_related_posts', true ) ) {
					get_template_part( 'partials/single/related-posts' );
				}

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			<?php do_action( 'bam_after_content_while' ); ?>

		</main><!-- #main -->

		<?php do_action( 'bam_after_main' ); ?>

	</div><!-- #primary -->

	<?php do_action( 'bam_after_primary' ); ?>

<?php
get_sidebar();
get_footer();
