<?php if ( has_nav_menu( 'menu-2' ) ) : ?>
    <div id="top-navigation" class="top-navigation">
        <?php wp_nav_menu( array( 'theme_location' => 'menu-2', 'menu_id' => 'top-menu' ) ); ?>					
    </div>		
<?php endif; ?>