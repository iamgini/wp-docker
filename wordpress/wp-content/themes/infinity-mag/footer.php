<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package infinity-mag
 */

?>
</div><!-- #content -->

    <?php $infinity_mag_footer_widgets_number = infinity_mag_get_option('number_of_footer_widget');
    if (1 == $infinity_mag_footer_widgets_number) {
        $col = 'col-md-12';
    } elseif (2 == $infinity_mag_footer_widgets_number) {
        $col = 'col-md-6';
    } elseif (3 == $infinity_mag_footer_widgets_number) {
        $col = 'col-md-4';
    } elseif (4 == $infinity_mag_footer_widgets_number) {
        $col = 'col-md-3';
    } else {
        $col = 'col-md-3';
    }
    if (is_active_sidebar('footer-col-one') || is_active_sidebar('footer-col-two') || is_active_sidebar('footer-col-three') || is_active_sidebar('footer-col-four')) { ?>
        <div class="footer-widget-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <span class="footer-divider footer-divider-top"></span>
                    </div>

                    <?php if (is_active_sidebar('footer-col-one') && $infinity_mag_footer_widgets_number > 0) : ?>
                        <div class="footer-widget-wrapper <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-one'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-two') && $infinity_mag_footer_widgets_number > 1) : ?>
                        <div class="footer-widget-wrapper <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-two'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-three') && $infinity_mag_footer_widgets_number > 2) : ?>
                        <div class="footer-widget-wrapper <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-three'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-four') && $infinity_mag_footer_widgets_number > 3) : ?>
                        <div class="footer-widget-wrapper <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-four'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php } ?>

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <span class="footer-divider"></span>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <?php if (has_nav_menu('social')) { ?>
                        <div class="twp-social-share">
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
                        </div>
                    <?php } ?>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <?php if (has_nav_menu('footer')) { ?>
                        <div class="site-footer-menu">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'footer',
                                'menu_id' => 'footer-menu',
                                'container' => 'div',
                                'depth' => 1,
                                'menu_class' => false
                            )); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-sm-12 col-xs-12">
                    <span class="footer-divider"></span>
                </div>

                <div class="col-sm-12 col-xs-12">
                    <div class="site-copyright">
                        <div class="row">
                            <div class="twp-equal">
                                <div class="col-md-4">
                                    <?php
                                    $infinity_mag_copyright_text = infinity_mag_get_option('copyright_text');
                                    if (!empty ($infinity_mag_copyright_text)) {
                                        echo wp_kses_post($infinity_mag_copyright_text);
                                    }
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <div class="footer-logo text-center">
                                        <?php infinity_mag_the_custom_logo(); ?>
                                        <span class="site-title secondary-font">
                                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                                <?php bloginfo('name'); ?>
                                            </a>
                                        </span>
                                        <?php $description = get_bloginfo('description', 'display');
                                        if ($description || is_customize_preview()) : ?>
                                            <p class="site-description"><?php echo $description; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="theme-info">
                                    <?php printf(esc_html__('Theme: %1$s by %2$s', 'infinity-mag'), 'Infinity Mag', '<a href="https://themeinwp.com/" target = "_blank" rel="designer">ThemeinWP </a>'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

</div><!-- #page -->


<?php if (is_active_sidebar('slide-menu')) : ?>
    <div id="sidr-nav">
        <div class="sidr-header">
            <div class="sidr-left">
                <?php infinity_mag_the_custom_logo(); ?>
                <span class="site-title secondary-font">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </span>
                <?php $description = get_bloginfo('description', 'display');
                if ($description || is_customize_preview()) : ?>
                    <p class="site-description"><?php echo $description; ?></p>
                <?php endif; ?>
            </div>
            <div class="sidr-right">
                <a class="sidr-class-sidr-button-close" href="#sidr-nav">
                    <span class="screen-reader-text"><?php esc_html_e('Close', 'infinity-mag');?></span>
                    <i class="fa fa-close"></i>
                </a>
            </div>
        </div>

        <!-- slider menu sidebar content -->
        <?php dynamic_sidebar('slide-menu'); ?>
    </div>
<?php endif; ?>


<a id="scroll-up">
    <span class="secondary-font">
        <span class="hidden-xs"><?php esc_html_e('scroll to top', 'infinity-mag'); ?></span> <i class="scroll-icon fa fa-long-arrow-right"></i>
    </span>
</a>

<?php wp_footer(); ?>

</body>
</html>