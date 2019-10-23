<?php
if (!function_exists('infinity_mag_featured_news')) :
    /**
     * Banner Slider
     *
     * @since infinity-mag 1.0.0
     *
     */
    function infinity_mag_featured_news()
    {
        if (1 != infinity_mag_get_option('show_featured_news_section')) {
            return null;
        }
        $infinity_mag_featured_news_category = esc_attr(infinity_mag_get_option('select_category_for_featured_news'));
        $infinity_mag_featured_news_title = esc_html(infinity_mag_get_option('featured_news_title'));
        $infinity_mag_featured_news_number = 4;
        ?>
        <section class="section-block featured-block">
            <div class="container-fluid">
                <div class="row">
                    <?php if (!empty($infinity_mag_featured_news_title)) { ?>
                        <div class="col-sm-12">
                            <h2 class="section-title">
                                <span class="primary-font primary-bgcolor">
                                    <?php echo esc_html($infinity_mag_featured_news_title); ?>
                                </span>
                            </h2>
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <?php
                    $infinity_mag_featured_news_args = array(
                        'post_type' => 'post',
                        'cat' => absint($infinity_mag_featured_news_category),
                        'ignore_sticky_posts' => true,
                        'posts_per_page' => absint($infinity_mag_featured_news_number),
                    ); ?>
                    <?php $infinity_mag_featured_news_post_query = new WP_Query($infinity_mag_featured_news_args);
                    if ($infinity_mag_featured_news_post_query->have_posts()) :
                        while ($infinity_mag_featured_news_post_query->have_posts()) : $infinity_mag_featured_news_post_query->the_post();
                            if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');
                                $url = $thumb['0'];
                            } else {
                                $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                            }
                            ?>
                            <div class="col-xxs-12 col-xs-6 col-sm-6 col-md-3">
                                <div class="column-post">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"
                                       class="bg-image bg-image-1">
                                        <img src="<?php echo esc_url($url); ?>">
                                    </a>
                                    <div class="article-detail">
                                        <h3 class="small-title">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <div class="post-meta">
                                            <span class="posted-on">
                                                    <?php echo get_the_date('F j, Y'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>

        <!-- end slider-section -->
        <?php
    }
endif;
add_action('infinity_mag_action_front_page', 'infinity_mag_featured_news', 50);
