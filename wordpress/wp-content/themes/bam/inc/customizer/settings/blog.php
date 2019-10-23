<?php
/**
 * Blog Customizer Settings
 */

if ( ! class_exists( 'Bam_Blog_Customizer' ) ) :

    class Bam_Blog_Customizer {

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
             * Blog Panel
             */
            $wp_customize->add_panel(
                'bam_blog_panel',
                array(
                    'priority' 			=> 128,
                    'capability' 		=> 'edit_theme_options',
                    'theme_supports'	=> '',
                    'title' 			=> esc_html__( 'Blog', 'bam' ),
                )
            );

            /**
             * Blog Entries Section
             */
            $wp_customize->add_section(
                'bam_blog_entries_section',
                array(
                    'title'			=> esc_html__( 'Blog Entries', 'bam' ),
                    'panel'			=> 'bam_blog_panel'
                )
            );

            // Blog Layout / Sidebar Alignment
            $wp_customize->add_setting(
                'bam_blog_layout',
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
                    'bam_blog_layout',
                    array(
                        'settings'		=> 'bam_blog_layout',
                        'section'		=> 'bam_blog_entries_section',
                        'label'			=> __( 'Blog Layout', 'bam' ),
                        'choices'		=> array(
                            'right-sidebar'	        => $images_uri . '2cr.png',
                            'left-sidebar' 	        => $images_uri . '2cl.png',
                            'no-sidebar' 		    => $images_uri . '1c.png',
                            'center-content' 	    => $images_uri . '1cc.png'
                        )
                    )
                )
            );
        
            // Blog Layout
            $wp_customize->add_setting(
                'bam_blog_style',
                array(
                    'default'			=> 'grid-style',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                'bam_blog_style',
                array(
                    'settings'		=> 'bam_blog_style',
                    'section'		=> 'bam_blog_entries_section',
                    'type'			=> 'radio',
                    'label'			=> esc_html__( 'Blog Style', 'bam' ),
                    'choices'		=> array(
                        'grid-style'   => esc_html__( 'Grid Posts', 'bam' ),
                        'list-style'   => esc_html__( 'List Posts', 'bam' ),
                        'large-style'  => esc_html__( 'Large Posts', 'bam' )
                    )
                )
            );

            // Posts per row.
            $wp_customize->add_setting(
                'bam_cols_per_row',
                array(
                    'default'			=> '2',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                'bam_cols_per_row',
                array(
                    'settings'		=> 'bam_cols_per_row',
                    'section'		=> 'bam_blog_entries_section',
                    'type'			=> 'select',
                    'label'			=> esc_html__( 'Grid Columns', 'bam' ),
                    'choices'		=> array(
                        '2'    => esc_html__( '2', 'bam' ),
                        '3'    => esc_html__( '3', 'bam' ),
                        '4'    => esc_html__( '4', 'bam' ),
                        '5'    => esc_html__( '5', 'bam' ),
                        '6'    => esc_html__( '6', 'bam' )
                    ),
                    'active_callback' => 'bam_is_grid_style_active'
                )
            );

            // Content Type
            $wp_customize->add_setting(
                'bam_blog_content_type',
                array(
                    'default'			=> 'excerpt',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                'bam_blog_content_type',
                array(
                    'settings'		=> 'bam_blog_content_type',
                    'section'		=> 'bam_blog_entries_section',
                    'type'			=> 'select',
                    'label'			=> esc_html__( 'Content Type', 'bam' ),
                    'choices'		=> array(
                        'excerpt'           => esc_html__( 'Excerpt', 'bam' ),
                        'full-content'      => esc_html__( 'Full Content', 'bam' ),
                        'none'              => esc_html__( 'No Content', 'bam' )
                    )
                )
            );

            // Excerpt length.
            $wp_customize->add_setting(
                'bam_excerpt_length',
                array(
                    'default'			=> 25,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_number_absint'
                )
            );
            $wp_customize->add_control(
                'bam_excerpt_length',
                array(
                    'settings'		=> 'bam_excerpt_length',
                    'section'		=> 'bam_blog_entries_section',
                    'type'			=> 'number',
                    'label'			=> __( 'Excerpt Length', 'bam' ),
                )
            );

            // Show ReadMore Button?
            $wp_customize->add_setting(
                'bam_show_readmore',
                array(
                    'default'			=> false,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_show_readmore',
                array(
                    'settings'		=> 'bam_show_readmore',
                    'section'		=> 'bam_blog_entries_section',
                    'type'			=> 'checkbox',
                    'label'			=> __( 'Display Read More Button', 'bam' ),
                )
            );

            // Show Category List?
            $wp_customize->add_setting(
                'bam_show_cat_list',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_show_cat_list',
                array(
                    'settings'		=> 'bam_show_cat_list',
                    'section'		=> 'bam_blog_entries_section',
                    'type'			=> 'checkbox',
                    'label'			=> __( 'Display Cateogry List', 'bam' ),
                )
            );

            // Show Author?
            $wp_customize->add_setting(
                'bam_show_author',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_show_author',
                array(
                    'settings'		=> 'bam_show_author',
                    'section'		=> 'bam_blog_entries_section',
                    'type'			=> 'checkbox',
                    'label'			=> __( 'Display Author', 'bam' ),
                )
            );

            // Show Author Image?
            $wp_customize->add_setting(
                'bam_show_author_avatar',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_show_author_avatar',
                array(
                    'settings'		    => 'bam_show_author_avatar',
                    'section'		    => 'bam_blog_entries_section',
                    'type'			    => 'checkbox',
                    'label'			    => __( 'Display Author Image Icon', 'bam' ),
                    'active_callback'   => 'bam_is_author_displayed'
                )
            );

            // Show Date?
            $wp_customize->add_setting(
                'bam_show_date',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_show_date',
                array(
                    'settings'		=> 'bam_show_date',
                    'section'		=> 'bam_blog_entries_section',
                    'type'			=> 'checkbox',
                    'label'			=> __( 'Display Date', 'bam' ),
                )
            );

            // Show Comments?
            $wp_customize->add_setting(
                'bam_show_comments',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_show_comments',
                array(
                    'settings'		=> 'bam_show_comments',
                    'section'		=> 'bam_blog_entries_section',
                    'type'			=> 'checkbox',
                    'label'			=> __( 'Display Comments Link', 'bam' ),
                )
            );

           // Posts Navigation Style
            $wp_customize->add_setting(
                'bam_pagination_type',
                array(
                    'default'			=> 'page-numbers',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                'bam_pagination_type',
                array(
                    'settings'		=> 'bam_pagination_type',
                    'section'		=> 'bam_blog_entries_section',
                    'type'			=> 'select',
                    'label'			=> esc_html__( 'Blog Pagination Style', 'bam' ),
                    'choices'		=> array(
                        'page-numbers'      => esc_html__( 'Number', 'bam' ),
                        'next-prev'         => esc_html__( 'Next/Prev', 'bam' ),
                    )
                )
            );


            /**
             * Single Post Section
             */
            $wp_customize->add_section(
                'bam_single_post_section',
                array(
                    'title'			=> esc_html__( 'Single Post', 'bam' ),
                    'panel'			=> 'bam_blog_panel'
                )
            );

            // Single Post Layout / Sidebar Alignment
            $wp_customize->add_setting(
                'bam_single_post_layout',
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
                    'bam_single_post_layout',
                    array(
                        'settings'		=> 'bam_single_post_layout',
                        'section'		=> 'bam_single_post_section',
                        'label'			=> __( 'Single Post Layout', 'bam' ),
                        'choices'		=> array(
                            'right-sidebar'	        => $images_uri . '2cr.png',
                            'left-sidebar' 	        => $images_uri . '2cl.png',
                            'no-sidebar' 		    => $images_uri . '1c.png',
                            'center-content' 	    => $images_uri . '1cc.png'
                        )
                    )
                )
            );

            // Display Featured Image?
            $wp_customize->add_setting(
                'bam_show_post_thumbnail',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_show_post_thumbnail',
                array(
                    'settings'		=> 'bam_show_post_thumbnail',
                    'section'		=> 'bam_single_post_section',
                    'type'			=> 'checkbox',
                    'label'			=> __( 'Display Featured Image', 'bam' ),
                )
            );

            // Featured Image Location.
            $wp_customize->add_setting(
                'bam_post_thumbnail_location',
                array(
                    'default'			=> 'before-title',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                'bam_post_thumbnail_location',
                array(
                    'settings'		=> 'bam_post_thumbnail_location',
                    'section'		=> 'bam_single_post_section',
                    'type'			=> 'select',
                    'label'			=> esc_html__( 'Post Thumbnail Location', 'bam' ),
                    'choices'		=> array(
                        'before-title'  => esc_html__( 'Before Post Title', 'bam' ),
                        'after-title'   => esc_html__( 'After Post Title', 'bam' )
                    )
                )
            );

            // Show Category List?
            $wp_customize->add_setting(
                'bam_single_show_cat_list',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_single_show_cat_list',
                array(
                    'settings'		=> 'bam_single_show_cat_list',
                    'section'		=> 'bam_single_post_section',
                    'type'			=> 'checkbox',
                    'label'			=> __( 'Display Cateogry List', 'bam' ),
                )
            );

            // Show Author?
            $wp_customize->add_setting(
                'bam_single_show_author',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_single_show_author',
                array(
                    'settings'		=> 'bam_single_show_author',
                    'section'		=> 'bam_single_post_section',
                    'type'			=> 'checkbox',
                    'label'			=> __( 'Display Author', 'bam' ),
                )
            );

            // Show Author Image?
            $wp_customize->add_setting(
                'bam_single_show_author_avatar',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_single_show_author_avatar',
                array(
                    'settings'		    => 'bam_single_show_author_avatar',
                    'section'		    => 'bam_single_post_section',
                    'type'			    => 'checkbox',
                    'label'			    => __( 'Display Author Image Icon', 'bam' ),
                    'active_callback'   => 'bam_is_singlepost_author_displayed'
                )
            );

            // Show Date?
            $wp_customize->add_setting(
                'bam_single_show_date',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_single_show_date',
                array(
                    'settings'		=> 'bam_single_show_date',
                    'section'		=> 'bam_single_post_section',
                    'type'			=> 'checkbox',
                    'label'			=> __( 'Display Date', 'bam' ),
                )
            );

            // Show Comments?
            $wp_customize->add_setting(
                'bam_single_show_comments',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_single_show_comments',
                array(
                    'settings'		=> 'bam_single_show_comments',
                    'section'		=> 'bam_single_post_section',
                    'type'			=> 'checkbox',
                    'label'			=> __( 'Display Comments Link', 'bam' ),
                )
            );    
            
            // Show Tags?
            $wp_customize->add_setting(
                'bam_single_show_tags',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_single_show_tags',
                array(
                    'settings'		=> 'bam_single_show_tags',
                    'section'		=> 'bam_single_post_section',
                    'type'			=> 'checkbox',
                    'label'			=> __( 'Display Tags List', 'bam' ),
                )
            );  
            
            // Show Post Navigation?
            $wp_customize->add_setting(
                'bam_single_show_post_nav',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_single_show_post_nav',
                array(
                    'settings'		=> 'bam_single_show_post_nav',
                    'section'		=> 'bam_single_post_section',
                    'type'			=> 'checkbox',
                    'label'			=> __( 'Display Post Navigation', 'bam' ),
                )
            );  

            // Show Author Box?
            $wp_customize->add_setting(
                'bam_show_authorbox',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_show_authorbox',
                array(
                    'settings'		=> 'bam_show_authorbox',
                    'section'		=> 'bam_single_post_section',
                    'type'			=> 'checkbox',
                    'label'			=> __( 'Display Author Details Box', 'bam' ),
                )
            );   
            
            // Show Related Posts?
            $wp_customize->add_setting(
                'bam_show_related_posts',
                array(
                    'default'			=> true,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(
                'bam_show_related_posts',
                array(
                    'settings'		=> 'bam_show_related_posts',
                    'section'		=> 'bam_single_post_section',
                    'type'			=> 'checkbox',
                    'label'			=> __( 'Display Related Posts', 'bam' ),
                )
            ); 

            // Related Posts Taxonomy.
            $wp_customize->add_setting(
                'bam_related_posts_taxonomy',
                array(
                    'default'			=> 'category',
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_select'
                )
            );
            $wp_customize->add_control(
                'bam_related_posts_taxonomy',
                array(
                    'settings'		=> 'bam_related_posts_taxonomy',
                    'section'		=> 'bam_single_post_section',
                    'type'			=> 'select',
                    'label'			=> esc_html__( 'Related Posts Taxonomy', 'bam' ),
                    'choices'		=> array(
                        'category'  => esc_html__( 'Category', 'bam' ),
                        'post_tag'  => esc_html__( 'Tag', 'bam' )
                    )
                )
            );

            // Number of related posts.
            $wp_customize->add_setting(
                'bam_related_posts_count',
                array(
                    'default'			=> 3,
                    'type'				=> 'theme_mod',
                    'capability'		=> 'edit_theme_options',
                    'sanitize_callback'	=> 'bam_sanitize_number_absint'
                )
            );
            $wp_customize->add_control(
                'bam_related_posts_count',
                array(
                    'settings'		=> 'bam_related_posts_count',
                    'section'		=> 'bam_single_post_section',
                    'type'			=> 'number',
                    'label'			=> __( 'Related Posts Count', 'bam' ),
                )
            );


        }


    }

endif;

return new Bam_Blog_Customizer();