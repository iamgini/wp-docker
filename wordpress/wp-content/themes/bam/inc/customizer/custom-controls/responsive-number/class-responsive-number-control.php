<?php
/**
 * Responsive Number Input Control.
 * 
 * @since 1.0.0
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

    class Bam_Responsive_Number_Control extends WP_Customize_Control {

        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'bam-responsive-number';

        /**
         * Enqueue scripts/styles.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function enqueue() {
            wp_enqueue_script( 'bam-responsive-number', BAM_DIR_URI . '/inc/customizer/custom-controls/responsive-number/responsive-number.js', array( 'jquery', 'customize-base' ), false, true );
        }

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         */
        public function to_json() {
            parent::to_json();

            $this->json['id'] = $this->id;

            $this->json['desktop'] = array();
            $this->json['tablet'] = array();
            $this->json['mobile'] = array();

            
            foreach ( $this->settings as $key => $setting ) {
                $this->json[ $key ] = array(
                    'id'        => $setting->id,
                    'default'   => $setting->default,
                    'link'      => $this->get_link( $key ),
                    'value'     => $this->value( $key )
                );
            }
        }

        /**
         * Renders the control wrapper and calls $this->render_content() for the internals.
         */
        protected function render() {
            $id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
            $class = 'customize-control th-has-switches customize-control-' . $this->type;
    
            printf( '<li id="%s" class="%s">', esc_attr( $id ), esc_attr( $class ) );
            $this->render_content();
            echo '</li>';
        }

        /**
         * Render a JS template for the content.
         */
        public function content_template() { ?>
            <label>
            <# if ( data.label ) { #>
                <span class="customize-control-title">
                    <span>{{{ data.label }}}</span>

                    <ul class="th-responsive-switches">
                        <li class="desktop">
                            <button type="button" class="preview-desktop active" data-device="desktop">
                                <i class="dashicons dashicons-desktop"></i>
                            </button>
                        </li>
                        <li class="tablet">
                            <button type="button" class="preview-tablet" data-device="tablet">
                                <i class="dashicons dashicons-tablet"></i>
                            </button>
                        </li>
                        <li class="mobile">
                            <button type="button" class="preview-mobile" data-device="mobile">
                                <i class="dashicons dashicons-smartphone"></i>
                            </button>
                        </li>
                    </ul>
                </span>
            <# } #>

            <# if ( data.description ) { #>
                <span class="description customize-control-description">{{ data.description }}</span>
            <# } #>

            <# if ( data.desktop ) { #>
                <div class="desktop th-control-wrap active">
                    <input type="text" value="{{ data.desktop.value }}" {{{ data.desktop.link }}} />
                </div>  
            <# } #>

            <# if ( data.tablet ) { #>
                <div class="tablet th-control-wrap">
                    <input type="text" value="{{ data.tablet.value }}" {{{ data.tablet.link }}} />
                </div>
            <# } #>

            <# if ( data.mobile ) { #>
                <div class="mobile th-control-wrap">
                    <input type="text" value="{{ data.mobile.value }}" {{{ data.mobile.link }}} />
                </div>
            <# } #>

          </label>
        <?php
        }

    }

endif;