<?php
/**
 * Color Customizer Settings
 */

if ( ! class_exists( 'Bam_Color_Customizer' ) ) :

    class Bam_Color_Customizer {

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

            // Primary Color.
            $wp_customize->add_setting(
                'bam_primary_color',
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
                    'bam_primary_color',
                    array(
                        'settings'		    => 'bam_primary_color',
                        'section'		    => 'colors',
                        'priority'          => 1,
                        'label'			    => esc_html__( 'Theme Primary Color', 'bam' ),
                    )
                )
            );

            // Boxed Layout Single Container Inner background color.
            $wp_customize->add_setting(
                'bam_boxed_inner_bg_color',
                array(
                    'default'			=> '#ffffff',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_boxed_inner_bg_color',
                    array(
                        'settings'		    => 'bam_boxed_inner_bg_color',
                        'section'		    => 'colors',
                        'label'			    => esc_html__( 'Inner Background Color', 'bam' ),
                        'active_callback'	=> 'bam_is_boxed_single_container_layout_active'
                    )
                )
            );

            // Boxed Layout Single Container Outer background color.
            $wp_customize->add_setting(
                'bam_boxed_outer_bg_color',
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
                    'bam_boxed_outer_bg_color',
                    array(
                        'settings'		    => 'bam_boxed_outer_bg_color',
                        'section'		    => 'colors',
                        'label'			    => esc_html__( 'Outer Background Color', 'bam' ),
                        'active_callback'	=> 'bam_is_boxed_single_container_layout_active'
                    )
                )
            );

            // Boxed Layout Separate Containers Inner background color.
            $wp_customize->add_setting(
                'bam_boxed_separate_inner_bg_color',
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
                    'bam_boxed_separate_inner_bg_color',
                    array(
                        'settings'		    => 'bam_boxed_separate_inner_bg_color',
                        'section'		    => 'colors',
                        'label'			    => esc_html__( 'Inner Background Color', 'bam' ),
                        'active_callback'	=> 'bam_is_boxed_separate_containers_layout_active'
                    )
                )
            );

            // Boxed Layout Separate Containers Outer background color.
            $wp_customize->add_setting(
                'bam_boxed_separate_outer_bg_color',
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
                    'bam_boxed_separate_outer_bg_color',
                    array(
                        'settings'		    => 'bam_boxed_separate_outer_bg_color',
                        'section'		    => 'colors',
                        'label'			    => esc_html__( 'Outer Background Color', 'bam' ),
                        'active_callback'	=> 'bam_is_boxed_separate_containers_layout_active'
                    )
                )
            );

            // Wide Layout Separate Containers Outer background color.
            $wp_customize->add_setting(
                'bam_wide_separate_bg_color',
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
                    'bam_wide_separate_bg_color',
                    array(
                        'settings'		    => 'bam_wide_separate_bg_color',
                        'section'		    => 'colors',
                        'label'			    => esc_html__( 'Background Color', 'bam' ),
                        'active_callback'	=> 'bam_is_wide_separate_containers_layout_active'
                    )
                )
            );

            // Wide Layout Separate Containers Outer background color.
            $wp_customize->add_setting(
                'bam_separate_content_bg_color',
                array(
                    'default'			=> '#ffffff',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_separate_content_bg_color',
                    array(
                        'settings'		    => 'bam_separate_content_bg_color',
                        'section'		    => 'colors',
                        'label'			    => esc_html__( 'Content Background Color', 'bam' ),
                        'active_callback'	=> 'bam_is_separate_containers_layout_active'
                    )
                )
            );

            // Post link color.
            $wp_customize->add_setting(
                'bam_link_color',
                array(
                    'default'			=> '#00aeef',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_link_color',
                    array(
                        'settings'		    => 'bam_link_color',
                        'section'		    => 'colors',
                        'label'			    => esc_html__( 'Article Link Color', 'bam' ),
                    )
                )
            );

            // Post link color:hover.
            $wp_customize->add_setting(
                'bam_link_color_hover',
                array(
                    'default'			=> '#0076a3',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_link_color_hover',
                    array(
                        'settings'		    => 'bam_link_color_hover',
                        'section'		    => 'colors',
                        'label'			    => esc_html__( 'Article Link Color: Hover', 'bam' ),
                    )
                )
            );

            // Article Meta Color.
            $wp_customize->add_setting(
                'bam_article_meta_color',
                array(
                    'default'			=> '#999999',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_article_meta_color',
                    array(
                        'settings'		    => 'bam_article_meta_color',
                        'section'		    => 'colors',
                        'label'			    => esc_html__( 'Article Meta Data Color', 'bam' ),
                    )
                )
            );

            // Article Meta Color :Hover.
            $wp_customize->add_setting(
                'bam_article_meta_color_hover',
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
                    'bam_article_meta_color_hover',
                    array(
                        'settings'		    => 'bam_article_meta_color_hover',
                        'section'		    => 'colors',
                        'label'			    => esc_html__( 'Article Meta Data Color: Hover', 'bam' ),
                    )
                )
            );

            // Button Background Color.
            $wp_customize->add_setting(
                'bam_button_bg_color',
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
                    'bam_button_bg_color',
                    array(
                        'settings'		    => 'bam_button_bg_color',
                        'section'		    => 'colors',
                        'label'			    => esc_html__( 'Button Background Color', 'bam' ),
                    )
                )
            );

            // Button Text Color.
            $wp_customize->add_setting(
                'bam_button_text_color',
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
                    'bam_button_text_color',
                    array(
                        'settings'		    => 'bam_button_text_color',
                        'section'		    => 'colors',
                        'label'			    => esc_html__( 'Button Text Color', 'bam' ),
                    )
                )
            );

            // Button Background Color:hover.
            $wp_customize->add_setting(
                'bam_button_bg_color_hover',
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
                    'bam_button_bg_color_hover',
                    array(
                        'settings'		    => 'bam_button_bg_color_hover',
                        'section'		    => 'colors',
                        'label'			    => esc_html__( 'Button Background Color: Hover', 'bam' ),
                    )
                )
            );

            // Button Text Color:hover.
            $wp_customize->add_setting(
                'bam_button_text_color_hover',
                array(
                    'default'			=> '#ffffff',
                    'transport'         => 'refresh',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_hex_color'
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control( 
                    $wp_customize,
                    'bam_button_text_color_hover',
                    array(
                        'settings'		    => 'bam_button_text_color_hover',
                        'section'		    => 'colors',
                        'label'			    => esc_html__( 'Button Text Color: Hover', 'bam' ),
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

            $primary_color                      = get_theme_mod( 'bam_primary_color', '#ff4f4f' );
            $link_color                         = get_theme_mod( 'bam_link_color', '#00aeef' );
            $link_color_hover                   = get_theme_mod( 'bam_link_color_hover', '#00aeef' );
            $btn_bg_color                       = get_theme_mod( 'bam_button_bg_color', '#ff4f4f' );
            $btn_text_color                     = get_theme_mod( 'bam_button_text_color', '#eeeeee' );
            $btn_bg_color_hover                 = get_theme_mod( 'bam_button_bg_color_hover', '#222222' );
            $btn_text_color_hover               = get_theme_mod( 'bam_button_text_color_hover', '#ffffff' );
            $boxed_outer_bg_color               = get_theme_mod( 'bam_boxed_outer_bg_color', '#dddddd' );
            $boxed_inner_bg_color               = get_theme_mod( 'bam_boxed_inner_bg_color', '#ffffff' );
            $boxed_separate_outer_bg_color      = get_theme_mod( 'bam_boxed_separate_outer_bg_color', '#dddddd' );
            $boxed_separate_inner_bg_color      = get_theme_mod( 'bam_boxed_separate_inner_bg_color', '#eeeeee' );
            $wide_separate_bg_color             = get_theme_mod( 'bam_wide_separate_bg_color', '#eeeeee' );
            $separate_content_bg_color          = get_theme_mod( 'bam_separate_content_bg_color', '#ffffff' );
            $article_meta_color                 = get_theme_mod( 'bam_article_meta_color', '#999999' );
            $article_meta_color_hover           = get_theme_mod( 'bam_article_meta_color_hover', '#ff4f4f' );

            $css = '';

            if ( ! empty( $primary_color ) && '#ff4f4f' != $primary_color ) {
                $css .= '
                
                    blockquote {
                        border-left: 4px solid '. $primary_color .';
                    }

                    button,
                    input[type="button"],
                    input[type="reset"],
                    input[type="submit"] {
                        background: '. $primary_color .';
                    }

                    .bam-readmore {
                        background: '. $primary_color .';
                    }

                    .site-title a, .site-description {
                        color: '. $primary_color .';
                    }

                    .site-header.default-style .main-navigation ul li a:hover {
                        color: '. $primary_color .';
                    }

                    .site-header.default-style .main-navigation ul ul li a:hover {
                        background: '. $primary_color .';
                    }

                    .site-header.default-style .main-navigation .current_page_item > a,
                    .site-header.default-style .main-navigation .current-menu-item > a,
                    .site-header.default-style .main-navigation .current_page_ancestor > a,
                    .site-header.default-style .main-navigation .current-menu-ancestor > a {
                        color: '. $primary_color .';
                    }

                    .site-header.horizontal-style .main-navigation ul li a:hover {
                        color: '. $primary_color .';
                    }

                    .site-header.horizontal-style .main-navigation ul ul li a:hover {
                        background: '. $primary_color .';
                    }

                    .site-header.horizontal-style .main-navigation .current_page_item > a,
                    .site-header.horizontal-style .main-navigation .current-menu-item > a,
                    .site-header.horizontal-style .main-navigation .current_page_ancestor > a,
                    .site-header.horizontal-style .main-navigation .current-menu-ancestor > a {
                        color: '. $primary_color .';
                    }

                    .posts-navigation .nav-previous a:hover,
                    .posts-navigation .nav-next a:hover {
                        color: '. $primary_color .';
                    }

                    .post-navigation .nav-previous .post-title:hover,
                    .post-navigation .nav-next .post-title:hover {
                        color: '. $primary_color .';
                    }

                    .pagination .page-numbers.current {
                        background: '. $primary_color .';
                        border: 1px solid '. $primary_color .';
                        color: #ffffff;
                    }
                      
                    .pagination a.page-numbers:hover {
                        background: '. $primary_color .';
                        border: 1px solid '. $primary_color .';
                    }

                    .widget a:hover,
                    .widget ul li a:hover {
                        color: '. $primary_color .';
                    }

                    li.bm-tab.ui-state-active a {
                        border-bottom: 1px solid '. $primary_color .';
                    }

                    .footer-widget-area .widget a:hover {
                        color: '. $primary_color .';
                    }

                    .bms-title a:hover {
                        color: '. $primary_color .';
                    }

                    .bam-entry .entry-title a:hover {
                        color: '. $primary_color .';
                    }

                    .related-post-meta a:hover,
                    .entry-meta a:hover {
                        color: '. $primary_color .';
                    }

                    .related-post-meta .byline a:hover,
                    .entry-meta .byline a:hover {
                        color: '. $primary_color .';
                    }

                    .cat-links a {
                        color: '. $primary_color .';
                    }

                    .tags-links a:hover {
                        background: '. $primary_color .';
                    }

                    .related-post-title a:hover {
                        color: '. $primary_color .';
                    }

                    .author-posts-link:hover {
                        color: '. $primary_color .';
                    }

                    .comment-author a {
                        color: '. $primary_color .';
                    }

                    .comment-metadata a:hover,
                    .comment-metadata a:focus,
                    .pingback .comment-edit-link:hover,
                    .pingback .comment-edit-link:focus {
                        color: '. $primary_color .';
                    }

                    .comment-reply-link:hover,
                    .comment-reply-link:focus {
                        background: '. $primary_color .';
                    }

                    .comment-notes a:hover,
                    .comment-awaiting-moderation a:hover,
                    .logged-in-as a:hover,
                    .form-allowed-tags a:hover {
                        color: '. $primary_color .';
                    }

                    .required {
                        color: '. $primary_color .';
                    }

                    .comment-reply-title small a:before {
                        color: '. $primary_color .';
                    }

                    .wp-block-quote {
                        border-left: 4px solid '. $primary_color .';
                    }

                    .wp-block-quote[style*="text-align:right"], .wp-block-quote[style*="text-align: right"] {
                        border-right: 4px solid '. $primary_color .';
                    }

                    .site-info a:hover {
                        color: '. $primary_color .';
                    }

                    #bam-tags a, .widget_tag_cloud .tagcloud a {
                        background: '. $primary_color .';
                    }

                ';
            } // endif primary color

            // header text color
            $header_textcolor = get_header_textcolor();
            if ( 'blank' != $header_textcolor && 'FF4F4F' != $header_textcolor ) {
                $css .= '
                    .site-title a, .site-description,
                    .site-header.horizontal-style .site-description {
                        color: #'. $header_textcolor .';
                    }
                ';
            }
            
            // link color
            if ( ! empty( $link_color ) && '#00aeef' != $link_color ) {
                $css .= '
                    .single article .entry-content a {
                        color: '. $link_color .';
                    }
                ';
            } 

            // link color hover
            if ( ! empty( $link_color_hover ) && '#21759b' != $link_color_hover ) {
                $css .= '
                    .single article .entry-content a:hover {
                        color: '. $link_color_hover .';
                    }
                ';
            } 

            // button background color
            if ( ! empty( $btn_bg_color ) && '#ff4f4f' != $btn_bg_color ) {
                $css .= '
                    button,
                    input[type="button"],
                    input[type="reset"],
                    input[type="submit"],
                    .bam-readmore {
                        background: '. $btn_bg_color .';
                    }
                ';
            } 
            // button text color
            if ( ! empty( $btn_text_color ) && '#eeeeee' != $btn_text_color ) {
                $css .= '
                    button,
                    input[type="button"],
                    input[type="reset"],
                    input[type="submit"],
                    .bam-readmore {
                        color: '. $btn_text_color .';
                    }
                ';
            } 
            // button background color:hover
            if ( ! empty( $btn_bg_color_hover ) && '#222222' != $btn_bg_color_hover ) {
                $css .= '
                    button:hover,
                    input[type="button"]:hover,
                    input[type="reset"]:hover,
                    input[type="submit"]:hover,
                    .bam-readmore:hover {
                        background: '. $btn_bg_color_hover .';
                    }
                ';
            } 
            // button text color:hover
            if ( ! empty( $btn_text_color_hover ) && '#ffffff' != $btn_text_color_hover ) {
                $css .= '
                    button:hover,
                    input[type="button"]:hover,
                    input[type="reset"]:hover,
                    input[type="submit"]:hover,
                    .bam-readmore:hover {
                        color: '. $btn_text_color_hover .';
                    }
                ';
            } 

            // boxed layout outer background color.
            if ( ! empty( $boxed_outer_bg_color ) ) {
                $css .= '
                    body.boxed-layout.custom-background,
                    body.boxed-layout {
                        background: '. $boxed_outer_bg_color .';
                    }
                ';
            }

            // boxed layout inner background color.
            if ( ! empty( $boxed_inner_bg_color ) && '#ffffff' != $boxed_inner_bg_color ) {
                $css .= '
                    body.boxed-layout #page {
                        background: '. $boxed_inner_bg_color .';
                    }
                ';
            }

            // boxed layout separate containers outer background color.
            if ( ! empty( $boxed_separate_outer_bg_color ) ) {
                $css .= '
                    body.boxed-layout.custom-background.separate-containers,
                    body.boxed-layout.separate-containers {
                        background: '. $boxed_separate_outer_bg_color .';
                    }
                ';
            }

            // boxed layout separate containers inner background color.
            if ( ! empty( $boxed_separate_inner_bg_color ) && '#eeeeee' != $boxed_separate_inner_bg_color ) {
                $css .= '
                    body.boxed-layout.separate-containers .site-content {
                        background: '. $boxed_separate_inner_bg_color .';
                    }
                ';
            }

            // wide layout separate containers background color.
            if ( ! empty( $wide_separate_bg_color ) ) {
                $css .= '
                    body.wide-layout.custom-background.separate-containers .site-content,
                    body.wide-layout.separate-containers .site-content {
                        background: '. $wide_separate_bg_color .';
                    }
                ';
            }

            // Separate container content bg color.
            if ( ! empty( $separate_content_bg_color ) && '#ffffff' != $separate_content_bg_color ) {
                $css .= '
                    body.separate-containers .blog-entry-inner,
                    body.separate-containers.single .site-main,
                    body.separate-containers.page .site-main,
                    body.separate-containers #secondary .widget {
                        background: '. $separate_content_bg_color .';
                    }
                ';
            }

            // Article meta color.
            if ( ! empty( $article_meta_color ) && '#999999' != $article_meta_color ) {
                $css .= '
                    .related-post-meta, 
                    .entry-meta,
                    .related-post-meta .byline a, 
                    .entry-meta .byline a,
                    .related-post-meta a, 
                    .entry-meta a {
                        color: '. $article_meta_color .';
                    }
                ';
            }

            // Article meta color:hover.
            if ( ! empty( $article_meta_color_hover ) && '#ff4f4f' != $article_meta_color_hover ) {
                $css .= '
                    .related-post-meta .byline a:hover, 
                    .entry-meta .byline a:hover,
                    .related-post-meta a:hover, 
                    .entry-meta a:hover {
                        color: '. $article_meta_color_hover .';
                    }
                ';
            }

            // Return CSS
            if ( ! empty( $css ) ) {
                $output .= '/* Color CSS */'. $css;
            }

            // Return output css
            return $output;

        }

    }

endif;

return new Bam_Color_Customizer();