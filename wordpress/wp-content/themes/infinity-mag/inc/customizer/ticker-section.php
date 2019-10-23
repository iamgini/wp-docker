<?php
/**
 * ticker section
 *
 * @package infinity-mag
 */

$default = infinity_mag_get_default_theme_options();

// Ticker Main Section.
$wp_customize->add_section( 'ticker_section_settings',
	array(
		'title'      => esc_html__( 'Ticker Section', 'infinity-mag' ),
		'priority'   => 60,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_front_page_section',
	)
);


// Setting - show_ticker_section.
$wp_customize->add_setting( 'show_ticker_section',
	array(
		'default'           => $default['show_ticker_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'infinity_mag_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_ticker_section',
	array(
		'label'    => esc_html__( 'Enable Ticker', 'infinity-mag' ),
		'section'  => 'ticker_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

/*No of Slider*/
$wp_customize->add_setting('number_of_home_ticker',
	array(
		'default'           => $default['number_of_home_ticker'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'infinity_mag_sanitize_positive_integer',
	)
);
$wp_customize->add_control('number_of_home_ticker',
	array(
		'label'       => esc_html__('Select no of Ticker', 'infinity-mag'),
        'description'     => esc_html__( 'Number of Ticker to be shown the allowed range is 1 - 10', 'infinity-mag' ),

		'section'     => 'ticker_section_settings',
		'type'     => 'number',
		'priority' => 105,
		'input_attrs' => array('min' => 1, 'max' => 10, 'style' => 'width: 150px;'),
	)
);


// Setting - drop down category for ticker.
$wp_customize->add_setting( 'select_category_for_ticker',
	array(
		'default'           => $default['select_category_for_ticker'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Infinity_Mag_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_ticker',
	array(
        'label'           => esc_html__( 'Category for Ticker', 'infinity-mag' ),
        'description'     => esc_html__( 'Select category to be shown on ticker ', 'infinity-mag' ),
        'section'         => 'ticker_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 130,
    ) ) );


