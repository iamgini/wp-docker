<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package infinity-mag
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if (function_exists('wp_body_open')) {
    wp_body_open();
}
?>
<?php if (infinity_mag_get_option('enable_preloader_option') == 1) { ?>
    <div class="preloader">
        <div class="preloader-wrapper">
            <div class="loader">
                <span class="screen-reader-text"><?php esc_html_e('Loading...', 'infinity-mag'); ?></span>
            </div>
        </div>
    </div>
<?php } ?>
<div id="page" class="site site-bg">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'infinity-mag'); ?></a>
    <header id="masthead" class="site-header" role="banner">
        <div class="upper-header">
            <div class="container-fluid">
                <div class="col-md-5 col-xs-12">
                    <div class="twp-sidr">
                        <a id="widgets-nav" class="alt-bgcolor" href="#sidr-nav">
                            <span class="hamburger hamburger--arrow">
                                  <span class="hamburger-box">
                                    <span class="hamburger-inner">
                                       <small class="screen-reader-text"><?php esc_html_e('Toggle menu', 'infinity-mag');?></small>
                                    </span>
                                  </span>
                            </span>
                        </a>
                    </div>

                    <div class="site-branding">
                        <?php
                        if (is_front_page() && is_home()) : ?>
                            <span class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </span>
                        <?php else : ?>
                            <span class="site-title secondary-font">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                        <?php bloginfo('name'); ?>
                                    </a>
                                </span>
                        <?php endif;
                        infinity_mag_the_custom_logo();
                        $description = get_bloginfo('description', 'display');
                        if ($description || is_customize_preview()) : ?>
                            <p class="site-description"><?php echo $description; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ( is_active_sidebar( 'top-header-add' ) ) { ?>
                    <div class="col-md-7 col-xs-12">
                        <?php dynamic_sidebar( 'top-header-add' ); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="site-navigation">
            <?php
            $navigation_collaps_enable = absint(infinity_mag_get_option('show_navigation_collaps'));
            ?>
            <div class="container-fluid">
                <div class="col-sm-12">
                        <nav class="main-navigation" role="navigation">
                            <span class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                                 <span class="screen-reader-text"><?php esc_html_e('Primary Menu', 'infinity-mag'); ?></span>
                                <i class="ham"></i>
                            </span>
                            <?php wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_id' => 'primary-menu',
                                'container' => 'div',
                                'container_class' => 'menu'
                            )); ?>

                            <div class="nav-right">
                                <span class="icon-search">
                                    <i class="twp-icon fa fa-search"></i>
                                </span>

                                <?php if (has_nav_menu('social')) { ?>
                                    <div class="social-icons ">
                                        <?php
                                        wp_nav_menu(
                                            array('theme_location' => 'social',
                                                'link_before' => '<span class="screen-reader-text">',
                                                'link_after' => '</span>',
                                                'menu_id' => 'social-menu',
                                                'fallback_cb' => false,
                                                'menu_class' => 'twp-social-nav',
                                                'container_class' => 'social-menu-container'
                                            )); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </nav>
                        <!-- #site-navigation -->

                    </div>
            </div>
        </div>

    </header>

    <div class="popup-search">
        <div class="table-align">
            <div class="table-align-cell v-align-middle">
                <?php get_search_form(); ?>
            </div>
        </div>
        <div class="close-popup"></div>
    </div>

<!-- Innerpage Header Begins Here -->
<?php
if (is_front_page()) {
    do_action( 'infinity_mag_action_ticker_section' );

    /**
     * infinity_mag_action_front_page hook
     * @since infinity-mag 0.0.2
     *
     * @hooked infinity_mag_action_front_page -  10
     * @sub_hooked infinity_mag_action_front_page -  10
     */
    do_action( 'infinity_mag_action_front_page' );
} else {
    do_action('infinity-mag-page-inner-title');
}
?>
<!-- Innerpage Header Ends Here -->
<div id="content" class="site-content">