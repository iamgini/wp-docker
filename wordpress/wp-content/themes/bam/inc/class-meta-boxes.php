<?php

/**
 * Calls the class on the post edit screen.
 */
function bam_metaboxes_call() {
    new Bam_Metaboxes();
}
 
if ( is_admin() ) {
    add_action( 'load-post.php',     'bam_metaboxes_call' );
    add_action( 'load-post-new.php', 'bam_metaboxes_call' );
}
 
/**
 * Adds a Layout select meta box to posts and pages.
 */
class Bam_Metaboxes {
 
    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post',      array( $this, 'save'         ) );
    }
 
    /**
     * Adds the meta box container.
     */
    public function add_meta_box( $post_type ) {
        // Limit meta box to certain post types.
        $post_types = array( 'post', 'page' );
 
        if ( in_array( $post_type, $post_types ) ) {
            add_meta_box(
                'bam_layout_meta',
                esc_html__( 'Select Layout', 'bam' ),
                array( $this, 'render_meta_box_content' ),
                $post_type,
                'side',
                'default'
            );
        }
    }
 
    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save( $post_id ) {
 
        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */
 
        // Check if our nonce is set.
        if ( ! isset( $_POST['bam_layout_metabox_nonce'] ) ) {
            return $post_id;
        }
 
        $nonce = sanitize_key( $_POST['bam_layout_metabox_nonce'] );
 
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'bam_layout_metabox' ) ) {
            return $post_id;
        }
 
        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
 
        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
 
        /* OK, it's safe for us to save the data now. */
 
        if ( isset( $_POST['bam_layout'] ) ) {
            
            // Sanitize the user input.
            $selected_layout = sanitize_text_field( wp_unslash( $_POST['bam_layout'] ) );
    
            // Update the meta field.
            update_post_meta( $post_id, '_bam_layout_meta', $selected_layout );

        } else {
            return $post_id;
        }
    }
 
 
    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content( $post ) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'bam_layout_metabox', 'bam_layout_metabox_nonce' );
 
        // Use get_post_meta to retrieve an existing value from the database.
        $selected_layout = get_post_meta( $post->ID, '_bam_layout_meta', true );
 
        // Display the form, using the current value.
        if( empty( $selected_layout) ) { $selected_layout = 'default-layout'; }
        ?>

        <input type="radio" id="default-layout" name="bam_layout" value="default-layout" <?php checked( 'default-layout', $selected_layout ); ?> />
        <label for="default-layout" class="post-format-icon"><?php esc_html_e( 'Default Layout', 'bam' ); ?></label><br/>
        
        <input type="radio" id="right-sidebar" name="bam_layout" value="right-sidebar" <?php checked( 'right-sidebar', $selected_layout ); ?> />
        <label for="right-sidebar" class="post-format-icon"><?php esc_html_e( 'Right Sidebar', 'bam' ); ?></label><br/>
        
        <input type="radio" id="left-sidebar" name="bam_layout" value="left-sidebar" <?php checked( 'left-sidebar', $selected_layout ); ?> />
        <label for="left-sidebar" class="post-format-icon"><?php esc_html_e( 'Left Sidebar', 'bam' ); ?></label><br/>
        
        <input type="radio" id="no-sidebar" name="bam_layout" value="no-sidebar" <?php checked( 'no-sidebar', $selected_layout ); ?> />
        <label for="no-sidebar" class="post-format-icon"><?php esc_html_e( 'Full Width', 'bam' ); ?></label><br/>
        
        <input type="radio" id="center-content" name="bam_layout" value="center-content" <?php checked( 'center-content', $selected_layout ); ?> />
        <label for="center-content" class="post-format-icon"><?php esc_html_e( 'Full Width Content Centered.', 'bam' ); ?></label><br/>
        
        <?php
    }
}