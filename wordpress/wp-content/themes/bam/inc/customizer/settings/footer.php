<?php
/**
 * Footer Customizer Settings
 */

if ( ! class_exists( 'Bam_Footer_Customizer' ) ) :

    class Bam_Footer_Customizer {

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
             * Footer Panel
             */
            $wp_customize->add_panel(
                'bam_footer_panel',
                array(
                    'priority' 			=> 131,
                    'capability' 		=> 'edit_theme_options',
                    'theme_supports'	=> '',
                    'title' 			=> esc_html__( 'Footer', 'bam' ),
                )
            );
            
            /**
             * Footer Widgets Section
             */
            $wp_customize->add_section(
                'bam_footer_widget_section',
                array(
                    'title'			=> esc_html__( 'Footer Widgets', 'bam' ),
                    'panel'	        => 'bam_footer_panel'
                )
            );

            // Posts per row.
            $wp_customize->add_setting(
                'bam_footer_sidebar_count',
                array(
                    'default'			=> '3',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                'bam_footer_sidebar_count',
                array(
                    'settings'		=> 'bam_footer_sidebar_count',
                    'section'		=> 'bam_footer_widget_section',
                    'type'			=> 'select',
                    'label'			=> esc_html__( 'Widget Columns', 'bam' ),
                    'choices'		=> array(
                        '1'    => esc_html__( '1', 'bam' ),
                        '2'    => esc_html__( '2', 'bam' ),
                        '3'    => esc_html__( '3', 'bam' ),
                        '4'    => esc_html__( '4', 'bam' )
                    )
                )
            );

            // Footer widget area full width?
            $wp_customize->add_setting(
                'bam_footer_widgets_fullwidth',
                array(
                    'default'			=> false,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_footer_widgets_fullwidth',
                array(
                    'settings'		=> 'bam_footer_widgets_fullwidth',
                    'section'		=> 'bam_footer_widget_section',
                    'type'			=> 'checkbox',
                    'label'			=> esc_html__( 'Footer widget area fullwidth?', 'bam' ),
                )
            );

            // Widget area background color.
            $wp_customize->add_setting(
                'bam_footer_widget_area_bg_color',
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
                    'bam_footer_widget_area_bg_color',
                    array(
                        'settings'		    => 'bam_footer_widget_area_bg_color',
                        'section'		    => 'bam_footer_widget_section',
                        'label'			    => esc_html__( 'Widget Area Background Color', 'bam' ),
                    )
                )
            );

            // Widget area text color.
            $wp_customize->add_setting(
                'bam_footer_widget_area_text_color',
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
                    'bam_footer_widget_area_text_color',
                    array(
                        'settings'		    => 'bam_footer_widget_area_text_color',
                        'section'		    => 'bam_footer_widget_section',
                        'label'			    => esc_html__( 'Widget Area Text Color', 'bam' ),
                    )
                )
            );

            // Widget area link color.
            $wp_customize->add_setting(
                'bam_footer_widget_area_link_color',
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
                    'bam_footer_widget_area_link_color',
                    array(
                        'settings'		    => 'bam_footer_widget_area_link_color',
                        'section'		    => 'bam_footer_widget_section',
                        'label'			    => esc_html__( 'Widget Area Link Color', 'bam' ),
                    )
                )
            );

            // Widget area link color:hover.
            $wp_customize->add_setting(
                'bam_footer_widget_area_link_color_hover',
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
                    'bam_footer_widget_area_link_color_hover',
                    array(
                        'settings'		    => 'bam_footer_widget_area_link_color_hover',
                        'section'		    => 'bam_footer_widget_section',
                        'label'			    => esc_html__( 'Widget Area Link Color:Hover', 'bam' ),
                    )
                )
            );

            /**
             * Footer Bottom Section
             */
            $wp_customize->add_section(
                'bam_footer_bottom_section',
                array(
                    'title'			=> esc_html__( 'Footer Bottom', 'bam' ),
                    'panel'	        => 'bam_footer_panel'
                )
            );

            $wp_customize->add_setting(
                'bam_footer_copyright_text',
                array(
                    'default'			=> '',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_html'
                )
            );
            $wp_customize->add_control(
                'bam_footer_copyright_text',
                array(
                    'settings'		=> 'bam_footer_copyright_text',
                    'section'		=> 'bam_footer_bottom_section',
                    'type'			=> 'textarea',
                    'label'			=> __( 'Copyright Text', 'bam' )
                )
            );

            // Copyright area background color.
            $wp_customize->add_setting(
                'bam_footer_bottom_bg_color',
                array(
                    'default'			=> '#000000',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_footer_bottom_bg_color',
                    array(
                        'settings'		    => 'bam_footer_bottom_bg_color',
                        'section'		    => 'bam_footer_bottom_section',
                        'label'			    => esc_html__( 'Background Color', 'bam' ),
                    )
                )
            );

            // Copyright area text color.
            $wp_customize->add_setting(
                'bam_footer_bottom_text_color',
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
                    'bam_footer_bottom_text_color',
                    array(
                        'settings'		    => 'bam_footer_bottom_text_color',
                        'section'		    => 'bam_footer_bottom_section',
                        'label'			    => esc_html__( 'Text Color', 'bam' ),
                    )
                )
            );

            // Widget area link color.
            $wp_customize->add_setting(
                'bam_footer_bottom_link_color',
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
                    'bam_footer_bottom_link_color',
                    array(
                        'settings'		    => 'bam_footer_bottom_link_color',
                        'section'		    => 'bam_footer_bottom_section',
                        'label'			    => esc_html__( 'Link Color', 'bam' ),
                    )
                )
            );

            // Widget area link color:hover.
            $wp_customize->add_setting(
                'bam_footer_bottom_link_color_hover',
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
                    'bam_footer_bottom_link_color_hover',
                    array(
                        'settings'		    => 'bam_footer_bottom_link_color_hover',
                        'section'		    => 'bam_footer_bottom_section',
                        'label'			    => esc_html__( 'Link Color:Hover', 'bam' ),
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
            
            $widget_area_bg_color               = get_theme_mod( 'bam_footer_widget_area_bg_color', '#222222' );
            $widget_area_text_color             = get_theme_mod( 'bam_footer_widget_area_text_color', '#eeeeee' );
            $widget_area_link_color             = get_theme_mod( 'bam_footer_widget_area_link_color', '#eeeeee' );
            $widget_area_link_color_hover       = get_theme_mod( 'bam_footer_widget_area_link_color_hover', '#ff4f4f' );
            $bottom_bg_color                    = get_theme_mod( 'bam_footer_bottom_bg_color', '#000000' );
            $bottom_text_color                  = get_theme_mod( 'bam_footer_bottom_text_color', '#eeeeee' );
            $bottom_link_color                  = get_theme_mod( 'bam_footer_bottom_link_color', '#eeeeee' );
            $bottom_link_color_hover            = get_theme_mod( 'bam_footer_bottom_link_color_hover', '#ff4f4f' );

            $css = '';

            // Widget area bg color
            if ( ! empty( $widget_area_bg_color ) && '#222222' != $widget_area_bg_color ) {
                $css .= '
                    .footer-widget-area {
                        background: '. $widget_area_bg_color .';
                    }
                ';
            }

            // widget area text color.
            if ( ! empty( $widget_area_text_color ) && '#eeeeee' != $widget_area_text_color ) {
                $css .= '
                    .footer-widget-area .widget {
                        color: '. $widget_area_text_color .';
                    }
                ';
            }

            // widget area link color
            if ( ! empty( $widget_area_link_color ) && '#eeeeee' != $widget_area_link_color ) {
                $css .= '
                    .footer-widget-area .widget a {
                        color: '. $widget_area_link_color .';
                    }
                ';
            }

            // widget area link hover color
            if ( ! empty( $widget_area_link_color_hover ) && '#ff4f4f' != $widget_area_link_color_hover ) {
                $css .= '
                    .footer-widget-area .widget a:hover {
                        color: '. $widget_area_link_color_hover .';
                    }
                ';
            }

            // Footer bottom BG color
            if ( ! empty( $bottom_bg_color ) && '#000000' != $bottom_bg_color ) {
                $css .= '
                    .site-info {
                        background: '. $bottom_bg_color .';
                    }
                ';
            }

            // Footer bottom text color
            if ( ! empty( $bottom_text_color ) && '#eeeeee' != $bottom_text_color ) {
                $css .= '
                    .site-info {
                        color: '. $bottom_text_color .';
                    }
                ';
            }

            // Footer bottom link color
            if ( ! empty( $bottom_link_color ) && '#eeeeee' != $bottom_link_color ) {
                $css .= '
                    .site-info a {
                        color: '. $bottom_link_color .';
                    }
                ';
            }

            // Footer bottom link color:hover
            if ( ! empty( $bottom_link_color_hover ) && '#ff4f4f' != $bottom_link_color_hover ) {
                $css .= '
                    .site-info a:hover {
                        color: '. $bottom_link_color_hover .';
                    }
                ';
            }

            // Return CSS
            if ( ! empty( $css ) ) {
                $output .= '/* Footer CSS */'. $css;
            }

            // Return output css
            return $output;

        }

    }

endif;

return new Bam_Footer_Customizer();