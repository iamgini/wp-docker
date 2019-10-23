<?php

// social media options array
$bam_social_options = bam_social_options();

// topbar social media style.
$bam_topbar_social_style = get_theme_mod( 'bam_topbar_social_style', 'colored' );

// social links open in new window.
$bam_social_new_window = get_theme_mod( 'bam_social_new_window', true );

// social media target attribute.
if ( true == $bam_social_new_window ) {
    $bam_social_target = '_blank';
} else {
    $bam_social_target = '_self';
}

?>

<div class="bam-topbar-social <?php echo esc_attr( $bam_topbar_social_style ); ?>">

    <?php foreach ( $bam_social_options as $key => $value ) { ?>

        <?php $bam_social_link = get_theme_mod( 'bam_social_profile_'. $key, '' ); ?>

        <?php if ( ! empty( $bam_social_link ) ) : ?>
            <span class="bam-social-icon">
                <?php if ( 'email' == $key ) { ?>
                    <a href="mailto:<?php echo esc_attr( $bam_social_link ); ?>" class="bam-social-link <?php echo esc_attr( $key ); ?>" target="_self" title="<?php echo esc_attr( $value[ 'label' ] ); ?>">
                        <i class="<?php echo esc_attr( $value[ 'icon_class' ] ); ?>"></i>
                    </a>
                <?php } elseif ( 'skype' == $key ) { ?>
                    <a href="skype:<?php echo esc_attr( $bam_social_link ); ?>?call" class="bam-social-link <?php echo esc_attr( $key ); ?>" target="_self" title="<?php echo esc_attr( $value[ 'label' ] ); ?>">
                        <i class="<?php echo esc_attr( $value[ 'icon_class' ] ); ?>"></i>
                    </a>
                <?php  } else { ?>
                    <a href="<?php echo esc_url( $bam_social_link ); ?>" class="bam-social-link <?php echo esc_attr( $key ); ?>" target="<?php echo esc_attr( $bam_social_target ); ?>" title="<?php echo esc_attr( $value[ 'label' ] ); ?>">
                        <i class="<?php echo esc_attr( $value[ 'icon_class' ] ); ?>"></i>
                    </a>
                <?php } ?>
            </span>
        <?php endif; ?>
        
    <?php } ?>

</div><!-- .bam-social-media -->