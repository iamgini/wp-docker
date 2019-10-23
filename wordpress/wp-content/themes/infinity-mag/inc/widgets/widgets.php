<?php
/**
 * Theme widgets.
 *
 * @package Infinity Mag
 */
// Load widget base.
require_once get_template_directory() . '/inc/widgets/widget-base-class.php';
if (!function_exists('infinity_mag_load_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function infinity_mag_load_widgets()
    {
        // infinity_mag_Grid_Panel widget.
        register_widget('Infinity_Mag_Widget_Style_1');
        // list panel widget.
        register_widget('Infinity_Mag_Widget_Style_2');
        // style 3
        register_widget('Infinity_Mag_Widget_Style_3');
        // Recent Post widget.
        register_widget('Infinity_Mag_Sidebar_Widget');

        // Carousel widget.
        register_widget('Infinity_Mag_Carousel_Post_Widget');

        // Auther widget.
        register_widget('Infinity_Mag_Author_Post_Widget');

        // Tabbed widget.
        register_widget('Infinity_Mag_Tabbed_Widget');
        register_widget('Infinity_Mag_Widget_Social');
        register_widget('Infinity_Mag_Widget_Slider');
    }
endif;
add_action('widgets_init', 'infinity_mag_load_widgets');
/*Grid Panel single cat widget*/
if (!class_exists('Infinity_Mag_Widget_Style_1')) :
    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Infinity_Mag_Widget_Style_1 extends Infinity_Mag_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'infinity_mag_grid_panel_widget',
                'description' => __('Displays posts from selected category.', 'infinity-mag'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'infinity-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'infinity-mag'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'infinity-mag'),
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'infinity-mag'),
                    'description' => __('Number of words', 'infinity-mag'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 20,
                    'min' => 0,
                    'max' => 200,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'infinity-mag'),
                    'type' => 'number',
                    'default' => 5,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 5,
                ),
                'view_detail' => array(
                    'label' => __('View Detail Text:', 'infinity-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('infinity-mag-grid-layout', __('IM: Single Category Widget', 'infinity-mag'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            $qargs = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post;
            $author_id = $post->post_author;
            $i = 1;
            ?>
            <div class="home_category_news clearfix">
                <div class="border-top"></div>
                <?php if (!empty($params['title'])) {
                    echo $args['before_title'] . $params['title'] . $args['after_title'];
                } ?>
                <div class="widget-row row">
                    <?php foreach ($all_posts as $key => $post) : ?>
                        <?php setup_postdata($post); ?>
                        <?php if ($i == 1) {
                            $feature_post = 'first-post';
                        } else {
                            $feature_post = 'all-post';
                        } ?>
                        <div class="widget-half-column <?php echo esc_attr($feature_post); ?>">
                            <div class="post-image">
                                <?php if ($i == 1) { ?>
                                    <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'infinity-mag-725-480');
                                        $url = $thumb['0'];
                                    } else {
                                        $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                                    }
                                    ?>
                                    <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                </a>
                                <?php } else { ?>
                                    <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'infinity-mag-400-260');
                                        $url = $thumb['0'];
                                    } else {
                                        $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                                    }
                                    ?>
                                    <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                </a>
                                <?php } ?>
                                </div>
                            <div class="post-content">
                                <h3 class="small-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?>
                                    </a>
                                </h3>
                                <div class="post-meta">
                                    <span>
                                        <?php echo esc_html__('Posted On: ', 'infinity-mag'); ?><?php the_time('F j, Y'); ?>
                                    </span>
                                </div>
                                <?php if ( ! is_active_sidebar( 'sidebar-home-2' ) ) { ?>
                                <div class="post-description">
                                    <?php if (absint($params['excerpt_length']) > 0) : ?>
                                        <?php
                                        $excerpt = infinity_mag_words_count(absint($params['excerpt_length']), get_the_content());
                                        echo wp_kses_post(wpautop($excerpt));
                                        ?>
                                    <?php endif; ?>
                                </div>
                            <?php } ?>
                            </div>
                                <?php if ( is_active_sidebar( 'sidebar-home-2' ) ) { ?>
                                <div class="post-description">
                                    <?php if (absint($params['excerpt_length']) > 0) : ?>
                                        <?php
                                        $excerpt = infinity_mag_words_count(absint($params['excerpt_length']), get_the_content());
                                        echo wp_kses_post(wpautop($excerpt));
                                        ?>
                                    <?php endif; ?>
                                </div>
                            <?php } ?>
                        </div>
                        <?php $i++; endforeach; ?>
                </div>
                <?php $post_cat_id = absint($params['post_category']); ?>
                <?php if (!empty($params['view_detail'])) { ?>
                    <div class="view-all"><a
                                href="<?php echo esc_url(get_category_link($post_cat_id)); ?>"><?php echo esc_html($params['view_detail']) ?></a>
                    </div>
                <?php } ?>   
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;
/*Grid Panel widget*/
if (!class_exists('Infinity_Mag_Widget_Style_2')) :
    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Infinity_Mag_Widget_Style_2 extends Infinity_Mag_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'infinity_mag_list_panel_widget',
                'description' => __('Displays post form selected category on List Format.', 'infinity-mag'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title_1' => array(
                    'label' => __('Title For Category 1:', 'infinity-mag'),
                    'default' => __('Title 1', 'infinity-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category_1' => array(
                    'label' => __('Select Category 1:', 'infinity-mag'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'infinity-mag'),
                ),
                'title_2' => array(
                    'label' => __('Title For Category 2:', 'infinity-mag'),
                    'default' => __('Title 2', 'infinity-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category_2' => array(
                    'label' => __('Select Category 2:', 'infinity-mag'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'infinity-mag'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'infinity-mag'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 4,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'infinity-mag'),
                    'description' => __('Number of words', 'infinity-mag'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 20,
                    'min' => 0,
                    'max' => 200,
                ),
                'view_detail' => array(
                    'label' => __('View Detail Text:', 'infinity-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('infinity-mag-list-layout', __('IM: Double Category Widget', 'infinity-mag'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            $q_1_args = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category_1']) > 0) {
                $q_1_args['category'] = absint($params['post_category_1']);
            }
            $all_posts_1 = get_posts($q_1_args);
            // query for 2nd cat
            $q_2_args = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category_2']) > 0) {
                $q_2_args['category'] = absint($params['post_category_2']);
            }
            $all_posts_2 = get_posts($q_2_args);
            ?>
            <div class="widget-row row">
                <?php if (!empty($all_posts_1)) : ?>
                    <?php global $post;
                    $author_id = $post->post_author;
                    $i = 1;
                    ?>
                    <div class="widget-half-column clearfix">
                        <div class="border-top"></div>
                        <?php if (!empty($params['title_1'])) {
                            echo $args['before_title'] . $params['title_1'] . $args['after_title'];
                        } ?>
                        <div class="widget-list clearfix">
                            <?php foreach ($all_posts_1 as $key => $post) : ?>
                                <?php setup_postdata($post); ?>
                                <?php if ($i == 1) {
                                    $feature_post = 'first-post';
                                } else {
                                    $feature_post = '';
                                } ?>
                                <div class="article-block-wrapper <?php echo esc_attr($feature_post); ?>">
                                    <div class="post-image">
                                        <?php if ($i == 1) { ?>
                                        <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                            <?php if (has_post_thumbnail()) {
                                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'infinity-mag-725-480');
                                                $url = $thumb['0'];
                                            } else {
                                                $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                                            }
                                            ?>
                                            <img src="<?php echo esc_url($url); ?>"
                                                 alt="<?php the_title_attribute(); ?>">
                                        </a>
                                    <?php } else { ?>
                                        <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                            <?php if (has_post_thumbnail()) {
                                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'infinity-mag-400-260');
                                                $url = $thumb['0'];
                                            } else {
                                                $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                                            }
                                            ?>
                                            <img src="<?php echo esc_url($url); ?>"
                                                 alt="<?php the_title_attribute(); ?>">
                                        </a>
                                    <?php } ?>
                                        </div>
                                    <div class="post-content">
                                        <h3 class="small-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <div class="post-meta">
                                            <span>
                                                <?php echo esc_html__('Posted On: ', 'infinity-mag'); ?><?php the_time('F j, Y'); ?>
                                            </span>
                                        </div>

                                        <div class="post-description">
                                            <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                <?php
                                                $excerpt = infinity_mag_words_count(absint($params['excerpt_length']), get_the_content());
                                                echo wp_kses_post(wpautop($excerpt));
                                                ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; endforeach; ?>
                        </div>
                        <?php $post_cat_id = absint($params['post_category_1']); ?>
                        <?php if (!empty($params['view_detail'])) { ?>
                            <div class="view-all"><a
                                        href="<?php echo esc_url(get_category_link($post_cat_id)); ?>"><?php echo esc_html($params['view_detail']) ?></a>
                            </div>
                        <?php } ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
                <!-- second category -->
                <?php if (!empty($all_posts_2)) : ?>
                    <?php global $post;
                    $author_id = $post->post_author;
                    $i = 1;
                    ?>
                    <div class="widget-half-column clearfix">
                        <div class="border-top"></div>
                        <?php if (!empty($params['title_2'])) {
                            echo $args['before_title'] . $params['title_2'] . $args['after_title'];
                        } ?>
                        <div class="items-wrap">
                            <?php foreach ($all_posts_2 as $key => $post) : ?>
                                <?php setup_postdata($post); ?>
                                <?php if ($i == 1) {
                                    $feature_post = 'first-post';
                                } else {
                                    $feature_post = '';
                                } ?>
                                <div class="article-block-wrapper <?php echo esc_attr($feature_post); ?>">
                                    <div class="post-image">
                                        <?php if ($i == 1) { ?>
                                        <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                            <?php if (has_post_thumbnail()) {
                                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'infinity-mag-725-480');
                                                $url = $thumb['0'];
                                            } else {
                                                $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                                            }
                                            ?>
                                            <img src="<?php echo esc_url($url); ?>"
                                                 alt="<?php the_title_attribute(); ?>">
                                        </a>
                                    <?php } else { ?>
                                        <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                            <?php if (has_post_thumbnail()) {
                                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'infinity-mag-400-260');
                                                $url = $thumb['0'];
                                            } else {
                                                $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                                            }
                                            ?>
                                            <img src="<?php echo esc_url($url); ?>"
                                                 alt="<?php the_title_attribute(); ?>">
                                        </a>
                                    <?php } ?>    
                                    </div>
                                    <div class="post-content">
                                        <h3 class="small-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="post-meta">
                                            <span>
                                                <?php echo esc_html__('Posted On: ', 'infinity-mag'); ?><?php the_time('F j, Y'); ?>
                                            </span>
                                        </div>
                                        <div class="post-description">
                                            <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                <?php
                                                $excerpt = infinity_mag_words_count(absint($params['excerpt_length']), get_the_content());
                                                echo wp_kses_post(wpautop($excerpt));
                                                ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; endforeach; ?>
                        </div>
                        <?php $post_cat_id = absint($params['post_category_2']); ?>
                        <?php if (!empty($params['view_detail'])) { ?>
                            <div class="view-all"><a
                                        href="<?php echo(get_category_link($post_cat_id)); ?>"><?php echo esc_html($params['view_detail']) ?></a>
                            </div>
                        <?php } ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;

