<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bam
 */

?>

<?php $bam_article_classes = bam_blog_article_classes(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $bam_article_classes ); ?>>

	<?php $bam_thumb_size = bam_thumbnail_size(); ?>

	<div class="blog-entry-inner clearfix">

		<?php bam_post_thumbnail( $bam_thumb_size ); ?>

		<div class="blog-entry-content">

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

				if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php bam_entry_meta(); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<?php do_action( 'bam_before_blog_entry_content' ); ?>

			<div class="entry-summary">
				<?php
				$bam_content_type = get_theme_mod( 'bam_blog_content_type', 'excerpt' );
				if ( 'excerpt' == $bam_content_type ) {
					the_excerpt();
				} elseif ( 'full-content' == $bam_content_type ) {
					the_content();
				}

				if ( true == get_theme_mod( 'bam_show_readmore', false ) ) { ?>
					<div class="entry-readmore">
						<a href="<?php the_permalink(); ?>" class="bam-readmore"><?php echo esc_html_e( 'Read More', 'bam' ); ?></a>
					</div>
				<?php } 
				
				?>
			</div><!-- .entry-summary -->

			<?php do_action( 'bam_after_blog_entry_content' ); ?>

			<footer class="entry-footer">
				<?php bam_entry_footer(); ?>
			</footer><!-- .entry-footer -->

		</div><!-- .blog-entry-content -->

	</div><!-- .blog-entry-inner -->

</article><!-- #post-<?php the_ID(); ?> -->
