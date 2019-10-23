<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function infinity_mag_widgets_init()
{

    register_sidebar(array(
        'name' => esc_html__('Off-Canvas Widget', 'infinity-mag'),
        'id' => 'slide-menu',
        'description' => esc_html__('Add widgets here.', 'infinity-mag'),
        'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Top Header Advertise', 'infinity-mag'),
        'id' => 'top-header-add',
        'description' => esc_html__('Add widgets here.', 'infinity-mag'),
        'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Main Sidebar', 'infinity-mag'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'infinity-mag'),
        'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home Page Sidebar One', 'infinity-mag'),
        'id' => 'sidebar-home-1',
        'description' => esc_html__('Add widgets here.', 'infinity-mag'),
        'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home Page Sidebar Two', 'infinity-mag'),
        'id' => 'sidebar-home-2',
        'description' => esc_html__('Add widgets here.', 'infinity-mag'),
        'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    $infinity_mag_footer_widgets_number = infinity_mag_get_option('number_of_footer_widget');
    if ($infinity_mag_footer_widgets_number > 0) {
        register_sidebar(array(
            'name' => esc_html__('Footer Column One', 'infinity-mag'),
            'id' => 'footer-col-one',
            'description' => esc_html__('Displays items on footer section.', 'infinity-mag'),
            'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));
        if ($infinity_mag_footer_widgets_number > 1) {
            register_sidebar(array(
                'name' => esc_html__('Footer Column Two', 'infinity-mag'),
                'id' => 'footer-col-two',
                'description' => esc_html__('Displays items on footer section.', 'infinity-mag'),
                'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ));
        }
        if ($infinity_mag_footer_widgets_number > 2) {
            register_sidebar(array(
                'name' => esc_html__('Footer Column Three', 'infinity-mag'),
                'id' => 'footer-col-three',
                'description' => esc_html__('Displays items on footer section.', 'infinity-mag'),
                'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ));
        }
    }
}

add_action('widgets_init', 'infinity_mag_widgets_init');
