<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bam
 */

if ( ! is_active_sidebar( 'header-sidebar-1' ) ) {
	return;
}
// It is good to have a content alingment for header sidebar.
?>

<div class="header-sidebar">
    <div class="header-sidebar-inner">
        <?php dynamic_sidebar( 'header-sidebar-1' ); ?>
    </div><!-- .header-sidebar-inner -->
</div><!-- .header-sidebar -->
