<?php
/**
 * General Customizer Settings
 */

if ( ! class_exists( 'Bam_General_Customizer' ) ) :

    class Bam_General_Customizer {

        /**
         * Setup class
         */
        public function __construct() {
            add_action( 'customize_register', array( $this, 'customizer_options' ) );
            add_action( 'bam_head_css', array( $this, 'head_css' ) );
        }

        /**
         * Customizer options
         */
        public function customizer_options( $wp_customize ) {
            
            /**
             * Section
             */
            $wp_customize->add_section(
                'bam_general_section',
                array(
                    'priority'		=> 125,
                    'title'			=> esc_html__( 'General Options', 'bam' ),
                )
            );

            $wp_customize->add_setting(
                'bam_site_layout',
                array(
                    'default'			=> 'boxed-layout',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                'bam_site_layout',
                array(
                    'settings'		=> 'bam_site_layout',
                    'section'		=> 'bam_general_section',
                    'type'			=> 'select',
                    'label'			=> esc_html__( 'Site Layout', 'bam' ),
                    'choices'		=> array(
                        'wide-layout'	=> esc_html__( 'Wide', 'bam' ),
                        'boxed-layout' 	=> esc_html__( 'Boxed', 'bam' )
                    )
                )
            );

            // Content Layout
            $wp_customize->add_setting(
                'bam_content_layout',
                array(
                    'default'			=> 'one-container',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                'bam_content_layout',
                array(
                    'settings'		=> 'bam_content_layout',
                    'section'		=> 'bam_general_section',
                    'type'			=> 'select',
                    'label'			=> esc_html__( 'Content Layout', 'bam' ),
                    'choices'		=> array(
                        'one-container'	        => esc_html__( 'Single Container', 'bam' ),
                        'separate-containers' 	=> esc_html__( 'Separate Containers', 'bam' )
                    )
                )
            );

            // Site container width
            $wp_customize->add_setting( 
                'bam_container_width',
                array(
                    'default'           => 1320,
                    'sanitize_callback' => 'bam_sanitize_slider_number_input',
                    'transport'         => 'postMessage'
                )
            );
            $wp_customize->add_control( 
                new Bam_Slider_Control( $wp_customize, 'bam_container_width',
                array(
                    'label'         => esc_html__( 'Container Width (px)', 'bam' ),
                    'section'       => 'bam_general_section',
                    'choices'       => array(
                        'min'   => 700,
                        'max'   => 2000,
                        'step'  => 1,
                    ),
                    'active_callback' => 'bam_is_wide_layout_active'
                )
            ) );

            // Boxed width
            $wp_customize->add_setting( 
                'bam_boxed_width',
                array(
                    'default'           => 1400,
                    'sanitize_callback' => 'bam_sanitize_slider_number_input',
                    'transport'         => 'postMessage'
                )
            );
            $wp_customize->add_control( 
                new Bam_Slider_Control( $wp_customize, 'bam_boxed_width',
                array(
                    'label'         => esc_html__( 'Boxed Width (px)', 'bam' ),
                    'section'       => 'bam_general_section',
                    'choices'       => array(
                        'min'   => 700,
                        'max'   => 2000,
                        'step'  => 1,
                    ),
                    'active_callback' => 'bam_is_boxed_layout_active'
                )
            ) );

            // Site Content width
            $wp_customize->add_setting( 
                'bam_content_width',
                array(
                    'default'           => 72,
                    'sanitize_callback' => 'bam_sanitize_slider_number_input',
                    'transport'         => 'postMessage'
                )
            );
            $wp_customize->add_control( 
                new Bam_Slider_Control( $wp_customize, 'bam_content_width',
                array(
                    'label'         => esc_html__( 'Content Width (%)', 'bam' ),
                    'section'       => 'bam_general_section',
                    'choices'       => array(
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ),
                )
            ) );

            // Sidebar width
            $wp_customize->add_setting( 
                'bam_sidebar_width',
                array(
                    'default'           => 28,
                    'sanitize_callback' => 'bam_sanitize_slider_number_input',
                    'transport'         => 'postMessage'
                )
            );
            $wp_customize->add_control( 
                new Bam_Slider_Control( $wp_customize, 'bam_sidebar_width',
                array(
                    'label'         => esc_html__( 'Sidebar Width (%)', 'bam' ),
                    'section'       => 'bam_general_section',
                    'choices'       => array(
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ),
                )
            ) );

        }


        /**
		 * Get CSS
		 *
		 * @since 1.0.0
		 */
		public static function head_css( $output ) {

            // Define css var
            $css = '';

            $site_layout = get_theme_mod( 'bam_site_layout', 'boxed-layout' );
            $container_width = get_theme_mod( 'bam_container_width', 1320 );
            $boxed_width = get_theme_mod( 'bam_boxed_width', 1400 );
            $content_width = get_theme_mod( 'bam_content_width', 72 );
            $sidebar_width = get_theme_mod( 'bam_sidebar_width', 28 );

            if ( 'wide-layout' == $site_layout && 1320 != $container_width && ! empty( $container_width ) ) {
                $css .= '
                    .container {
                        width: '. $container_width .'px;
                    }
                ';
            }
            
            if ( 'boxed-layout' == $site_layout && 1400 != $boxed_width && ! empty( $boxed_width ) ) {
                $css .= '
                    body.boxed-layout #page {
                        max-width: '. $boxed_width .'px;
                    }
                ';
            }

            if ( 72 != $content_width && ! empty( $content_width ) ) {
                $css .= '
                    @media ( min-width: 768px ) {
                        #primary {
                            width: '. $content_width .'%;
                        }
                    }
                ';
            }

            if ( 28 != $sidebar_width && ! empty( $sidebar_width ) ) {
                $css .= '
                    @media ( min-width: 768px ) {
                        #secondary {
                            width: '. $sidebar_width .'%;
                        }
                    }
                ';
            }

            // Return CSS
            if ( ! empty( $css ) ) {
                $output .= '/* Header CSS */'. $css;
            }

            // Return output css
            return $output;

        }
    }

endif;

return new Bam_General_Customizer();