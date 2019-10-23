<?php
/**
 * Header Customizer Settings
 */

if ( ! class_exists( 'Bam_Header_Customizer' ) ) :

    class Bam_Header_Customizer {

        /**
         * Setup class
         */
        public function __construct() {
            add_action( 'customize_register', array( $this, 'customizer_options' ) );
            add_filter( 'bam_head_css', array( $this, 'head_css' ) );
        }

        /**
         * Customizer options
         */
        public function customizer_options( $wp_customize ) {

            /**
             * Header Panel
             */
            $wp_customize->add_panel(
                'bam_header_panel',
                array(
                    'priority' 			=> 126,
                    'capability' 		=> 'edit_theme_options',
                    'theme_supports'	=> '',
                    'title' 			=> esc_html__( 'Header', 'bam' ),
                )
            );
        
            /**
             * Header General Section
             */
            $wp_customize->add_section(
                'bam_header_general_section',
                array(
                    'title'			=> esc_html__( 'General', 'bam' ),
                    'panel'			=> 'bam_header_panel'
                )
            );

            // Logo Max Width
            $wp_customize->add_setting(
                'bam_logo_max_width_desktop',
                array(
                    'default'			=> '',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_number_blank'
                )
            );
            // Logo Max Width - Tab.
            $wp_customize->add_setting(
                'bam_logo_max_width_tablet',
                array(
                    'default'			=> '',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_number_blank'
                )
            );
            // Logo Max Width - Mobile.
            $wp_customize->add_setting(
                'bam_logo_max_width_mobile',
                array(
                    'default'			=> '',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_number_blank'
                )
            );
            $wp_customize->add_control( 
                new Bam_Responsive_Number_Control( $wp_customize, 'bam_logo_max_width',
                array(
                    'label'         => esc_html__( 'Logo Max Width (px)', 'bam' ),
                    'priority'      => 100,
                    'section'       => 'title_tagline',
                    'settings'      => array(
                        'desktop'   => 'bam_logo_max_width_desktop',
                        'tablet'    => 'bam_logo_max_width_tablet',
                        'mobile'    => 'bam_logo_max_width_mobile'
                    ),
                    'active_callback'	=> 'bam_has_custom_logo'
                )
            ) );

            // Logo Max Height
            $wp_customize->add_setting(
                'bam_logo_max_height_desktop',
                array(
                    'default'			=> '',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'absint'
                )
            );
            // Logo Max Height - Tab.
            $wp_customize->add_setting(
                'bam_logo_max_height_tablet',
                array(
                    'default'			=> '',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'absint'
                )
            );
            // Logo Max Height - Mobile.
            $wp_customize->add_setting(
                'bam_logo_max_height_mobile',
                array(
                    'default'			=> '',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'absint'
                )
            );
            $wp_customize->add_control( 
                new Bam_Responsive_Number_Control( $wp_customize, 'bam_logo_max_height',
                array(
                    'label'         => esc_html__( 'Logo Max Height (px)', 'bam' ),
                    'priority'      => 100,
                    'section'       => 'title_tagline',
                    'settings'      => array(
                        'desktop'   => 'bam_logo_max_height_desktop',
                        'tablet'    => 'bam_logo_max_height_tablet',
                        'mobile'    => 'bam_logo_max_height_mobile'
                    ),
                    'active_callback'	=> 'bam_has_custom_logo'
                )
            ) );
        
            // Header Style
            $wp_customize->add_setting(
                'bam_header_style',
                array(
                    'default'			=> 'default-style',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                'bam_header_style',
                array(
                    'settings'		=> 'bam_header_style',
                    'section'		=> 'bam_header_general_section',
                    'type'			=> 'select',
                    'label'			=> esc_html__( 'Header Style', 'bam' ),
                    'choices'		=> array(
                        'default-style'		=> esc_html__( 'Default Style', 'bam' ),
                        'horizontal-style' 	=> esc_html__( 'Horizontal Style', 'bam' )
                    )
                )
            );
        
            // Header Inner width
            $wp_customize->add_setting(
                'bam_header_inner_width',
                array(
                    'default'			=> 'contained',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                'bam_header_inner_width',
                array(
                    'settings'		=> 'bam_header_inner_width',
                    'section'		=> 'bam_header_general_section',
                    'type'			=> 'select',
                    'label'			=> esc_html__( 'Header Width', 'bam' ),
                    'choices'		=> array(
                        'contained'	=> esc_html__( 'Contained', 'bam' ),
                        'full' 		=> esc_html__( 'Full Width', 'bam' )
                    )
                )
            );
        
            // Header Height
            $wp_customize->add_setting( 
                'bam_header_height',
                array(
                    'default'           => 65,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'bam_sanitize_slider_number_input',
                )
            );
            $wp_customize->add_control( 
                new Bam_Slider_Control( $wp_customize, 'bam_header_height',
                array(
                    'label'         => esc_html__( 'Header Height (px)', 'bam' ),
                    'section'       => 'bam_header_general_section',
                    'settings'      => 'bam_header_height',
                    'choices'       => array(
                        'min'   => 30,
                        'max'   => 200,
                        'step'  => 1,
                    ),
                    'active_callback'	=> 'bam_is_horizontal_header_style'
                )
            ) );
        
            // Logo Alignment
            $wp_customize->add_setting(
                'bam_logo_alignment',
                array(
                    'default'			=> 'left-logo',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                'bam_logo_alignment',
                array(
                    'settings'		=> 'bam_logo_alignment',
                    'section'		=> 'bam_header_general_section',
                    'type'			=> 'select',
                    'label'			=> esc_html__( 'Logo Alignment', 'bam' ),
                    'choices'		=> array(
                        'left-logo'		=> esc_html__( 'Left', 'bam' ),
                        'center-logo'	=> esc_html__( 'Center', 'bam' ),
                        'right-logo'	=> esc_html__( 'Right', 'bam' )
                    ),
                    'active_callback'	=> 'bam_is_default_header_style'
                )
            );

            // Display header border bottom?
            $wp_customize->add_setting(
                'bam_header_border_bottom',
                array(
                    'default'			=> false,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_header_border_bottom',
                array(
                    'settings'		=> 'bam_header_border_bottom',
                    'section'		=> 'bam_header_general_section',
                    'type'			=> 'checkbox',
                    'label'			=> esc_html__( 'Header Border Bottom', 'bam' ),
                )
            );
        
            // Header image position
            $wp_customize->add_setting(
                'bam_header_image_location',
                array(
                    'default'			=> 'before-navigation',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                'bam_header_image_location',
                array(
                    'settings'		=> 'bam_header_image_location',
                    'section'		=> 'bam_header_general_section',
                    'type'			=> 'select',
                    'label'			=> esc_html__( 'Header Image Location', 'bam' ),
                    'choices'		=> array(
                        'before-navigation'	=> esc_html__( 'Before Menu', 'bam' ),
                        'after-navigation'	=> esc_html__( 'After Menu', 'bam' ),
                        'before-site-title'	=> esc_html__( 'Before Site Title', 'bam' ),
                        'header-background' => esc_html__( 'Display as Header Background', 'bam' )
                    ),
                    'active_callback'	=> 'bam_has_header_image'
                )
            );

            // Link header image to homepage?
            $wp_customize->add_setting(
                'bam_link_header_image',
                array(
                    'default'			=> false,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_link_header_image',
                array(
                    'settings'		    => 'bam_link_header_image',
                    'section'		    => 'bam_header_general_section',
                    'type'			    => 'checkbox',
                    'label'			    => esc_html__( 'Link header image to homepage.', 'bam' ),
                    'active_callback'	=> 'bam_is_not_header_background_image'
                )
            );

            // Header Padding Top
            $wp_customize->add_setting( 
                'bam_default_header_padding_top',
                array(
                    'default'           => 28,
                    'type'              => 'theme_mod',
                    'capablity'         => 'edit_theme_options',
                    'sanitize_callback' => 'absint',
                )
            );
            $wp_customize->add_control( 
                'bam_default_header_padding_top',
                array(
                    'settings'		    => 'bam_default_header_padding_top',
                    'section'		    => 'bam_header_general_section',
                    'type'			    => 'number',
                    'label'			    => esc_html__( 'Header Padding Top (px)', 'bam' ),
                    'description'	    => esc_html__( 'Default: 28px', 'bam' ),
                    'active_callback'	=> 'bam_is_default_header_style'
                )
            );

            // Header Padding Bottom
            $wp_customize->add_setting( 
                'bam_default_header_padding_bottom',
                array(
                    'default'           => 28,
                    'type'              => 'theme_mod',
                    'capablity'         => 'edit_theme_options',
                    'sanitize_callback' => 'absint',
                )
            );
            $wp_customize->add_control( 
                'bam_default_header_padding_bottom',
                array(
                    'settings'		    => 'bam_default_header_padding_bottom',
                    'section'		    => 'bam_header_general_section',
                    'type'			    => 'number',
                    'label'			    => esc_html__( 'Header Padding Bottom (px)', 'bam' ),
                    'description'	    => esc_html__( 'Default: 28px', 'bam' ),
                    'active_callback'	=> 'bam_is_default_header_style'
                )
            );

            // Header Padding Top
            $wp_customize->add_setting( 
                'bam_horizontal_header_padding_top',
                array(
                    'default'           => 0,
                    'type'              => 'theme_mod',
                    'capablity'         => 'edit_theme_options',
                    'sanitize_callback' => 'absint',
                )
            );
            $wp_customize->add_control( 
                'bam_horizontal_header_padding_top',
                array(
                    'settings'		    => 'bam_horizontal_header_padding_top',
                    'section'		    => 'bam_header_general_section',
                    'type'			    => 'number',
                    'label'			    => esc_html__( 'Header Padding Top (px)', 'bam' ),
                    'description'	    => esc_html__( 'Default: 0px', 'bam' ),
                    'active_callback'	=> 'bam_is_horizontal_header_style'
                )
            );

            // Header Padding Bottom
            $wp_customize->add_setting( 
                'bam_horizontal_header_padding_bottom',
                array(
                    'default'           => 0,
                    'type'              => 'theme_mod',
                    'capablity'         => 'edit_theme_options',
                    'sanitize_callback' => 'absint',
                )
            );
            $wp_customize->add_control( 
                'bam_horizontal_header_padding_bottom',
                array(
                    'settings'		    => 'bam_horizontal_header_padding_bottom',
                    'section'		    => 'bam_header_general_section',
                    'type'			    => 'number',
                    'label'			    => esc_html__( 'Header Padding Bottom (px)', 'bam' ),
                    'description'	    => esc_html__( 'Default: 0px', 'bam' ),
                    'active_callback'	=> 'bam_is_horizontal_header_style'
                )
            );

            // Header background color.
            $wp_customize->add_setting(
                'bam_default_header_bg_color',
                array(
                    'default'			=> '#ffffff',
                    'transport'         => 'postMessage',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color',
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_default_header_bg_color',
                    array(
                        'settings'		    => 'bam_default_header_bg_color',
                        'section'		    => 'bam_header_general_section',
                        'label'			    => esc_html__( 'Header Background Color', 'bam' ),
                        'active_callback'   => 'bam_is_default_header_style'
                    )
                )
            );

            // Header background color.
            $wp_customize->add_setting(
                'bam_horizontal_header_bg_color',
                array(
                    'default'			=> '#141414',
                    'transport'         => 'postMessage',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color',
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_horizontal_header_bg_color',
                    array(
                        'settings'		    => 'bam_horizontal_header_bg_color',
                        'section'		    => 'bam_header_general_section',
                        'label'			    => esc_html__( 'Header Background Color', 'bam' ),
                        'active_callback'   => 'bam_is_horizontal_header_style'
                    )
                )
            );
        
            // Border bottom color.
            $wp_customize->add_setting(
                'bam_header_border_bottom_color',
                array(
                    'default'			=> '#dddddd',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_header_border_bottom_color',
                    array(
                        'settings'		    => 'bam_header_border_bottom_color',
                        'section'		    => 'bam_header_general_section',
                        'label'			    => esc_html__( 'Border Bottom Color', 'bam' ),
                        'active_callback'   => 'bam_is_header_border_active'
                    )
                    
                )
            );

            /**
             *  Header Navigation Section
             */
            $wp_customize->add_section(
                'bam_header_nav_section',
                array(
                    'title'			=> esc_html__( 'Menu', 'bam' ),
                    'panel'			=> 'bam_header_panel'
                )
            );
        
            // Menu width
            $wp_customize->add_setting(
                'bam_nav_inner_width',
                array(
                    'default'			=> 'contained',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                'bam_nav_inner_width',
                array(
                    'settings'		=> 'bam_nav_inner_width',
                    'section'		=> 'bam_header_nav_section',
                    'type'			=> 'select',
                    'label'			=> esc_html__( 'Menu Width', 'bam' ),
                    'choices'		=> array(
                        'contained'	=> esc_html__( 'Contained', 'bam' ),
                        'full' 		=> esc_html__( 'Full Width', 'bam' )
                    ),
                    'active_callback' => 'bam_is_default_header_style',
                )
            );
        
            // Menu Height
            $wp_customize->add_setting( 
                'bam_menu_height',
                array(
                    'default'           => 50,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'bam_sanitize_slider_number_input',
                )
            );
            $wp_customize->add_control( 
                new Bam_Slider_Control( $wp_customize, 'bam_menu_height',
                array(
                    'label'         => esc_html__( 'Menu Height (px)', 'bam' ),
                    'section'       => 'bam_header_nav_section',
                    'settings'      => 'bam_menu_height',
                    'choices'       => array(
                        'min'   => 20,
                        'max'   => 200,
                        'step'  => 1,
                    ),
                    'active_callback'	=> 'bam_is_default_header_style',
                )
            ) );

            // Menu Align
            $wp_customize->add_setting(
                'bam_menu_align',
                array(
                    'default'			=> 'align-left',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select',
                )
            );
            $wp_customize->add_control(
                'bam_menu_align',
                array(
                    'settings'		=> 'bam_menu_align',
                    'section'		=> 'bam_header_nav_section',
                    'type'			=> 'select',
                    'label'			=> esc_html__( 'Menu Align', 'bam' ),
                    'choices'		=> array(
                        'align-left'    => esc_html__( 'Left', 'bam' ),
                        'align-center' 	=> esc_html__( 'Center', 'bam' ),
                        'align-right' 	=> esc_html__( 'Right', 'bam' )
                    ),
                    'active_callback'	=> 'bam_is_default_header_style'
                )
            );

            // Display Search bottom?
            $wp_customize->add_setting(
                'bam_display_header_search',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_display_header_search',
                array(
                    'settings'		=> 'bam_display_header_search',
                    'section'		=> 'bam_header_nav_section',
                    'type'			=> 'checkbox',
                    'label'			=> esc_html__( 'Display Search Box.', 'bam' ),
                )
            );

            // Default Menu Background Color.
            $wp_customize->add_setting(
                'bam_default_menu_bg_color',
                array(
                    'default'			=> '#141414',
                    'transport'         => 'postMessage',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_default_menu_bg_color',
                    array(
                        'settings'		    => 'bam_default_menu_bg_color',
                        'section'		    => 'bam_header_nav_section',
                        'label'			    => esc_html__( 'Menu Background Color', 'bam' ),
                        'active_callback'	=> 'bam_is_default_header_style'
                    )
                )
            );

            // Horizontal Menu Background Color.
            $wp_customize->add_setting(
                'bam_horizontal_menu_bg_color',
                array(
                    'default'			=> '',
                    'transport'         => 'postMessage',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_horizontal_menu_bg_color',
                    array(
                        'settings'		    => 'bam_horizontal_menu_bg_color',
                        'section'		    => 'bam_header_nav_section',
                        'label'			    => esc_html__( 'Menu Background Color', 'bam' ),
                        'active_callback'	=> 'bam_is_horizontal_header_style'
                    )
                )
            );

            // Menu Link Color.
            $wp_customize->add_setting(
                'bam_menu_link_color',
                array(
                    'default'			=> '#ffffff',
                    'transport'         => 'postMessage',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_menu_link_color',
                    array(
                        'settings'		    => 'bam_menu_link_color',
                        'section'		    => 'bam_header_nav_section',
                        'label'			    => esc_html__( 'Link Color', 'bam' ),
                    )
                )
            );

            // Menu Link Hover Color.
            $wp_customize->add_setting(
                'bam_menu_link_hover_color',
                array(
                    'default'			=> '#ff4f4f',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_menu_link_hover_color',
                    array(
                        'settings'		    => 'bam_menu_link_hover_color',
                        'section'		    => 'bam_header_nav_section',
                        'label'			    => esc_html__( 'Link Color: Hover', 'bam' ),
                    )
                )
            );

            // Menu Link Background Color.
            $wp_customize->add_setting(
                'bam_menu_link_bg_color',
                array(
                    'default'			=> '',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_menu_link_bg_color',
                    array(
                        'settings'		    => 'bam_menu_link_bg_color',
                        'section'		    => 'bam_header_nav_section',
                        'label'			    => esc_html__( 'Link Background Color', 'bam' ),
                    )
                )
            );

            // Menu Link Background Hover Color.
            $wp_customize->add_setting(
                'bam_menu_link_bg_hover_color',
                array(
                    'default'			=> '',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_menu_link_bg_hover_color',
                    array(
                        'settings'		    => 'bam_menu_link_bg_hover_color',
                        'section'		    => 'bam_header_nav_section',
                        'label'			    => esc_html__( 'Link Background Color: Hover', 'bam' ),
                    )
                )
            );

            /**
             * Dropdown
             */
            // Dropdown Menu Background Color.
            $wp_customize->add_setting(
                'bam_dropdown_menu_bg_color',
                array(
                    'default'			=> '#333333',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_dropdown_menu_bg_color',
                    array(
                        'settings'		    => 'bam_dropdown_menu_bg_color',
                        'section'		    => 'bam_header_nav_section',
                        'label'			    => esc_html__( 'Dropdown Menu Background Color', 'bam' ),
                    )
                )
            );

            // Dropdown Menu Link Color.
            $wp_customize->add_setting(
                'bam_dropdown_menu_link_color',
                array(
                    'default'			=> '#eeeeee',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_dropdown_menu_link_color',
                    array(
                        'settings'		    => 'bam_dropdown_menu_link_color',
                        'section'		    => 'bam_header_nav_section',
                        'label'			    => esc_html__( 'Dropdown Link Color', 'bam' ),
                    )
                )
            );

            // Dropdown Menu Link Hover Color.
            $wp_customize->add_setting(
                'bam_dropdown_menu_link_hover_color',
                array(
                    'default'			=> '#ffffff',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_dropdown_menu_link_hover_color',
                    array(
                        'settings'		    => 'bam_dropdown_menu_link_hover_color',
                        'section'		    => 'bam_header_nav_section',
                        'label'			    => esc_html__( 'Dropdown Link Color: Hover', 'bam' ),
                    )
                )
            );

            // Dropdown Menu Link Background Color.
            $wp_customize->add_setting(
                'bam_dropdown_menu_link_bg_color',
                array(
                    'default'			=> '',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_dropdown_menu_link_bg_color',
                    array(
                        'settings'		    => 'bam_dropdown_menu_link_bg_color',
                        'section'		    => 'bam_header_nav_section',
                        'label'			    => esc_html__( 'Dropdown Link Background Color', 'bam' ),
                    )
                )
            );

            // Menu Dropdown Link Background Hover Color.
            $wp_customize->add_setting(
                'bam_dropdown_menu_link_bg_hover_color',
                array(
                    'default'			=> '#ff4f4f',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_dropdown_menu_link_bg_hover_color',
                    array(
                        'settings'		    => 'bam_dropdown_menu_link_bg_hover_color',
                        'section'		    => 'bam_header_nav_section',
                        'label'			    => esc_html__( 'Dropdown Link Background Color: Hover', 'bam' ),
                    )
                )
            );
        }

        /**
		 * Get CSS
		 *
		 * @since 1.0.0
		 */
		public static function head_css( $output ) {

            // Define css var
            $css = '';

            $header_style = bam_header_style();

            $header_height                      = get_theme_mod( 'bam_header_height', 65 );
            $menu_height                        = get_theme_mod( 'bam_menu_height', 50 );
            $horizontal_header_bg_color         = get_theme_mod( 'bam_horizontal_header_bg_color', '#141414' );
            $default_header_bg_color            = get_theme_mod( 'bam_default_header_bg_color', '#ffffff' );
            $default_menu_bg_color              = get_theme_mod( 'bam_default_menu_bg_color', '#141414' );
            $horizontal_menu_bg_color           = get_theme_mod( 'bam_horizontal_menu_bg_color', '' );
            $link_color                         = get_theme_mod( 'bam_menu_link_color', '#ffffff' );
            $link_color_hover                   = get_theme_mod( 'bam_menu_link_hover_color', '#ff4f4f' );
            $link_bg_color                      = get_theme_mod( 'bam_menu_link_bg_color', '' );
            $link_bg_color_hover                = get_theme_mod( 'bam_menu_link_bg_hover_color', '' );
            $dropdown_menu_bg_color             = get_theme_mod( 'bam_dropdown_menu_bg_color', '#333333' );
            $dropdown_link_color                = get_theme_mod( 'bam_dropdown_menu_link_color', '#eeeeee' );
            $dropdown_link_color_hover          = get_theme_mod( 'bam_dropdown_menu_link_hover_color', '#ffffff' );
            $dropdown_link_bg_color             = get_theme_mod( 'bam_dropdown_menu_link_bg_color', '' );
            $dropdown_link_bg_color_hover       = get_theme_mod( 'bam_dropdown_menu_link_bg_hover_color', '#ff4f4f' );
            $default_header_padding_top         = get_theme_mod( 'bam_default_header_padding_top', 28 );
            $default_header_padding_bottom      = get_theme_mod( 'bam_default_header_padding_bottom', 28 );
            $horizontal_header_padding_top      = get_theme_mod( 'bam_horizontal_header_padding_top', 0 );
            $horizontal_header_padding_bottom   = get_theme_mod( 'bam_horizontal_header_padding_bottom', 0 );
            $logo_max_width_desktop             = get_theme_mod( 'bam_logo_max_width_desktop', '' );
            $logo_max_width_tablet              = get_theme_mod( 'bam_logo_max_width_tablet', '' );
            $logo_max_width_mobile              = get_theme_mod( 'bam_logo_max_width_mobile', '' );
            $logo_max_height_desktop            = get_theme_mod( 'bam_logo_max_height_desktop', '' );
            $logo_max_height_tablet             = get_theme_mod( 'bam_logo_max_height_tablet', '' );
            $logo_max_height_mobile             = get_theme_mod( 'bam_logo_max_height_mobile', '' );
            $header_image_location              = get_theme_mod( 'bam_header_image_location', 'before-navigation' );
            $header_border_bottom               = get_theme_mod( 'bam_header_border_bottom', false );
            $header_border_bottom_color         = get_theme_mod( 'bam_header_border_bottom_color', '#dddddd' );
            $header_image                       = get_header_image();


            // Header Image.
            if ( has_header_image() && 'header-background' == $header_image_location ) {
                $css .= '
                    .site-header,
                    .site-header.horizontal-style #site-header-inner-wrap {
                        background-image:url('. $header_image .');
                        background-position: center center;
                        background-size: cover;
                    }
                ';
            }

            // Header Border Bottom.
            if ( true == $header_border_bottom && ! empty( $header_border_bottom_color ) ) {
                $css .= '
                    .site-header {
                        border-bottom: 1px solid '. $header_border_bottom_color .';
                    }
                ';
            }

            // max logo width - desktop
            if ( ! empty( $logo_max_width_desktop ) ) {
                $css .= '
                    .site-logo-image img {
                        max-width: '. $logo_max_width_desktop .'px;
                    }
                ';
            }

            // max logo width - tablet
            if ( ! empty( $logo_max_width_tablet ) ) {
                $css .= '
                    @media( max-width: 767px ) {
                        .site-logo-image img {
                            max-width: '. $logo_max_width_tablet .'px;
                        }
                    }
                ';
            }

            // max logo width - mobile
            if ( ! empty( $logo_max_width_mobile ) ) {
                $css .= '
                    @media( max-width: 480px ) {
                        .site-logo-image img {
                            max-width: '. $logo_max_width_mobile .'px;
                        }
                    }
                ';
            }

            // max logo height - desktop
            if ( ! empty( $logo_max_height_desktop ) ) {
                $css .= '
                    .site-logo-image img {
                        max-height: '. $logo_max_height_desktop .'px;
                    }
                ';
            }

            // max logo height - tablet
            if ( ! empty( $logo_max_height_tablet ) ) {
                $css .= '
                    @media( max-width: 767px ) {
                        .site-logo-image img {
                            max-height: '. $logo_max_height_tablet .'px;
                        }
                    }
                ';
            }

            // max logo height - mobile
            if ( ! empty( $logo_max_height_mobile ) ) {
                $css .= '
                    @media( max-width: 480px ) {
                        .site-logo-image img {
                            max-height: '. $logo_max_height_mobile .'px;
                        }
                    }
                ';
            }

            // Default Style
            if ( 'default-style' == $header_style ) :

                if ( 50 != $menu_height ) {
                    $css .= '
                        .site-header.default-style .main-navigation ul li a, .site-header.default-style .bam-search-button-icon, .site-header.default-style .menu-toggle { line-height: '. $menu_height .'px; }
                        .site-header.default-style .main-navigation ul ul li a { line-height: 1.3; }
                        .site-header.default-style .bam-search-box-container { top: '. $menu_height .'px }
                    ';
                }

                if ( '#ffffff' != $default_header_bg_color && ! empty( $default_header_bg_color ) ) {
                    $css .= '
                        .site-header.default-style { background: '. $default_header_bg_color .'; }
                    ';
                }

                if ( ! empty( $default_menu_bg_color ) && '#141414' != $default_menu_bg_color ) {
                    $css .= '
                        .site-header.default-style .main-navigation { background: '. $default_menu_bg_color .'; }
                    ';
                }

                if ( ! empty( $link_color ) && '#ffffff' != $link_color ) {
                    $css .= '
                        .site-header.default-style .main-navigation ul li a { color: '. $link_color .'; }
                    ';
                }

                if ( ! empty( $link_color_hover ) && '#ff4f4f' != $link_color_hover ) {
                    $css .= '
                        .site-header.default-style .main-navigation ul li a:hover { color: '. $link_color_hover .'; }
                        .site-header.default-style .main-navigation .current_page_item > a, .site-header.default-style .main-navigation .current-menu-item > a, .site-header.default-style .main-navigation .current_page_ancestor > a, .site-header.default-style .main-navigation .current-menu-ancestor > a { color: '. $link_color_hover .'; }
                    ';
                }

                if ( ! empty( $link_bg_color ) ) {
                    $css .= '
                        .site-header.default-style .main-navigation ul li a { background-color: '. $link_bg_color .'; }
                    ';
                }

                if ( ! empty( $link_bg_color_hover ) ) {
                    $css .= '
                        .site-header.default-style .main-navigation ul li a:hover { background-color: '. $link_bg_color_hover .'; }
                        .site-header.default-style .main-navigation .current_page_item > a, .site-header.default-style .main-navigation .current-menu-item > a, .site-header.default-style .main-navigation .current_page_ancestor > a, .site-header.default-style .main-navigation .current-menu-ancestor > a { background-color: '. $link_bg_color_hover .'; }
                    ';
                }

                if( ! empty( $dropdown_menu_bg_color ) && '#333333' != $dropdown_menu_bg_color ) {
                    $css .= '
                        .site-header.default-style .main-navigation ul ul {
                            background-color: '. $dropdown_menu_bg_color .';
                        }
                    ';
                }

                if( ! empty( $dropdown_link_color ) && '#eeeeee' != $dropdown_link_color ) {
                    $css .= '
                        .site-header.default-style .main-navigation ul ul li a {
                            color: '. $dropdown_link_color .';
                        }
                    ';
                }

                if( ! empty( $dropdown_link_color_hover ) && '#ffffff' != $dropdown_link_color_hover ) {
                    $css .= '
                        .site-header.default-style .main-navigation ul ul li a:hover {
                            color: '. $dropdown_link_color_hover .';
                        }
                    ';
                }

                if( ! empty( $dropdown_link_bg_color ) ) {
                    $css .= '
                        .site-header.default-style .main-navigation ul ul li a {
                            background-color: '. $dropdown_link_bg_color .';
                        }
                    ';
                }

                if( ! empty( $dropdown_link_bg_color_hover ) && '#ff4f4f' != $dropdown_link_bg_color_hover ) {
                    $css .= '
                        .site-header.default-style .main-navigation ul ul li a:hover {
                            background-color: '. $dropdown_link_bg_color_hover .';
                        }
                    ';
                }

                if( 28 != $default_header_padding_top ) {
                    $css .= '
                        .site-header.default-style #site-header-inner {
                            padding-top: '. $default_header_padding_top .'px;
                        }
                    ';
                }

                if( 28 != $default_header_padding_bottom ) {
                    $css .= '
                        .site-header.default-style #site-header-inner {
                            padding-bottom: '. $default_header_padding_bottom .'px;
                        }
                    ';
                }

            endif; // Default style.



            // Horizontal Style 
            if ( 'horizontal-style' == $header_style ) :

                if ( 65 != $header_height && ! empty( $header_height ) ) {
                    $css .= '
                        .site-header.horizontal-style .site-branding-inner { height: '. $header_height .'px; }
                        .site-header.horizontal-style .main-navigation ul li a, .site-header.horizontal-style .bam-search-button-icon, .site-header.horizontal-style .menu-toggle { line-height: '. $header_height .'px; }
                        .site-header.horizontal-style .main-navigation ul ul li a { line-height: 1.3; }
                        .site-header.horizontal-style .bam-search-box-container { top: '. $header_height .'px; }
                    ';
                }

                if ( '#141414' != $horizontal_header_bg_color && ! empty( $horizontal_header_bg_color ) ) {
                    $css .= '
                        .site-header.horizontal-style #site-header-inner-wrap { background: '. $horizontal_header_bg_color .'; }
                    ';
                }

                if ( ! empty( $horizontal_menu_bg_color ) ) {
                    $css .= '
                        .site-header.horizontal-style .main-navigation { background: '. $horizontal_menu_bg_color .'; }
                    ';
                }

                if ( ! empty( $link_color ) && '#ffffff' != $link_color ) {
                    $css .= '
                        .site-header.horizontal-style .main-navigation ul li a { color: '. $link_color .'; }
                    ';
                }

                if ( ! empty( $link_color_hover ) && '#ff4f4f' != $link_color_hover ) {
                    $css .= '
                        .site-header.horizontal-style .main-navigation ul li a:hover { color: '. $link_color_hover .'; }
                        .site-header.horizontal-style .main-navigation .current_page_item > a, .site-header.horizontal-style .main-navigation .current-menu-item > a, .site-header.horizontal-style .main-navigation .current_page_ancestor > a, .site-header.horizontal-style .main-navigation .current-menu-ancestor > a { color: '. $link_color_hover .'; }
                    ';
                }

                if ( ! empty( $link_bg_color ) ) {
                    $css .= '
                        .site-header.horizontal-style .main-navigation ul li a { background-color: '. $link_bg_color .'; }
                    ';
                }

                if ( ! empty( $link_bg_color_hover ) ) {
                    $css .= '
                        .site-header.horizontal-style .main-navigation ul li a:hover { background-color: '. $link_bg_color_hover .'; }
                        .site-header.horizontal-style .main-navigation .current_page_item > a, .site-header.horizontal-style .main-navigation .current-menu-item > a, .site-header.horizontal-style .main-navigation .current_page_ancestor > a, .site-header.horizontal-style .main-navigation .current-menu-ancestor > a { background-color: '. $link_bg_color_hover .'; }
                    ';
                }

                if( ! empty( $dropdown_menu_bg_color ) && '#333333' != $dropdown_menu_bg_color ) {
                    $css .= '
                        .site-header.horizontal-style .main-navigation ul ul {
                            background-color: '. $dropdown_menu_bg_color .';
                        }
                    ';
                }

                if( ! empty( $dropdown_link_color ) && '#eeeeee' != $dropdown_link_color ) {
                    $css .= '
                        .site-header.horizontal-style .main-navigation ul ul li a {
                            color: '. $dropdown_link_color .';
                        }
                    ';
                }

                if( ! empty( $dropdown_link_color_hover ) && '#ff4f4f' != $dropdown_link_color_hover ) {
                    $css .= '
                        .site-header.horizontal-style .main-navigation ul ul li a:hover {
                            color: '. $dropdown_link_color_hover .';
                        }
                    ';
                }

                if( ! empty( $dropdown_link_bg_color ) && '#ffffff' != $dropdown_link_bg_color ) {
                    $css .= '
                        .site-header.horizontal-style .main-navigation ul ul li a {
                            background-color: '. $dropdown_link_bg_color .';
                        }
                    ';
                }

                if( ! empty( $dropdown_link_bg_color_hover ) && '#ff4f4f' != $dropdown_link_bg_color_hover ) {
                    $css .= '
                        .site-header.horizontal-style .main-navigation ul ul li a:hover {
                            background-color: '. $dropdown_link_bg_color_hover .';
                        }
                    ';
                }

                if( 0 != $horizontal_header_padding_top ) {
                    $css .= '
                        .site-header.horizontal-style #site-header-inner-wrap {
                            padding-top: '. $horizontal_header_padding_top .'px;
                        }
                    ';
                }

                if( 0 != $horizontal_header_padding_bottom ) {
                    $css .= '
                        .site-header.horizontal-style #site-header-inner-wrap {
                            padding-bottom: '. $horizontal_header_padding_bottom .'px;
                        }
                    ';
                }
                
            endif; // Horizontal style.


            // Return CSS
            if ( ! empty( $css ) ) {
                $output .= '/* Header CSS */'. $css;
            }

            // Return output css
            return $output;

        }

    }

endif;

return new Bam_Header_Customizer();