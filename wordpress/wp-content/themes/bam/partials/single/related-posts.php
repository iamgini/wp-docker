<?php
/**
 * Related posts based on categories and tags.
 * 
 * @since 1.0.0
 */

// Related posts taxonomy
$bam_related_posts_taxonomy = get_theme_mod( 'bam_related_posts_taxonomy', 'category' );

// Query Arguments
$bam_post_args = array(
    'posts_per_page'    => absint( get_theme_mod( 'bam_related_posts_count', '3' ) ),
    'orderby'           => 'rand',
    'post__not_in'      => array( get_the_ID() ),
);

// Create an array of current term ID's
$bam_tax_terms = wp_get_post_terms( get_the_ID(), $bam_related_posts_taxonomy );
$bam_terms_ids = array();
foreach( $bam_tax_terms as $tax_term ) {
	$bam_terms_ids[] = $tax_term->term_id;
}

// Use category ids
if ( 'category' == $bam_related_posts_taxonomy ) {
    $bam_post_args['category__in'] = $bam_terms_ids; 
}

// Use tag ids
if ( 'tag' == $bam_related_posts_taxonomy ) {
    $bam_post_args['tag__in'] = $bam_terms_ids; 
}

// Related posts query.
$bam_related_posts = new WP_Query( $bam_post_args );

if ( $bam_related_posts->have_posts() ) : ?>



<div class="bam-related-posts clearfix">

    <h3 class="related-section-title"><?php esc_html_e( 'You might also like', 'bam' ); ?></h3>

    <div class="related-posts-wrap">
        <?php while ( $bam_related_posts->have_posts() ) : $bam_related_posts->the_post(); ?>
            <div class="related-post">
                <div class="related-post-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'bam-thumb' ); ?>
                    </a>
                </div><!-- .related-post-thumbnail -->
                <h3 class="related-post-title">
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3><!-- .related-post-title -->
                <div class="related-post-meta"><?php bam_posted_on(); ?></div>
            </div><!-- .related-post -->
        <?php endwhile; ?>
    </div><!-- .related-post-wrap-->

</div><!-- .related-posts -->

<?php endif;
wp_reset_postdata();