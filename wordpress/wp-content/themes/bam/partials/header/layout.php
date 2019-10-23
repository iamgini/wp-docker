<?php
/**
 * Header Layout
 */
?>

<?php $header_style = bam_header_style(); ?>

<?php do_action( 'bam_before_header' ); ?>

<header id="masthead" class="site-header <?php echo esc_attr( $header_style ); ?>">

    <?php do_action( 'bam_header_top' ); ?>

    <?php 
        switch ( $header_style ) {
            case 'default-style':
                get_template_part( 'partials/header/styles/default-style' );
                break;

            case 'horizontal-style':
                get_template_part( 'partials/header/styles/horizontal-style' );
                break;
            
            default:
                get_template_part( 'partials/header/styles/default-style' );
                break;
        }
    ?>

    <?php do_action( 'bam_header_bottom' ); ?>

    <?php
		// If header image available.
		if ( has_header_image() ) { ?>
			<div class="bam-header-bg"></div>
    <?php } ?>
     
</header><!-- #masthead -->

<?php do_action( 'bam_after_header' ); ?>