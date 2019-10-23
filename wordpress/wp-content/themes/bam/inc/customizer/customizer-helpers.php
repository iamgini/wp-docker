<?php
/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function bam_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function bam_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Check if the default header style is active.
 */
function bam_is_default_header_style( $control ) {
	if ( $control->manager->get_setting( 'bam_header_style' )->value() == 'default-style' ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the horizontal header style is active.
 */
function bam_is_horizontal_header_style( $control ) {
	if ( $control->manager->get_setting( 'bam_header_style' )->value() == 'horizontal-style' ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the site wide layout is active.
 */
function bam_is_wide_layout_active( $control ) {
	if ( $control->manager->get_setting( 'bam_site_layout' )->value() == 'wide-layout' ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the site boxed layout is active.
 */
function bam_is_boxed_layout_active( $control ) {
	if ( $control->manager->get_setting( 'bam_site_layout' )->value() == 'boxed-layout' ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the separate containers content layout active.
 */
function bam_is_separate_containers_layout_active( $control ) {
	if ( $control->manager->get_setting( 'bam_content_layout' )->value() == 'separate-containers' ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the single container content layout active.
 */
function bam_is_single_container_layout_active( $control ) {
	if ( $control->manager->get_setting( 'bam_content_layout' )->value() == 'one-container' ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if site wide layout and single container content layout is active
 */
function bam_is_wide_single_container_layout_active( $control ) {
	if ( bam_is_single_container_layout_active( $control ) && bam_is_wide_layout_active( $control ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if site wide layout and separate containers content layout is active
 */
function bam_is_wide_separate_containers_layout_active( $control ) {
	if ( bam_is_separate_containers_layout_active( $control ) && bam_is_wide_layout_active( $control ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if site boxed layout and single container content layout is active
 */
function bam_is_boxed_single_container_layout_active( $control ) {
	if ( bam_is_single_container_layout_active( $control ) && bam_is_boxed_layout_active( $control ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if site boxed layout and separate containers content layout is active
 */
function bam_is_boxed_separate_containers_layout_active( $control ) {
	if ( bam_is_separate_containers_layout_active( $control ) && bam_is_boxed_layout_active( $control ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the header border bottom is active.
 */
function bam_is_header_border_active( $control ) {
	if ( $control->manager->get_setting( 'bam_header_border_bottom')->value() == true ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the grid style is active.
 */
function bam_is_grid_style_active( $control ) {
	if ( $control->manager->get_setting( 'bam_blog_style' )->value() == 'grid-style' ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if author name displayed
 */
function bam_is_author_displayed( $control ) {
	if ( $control->manager->get_setting( 'bam_show_author' )->value() == true ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if author name displayed in singlepost
 */
function bam_is_singlepost_author_displayed( $control ) {
	if ( $control->manager->get_setting( 'bam_single_show_author' )->value() == true ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the topbar is active.
 */
function bam_is_topbar_active( $control ) {
	if ( $control->manager->get_setting( 'bam_enable_topbar' )->value() == true ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the topbar social icons are active.
 */
function bam_is_topbar_social_active( $control ) {
	if ( $control->manager->get_setting( 'bam_enable_topbar_social' )->value() == true ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the topbar social icons dark mode active.
 */
function bam_is_topbar_social_dark_mode( $control ) {
	if ( bam_is_topbar_social_active( $control ) && ( $control->manager->get_setting( 'bam_topbar_social_style' )->value() == 'dark' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the topbar social icons light mode active.
 */
function bam_is_topbar_social_light_mode( $control ) {
	if ( bam_is_topbar_social_active( $control ) && ( $control->manager->get_setting( 'bam_topbar_social_style' )->value() == 'light' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the topbar social icons color mode active.
 */
function bam_is_topbar_social_color_mode( $control ) {
	if ( bam_is_topbar_social_active( $control ) && ( $control->manager->get_setting( 'bam_topbar_social_style' )->value() == 'colored' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the custom logo has been set.
 */
function bam_has_custom_logo() {
	if ( has_custom_logo() ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the custom logo has been set.
 */
function bam_has_header_image() {
	if ( has_header_image() ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the custom logo has been set.
 */
function bam_is_not_header_background_image( $control ) {
	if ( has_header_image() && $control->manager->get_setting( 'bam_header_image_location' )->value() != 'header-background' ) {
		return true;
	} else {
		return false;
	}
}