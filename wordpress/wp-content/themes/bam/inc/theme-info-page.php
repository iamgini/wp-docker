<?php

function bam_enqueue_admin_scripts( $hook ) {
    if ( 'appearance_page_about-bam-theme' != $hook ) {
        return;
    }
    wp_register_style( 'bam-admin-css', get_template_directory_uri() . '/assets/css/admin.css', false, '1.0.0' );
    wp_enqueue_style( 'bam-admin-css' );
}
add_action( 'admin_enqueue_scripts', 'bam_enqueue_admin_scripts' );


function bam_add_themeinfo_page() {

    // Menu title can be displayed with recommended actions count.
    $menu_title = esc_html__( 'Bam Theme', 'bam' );

    add_theme_page( esc_html__( 'Bam Theme', 'bam' ), $menu_title , 'edit_theme_options', 'about-bam-theme', 'bam_themeinfo_page_render' );

}
add_action( 'admin_menu', 'bam_add_themeinfo_page' );


function bam_themeinfo_page_render() { ?>

    <div class="wrap about-wrap bm-info-wrap">

        <?php $theme_info = wp_get_theme(); ?>

        <h1 class="theme-info-heading"><?php esc_html_e( 'Welcome to Bam WordPress Theme', 'bam' ); ?></h1>

        <p><?php echo esc_html( $theme_info->get( 'Description' ) ); ?></p>

        <div class="bm-box-wrapper">
    
            <div class="bm-info-box">
                <div class="bm-info-box-inner">
                    <span class="dashicons dashicons-admin-generic"></span>
                    <h3 class="bm-info-title"><?php esc_html_e( 'Theme Settings', 'bam' ); ?></h3>
                    <p><?php esc_html_e( 'All the Bam theme settings are located at the customizer. Start customizing your website with customizer.', 'bam' ) ?></p>
                    <a class="button button-primary button-large" target="_blank" href="<?php echo esc_url( admin_url( '/customize.php' ) ); ?>"><?php esc_html_e( 'Go to customizer','bam' ); ?></a>
                </div>
            </div>

            <div class="bm-info-box">
                <div class="bm-info-box-inner">
                    <span class="dashicons dashicons-book-alt"></span>
                    <h3 class="bm-info-title"><?php esc_html_e( 'Theme Documentation', 'bam' ); ?></h3>
                    <p><?php esc_html_e( 'Need to learn all about Bam? Read the theme documentation carefully.', 'bam' ) ?></p>
                    <a class="button" target="_blank" href="<?php echo esc_url( 'https://themezhut.com/bam-wordpress-theme-documentation/' ); ?>"><?php esc_html_e( 'Read the documentation.','bam' ); ?></a>
                </div>
            </div>

            <div class="bm-info-box bm-clr">
                <div class="bm-info-box-inner">
                    <span class="dashicons dashicons-info"></span>
                    <h3 class="bm-info-title"><?php esc_html_e( 'Theme Info', 'bam' ); ?></h3>
                    <p><?php esc_html_e( 'Know all the details about Bam theme.', 'bam' ) ?></p>
                    <a class="button" target="_blank" href="<?php echo esc_url( 'https://themezhut.com/themes/bam/' ); ?>"><?php esc_html_e( 'Theme Details.','bam' ); ?></a>
                </div>
            </div>

            <div class="bm-info-box">
                <div class="bm-info-box-inner">
                    <span class="dashicons dashicons-visibility"></span>
                    <h3 class="bm-info-title"><?php esc_html_e( 'Theme Demo', 'bam' ); ?></h3>
                    <p><?php esc_html_e( 'See the theme preview of free version.', 'bam' ) ?></p>
                    <a class="button" target="_blank" href="<?php echo esc_url( 'https://themezhut.com/demo/bam/' ); ?>"><?php esc_html_e( 'Theme Preview','bam' ); ?></a>
                </div>
            </div>
    </div>

    </div><!-- .wrap .about-wrap -->

    <?php

}