<?php

if( ! class_exists( 'Bam_Admin' ) ) {

    /**
     * Admin area related functions.
     */
    class Bam_Admin {

        public function __construct() {
            add_action( 'after_setup_theme', array( $this, 'editor_fonts_url' ) );
        }

        /**
         * Add custom styles for TinyMce 
         */
        public function editor_inline_styles( $init ) {
            $editor_style = $this->admin_editor_inline_style();

            if ( wp_default_editor() === 'tinymce' ) {
                $init['content_style'] = $editor_style;
            }

            return $init;
        }

        /**
         * Add custom inline style for editor.
         *
         * @return string
         */
        private function admin_editor_inline_style() {

            $css = '';

            // Body
            $body_font = get_theme_mod( 'bam_body_font_family', 'Source Sans Pro' );
            if( ! empty( $body_font ) && 'Source Sans Pro' != $body_font ) {
                $css .= '
                    body, button, input, select, optgroup, textarea { font-family: '. $body_font .'; }
                ';
            }


            // Headings
            $headings_font = get_theme_mod( 'bam_headings_font_family', '' );
            if( ! empty( $headings_font ) ) {
                $css .= '
                    h1, h2, h3, h4, h5, h6 { font-family: '. $headings_font .'; }
                ';
            }

            // H1
            $h1_font = get_theme_mod( 'bam_h1_font_family', '' );
            if( ! empty( $h1_font ) ) {
                $css .= '
                    h1 { font-family: '. $h1_font .'; }
                ';
            }

            // H2
            $h2_font = get_theme_mod( 'bam_h2_font_family', '' );
            if( ! empty( $h2_font ) ) {
                $css .= '
                    h2 { font-family: '. $h2_font .'; }
                ';
            }

            // H3
            $h3_font = get_theme_mod( 'bam_h3_font_family', '' );
            if( ! empty( $h3_font ) ) {
                $css .= '
                    h3 { font-family: '. $h3_font .'; }
                ';
            }

            // H4
            $h4_font = get_theme_mod( 'bam_h4_font_family', '' );
            if( ! empty( $h4_font ) ) {
                $css .= '
                    h4 { font-family: '. $h4_font .'; }
                ';
            }

            // Single Post Body
            $single_post_body_font = get_theme_mod( 'bam_single_post_body_font_family', '' );
            if( ! empty( $single_post_body_font ) ) {
                $css .= '
                    body, button, input, select, optgroup, textarea { font-family: '. $single_post_body_font .'; }
                ';
            }

            return $css;

        }

        public function editor_fonts_url() {
            
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

            $fonts_url = bam_get_google_font_uri( $fonts );

            //Add editor style.
            add_editor_style( array( 'assets/css/editor-style.css',  $fonts_url ) );

        }

    }

} // endif;

return new Bam_Admin();