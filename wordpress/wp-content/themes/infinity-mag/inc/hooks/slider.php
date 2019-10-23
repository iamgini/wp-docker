<?php
if (!function_exists('infinity_mag_banner_slider')) :
    /**
     * Banner Slider
     *
     * @since infinity-mag 1.0.0
     *
     */
    function infinity_mag_banner_slider()
    {
        if (1 != infinity_mag_get_option('show_slider_section')) {
            return null;
        }
        $infinity_mag_slider_category = esc_attr(infinity_mag_get_option('select_category_for_slider'));
        $infinity_mag_slider_number = 6;
        ?>
        <!-- slider News -->
        <section class="main-banner">
            <?php
            $infinity_mag_banner_slider_args = array(
                'post_type' => 'post',
                'cat' => esc_attr($infinity_mag_slider_category),
                'ignore_sticky_posts' => true,
                'posts_per_page' => absint( $infinity_mag_slider_number ),
            ); ?>
            <?php 
            $infinity_mag_slider_layout = '';
            if (infinity_mag_get_option('slider_layout_option') == 'full-width') {
                $infinity_mag_slider_layout = 'mainbanner-jumbotron-fullwidth';
            } elseif (infinity_mag_get_option('slider_layout_option') == 'boxed') {
                $infinity_mag_slider_layout = '';
            }
            ?> 
            <?php 
                $infinity_mag_slider_style = '';
                if (infinity_mag_get_option('slider_style_option') == 'single-slider') {
                    $infinity_mag_slider_style = 'mainbanner-jumbotron-1';
                } elseif (infinity_mag_get_option('slider_style_option') == 'carousel-slider') {
                    $infinity_mag_slider_style = 'mainbanner-jumbotron-2';
                }
            ?>
            <!-- Slide -->
            <?php $rtl_class = 'false';
            if(is_rtl()){ 
                $rtl_class = 'true';
            }?>
            <div class="mainbanner-jumbotron <?php echo esc_attr($infinity_mag_slider_style); ?> <?php echo esc_attr($infinity_mag_slider_layout);?>"  data-slick='{"rtl": <?php echo($rtl_class); ?>}'>
                <?php
                $infinity_mag_banner_slider_post_query = new WP_Query($infinity_mag_banner_slider_args);
                if ($infinity_mag_banner_slider_post_query->have_posts()) :
                    while ($infinity_mag_banner_slider_post_query->have_posts()) : $infinity_mag_banner_slider_post_query->the_post();
                        if(has_post_thumbnail()){
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                            $url = $thumb['0'];
                        }
                        else{
                            $url = '';
                        }
                        global $post;
                        $author_id = $post->post_author;
                        ?>
                            <figure class="slick-item">
                                <div class="data-bg data-bg-slide" data-background="<?php echo esc_url($url); ?>"></div>
                                <figcaption class="slider-figcaption">
                                    <div class="slider-figcaption-wrapper">
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
                                </figcaption>
                            </figure>
                        <?php
                        endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </section>
        <!-- end slider-section -->
        <?php
    }
endif;
add_action('infinity_mag_action_front_page', 'infinity_mag_banner_slider', 40);
