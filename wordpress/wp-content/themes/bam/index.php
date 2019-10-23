<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
				
				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) :
						?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
					<?php endif; ?>

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