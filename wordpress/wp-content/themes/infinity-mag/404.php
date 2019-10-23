<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package infinity-mag
 */

get_header(); ?>

<section class="error-404 not-found">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="page-content error-404-content">
					<h3 class="error-404-title"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'infinity-mag' ); ?></h3>
					<?php
					get_search_form();
					?>
				</div><!-- .page-content -->
			</div>
		</div>
	</div>
	</section><!-- .error-404 -->
<?php
get_footer();
