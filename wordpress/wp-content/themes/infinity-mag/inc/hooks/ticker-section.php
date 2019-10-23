<?php
if (!function_exists('infinity_mag_ticker_news')) :
    /**
     * Banner Slider
     *
     * @since infinity-mag 1.0.0
     *
     */
    function infinity_mag_ticker_news()
    {
        if (1 != infinity_mag_get_option('show_ticker_section')) {
            return null;
        }
        $infinity_mag_ticker_news_category = esc_attr(infinity_mag_get_option('select_category_for_ticker'));
        $infinity_mag_ticker_news_number = absint(infinity_mag_get_option('number_of_home_ticker'));
        ?>
        <section class="featured-section">
            <div class="container-fluid">
                <?php $rtl_class = 'false';
                if(is_rtl()){ 
                    $rtl_class = 'true';
                }?>
                <div class="featured-slider" data-slick='{"rtl": <?php echo($rtl_class); ?>}'>
                    <?php
                    $infinity_mag_ticker_news_args = array(
                        'post_type' => 'post',
                        'cat' => absint($infinity_mag_ticker_news_category),
                        'ignore_sticky_posts' => true,
                        'posts_per_page' => absint($infinity_mag_ticker_news_number),
                    ); ?>
                    <?php $infinity_mag_ticker_news_post_query = new WP_Query($infinity_mag_ticker_news_args);
                    if ($infinity_mag_ticker_news_post_query->have_posts()) :
                        while ($infinity_mag_ticker_news_post_query->have_posts()) : $infinity_mag_ticker_news_post_query->the_post();
                            if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail');
                                $url = $thumb['0'];
                            } else {
                                $url = get_template_directory_uri() . '/images/no-image.jpg';
                            }
                            ?>
                            <div class="featured-item">
                                <div class="table-align featured-wrapper">
                                    <div class="post-image table-align-cell v-align-top">
                                        <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                            <img src="<?php echo esc_url($url); ?>">
                                        </a>
                                    </div>
                                    <div class="post-content table-align-cell v-align-top">
                                        <h3 class="small-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
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
        <!-- end ticker-section -->
        <?php
    }
endif;
add_action('infinity_mag_action_ticker_section', 'infinity_mag_ticker_news', 50);
