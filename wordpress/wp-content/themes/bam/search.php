<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
						<h1 class="page-title">
							<?php
							/* translators: %s: search query. */
							printf( esc_html__( 'Search Results for: %s', 'bam' ), '<span>' . get_search_query() . '</span>' );
							?>
						</h1>
					</header><!-- .page-header -->

					<?php do_action( 'bam_before_content_while' ); ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						// increase counter.
						$bam_post_count++;					

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'partials/content', 'search' );

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
