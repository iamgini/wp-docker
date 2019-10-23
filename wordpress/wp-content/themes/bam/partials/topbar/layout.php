<?php
/**
 * Top Bar Layout
 */

if ( 'contained' ==  get_theme_mod( 'bam_topbar_inner_width', 'contained' ) ) {
    $bam_topbar_container_class = "container";
} else {
    $bam_topbar_container_class = "container-fluid";
}

?>

<div id="topbar" class="bam-topbar clearfix">

    <div class="<?php echo esc_attr( $bam_topbar_container_class ); ?>">

        <?php if ( true == get_theme_mod( 'bam_show_topbar_date', true ) ) : ?>
            <span class="bam-date"><?php echo esc_html( date_i18n( get_option( 'date_format' ) ) ); ?></span>
        <?php endif; ?>

        <?php get_template_part( 'partials/topbar/nav' ); ?>

        <?php 
            // Social media icons
            if ( true == get_theme_mod( 'bam_enable_topbar_social', false ) ) {
                get_template_part( 'partials/topbar/social' ); 
            } 
        ?>

    </div>

</div>