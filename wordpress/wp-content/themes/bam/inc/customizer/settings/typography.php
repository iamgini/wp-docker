<?php
/**
 * Typography Customizer Settings
 */

if ( ! class_exists( 'Bam_Typography_Customizer' ) ) :

    class Bam_Typography_Customizer {

        /**
         * Setup class
         */
        public function __construct() {
            add_action( 'customize_register', array( $this, 'customizer_options' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'load_fonts' ) );
            add_filter( 'bam_head_css', array( $this, 'head_css' ) );
        }

        /**
         * Array of elements.
         * 
         * @return array 
         */
        public function elements() {

            return apply_filters( 'bam_typography_elements', array (
                'body'  => array(
                    'title'     => esc_html__( 'Body', 'bam' ),
                    'target'    => 'body, button, input, select, optgroup, textarea',
                    'defaults'  => array(
                        'font-family'   => 'Source Sans Pro',
                        'font-size'     => array(
                            'desktop'   => '18px'
                        ),
                        'line-height'   => 1.5,
                        'color'         => '#404040'
                    )
                ),

                'headings'  => array(
                    'title'     => esc_html__( 'All Headings', 'bam' ),
                    'target'    => 'h1, h2, h3, h4, h5, h6, .site-title, .bam-entry .entry-title a, .widget-title, .entry-title, .related-section-title, .related-post-title a, .single .entry-title, .archive .page-title',
                    'defaults'  => array(
                        'font-family'   => 'Roboto Condensed',
                        'line-height'   => 1.3,
                        'color'         => '#000000'
                    ),
                    'exclude'   => array( 'font-size' ),
                ),

                'h1'  => array(
                    'title'     => esc_html__( 'Heading 1 (h1)', 'bam' ),
                    'target'    => 'h1',
                    'defaults'  => array(
                        'font-size'     => array(
                            'desktop'   => '36px'
                        ),
                        'line-height'   => 1.3,
                        'color'         => '#000000'
                    )
                ),

                'h2'  => array(
                    'title'     => esc_html__( 'Heading 2 (h2)', 'bam' ),
                    'target'    => 'h2',
                    'defaults'  => array(
                        'font-size'     => array(
                            'desktop'   => '32px'
                        ),
                        'line-height'   => 1.3,
                        'color'         => '#000000'
                    )
                ),

                'h3'  => array(
                    'title'     => esc_html__( 'Heading 3 (h3)', 'bam' ),
                    'target'    => 'h3',
                    'defaults'  => array(
                        'font-size'     => array(
                            'desktop'   => '28px'
                        ),
                        'line-height'   => 1.3,
                        'color'         => '#000000'
                    )
                ),

                'h4'  => array(
                    'title'     => esc_html__( 'Heading 4 (h4)', 'bam' ),
                    'target'    => 'h4',
                    'defaults'  => array(
                        'font-size'     => array(
                            'desktop'   => '24px'
                        ),
                        'line-height'   => 1.3,
                        'color'         => '#000000'
                    )
                ),

                'logo'  => array(
                    'title'     => esc_html__( 'Logo', 'bam' ),
                    'target'    => '.site-title, .site-header.horizontal-style .site-title',
                    'defaults'  => array(
                        'font-size'     => array(
                            'desktop'   => '44px'
                        ),
                        'line-height'   => 1.2
                    ), 
                    'exclude'   => array( 'color' ),
                ),

                'menu'  => array(
                    'title'     => esc_html__( 'Main Menu', 'bam' ),
                    'target'    => '.main-navigation li a',
                    'defaults'  => array(
                        'font-size'     => array(
                            'desktop'   => '16px'
                        ),
                    ),
                    'exclude'   => array( 'line-height', 'color' )
                ),

                'dropdown_menu'  => array(
                    'title'     => esc_html__( 'Main Menu ( Drop Down )', 'bam' ),
                    'target'    => '.main-navigation ul ul a, .site-header.default-style .main-navigation ul ul a, .site-header.horizontal-style .main-navigation ul ul a',
                    'defaults'  => array(
                        'font-size'     => array(
                            'desktop'   => '16px'
                        ),
                        'line-height'   => 1.3
                    ),
                    'exclude'   => array( 'color' )
                ),

                'blog_entry_title'  => array(
                    'title'     => esc_html__( 'Blog Entry Title', 'bam' ),
                    'target'    => '.bam-entry .entry-title a',
                    'defaults'  => array(
                        'font-size'     => array(
                            'desktop'   => '25px'
                        ),
                        'line-height'   => 1.3,
                        'color'         => '#000000'
                    )
                ),

                'post_entry_title'  => array(
                    'title'     => esc_html__( 'Single Post Entry Title', 'bam' ),
                    'target'    => '.single .entry-title',
                    'defaults'  => array(
                        'font-size'     => array(
                            'desktop'   => '36px'
                        ),
                        'line-height'   => 1.3,
                        'color'         => '#000000'
                    )
                ),

                'single_post_body'  => array(
                    'title'     => esc_html__( 'Single Post Content', 'bam' ),
                    'target'    => '.single-post article.type-post',
                    'defaults'  => array(
                        'font-size'     => array(
                            'desktop'   => '18px'
                        ),
                        'line-height'   => 1.7,
                        'color'         => '#404040'
                    )
                ),

                'page_entry_title'  => array(
                    'title'     => esc_html__( 'Page Title', 'bam' ),
                    'target'    => '.page-entry-title',
                    'defaults'  => array(
                        'font-size'     => array(
                            'desktop'   => '36px'
                        ),
                        'line-height'   => 1.3,
                        'color'         => '#000000'
                    )
                ),

                'widget_title'  => array(
                    'title'     => esc_html__( 'Widget Title', 'bam' ),
                    'target'    => '.widget-title',
                    'defaults'  => array(
                        'font-size'     => array(
                            'desktop'   => '21px'
                        ),
                        'line-height'   => 1.3,
                        'color'         => '#000000'
                    )
                ),

                )
            );

        }

        /**
         * Customizer options
         */
        public function customizer_options( $wp_customize ) {
            /**
             * Typography Panel
             */
            $wp_customize->add_panel(
                'bam_typography_panel',
                array(
                    'priority' 			=> 129,
                    'capability' 		=> 'edit_theme_options',
                    'theme_supports'	=> '',
                    'title' 			=> esc_html__( 'Typography', 'bam' ),
                )
            );

            /**
             * General Section
             */
            $wp_customize->add_section(
                'bam_general_typography_section',
                array(
                    'title'			=> esc_html__( 'General', 'bam' ),
                    'panel'			=> 'bam_typography_panel'
                )
            );

            // Disable google fonts?
            $wp_customize->add_setting(
                'bam_disable_google_fonts',
                array(
                    'default'			=> false,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_disable_google_fonts',
                array(
                    'settings'		=> 'bam_disable_google_fonts',
                    'section'		=> 'bam_general_typography_section',
                    'type'			=> 'checkbox',
                    'label'			=> esc_html__( 'Disable Google Fonts', 'bam' ),
                )
            );

            // Font Subsets
            $wp_customize->add_setting(
                'bam_font_subsets',
                array(
                    'default'           => array( 'latin' ),
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'bam_sanitize_multiple_checkboxes'
                )
            );
        
            $wp_customize->add_control(
                new Bam_Multiple_Checkboxes(
                    $wp_customize,
                    'bam_font_subsets',
                    array(
                        'section' => 'bam_general_typography_section',
                        'label'   => esc_html__( 'Font Subsets', 'bam' ),
                        'choices' => array(
                            'latin'         => esc_html__( 'latin', 'bam' ),
                            'latin-ext'     => esc_html__( 'latin-ext', 'bam' ),
                            'cyrillic'      => esc_html__( 'cyrillic', 'bam' ),
                            'cyrillic-ext'  => esc_html__( 'cyrillic-ext', 'bam' ),
                            'greek'         => esc_html__( 'greek', 'bam' ),
                            'greek-ext'     => esc_html__( 'greek-ext', 'bam' ),
                            'vietnamese'    => esc_html__( 'vietnamese', 'bam' ),
                        )
                    )
                )
            );

            // Get all the typography elements
            $elements = $this->elements();

            foreach ( $elements as $element => $values ) {

                $exclude_attributes = ! empty( $values['exclude'] ) ? $values['exclude'] : false;

                if ( ! empty ( $values['attributes'] ) ) {
					$attributes = $values['attributes'];
				} else {
                    $attributes = array(
                        'font-family',
                        'font-weight',
                        'font-style',
                        'text-transform',
                        'font-size',
                        'line-height',
                        'color'
                    );
                }

                $attributes = array_combine( $attributes, $attributes );
                
                if( $exclude_attributes ) {
                    foreach ( $exclude_attributes as $key => $value ) {
                        unset( $attributes[ $value ] );
                    }
                }

                /**
                 * Body Fonts Section
                 */
                $wp_customize->add_section(
                    'bam_'. $element .'_typography_section',
                    array(
                        'title'			=> $values['title'],
                        'panel'			=> 'bam_typography_panel'
                    )
                );

                /**
                 * Font Family
                 */
                if ( in_array( 'font-family', $attributes ) ) {

                    $default_font = ! empty( $values[ 'defaults' ][ 'font-family' ] ) ? $values[ 'defaults' ][ 'font-family' ] : '';

                    $wp_customize->add_setting( 
                        'bam_'. $element .'_font_family',
                        array(
                            'default'           => $default_font,
                            'sanitize_callback' => 'sanitize_text_field',
                        )
                    );
                    $wp_customize->add_control( 
                        new Bam_Fonts_Control( $wp_customize, 'bam_'. $element .'_font_family',
                        array(
                            'label'         => esc_html__( 'Font Family', 'bam' ),
                            'section'       => 'bam_'. $element .'_typography_section',
                            'settings'      => 'bam_'. $element .'_font_family'
                        )
                    ) );

                }

                /**
                 * Font Weight
                 */
                if ( in_array( 'font-weight', $attributes ) ) {

                    $font_weight = ! empty( $values[ 'defaults' ][ 'font-weight' ] ) ? $values[ 'defaults' ][ 'font-weight' ] : '';

                    $wp_customize->add_setting(
                        'bam_'. $element .'_font_weight',
                        array(
                            'default'			=> $font_weight,
                            'type'				=> 'theme_mod',
                            'capability'		=> 'edit_theme_options',
                            'sanitize_callback'	=> 'bam_sanitize_select'
                        )
                    );
                    $wp_customize->add_control(
                        'bam_'. $element .'_font_weight',
                        array(
                            'settings'		=> 'bam_'. $element .'_font_weight',
                            'section'		=> 'bam_'. $element .'_typography_section',
                            'type'			=> 'select',
                            'label'			=> esc_html__( 'Font Weight', 'bam' ),
                            'choices'		=> array(
                                ''          => esc_html__( 'Default', 'bam' ),
                                '100'       => esc_html__( 'Thin: 100', 'bam' ),
                                '200'       => esc_html__( 'Extra Light: 200', 'bam' ),
                                '300'       => esc_html__( 'Light: 300', 'bam' ),
                                '400'       => esc_html__( 'Normal: 400', 'bam' ),
                                '500'       => esc_html__( 'Medium: 500', 'bam' ),
                                '600'       => esc_html__( 'Semi Bold: 600', 'bam' ),
                                '700'       => esc_html__( 'Bold: 700', 'bam' ),
                                '800'       => esc_html__( 'Extra Bold: 800', 'bam' ),
                                '900'       => esc_html__( 'Black: 900', 'bam' )
                            )
                        )
                    );

                }

                /**
                 * Font Style
                 */
                if ( in_array( 'font-style', $attributes ) ) {

                    $font_style = ! empty( $values[ 'defaults' ][ 'font-style' ] ) ? $values[ 'defaults' ][ 'font-style' ] : '';

                    $wp_customize->add_setting(
                        'bam_'. $element .'_font_style',
                        array(
                            'default'			=> $font_style,
                            'type'				=> 'theme_mod',
                            'capability'		=> 'edit_theme_options',
                            'sanitize_callback'	=> 'bam_sanitize_select'
                        )
                    );
                    $wp_customize->add_control(
                        'bam_'. $element .'_font_style',
                        array(
                            'settings'		=> 'bam_'. $element .'_font_style',
                            'section'		=> 'bam_'. $element .'_typography_section',
                            'type'			=> 'select',
                            'label'			=> esc_html__( 'Font Style', 'bam' ),
                            'choices'		=> array(
                                ''          => esc_html__( 'Default', 'bam' ),
                                'normal'    => esc_html__( 'Normal', 'bam' ),
                                'italic'    => esc_html__( 'Italic', 'bam' )
                            )
                        )
                    );   
                
                }
                
                
                /**
                 * Text Transform
                 */
                if ( in_array( 'text-transform', $attributes ) ) {

                    $text_transform = ! empty( $values[ 'defaults' ][ 'text-transform' ] ) ? $values[ 'defaults' ][ 'text-transform' ] : '';

                    $wp_customize->add_setting(
                        'bam_'. $element .'_text_transform',
                        array(
                            'default'			=> $text_transform,
                            'type'				=> 'theme_mod',
                            'capability'		=> 'edit_theme_options',
                            'sanitize_callback'	=> 'bam_sanitize_select'
                        )
                    );
                    $wp_customize->add_control(
                        'bam_'. $element .'_text_transform',
                        array(
                            'settings'		=> 'bam_'. $element .'_text_transform',
                            'section'		=> 'bam_'. $element .'_typography_section',
                            'type'			=> 'select',
                            'label'			=> esc_html__( 'Text Transform', 'bam' ),
                            'choices'		=> array(
                                ''              => esc_html__( 'Default', 'bam' ),
                                'uppercase'     => esc_html__( 'Uppercase', 'bam' ),
                                'capitalize'    => esc_html__( 'Capitalize', 'bam' ),
                                'lowercase'     => esc_html__( 'Lowercase', 'bam' ),
                                'none'          => esc_html__( 'None', 'bam' )
                            )
                        )
                    );

                }


                /**
                 * Font Size
                 */
                if ( in_array( 'font-size', $attributes ) ) {
                
                    $desktop_font_size = ! empty( $values[ 'defaults' ][ 'font-size' ][ 'desktop' ] ) ? $values[ 'defaults' ][ 'font-size' ][ 'desktop' ] : '';
                    $tablet_font_size = ! empty( $values[ 'defaults' ][ 'font-size' ][ 'tablet' ] ) ? $values[ 'defaults' ][ 'font-size' ][ 'tablet' ] : '';
                    $mobile_font_size = ! empty( $values[ 'defaults' ][ 'font-size' ][ 'mobile' ] ) ? $values[ 'defaults' ][ 'font-size' ][ 'mobile' ] : '';
                    
                    // Font Size - Desktop.
                    $wp_customize->add_setting(
                        'bam_'. $element .'_desktop_font_size',
                        array(
                            'default'			=> $desktop_font_size,
                            'type'				=> 'theme_mod',
                            'capability'		=> 'edit_theme_options',
                            'sanitize_callback'	=> 'sanitize_text_field'
                        )
                    );
                    // Font Size - Tab.
                    $wp_customize->add_setting(
                        'bam_'. $element .'_tablet_font_size',
                        array(
                            'default'			=> $tablet_font_size,
                            'type'				=> 'theme_mod',
                            'capability'		=> 'edit_theme_options',
                            'sanitize_callback'	=> 'sanitize_text_field'
                        )
                    );
                    // Font Size - Mobile.
                    $wp_customize->add_setting(
                        'bam_'. $element .'_mobile_font_size',
                        array(
                            'default'			=> $mobile_font_size,
                            'type'				=> 'theme_mod',
                            'capability'		=> 'edit_theme_options',
                            'sanitize_callback'	=> 'sanitize_text_field'
                        )
                    );
                    $wp_customize->add_control( 
                        new Bam_Responsive_Number_Control( $wp_customize, 'bam_'. $element .'_font_size',
                        array(
                            'label'         => esc_html__( 'Font Size', 'bam' ),
                            'description' 	=> esc_html__( 'You can add: px-em-rem', 'bam' ),
                            'section'       => 'bam_'. $element .'_typography_section',
                            'settings'      => array(
                                'desktop'   => 'bam_'. $element .'_desktop_font_size',
                                'tablet'    => 'bam_'. $element .'_tablet_font_size',
                                'mobile'    => 'bam_'. $element .'_mobile_font_size'
                            )
                        )
                    ) );
                }

                /**
                 * Line Height
                 */
                if ( in_array( 'line-height', $attributes ) ) {

                    $line_height = ! empty( $values[ 'defaults' ][ 'line-height' ] ) ? $values[ 'defaults' ][ 'line-height' ] : '';

                    $wp_customize->add_setting( 
                        'bam_'. $element .'_line_height',
                        array(
                            'default'           => $line_height,
                            'sanitize_callback' => 'bam_sanitize_slider_number_input',
                        )
                    );
                    $wp_customize->add_control( 
                        new Bam_Slider_Control( $wp_customize, 'bam_'. $element .'_line_height',
                        array(
                            'label'         => esc_html__( 'Line Height', 'bam' ),
                            'section'       => 'bam_'. $element .'_typography_section',
                            'choices'       => array(
                                'min'   => 0.5,
                                'max'   => 4,
                                'step'  => 0.1,
                            )
                        )
                    ) );
                }

                /**
                 * Color
                 */
                if ( in_array( 'color', $attributes ) ) {

                    $color = ! empty( $values[ 'defaults' ][ 'color' ] ) ? $values[ 'defaults' ][ 'color' ] : '';

                    $wp_customize->add_setting(
                        'bam_'. $element .'_color',
                        array(
                            'default'			=> $color,
                            'type'				=> 'theme_mod',
                            'capability'		=> 'edit_theme_options',
                            'sanitize_callback'	=> 'bam_sanitize_hex_color'
                        )
                    );
                    $wp_customize->add_control(
                        new WP_Customize_Color_Control(
                            $wp_customize,
                            'bam_'. $element .'_color',
                            array(
                                'settings'		=> 'bam_'. $element .'_color',
                                'section'		=> 'bam_'. $element .'_typography_section',
                                'label'			=> __( 'Color', 'bam' ),
                            )
                        )
                    );

                }
            
            }
        
        }

        /**
         * This goes through each elements and get values for all settings.
         * 
         */
        public function loop( $return = 'css' ) {

            $css = '';
            $fonts = array();
            $elements = $this->elements();

            foreach ( $elements as $element => $values ) {
                
                $properties = array(
                    'font-family',
                    'font-weight',
                    'font-style',
                    'text-transform',
                    'font-size',
                    'line-height',
                    'color'
                );
    
                $common_css = '';
                $tablet_css = '';
                $mobile_css = '';

                foreach( $properties as $property ) {

                    $setting = str_replace( '-', '_', $property );

                    // font size css properties and values.
                    if ( 'font-size' == $property ) {
                        
                        // Get default values for each device.
                        $default_desktop        = isset( $values['defaults'][$property]['desktop'] ) ? $values['defaults'][$property]['desktop'] : '';
                        $default_tablet         = isset( $values['defaults'][$property]['tablet'] ) ? $values['defaults'][$property]['tablet'] : '';
                        $default_mobile         = isset( $values['defaults'][$property]['mobile'] ) ? $values['defaults'][$property]['mobile'] : '';

                        // Theme mods for each setting.
                        $theme_setting_desktop          = get_theme_mod( 'bam_'. $element .'_desktop_'. $setting, $default_desktop );
                        $theme_setting_tablet           = get_theme_mod( 'bam_'. $element .'_tablet_'. $setting, $default_tablet );
                        $theme_setting_mobile           = get_theme_mod( 'bam_'. $element .'_mobile_'. $setting, $default_mobile );

                        // CSS properties and values for desktop.
                        if ( ! empty( $theme_setting_desktop ) && $default_desktop != $theme_setting_desktop ) {
                            $common_css .= $property .':'. esc_attr( $theme_setting_desktop ) .';';
                        } 

                        // CSS properties and values for tablet.
                        if ( ! empty( $theme_setting_tablet ) && $default_tablet != $theme_setting_tablet ) {
                            $tablet_css .= $property .':'. esc_attr( $theme_setting_tablet ) .';';
                        } 
                        
                        // CSS properties and values for mobile.
                        if ( ! empty( $theme_setting_mobile ) && $default_mobile != $theme_setting_mobile ) {
                            $mobile_css .= $property .':'. esc_attr( $theme_setting_mobile ) .';';
                        }

                    } else {
                        // Default values defined in elements array.
                        $default = isset( $values['defaults'][$property] ) ? $values['defaults'][$property] : '';

                        // Theme mod.
                        $theme_setting = get_theme_mod( 'bam_'. $element .'_'. $setting, $default );

                        // CSS properties and values.
                        if ( ! empty( $theme_setting ) && $default != $theme_setting ) {
                            $common_css .= $property .':'. esc_attr( $theme_setting ).';';
                        }

                        // If the property is font family add the font family into fonts array.
                        if ( $property == 'font-family' ) {
                            $fonts[] = $theme_setting;
                        }
                    }

                }

                // Targeted selectors
                $selectors = $values['target'];

                // Common CSS appiled to all devices.
                if ( ! empty( $common_css ) ) {
                    $css .= $selectors .'{'. $common_css .'}';
                }

                // CSS for tablet devices.
                if ( ! empty( $tablet_css ) ) {
                    $css .= '@media(max-width: 768px){'. $selectors .'{'. $tablet_css .'}}';
                }

                // CSS for mobile devices.
                if ( ! empty( $mobile_css ) ) {
                    $css .= '@media(max-width: 480px){'. $selectors .'{'. $mobile_css .'}}';
                }

            }

            // If asked for css
            if ( 'css' == $return ) {
                return $css;
            }

            // If asked for fonts
            if ( 'fonts' == $return ) {
                return $fonts;
            }
            
            
        }

        /**
         * Get fonts URI
         */
        public function get_fonts_uri() {

            // Collect required fonts.
            $fonts = $this->loop('fonts');

            // Get google fonts uri
            $font_uri = bam_get_google_font_uri( $fonts );

            return $font_uri;

        }

        /**
        * Enqueue Google fonts on frontend.
        */
        public function load_fonts() {

            // Get fonts uri.
            $font_uri = $this->get_fonts_uri();

            // Load Google Fonts
            wp_enqueue_style( 'bam-google-fonts', $font_uri, array(), null );
            
        }

        public function head_css( $output ) {

            // Get CSS
            $css = $this->loop('css');

            // Return CSS
            if ( ! empty( $css ) ) {
                $output .= '/* Typography CSS */'. $css;
            }

            // Return output css
            return $output;

        }
	
    }

endif;

return new Bam_Typography_Customizer();