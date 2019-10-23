<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

				get_template_part( 'partials/content', 'page' );

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
