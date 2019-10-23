<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bam
 */

$bam_layout = bam_get_layout();

if ( 'no-sidebar' == $bam_layout || 'center-content' == $bam_layout ) {
	return;
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<?php do_action( 'bam_before_sidebar' ); ?>

<aside id="secondary" class="widget-area">

	<?php do_action( 'bam_sidebar_top' ); ?>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>

	<?php do_action( 'bam_sidebar_bottom' ); ?>

</aside><!-- #secondary -->

<?php do_action( 'bam_after_sidebar' ); ?>