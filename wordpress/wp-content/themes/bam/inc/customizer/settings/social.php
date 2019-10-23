<?php
/**
 * Social Media Customizer Settings
 */

if ( ! class_exists( 'Bam_Social_Customizer' ) ) :

    class Bam_Social_Customizer {

        /**
         * Setup class
         */
        public function __construct() {
            add_action( 'customize_register', array( $this, 'customizer_options' ) );
            //add_filter( 'bam_head_css', array( $this, 'head_css' ) );
        }

        /**
         * Customizer options
         */
        public function customizer_options( $wp_customize ) {

            /**
             * Social Media Section
             */
            $wp_customize->add_section(
                'bam_social_section',
                array(
                    'title'			=> esc_html__( 'Social Media', 'bam' ),
                    'priority'		=> 130
                )
            );

            // Open social link in new window?
            $wp_customize->add_setting(
                'bam_social_new_window',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_social_new_window',
                array(
                    'settings'		=> 'bam_social_new_window',
                    'section'		=> 'bam_social_section',
                    'type'			=> 'checkbox',
                    'label'			=> esc_html__( 'Open social link in new Window?', 'bam' ),
                )
            );

            $social_options = bam_social_options();

            foreach ( $social_options as $key => $value ) {

                if ( $key == 'email' ) {
                    $sanitize_callback = 'bam_sanitize_email';
                    $type = 'email';
                } elseif ( $key == 'skype' ) {
                    $sanitize_callback = 'wp_filter_nohtml_kses';
                    $type = 'text';
                } else {
                    $sanitize_callback = 'bam_sanitize_url';
                    $type = 'url';
                }
                
                $wp_customize->add_setting(
                    'bam_social_profile_'. $key,
                    array(
                        'default'			=> '',
                        'type'				=> 'theme_mod',
                        'capability'		=> 'edit_theme_options',
                        'sanitize_callback'	=> $sanitize_callback
                    )
                );
                $wp_customize->add_control(
                    'bam_social_profile_'. $key,
                    array(
                        'settings'		=> 'bam_social_profile_'. $key,
                        'section'		=> 'bam_social_section',
                        'type'			=> $type,
                        'label'			=> $value['label'],
                    )
                );

            }
        }


    }

endif;

return new Bam_Social_Customizer();