<?php
/**
 * Template part for displaying single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bam
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'bam-single-post' ); ?>>
	
	<?php 
		if ( 'before-title' == get_theme_mod( 'bam_post_thumbnail_location', 'before-title' ) ) {
			bam_post_thumbnail( 'bam-large' );
		}
	?>

	<div class="category-list">
		<?php bam_category_list(); ?>
	</div><!-- .category-list -->

	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php bam_entry_meta(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php 
	if ( 'after-title' == get_theme_mod( 'bam_post_thumbnail_location', 'before-title' ) ) {
		bam_post_thumbnail( 'bam-large' );
	}
	?>

	<?php do_action( 'bam_before_single_entry_content' ); ?>

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bam' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bam' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php do_action( 'bam_after_single_entry_content' ); ?>

	<footer class="entry-footer">
		<?php 
			if ( true == get_theme_mod( 'bam_single_show_tags', true ) ) {
				bam_tags_list(); 
			}
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->