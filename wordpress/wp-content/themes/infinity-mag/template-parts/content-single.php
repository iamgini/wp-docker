<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package infinity-mag
 */

?>
	<div class="entry-content">
		<?php
			$image_values = get_post_meta( $post->ID, 'infinity-mag-meta-image-layout', true );
			if ( empty( $image_values ) ) {
				$values = esc_attr( infinity_mag_get_option('single_post_image_layout') );
			} else{
				$values = esc_attr($image_values);
			}
			if( 'no-image' != $values ){
				if( 'left' == $values ){
					echo "<div class='image-left twp-featured-image'>";
					the_post_thumbnail('medium');
				}
				elseif( 'right' == $values ){
					echo "<div class='image-right twp-featured-image'>";
					the_post_thumbnail('medium');
				}
				else{
					echo "<div class='image-full twp-featured-image'>";
					the_post_thumbnail('full');
				}
				echo "</div>";/*div end */
			}
		?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'infinity-mag' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php infinity_mag_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