if (!class_exists('Infinity_Mag_Widget_Style_3')) :
    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Infinity_Mag_Widget_Style_3 extends Infinity_Mag_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'infinity_mag_single_panel_widget',
                'description' => __('Displays posts from selected category.', 'infinity-mag'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'infinity-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'infinity-mag'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'infinity-mag'),
                ),
                'select_layout' => array(
                    'label' => __('Select Layout:', 'infinity-mag'),
                    'type' => 'select',
                    'default' => 'img-alt',
                    'options' => array(
                        'img-alt' => esc_html__( 'Image Alternate', 'infinity-mag' ),
                        'img-left'    => esc_html__( 'Image Left', 'infinity-mag' ),
                        'img-right'    => esc_html__( 'Image Right', 'infinity-mag' ),
                        ),
                    
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'infinity-mag'),
                    'description' => __('Number of words', 'infinity-mag'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 20,
                    'min' => 0,
                    'max' => 200,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'infinity-mag'),
                    'type' => 'number',
                    'default' => 5,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 5,
                ),
                'view_detail' => array(
                    'label' => __('View Detail Text:', 'infinity-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('infinity-mag-alternate-layout', __('IM: List Category Widget', 'infinity-mag'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            $qargs = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post;
            $author_id = $post->post_author;
            $i = 1;
            ?>

            <div class="list-widget">    
                <div class="border-top"></div>
                
                <?php if (!empty($params['title'])) {
                    echo $args['before_title'] . $params['title'] . $args['after_title'];
                } ?>
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <?php 
                    $select_layout = esc_attr($params['select_layout']);
                    if ($select_layout == 'img-left') {
                        $feature_post = 'row-ltr';
                    } elseif($select_layout == 'img-right'){
                        $feature_post = 'row-rtl';
                    } else { 
                        if ($i % 2 == 0) {
                        $feature_post = 'row-rtl';
                            } else {
                            $feature_post = 'row-ltr';
                        } 
                    }?>
                    <div class="row twp-equal <?php echo esc_attr($feature_post); ?>">
                        <div class="col-md-6">
                            <div class="post-image">
                                <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'infinity-mag-725-480');
                                        $url = $thumb['0'];
                                    } else {
                                        $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                                    }
                                    ?>
                                    <img src="<?php echo esc_url($url); ?>">
                                </a>
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="post-content">
                                <h3 class="small-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a>
                                </h3>
                                <div class="post-meta">
                                    <span>
                                        <?php echo esc_html__('Posted On: ', 'infinity-mag'); ?><?php the_time('F j, Y'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="post-description">
                                <?php if (absint($params['excerpt_length']) > 0) : ?>
                                    <?php
                                    $excerpt = infinity_mag_words_count(absint($params['excerpt_length']), get_the_content());
                                    echo wp_kses_post(wpautop($excerpt));
                                    ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <span class="footer-divider"></span>
                        </div>
                    </div>
                    <?php $i++; endforeach; ?>
                    <?php $post_cat_id = absint($params['post_category']); ?>
                    <?php if (!empty($params['view_detail'])) { ?>
                        <div class="view-all"><a
                                    href="<?php echo esc_url(get_category_link($post_cat_id)); ?>"><?php echo esc_html($params['view_detail']) ?></a>
                        </div>
                    <?php } ?> 
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>

            <?php echo $args['after_widget'];
        }
    }
