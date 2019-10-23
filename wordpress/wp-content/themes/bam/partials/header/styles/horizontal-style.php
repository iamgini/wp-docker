<?php

// header classes array
$bam_header_classes = array( "clearfix" );

if ( 'contained' ==  get_theme_mod( 'bam_header_inner_width', 'contained' ) ) {
    $bam_header_classes[] = "container";
}  else {
    $bam_header_classes[] = "container-fluid";
}

$bam_header_classes = implode( ' ', $bam_header_classes ); 

// header image location
$bam_header_image_location = bam_header_image_location();
?>


<?php if ( $bam_header_image_location == 'before-site-title' || $bam_header_image_location == 'before-navigation' ) { bam_header_image(); } ?>

<div id="site-header-inner-wrap">
    <div id="site-header-inner" class="<?php echo esc_attr( $bam_header_classes ); ?>">
        <?php get_template_part( 'partials/header/logo' ); ?>
        <?php get_template_part( 'partials/header/nav' ); ?>
    </div>
</div>

<?php get_template_part( 'partials/mobile/mobile-dropdown' ); ?>

<?php if ( $bam_header_image_location == 'after-navigation' ) { bam_header_image(); } ?>

<?php get_sidebar( 'header-1' ); ?>