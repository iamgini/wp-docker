<?php
/**
 * Pages Customizer Settings
 */

if ( ! class_exists( 'Bam_Pages_Customizer' ) ) :

    class Bam_Pages_Customizer {

        /**
         * Setup class
         */
        public function __construct() {
            add_action( 'customize_register', array( $this, 'customizer_options' ) );
        }


        /**
         * Customizer options
         */
        public function customizer_options( $wp_customize ) {

            $images_uri = BAM_DIR_URI . '/inc/customizer/assets/images/'; 

            /**
             * Pages Section
             */
            $wp_customize->add_section(
                'bam_pages_section',
                array(
                    'title'			=> esc_html__( 'Pages', 'bam' ),
                    'priority'      => 128
                )
            );

            // Page Layout / Sidebar Alignment
            $wp_customize->add_setting(
                'bam_page_layout',
                array(
                    'default'			=> 'right-sidebar',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                new Bam_Radio_Image_Control( 
                    $wp_customize,
                    'bam_page_layout',
                    array(
                        'settings'		=> 'bam_page_layout',
                        'section'		=> 'bam_pages_section',
                        'label'			=> __( 'Page Layout', 'bam' ),
                        'choices'		=> array(
                            'right-sidebar'	        => $images_uri . '2cr.png',
                            'left-sidebar' 	        => $images_uri . '2cl.png',
                            'no-sidebar' 		    => $images_uri . '1c.png',
                            'center-content' 	    => $images_uri . '1cc.png'
                        )
                    )
                )
            );
        }

    }

endif;

return new Bam_Pages_Customizer();