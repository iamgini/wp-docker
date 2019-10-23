<?php
/**
 * Header Customizer Settings
 */

if ( ! class_exists( 'Bam_TopBar_Customizer' ) ) :

    class Bam_TopBar_Customizer {

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
             * TopBar Panel
             */
            $wp_customize->add_panel(
                'bam_topbar_panel',
                array(
                    'priority' 			=> 127,
                    'capability' 		=> 'edit_theme_options',
                    'theme_supports'	=> '',
                    'title' 			=> esc_html__( 'Top Bar', 'bam' ),
                )
            );
        
            /**
             * TopBar General Section
             */
            $wp_customize->add_section(
                'bam_topbar_general_section',
                array(
                    'title'			    => esc_html__( 'General', 'bam' ),
                    'panel' 			=> 'bam_topbar_panel',
                )
            );

            // Display Top Bar?
            $wp_customize->add_setting(
                'bam_enable_topbar',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_enable_topbar',
                array(
                    'settings'		=> 'bam_enable_topbar',
                    'section'		=> 'bam_topbar_general_section',
                    'type'			=> 'checkbox',
                    'label'			=> esc_html__( 'Display Top Bar', 'bam' ),
                )
            );

            // Topbar Inner width
            $wp_customize->add_setting(
                'bam_topbar_inner_width',
                array(
                    'default'			=> 'contained',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                'bam_topbar_inner_width',
                array(
                    'settings'		=> 'bam_topbar_inner_width',
                    'section'		=> 'bam_topbar_general_section',
                    'type'			=> 'select',
                    'label'			=> esc_html__( 'Top Bar Width', 'bam' ),
                    'choices'		=> array(
                        'contained'	=> esc_html__( 'Contained', 'bam' ),
                        'full' 		=> esc_html__( 'Full Width', 'bam' )
                    ),
                    'active_callback'	=> 'bam_is_topbar_active'
                )
            );

            // Display Top Bar Date?
            $wp_customize->add_setting(
                'bam_show_topbar_date',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_show_topbar_date',
                array(
                    'settings'		    => 'bam_show_topbar_date',
                    'section'		    => 'bam_topbar_general_section',
                    'type'			    => 'checkbox',
                    'label'			    => esc_html__( 'Display Date', 'bam' ),
                    'active_callback'	=> 'bam_is_topbar_active'
                )
            );

            // Background Color.
            $wp_customize->add_setting(
                'bam_topbar_bg_color',
                array(
                    'default'			=> '#f5f5f5',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_topbar_bg_color',
                    array(
                        'settings'		    => 'bam_topbar_bg_color',
                        'section'		    => 'bam_topbar_general_section',
                        'label'			    => esc_html__( 'Background Color', 'bam' ),
                        'active_callback'	=> 'bam_is_topbar_active'
                    )
                )
            ); 

            // Text Color.
            $wp_customize->add_setting(
                'bam_topbar_text_color',
                array(
                    'default'			=> '#222222',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_topbar_text_color',
                    array(
                        'settings'		    => 'bam_topbar_text_color',
                        'section'		    => 'bam_topbar_general_section',
                        'label'			    => esc_html__( 'Text Color', 'bam' ),
                        'active_callback'	=> 'bam_is_topbar_active'
                    )
                )
            );            

            // Link Color.
            $wp_customize->add_setting(
                'bam_topbar_link_color',
                array(
                    'default'			=> '#222222',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_topbar_link_color',
                    array(
                        'settings'		    => 'bam_topbar_link_color',
                        'section'		    => 'bam_topbar_general_section',
                        'label'			    => esc_html__( 'Link Color', 'bam' ),
                        'active_callback'	=> 'bam_is_topbar_active'
                    )
                )
            );            

            // Link Color Hover.
            $wp_customize->add_setting(
                'bam_topbar_link_color_hover',
                array(
                    'default'			=> '#ff4f4f',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_topbar_link_color_hover',
                    array(
                        'settings'		    => 'bam_topbar_link_color_hover',
                        'section'		    => 'bam_topbar_general_section',
                        'label'			    => esc_html__( 'Link Color: Hover', 'bam' ),
                        'active_callback'	=> 'bam_is_topbar_active'
                    )
                )
            );        
            
            // Border Color.
            $wp_customize->add_setting(
                'bam_topbar_border_color',
                array(
                    'default'			=> '#eeeeee',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_topbar_border_color',
                    array(
                        'settings'		    => 'bam_topbar_border_color',
                        'section'		    => 'bam_topbar_general_section',
                        'label'			    => esc_html__( 'Border Color', 'bam' ),
                        'active_callback'	=> 'bam_is_topbar_active'
                    )
                )
            );   

            /**
             * Social Media Section.
             */
            $wp_customize->add_section(
                'bam_topbar_social_section',
                array(
                    'title'			    => esc_html__( 'Social', 'bam' ),
                    'panel' 			=> 'bam_topbar_panel',
                    'active_callback'	=> 'bam_is_topbar_active'
                )
            );

            // Display social media
            $wp_customize->add_setting(
                'bam_enable_topbar_social',
                array(
                    'default'			=> false,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_enable_topbar_social',
                array(
                    'settings'		=> 'bam_enable_topbar_social',
                    'section'		=> 'bam_topbar_social_section',
                    'type'			=> 'checkbox',
                    'label'			=> esc_html__( 'Display Social Media Icons', 'bam' ),
                )
            );

            // Social Media Style
            $wp_customize->add_setting(
                'bam_topbar_social_style',
                array(
                    'default'			=> 'colored',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                'bam_topbar_social_style',
                array(
                    'settings'		=> 'bam_topbar_social_style',
                    'section'		=> 'bam_topbar_social_section',
                    'type'			=> 'select',
                    'label'			=> esc_html__( 'Social Link Style', 'bam' ),
                    'choices'		=> array(
                        'colored'	=> esc_html__( 'Colored', 'bam' ),
                        'dark' 		=> esc_html__( 'Dark', 'bam' ),
                        'light'     => esc_html__( 'Light', 'bam' ),
                    ),
                    'active_callback' => 'bam_is_topbar_social_active',
                )
            );            

            // Social Media Dark Link Color.
            $wp_customize->add_setting(
                'bam_topbar_dark_social_color',
                array(
                    'default'			=> '#333333',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_topbar_dark_social_color',
                    array(
                        'settings'		    => 'bam_topbar_dark_social_color',
                        'section'		    => 'bam_topbar_social_section',
                        'label'			    => esc_html__( 'Social Links Color', 'bam' ),
                        'active_callback'	=> 'bam_is_topbar_social_dark_mode'
                    )
                )
            ); 

            // Social Media Dark Link Color:hover.
            $wp_customize->add_setting(
                'bam_topbar_dark_social_color_hover',
                array(
                    'default'			=> '#ff4f4f',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_topbar_dark_social_color_hover',
                    array(
                        'settings'		    => 'bam_topbar_dark_social_color_hover',
                        'section'		    => 'bam_topbar_social_section',
                        'label'			    => esc_html__( 'Social Links Color: Hover', 'bam' ),
                        'active_callback'	=> 'bam_is_topbar_social_dark_mode'
                    )
                )
            ); 

            // Social Media Light Link Color.
            $wp_customize->add_setting(
                'bam_topbar_light_social_color',
                array(
                    'default'			=> '#dddddd',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_topbar_light_social_color',
                    array(
                        'settings'		    => 'bam_topbar_light_social_color',
                        'section'		    => 'bam_topbar_social_section',
                        'label'			    => esc_html__( 'Social Links Color', 'bam' ),
                        'active_callback'	=> 'bam_is_topbar_social_light_mode'
                    )
                )
            ); 

            // Social Media Light Link Color:hover.
            $wp_customize->add_setting(
                'bam_topbar_light_social_color_hover',
                array(
                    'default'			=> '',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_topbar_light_social_color_hover',
                    array(
                        'settings'		    => 'bam_topbar_light_social_color_hover',
                        'section'		    => 'bam_topbar_social_section',
                        'label'			    => esc_html__( 'Social Links Color: Hover', 'bam' ),
                        'active_callback'	=> 'bam_is_topbar_social_light_mode'
                    )
                )
            ); 

            // Social Media Colored Link Color:hover.
            $wp_customize->add_setting(
                'bam_topbar_colored_social_color_hover',
                array(
                    'default'			=> '#222222',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_topbar_colored_social_color_hover',
                    array(
                        'settings'		    => 'bam_topbar_colored_social_color_hover',
                        'section'		    => 'bam_topbar_social_section',
                        'label'			    => esc_html__( 'Social Links Color: Hover', 'bam' ),
                        'active_callback'	=> 'bam_is_topbar_social_color_mode'
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

            $topbar_bg_color = get_theme_mod( 'bam_topbar_bg_color', '#ffffff' );
            $topbar_border_color = get_theme_mod( 'bam_topbar_border_color', '#eeeeee' );
            $topbar_text_color = get_theme_mod( 'bam_topbar_text_color', '#222222' );
            $topbar_link_color = get_theme_mod( 'bam_topbar_link_color', '#222222' );
            $topbar_link_color_hover = get_theme_mod( 'bam_topbar_link_color_hover', '#ff4f4f' );
            $topbar_social_style = get_theme_mod( 'bam_topbar_social_style', 'colored' );

            if ( 'dark' == $topbar_social_style ) {
                $topbar_social_color = get_theme_mod( 'bam_topbar_dark_social_color', '#333333' );
                $topbar_social_color_hover = get_theme_mod( 'bam_topbar_dark_social_color_hover', '#ff4f4f' );
            } elseif ( 'light' == $topbar_social_style ) {
                $topbar_social_color = get_theme_mod( 'bam_topbar_light_social_color', '#dddddd' );
                $topbar_social_color_hover = get_theme_mod( 'bam_topbar_light_social_color_hover', '' );               
            } else {
                $topbar_social_color = '';
                $topbar_social_color_hover = get_theme_mod( 'bam_topbar_colored_social_color_hover', '#222222' );
            }            

            $css = '';

            // background color
            if ( ! empty( $topbar_bg_color ) && '#ffffff' != $topbar_bg_color ) {
                $css .= '
                    .bam-topbar, .top-navigation ul ul {
                        background: '. $topbar_bg_color .';
                    }
                ';
            }

            // Border color
            if ( ! empty( $topbar_border_color ) && '#eeeeee' != $topbar_border_color ) {
                $css .= '
                    .bam-topbar {
                        border-bottom: 1px solid '. $topbar_border_color .';
                    }
                ';
            }

            // Text color
            if ( ! empty( $topbar_text_color ) && '#222222' != $topbar_text_color ) {
                $css .= '
                    .bam-topbar {
                        color: '. $topbar_text_color .';
                    }
                ';
            }

            // Link color
            if ( ! empty( $topbar_link_color ) && '#222222' != $topbar_link_color ) {
                $css .= '
                    .bam-topbar a {
                        color: '. $topbar_link_color .';
                    }
                ';
            }

            // Link color: Hover
            if ( ! empty( $topbar_link_color_hover ) && '#ff4f4f' != $topbar_link_color_hover ) {
                $css .= '
                    .bam-topbar a:hover {
                        color: '. $topbar_link_color_hover .';
                    }
                ';
            }

            // Social Media Link Colors
            if ( 'dark' == $topbar_social_style ) {

                if ( ! empty( $topbar_social_color ) && '#333333' != $topbar_social_color ) {
                    $css .= '
                        .bam-topbar-social.dark .bam-social-link i {
                            color: '. $topbar_social_color .';
                        }
                    ';
                }

                if ( ! empty( $topbar_social_color_hover ) && '#ff4f4f' != $topbar_social_color_hover ) {
                    $css .= '
                        .bam-topbar-social.dark .bam-social-link i:hover {
                            color: '. $topbar_social_color_hover .';
                        }
                    ';
                }

            } elseif ( 'light' == $topbar_social_style ) {

                if ( ! empty( $topbar_social_color ) && '#dddddd' != $topbar_social_color ) {
                    $css .= '
                        .bam-topbar-social.light .bam-social-link i {
                            color: '. $topbar_social_color .';
                        }
                    ';
                }

                if ( ! empty( $topbar_social_color_hover ) ) {
                    $css .= '
                        .bam-topbar-social.light .bam-social-link i:hover {
                            color: '. $topbar_social_color_hover .' !important;
                        }
                    ';   
                }             

            } elseif ( 'colored' == $topbar_social_style ) {

                if ( ! empty( $topbar_social_color_hover ) && '#222222' != $topbar_social_color_hover ) {
                    $css .= '
                        .bam-topbar-social.colored .bam-social-link i:hover {
                            color: '. $topbar_social_color_hover .';
                        }
                    ';
                }

            }

            // Return CSS
            if ( ! empty( $css ) ) {
                $output .= '/* Top Bar CSS */'. $css;
            }

            // Return output css
            return $output;
 
        }

    }

endif;

return new Bam_TopBar_Customizer();