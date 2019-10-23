<?php
/**
 * Collection of other function file.
 */
require get_template_directory() . '/inc/common-functions-hooks.php';

/**
 * Tgmpa plugin activation.
 */
require get_template_directory().'/assets/libraries/TGM-Plugin/class-tgm-plugin-activation.php';

/*widget init*/
require get_template_directory() . '/inc/widget-init.php';

/*layout meta*/
require get_template_directory() . '/inc/hooks/layout-meta/layout-meta.php';

/*header css*/
require get_template_directory() . '/inc/hooks/added-style.php';

/*widgets init*/
require get_template_directory() . '/inc/widgets/widgets.php';

/*sidebar init*/
require get_template_directory() . '/inc/hooks/ticker-section.php';
require get_template_directory() . '/inc/hooks/slider.php';
require get_template_directory() . '/inc/hooks/featured-post.php';

/*section hook init*/
require get_template_directory() . '/inc/hooks/breadcrumb.php';
require get_template_directory() . '/inc/hooks/header-inner-page.php';
require get_template_directory() . '/inc/hooks/home-sidebar-layout.php';
