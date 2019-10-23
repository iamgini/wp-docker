<?php
/**
 * The template for displaying archive pages
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
		
			<?php do_action( 'bam_before_blog_entries' ); ?>

			<div id="blog-entries" class="<?php bam_blog_wrapper_classes(); ?>">

				<?php do_action( 'bam_blog_entries_top' ); ?>

				<?php 
					// Post count used to clear floats.
					$bam_post_count = 0;
				?>

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header><!-- .page-header -->

					<?php do_action( 'bam_before_content_while' ); ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						// increase counter.
						$bam_post_count++;

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'partials/content', get_post_type() );

						// Reset counter.
						if ( bam_cols_per_row() == $bam_post_count ) {
							$bam_post_count = 0;
						}

					endwhile;
				
					?>

					<?php do_action( 'bam_after_content_while' ); ?>

				<?php do_action( 'bam_blog_entries_bottom' ); ?>

			</div><!-- #blog-entries -->

			<?php do_action( 'bam_after_blog_entries' ); ?>

			<?php 

				bam_posts_pagination();

			else :

				get_template_part( 'partials/content', 'none' );

			endif;
			?>

		</main><!-- #main -->

		<?php do_action( 'bam_after_main' ); ?>

	</div><!-- #primary -->

	<?php do_action( 'bam_after_primary' ); ?>

<?php
get_sidebar();
get_footer();
