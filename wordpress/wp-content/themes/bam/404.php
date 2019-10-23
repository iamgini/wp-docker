<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Bam
 */

get_header();
?>

<?php do_action( 'bam_before_primary' ); ?>

	<div id="primary" class="content-area">

		<?php do_action( 'bam_before_main' ); ?>

			<main id="main" class="site-main">

				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'bam' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'bam' ); ?></p>

						<?php get_search_form(); ?>
					</div><!-- .page-content -->
				</section><!-- .error-404 -->

			</main><!-- #main -->

		<?php do_action( 'bam_after_main' ); ?>

	</div><!-- #primary -->

<?php do_action( 'bam_after_primary' ); ?>

<?php
get_footer();