endif;

/*Grid Panel widget*/
if (!class_exists('Infinity_Mag_Sidebar_Widget')) :
    /**
     * Popular widget Class.
     *
     * @since 1.0.0
     */
    class Infinity_Mag_Sidebar_Widget extends Infinity_Mag_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'infinity_mag_popular_post_widget',
                'description' => __('Displays post form selected category specific for popular post in sidebars.', 'infinity-mag'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'infinity-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'infinity-mag'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'infinity-mag'),
                ),
                'enable_discription' => array(
                    'label' => __('Enable Description:', 'infinity-mag'),
                    'type' => 'checkbox',
                    'default' => false,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'infinity-mag'),
                    'description' => __('Number of words', 'infinity-mag'),
                    'default' => 15,
                    'css' => 'max-width:60px;',
                    'min' => 0,
                    'max' => 200,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'infinity-mag'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 6,
                ),
            );
            parent::__construct('infinity-mag-popular-sidebar-layout', __('IM: Recent Post Widget', 'infinity-mag'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            if (!empty($params['title'])) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            }
            $qargs = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            global $post;
            ?>
            <?php if (!empty($all_posts)) : ?>
            <div class="twp-recent-widget">
                <ul class="recent-widget-list">
                    <?php foreach ($all_posts as $key => $post) : ?>
                        <?php setup_postdata($post); ?>
                        <li class="full-item">
                            <div class="row">
                                <div class="item-image col col-four pull-left">
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'infinity-mag-725-480');
                                        $url = $thumb['0'];
                                    } else {
                                        $url = get_template_directory_uri() . '/images/no-image.jpg';
                                    }
                                    ?>
                                    <figure class="twp-article">
                                        <div class="twp-article-item">
                                            <div class="article-item-image">
                                                <img src="<?php echo esc_url($url); ?>"
                                                     alt="<?php the_title_attribute(); ?>">
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                                <div class="full-item-details col col-six">
                                    <div class="full-item-content">
                                        <h3 class="small-title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="post-meta">
                        <span>
                            <?php echo esc_html__('Posted On: ', 'infinity-mag'); ?><?php the_time('F j, Y'); ?>
                        </span>
                                    </div>
                                    <div class="full-item-discription">
                                        <?php if (true === $params['enable_discription']) { ?>
                                            <div class="post-description">
                                                <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                    <?php
                                                    $excerpt = infinity_mag_words_count(absint($params['excerpt_length']), get_the_content());
                                                    echo wp_kses_post(wpautop($excerpt));
                                                    ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php
                    endforeach; ?>
                </ul>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;
/*Grid Panel widget*/
if (!class_exists('Infinity_Mag_Carousel_Post_Widget')) :
    /**
     * carousel widget Class.
     *
     * @since 1.0.0
     */
    class Infinity_Mag_Carousel_Post_Widget extends Infinity_Mag_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'infinity_mag_carousel_widget',
                'description' => __('Displays posts from selected category in carousel.', 'infinity-mag'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'post_category' => array(
                    'label' => __('Select Category:', 'infinity-mag'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'infinity-mag'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'infinity-mag'),
                    'type' => 'number',
                    'default' => 5,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 5,
                ),
                'view_detail' => array(
                    'label' => __('View Detail Text:', 'infinity-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('infinity-mag-carousel-layout', __('IM: Carousel Widget', 'infinity-mag'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            $qargs = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post;
            $author_id = $post->post_author;
            ?>
            <?php $rtl_class = 'false';
            if(is_rtl()){ 
                $rtl_class = 'true';
            }?>
            <div class="twp-carousal-widget" data-slick='{"rtl": <?php echo($rtl_class); ?>}'>
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <div class="carousal-item">
                        <div class="post-image">
                            <a class="bg-image carousal-bg-image" href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail($post->ID)) : ?>
                                    <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'infinity-mag-725-480'); ?>
                                    <?php if (!empty($image)) : ?>
                                        <img src="<?php echo esc_url($image[0]); ?>" alt=""/>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/no-image-900x600.jpg'); ?>"/>
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="post-content post-content-1">
                            <div class="post-meta">
                                <span>
                                    <?php echo esc_html__('Posted On: ', 'infinity-mag'); ?><?php the_time('F j, Y'); ?>
                                </span>
                            </div>
                            <h3 class="small-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*tabed widget*/
if (!class_exists('Infinity_Mag_Tabbed_Widget')) :
    /**
     * Tabbed widget Class.
     *
     * @since 1.0.0
     */
    class Infinity_Mag_Tabbed_Widget extends Infinity_Mag_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'infinity_mag_widget_tabbed',
                'description' => __('Tabbed widget.', 'infinity-mag'),
            );
            $fields = array(
                'popular_heading' => array(
                    'label' => __('Popular', 'infinity-mag'),
                    'type' => 'heading',
                ),
                'popular_number' => array(
                    'label' => __('No. of Posts:', 'infinity-mag'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'enable_discription' => array(
                    'label' => __('Enable Description:', 'infinity-mag'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'infinity-mag'),
                    'description' => __('Number of words', 'infinity-mag'),
                    'default' => 10,
                    'css' => 'max-width:60px;',
                    'min' => 0,
                    'max' => 200,
                ),
                'recent_heading' => array(
                    'label' => __('Recent', 'infinity-mag'),
                    'type' => 'heading',
                ),
                'recent_number' => array(
                    'label' => __('No. of Posts:', 'infinity-mag'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'comments_heading' => array(
                    'label' => __('Comments', 'infinity-mag'),
                    'type' => 'heading',
                ),
                'comments_number' => array(
                    'label' => __('No. of Comments:', 'infinity-mag'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
            );
            parent::__construct('infinity-mag-tabbed', __('IM: Tab Widgets', 'infinity-mag'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            $tab_id = 'tabbed-' . $this->number;
            echo $args['before_widget'];
            ?>
            <div class="tabbed-container">
                <div class="section-head primary-bgcolor">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="tab tab-popular active">
                            <a href="#<?php echo esc_attr($tab_id); ?>-popular"
                               aria-controls="<?php esc_html_e('Popular', 'infinity-mag'); ?>" role="tab"
                               data-toggle="tab" class="primary-bgcolor">
                                <?php esc_html_e('Popular', 'infinity-mag'); ?>
                            </a>
                        </li>
                        <li class="tab tab-recent">
                            <a href="#<?php echo esc_attr($tab_id); ?>-recent"
                               aria-controls="<?php esc_html_e('Recent', 'infinity-mag'); ?>" role="tab"
                               data-toggle="tab" class="primary-bgcolor">
                                <?php esc_html_e('Recent', 'infinity-mag'); ?>
                            </a>
                        </li>
                        <li class="tab tab-comments">
                            <a href="#<?php echo esc_attr($tab_id); ?>-comments"
                               aria-controls="<?php esc_html_e('Comments', 'infinity-mag'); ?>" role="tab"
                               data-toggle="tab" class="primary-bgcolor">
                                <?php esc_html_e('Comments', 'infinity-mag'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="<?php echo esc_attr($tab_id); ?>-popular" role="tabpanel" class="tab-pane active">
                        <?php $this->render_news('popular', $params); ?>
                    </div>
                    <div id="<?php echo esc_attr($tab_id); ?>-recent" role="tabpanel" class="tab-pane">
                        <?php $this->render_news('recent', $params); ?>
                    </div>
                    <div id="<?php echo esc_attr($tab_id); ?>-comments" role="tabpanel" class="tab-pane">
                        <?php $this->render_comments($params); ?>
                    </div>
                </div>
            </div>
            <?php
            echo $args['after_widget'];
        }
        /**
         * Render news.
         *
         * @since 1.0.0
         *
         * @param array $type Type.
         * @param array $params Parameters.
         * @return void
         */
        function render_news($type, $params)
        {
            if (!in_array($type, array('popular', 'recent'))) {
                return;
            }
            switch ($type) {
                case 'popular':
                    $qargs = array(
                        'posts_per_page' => $params['popular_number'],
                        'no_found_rows' => true,
                        'orderby' => 'comment_count',
                    );
                    break;
                case 'recent':
                    $qargs = array(
                        'posts_per_page' => $params['recent_number'],
                        'no_found_rows' => true,
                    );
                    break;
                default:
                    break;
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post;
            ?>
            <ul class="article-item article-list-item article-tabbed-list article-item-left">
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <li class="full-item">
                        <div class="row">
                            <div class="item-image col col-four">
                                <a href="<?php the_permalink(); ?>" class="news-item-thumb">
                                    <?php if (has_post_thumbnail($post->ID)) : ?>
                                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'infinity-mag-725-480'); ?>
                                        <?php if (!empty($image)) : ?>
                                            <img src="<?php echo esc_url($image[0]); ?>" alt=""/>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <img
                                                src="<?php echo esc_url(get_template_directory_uri() . '/images/no-image-900x600.jpg'); ?>"
                                                alt=""/>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="full-item-details col col-six">
                                <div class="full-item-content">
                                    <h3 class="small-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <div class="post-meta">
                        <span>
                            <?php echo esc_html__('Posted On: ', 'infinity-mag'); ?><?php the_time('F j, Y'); ?>
                        </span>
                                    </div>
                                    <div class="full-item-desc">
                                        <?php if (true === $params['enable_discription']) { ?>
                                            <div class="post-description">
                                                <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                    <?php
                                                    $excerpt = infinity_mag_words_count(absint($params['excerpt_length']), get_the_content());
                                                    echo wp_kses_post(wpautop($excerpt));
                                                    ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .news-content -->
                    </li>
                <?php endforeach; ?>
            </ul><!-- .news-list -->
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php
        }
        /**
         * Render comments.
         *
         * @since 1.0.0
         *
         * @param array $params Parameters.
         * @return void
         */
        function render_comments($params)
        {
            $comment_args = array(
                'number' => $params['comments_number'],
                'status' => 'approve',
                'post_status' => 'publish',
            );
            $comments = get_comments($comment_args);
            ?>
            <?php if (!empty($comments)) : ?>
            <ul class="article-item article-list-item article-item-left comments-tabbed--list">
                <?php foreach ($comments as $key => $comment) : ?>
                    <li class="article-panel clearfix">
                        <figure class="article-thumbmnail">
                            <?php $comment_author_url = get_comment_author_url($comment); ?>
                            <?php if (!empty($comment_author_url)) : ?>
                                <a href="<?php echo esc_url($comment_author_url); ?>"><?php echo get_avatar($comment, 65); ?></a>
                            <?php else : ?>
                                <?php echo get_avatar($comment, 65); ?>
                            <?php endif; ?>
                        </figure><!-- .comments-thumb -->
                        <div class="comments-content">
                            <?php echo get_comment_author_link($comment); ?>
                            &nbsp;<?php echo esc_html_x('on', 'Tabbed Widget', 'infinity-mag'); ?>&nbsp;<a
                                    href="<?php echo esc_url(get_comment_link($comment)); ?>"><?php echo get_the_title($comment->comment_post_ID); ?></a>
                        </div><!-- .comments-content -->
                    </li>
                <?php endforeach; ?>
            </ul><!-- .comments-list -->
        <?php endif; ?>
            <?php
        }
    }
endif;
if (!class_exists('Infinity_Mag_Widget_Social')) :
    /**
     * Social Menu widget Class.
     *
     * @since 1.0.0
     */
    class Infinity_Mag_Widget_Social extends Infinity_Mag_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'infinity_mag_social_widget',
                'description' => __('Displays social menu if you have set it(social menu)', 'infinity-mag'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'infinity-mag'),
                    'description' => __('Note: Displays social menu if you have set it(social menu)', 'infinity-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'description' => array(
                    'label' => __('Description:', 'infinity-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('infinity-mag-social-layout', __('IM: Social Menu Widget', 'infinity-mag'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            echo "<div class='widget-header-wrapper'>";
            if (!empty($params['title'])) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            }
            if (!empty($params['description'])) {
                echo "<p class='widget-description'>";
                echo esc_html($params['description']);
                echo "</p>";
            }
            echo "</div>";
            ?>
            <div class="social-widget-menu">
                <?php
                if ( has_nav_menu( 'social' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'social',
                        'link_before' => '<span class="screen-reader-text">',
                        'link_after'     => '</span>',
                    ) );
                } ?>
            </div>
            <?php if ( ! has_nav_menu( 'social' ) ) : ?>
            <p>
                <?php esc_html_e( 'Social menu is not set. You need to create menu and assign it to Social Menu on Menu Settings.', 'infinity-mag' ); ?>
            </p>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;
if (!class_exists('Infinity_Mag_Widget_Slider')) :
    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Infinity_Mag_Widget_Slider extends Infinity_Mag_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'infinity_mag_slider_widget',
                'description' => __('Displays posts from selected category in slider', 'infinity-mag'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'post_category' => array(
                    'label' => __('Select Category:', 'infinity-mag'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'infinity-mag'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'infinity-mag'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 5,
                ),
            );
            parent::__construct('infinity_mag-slider-layout', __('IM: Slider Widget', 'infinity-mag'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post;
            $author_id = $post->post_author;
            ?>
            <?php $rtl_class = 'false';
            if(is_rtl()){ 
                $rtl_class = 'true';
            }?>
            <div class="twp-slider-widget" data-slick='{"rtl": <?php echo($rtl_class); ?>}'>
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <?php if (has_post_thumbnail()) {
                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'infinity_mag-1140-600');
                        $url = $thumb['0'];
                    } else {
                        $url = get_template_directory_uri() . '/images/banner-image.jpg';
                    }
                    ?>
                    <figure class="slick-item">
                        <div class="data-bg data-bg-slide" data-background="<?php echo esc_url($url); ?>">
                            <figcaption class="slider-figcaption">
                                <div class="slider-figcaption-wrapper">
                                    <div class="title-wrap">
                                        <div class="item-metadata twp-meta-categories posts-date">
                                            <?php infinity_mag_entry_category(); ?>
                                        </div>
                                        <h2 class="slide-title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h2>
                                        <div class="post-meta">
                                            <span>
                                                <?php echo esc_html__('Posted On: ', 'infinity-mag'); ?><?php the_time('F j, Y'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </figcaption>
                        </div>
                    </figure>
                <?php endforeach; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;
/*author widget*/
if (!class_exists('Infinity_Mag_Author_Post_Widget')):

    /**
     * Author widget Class.
     *
     * @since 1.0.0
     */
    class Infinity_Mag_Author_Post_Widget extends Infinity_Mag_Widget_Base {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct() {
            $opts = array(
                'classname'                   => 'infinity_mag_author_widget',
                'description'                 => __('Displays authors details in post.', 'infinity-mag'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title'  => array(
                    'label' => __('Title:', 'infinity-mag'),
                    'type'  => 'text',
                    'class' => 'widefat',
                ),
                'author-name' => array(
                    'label'      => __('Name:', 'infinity-mag'),
                    'type'       => 'text',
                    'class'      => 'widefat',
                ),
                'discription' => array(
                    'label'      => __('Description:', 'infinity-mag'),
                    'type'       => 'textarea',
                    'class'      => 'widget-content widefat',
                ),
                'image_url' => array(
                    'label'    => __('Author Image:', 'infinity-mag'),
                    'type'     => 'image',
                ),
                'url-fb' => array(
                    'label' => __('Facebook URL:', 'infinity-mag'),
                    'type'  => 'url',
                    'class' => 'widefat',
                ),
                'url-tw' => array(
                    'label' => __('Twitter URL:', 'infinity-mag'),
                    'type'  => 'url',
                    'class' => 'widefat',
                ),
                'url-gp' => array(
                    'label' => __('Googleplus URL:', 'infinity-mag'),
                    'type'  => 'url',
                    'class' => 'widefat',
                ),
                'url-ins' => array(
                    'label'  => __('Instagram URL:', 'infinity-mag'),
                    'type'   => 'url',
                    'class'  => 'widefat',
                ),
            );

            parent::__construct('infinity-mag-author-layout', __('IM: Author Widget', 'infinity-mag'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance) {

            $params = $this->get_params($instance);

            echo $args['before_widget'];
            echo '<div class="author-widget-title">';
            if (!empty($params['title'])) {
                echo esc_html($params['title']);
            }
            echo '</div>';
            ?>
            <div class="author-info">
                <div class="author-image">
                    <?php if (!empty($params['image_url'])) {?>
                        <div class="profile-image bg-image">
                            <img src="<?php echo esc_url($params['image_url']);?>">
                        </div>
                    <?php }?>
                </div> <!-- /#author-image -->
                <div class="author-details">
                    <?php if (!empty($params['author-name'])) {?>
                        <h3 class="author-name"><?php echo esc_html($params['author-name']);?></h3>
                    <?php }?>
                    <?php if (!empty($params['discription'])) {?>
                        <p><?php echo wp_kses_post($params['discription']);?></p>
                    <?php }?>
                </div> <!-- /#author-details -->
                <div class="author-social">
                    <?php if (!empty($params['url-fb'])) {?>
                        <a href="<?php echo esc_url($params['url-fb']);?>" target="_blank">
                            <i class="meta-icon fa fa-facebook"></i>
                        </a>
                    <?php }?>
                    <?php if (!empty($params['url-tw'])) {?>
                        <a href="<?php echo esc_url($params['url-tw']);?>" target="_blank">
                            <i class="meta-icon fa fa-twitter"></i>
                        </a>
                    <?php }?>
                    <?php if (!empty($params['url-gp'])) {?>
                        <a href="<?php echo esc_url($params['url-gp']);?>" target="_blank">
                            <i class="meta-icon fa fa-google-plus"></i>
                        </a>
                    <?php }?>
                    <?php if (!empty($params['url-ins'])) {?>
                        <a href="<?php echo esc_url($params['url-ins']);?>" target="_blank">
                            <i class="meta-icon fa fa-instagram"></i>
                        </a>
                    <?php }?>
                </div>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;