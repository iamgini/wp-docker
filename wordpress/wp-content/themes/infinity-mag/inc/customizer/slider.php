<?php
/**
 * slider section
 *
 * @package infinity-mag
 */

$default = infinity_mag_get_default_theme_options();

// Slider Main Section.
$wp_customize->add_section( 'slider_section_settings',
	array(
		'title'      => esc_html__( 'Slider Section', 'infinity-mag' ),
		'priority'   => 60,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_front_page_section',
	)
);


// Setting - show_slider_section.
$wp_customize->add_setting( 'show_slider_section',
	array(
		'default'           => $default['show_slider_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'infinity_mag_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_slider_section',
	array(
		'label'    => esc_html__( 'Enable Slider', 'infinity-mag' ),
		'section'  => 'slider_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

$wp_customize->add_setting( 'slider_style_option',
	array(
		'default'           => $default['slider_style_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'infinity_mag_sanitize_select',
	)
);
$wp_customize->add_control( 'slider_style_option',
	array(
		'label'    => esc_html__( 'Slider Structure', 'infinity-mag' ),
		'section'  => 'slider_section_settings',
		'choices'  => array(
                'single-slider' => esc_html__( 'Single Slider', 'infinity-mag' ),
                'carousel-slider' => esc_html__( 'Carousel Slider', 'infinity-mag' ),
		    ),
		'type'     => 'select',
		'priority' => 100,
	)
);


$wp_customize->add_setting( 'slider_layout_option',
	array(
		'default'           => $default['slider_layout_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'infinity_mag_sanitize_select',
	)
);
$wp_customize->add_control( 'slider_layout_option',
	array(
		'label'    => esc_html__( 'Slider Layout', 'infinity-mag' ),
		'section'  => 'slider_section_settings',
		'choices'  => array(
                'full-width' => esc_html__( 'Full Width', 'infinity-mag' ),
                'boxed' => esc_html__( 'Boxed', 'infinity-mag' ),
		    ),
		'type'     => 'select',
		'priority' => 100,
	)
);

// Setting - drop down category for slider.
$wp_customize->add_setting( 'select_category_for_slider',
	array(
		'default'           => $default['select_category_for_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Infinity_Mag_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_slider',
	array(
        'label'           => esc_html__( 'Category for slider', 'infinity-mag' ),
        'description'     => esc_html__( 'Select category to be shown on tab ', 'infinity-mag' ),
        'section'         => 'slider_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 130,
    ) ) );


