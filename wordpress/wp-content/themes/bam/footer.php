<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bam
 */

?>
	</div><!-- .container -->
	</div><!-- #content -->

	<?php do_action( 'bam_after_content' ); ?>

	<?php do_action( 'bam_before_footer' ); ?>

	<footer id="colophon" class="site-footer">

		<?php do_action( 'bam_footer_top' ); ?>

		<?php 
			// sidebar count.
			$bam_footer_sidebar_count = get_theme_mod( 'bam_footer_sidebar_count', '3' ); 

			// widget area class.
			$bam_widget_area_class = 'th-columns-' . $bam_footer_sidebar_count;

			// container class.
			if ( true == get_theme_mod( 'bam_footer_widgets_fullwidth', false ) ) {
				$bam_footer_container_class = 'container-fluid';
			} else {
				$bam_footer_container_class = 'container';
			}
			
		?>

		<div class="footer-widget-area clearfix <?php echo esc_attr( $bam_widget_area_class ); ?>">
			<div class="<?php echo esc_attr( $bam_footer_container_class ); ?>">
				<div class="footer-widget-area-inner">
					<div class="col column-1">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>

					<?php if ( $bam_footer_sidebar_count >= '2' ) : ?>
						<div class="col column-2">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $bam_footer_sidebar_count >= '3' ) : ?>
						<div class="col column-3">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $bam_footer_sidebar_count >= '4' ) : ?>
						<div class="col column-4">
							<?php dynamic_sidebar( 'footer-4' ); ?>
						</div>
					<?php endif; ?>
				</div><!-- .footer-widget-area-inner -->
			</div><!-- .container -->
		</div><!-- .footer-widget-area -->

		<div class="site-info clearfix">
			<div class="container">
				<div class="copyright-container">
					<?php 
						$bam_copyright_text = get_theme_mod( 'bam_footer_copyright_text', '' ); 

						if ( ! empty( $bam_copyright_text ) ) {
							echo wp_kses_post( $bam_copyright_text );
						} else {
							$bam_site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" >' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
							/* translators: 1: Year 2: Site URL. */
							printf( esc_html__( 'Copyright &#169; %1$s %2$s.', 'bam' ), date_i18n( 'Y' ), $bam_site_link ); // WPCS: XSS OK.
						}		
					?>

					<?php
						/* translators: 1: WordPress 2: Theme Author. */
						printf( esc_html__( 'Powered by %1$s and %2$s.', 'bam' ),
							'<a href="https://wordpress.org" target="_blank">WordPress</a>',
							'<a href="https://themezhut.com/themes/bam/" target="_blank">Bam</a>'
						); 
					?>
				</div><!-- .copyright-container -->
			</div><!-- .container -->
		</div><!-- .site-info -->

		<?php do_action( 'bam_footer_bottom' ); ?>

	</footer><!-- #colophon -->

	<?php do_action( 'bam_after_footer' ); ?>

</div><!-- #page -->

<?php do_action( 'bam_body_bottom' ); ?>

<?php wp_footer(); ?>
</body>
</html>