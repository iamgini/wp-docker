<?php

$bam_menu_inner_classes = array();

// check if the navigation is contained or not. if contained add the "container" class to the "#site-navigation-inner"
if ( 'contained' == get_theme_mod( 'bam_nav_inner_width', 'contained' ) ) {
    $bam_menu_inner_classes[] = "container";
}

if ( 'horizontal-style' == bam_header_style() ) {
    if( ( $key = array_search( 'container', $bam_menu_inner_classes ) ) !== false ) {
        unset( $bam_menu_inner_classes[ $key ] );
    }
}

$bam_menu_inner_classes[] = get_theme_mod( 'bam_menu_align', 'align-left' );

$bam_display_search = get_theme_mod( 'bam_display_header_search', true ); 

if( true == $bam_display_search ) {
    $bam_menu_inner_classes[] = 'show-search';
}

$bam_menu_inner_classes = implode( ' ', $bam_menu_inner_classes ); 

?>

<nav id="site-navigation" class="main-navigation">

    <div id="site-navigation-inner" class="<?php echo esc_attr( $bam_menu_inner_classes ); ?>">
        
        <?php

            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
            ) );

            if ( true == $bam_display_search ) {
                get_template_part( 'partials/header/search-dropdown' );
            }

        ?>

        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars"></i><?php esc_html_e( 'Menu', 'bam' ); ?></button>
        
    </div><!-- .container -->
    
</nav><!-- #site-navigation -->