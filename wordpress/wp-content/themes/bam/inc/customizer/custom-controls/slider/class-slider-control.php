<?php
/**
 * Slider Control
 * 
 * @since 1.0.0
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

    class Bam_Slider_Control extends WP_Customize_Control {

        public $type = 'bam-slider';

        /**
         * Enqueue our scripts and styles
         */
        public function enqueue() {
            wp_enqueue_script( 'bam-slider-control-js', BAM_DIR_URI . '/inc/customizer/custom-controls/slider/slider.js', array( 'jquery', 'customize-base' ), false, true );
            wp_enqueue_style( 'bam-slider-control-css', BAM_DIR_URI . '/inc/customizer/custom-controls/slider/slider.css', array(), '1.0', 'all' );
        }

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @see WP_Customize_Control::to_json()
         */
        public function to_json() {
            parent::to_json();
            $this->json[ 'value' ]      = $this->setting->value();
            $this->json[ 'link' ]       = $this->get_link();
            $this->json[ 'default' ]    = isset( $this->setting->default ) ? $this->setting->default : ''; 
            
            $this->json[ 'choices' ]['min'] = ( isset( $this->choices['min'] ) ? $this->choices['min'] : '0' );
            $this->json[ 'choices' ]['max'] = ( isset( $this->choices['max'] ) ? $this->choices['max'] : '100' );
            $this->json[ 'choices' ]['step'] = ( isset( $this->choices['step'] ) ? $this->choices['step'] : '1' );
        }

        /**
         * Render content function should be empty.
         */
        public function render_content() {}

        /**
         * Render JS template for the content of the Slider Control.
         */
        protected function content_template() { ?>
            <label>
                <# if ( data.label ) { #>
                    <span class="customize-control-title">{{ data.label }}</span>
                <# } #>
                <# if ( data.description ) { #>
                    <span class="customize-control-description">{{ data.description }}</span>
                <# } #>
                
                <div class="bam-slider-control-wrapper">
                    <input type="range" min="{{ data.choices['min'] }}" max="{{ data.choices['max'] }}" step="{{ data.choices['step'] }}" value="{{ data.value }}" data-reset_value="{{ data.default }}" {{{ data.link }}} class="bam-slider">
                    <input class="bam-slider-text" type="number" />
                    <span class="bam-slider-reset"><span class="dashicons dashicons-image-rotate"></span></span>
                </div>
            </label>
            <?php
        }

    }

endif;