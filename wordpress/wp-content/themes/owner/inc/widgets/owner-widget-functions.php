<?php
/**
 * Expand some functions related to widgets
 *
 * @package Mystery Themes
 * @subpackage Owner
 * @since 1.0.0
 *
 */

/**
 * Load important files for widget and it's related
 */
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-widget-areas.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-widget-fields.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-grid-layout.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-call-to-action.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-portfolio-widget.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-team-widget.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-testimonials-widget.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-latest-blog-widget.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/owner-sponsors-widget.php' );