<?php

if ( ! class_exists( 'Bam_Gutenberg' ) ) {

    /**
     * Gutenberg related functions.
     */
    class Bam_Gutenberg {

        public function __construct() {
            add_action( 'enqueue_block_editor_assets', array( $this, 'block_editor_fonts' ) );
            add_action( 'enqueue_block_editor_assets', array( $this, 'block_editor_styles' ) );
        }

        /**
         * Add custom inline style for editor.
         *
         * @return string
         */
        private function block_editor_inline_style() {

            $css = '';

            // Body
            $body_font = get_theme_mod( 'bam_body_font_family', 'Source Sans Pro' );
            if( ! empty( $body_font ) && 'Source Sans Pro' != $body_font ) {
                $css .= '
                    body, 
                    button, 
                    input, 
                    select, 
                    optgroup, 
                    textarea, 
                    .editor-post-title__block .editor-post-title__input,
                    .editor-default-block-appender textarea.editor-default-block-appender__content, 
                    .edit-post-visual-editor .editor-block-list__block { 
                        font-family: '. $body_font .'; 
                    }
                ';
            }


            // Headings
            $headings_font = get_theme_mod( 'bam_headings_font_family', '' );
            if( ! empty( $headings_font ) ) {
                $css .= '
                    .edit-post-visual-editor h1,
                    .edit-post-visual-editor h2,
                    .edit-post-visual-editor h3,
                    .edit-post-visual-editor h4,
                    .edit-post-visual-editor h5,
                    .edit-post-visual-editor h6,
                    .editor-post-title__block .editor-post-title__input { 
                        font-family: '. $headings_font .'; 
                    }
                ';
            }

            // H1
            $h1_font = get_theme_mod( 'bam_h1_font_family', '' );
            if( ! empty( $h1_font ) ) {
                $css .= '
                    h1, .edit-post-visual-editor h1, .editor-post-title__block .editor-post-title__input { font-family: '. $h1_font .'; }
                ';
            }

            // H2
            $h2_font = get_theme_mod( 'bam_h2_font_family', '' );
            if( ! empty( $h2_font ) ) {
                $css .= '
                    h2, .edit-post-visual-editor h2 { font-family: '. $h2_font .'; }
                ';
            }

            // H3
            $h3_font = get_theme_mod( 'bam_h3_font_family', '' );
            if( ! empty( $h3_font ) ) {
                $css .= '
                    h3, .edit-post-visual-editor h3 { font-family: '. $h3_font .'; }
                ';
            }

            // H4
            $h4_font = get_theme_mod( 'bam_h4_font_family', '' );
            if( ! empty( $h4_font ) ) {
                $css .= '
                    h4, .edit-post-visual-editor h4 { font-family: '. $h4_font .'; }
                ';
            }

            // Single Post Body
            $single_post_body_font = get_theme_mod( 'bam_single_post_body_font_family', '' );
            if( ! empty( $single_post_body_font ) ) {
                $css .= '
                    body, 
                    button, 
                    input, 
                    select, 
                    optgroup, 
                    textarea, 
                    .editor-post-title__block .editor-post-title__input,
                    .editor-default-block-appender textarea.editor-default-block-appender__content, 
                    .edit-post-visual-editor .editor-block-list__block { 
                        font-family: '. $single_post_body_font .'; 
                    }
                ';
            }

            return $css;

        }

        /**
         * Enqueue block editor fonts.
         */
        public function block_editor_fonts() {
            
            $body_font              = get_theme_mod( 'bam_body_font_family', 'Source Sans Pro' );
            $headings_font          = get_theme_mod( 'bam_headings_font_family', '' );
            $h1_font                = get_theme_mod( 'bam_h1_font_family', '' );
            $h2_font                = get_theme_mod( 'bam_h2_font_family', '' );
            $h3_font                = get_theme_mod( 'bam_h3_font_family', '' );
            $h4_font                = get_theme_mod( 'bam_h4_font_family', '' );
            $single_post_body_font  = get_theme_mod( 'bam_single_post_body_font_family', '' );

            $fonts = array(
                $body_font, $headings_font, $h1_font, $h2_font, $h3_font, $h4_font, $single_post_body_font
            );

            $fonts_uri = bam_get_google_font_uri( $fonts );

            // Load Google Fonts
            wp_enqueue_style( 'bam-google-fonts', $fonts_uri, array(), null );

        }

        public function block_editor_styles() {
            
            $dir_uri = BAM_DIR_URI;

            // Block styles.
            wp_enqueue_style( 'bam-block-editor-style', $dir_uri . '/assets/css/editor-blocks.css', array(), '1.0.0' );

            // Get custom css.
            $css = $this->block_editor_inline_style();

            // Add custom css to the editor.
            wp_add_inline_style( 'bam-block-editor-style', $css );

        }


    }

}

return new Bam_Gutenberg();