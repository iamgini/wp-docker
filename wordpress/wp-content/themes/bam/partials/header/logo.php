<div class="site-branding">
    <div class="site-branding-inner">

        <?php if ( has_custom_logo() ) : ?>
            <div class="site-logo-image"><?php the_custom_logo(); ?></div>
        <?php endif; ?>

        <div class="site-branding-text">
            <?php
            if ( is_front_page() && is_home() ) :
                ?>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php
            else :
                ?>
                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php
            endif;
            $bam_description = get_bloginfo( 'description', 'display' );
            if ( $bam_description || is_customize_preview() ) :
                ?>
                <p class="site-description"><?php echo esc_html( $bam_description ); ?></p>
            <?php endif; ?>
        </div><!-- .site-branding-text -->

    </div><!-- .site-branding-inner -->
</div><!-- .site-branding -->