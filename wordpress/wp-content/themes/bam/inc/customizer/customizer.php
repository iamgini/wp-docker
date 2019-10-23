<?php
/**
 * Bam Theme Customizer Class
 *
 * @package Bam
 */


if ( ! class_exists( 'Bam_Customizer' ) ) :

	class Bam_Customizer {

		/**
		 * Setup class.
		 */
		public function __construct() {

			add_action( 'customize_register', array( $this, 'custom_controls' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_action( 'customize_register', array( $this, 'control_helpers' ) );
			add_action( 'after_setup_theme', array( $this, 'register_options' ) );
			add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_custom_enqueue' ) );

		}

		public function custom_controls( $wp_customize ) {

			$dir = BAM_DIR_PATH . '/inc/customizer/custom-controls/';

			require_once( $dir . 'slider/class-slider-control.php' );
			require_once( $dir . 'radio-image/class-radio-image-control.php' );
			require_once( $dir . 'multiple-checkboxes/class-multiple-checkboxes.php' );
			require_once( $dir . 'fonts/class-fonts-control.php' );
			require_once( $dir . 'responsive-number/class-responsive-number-control.php' );

			// Register JS control types
			$wp_customize->register_control_type( 'Bam_Slider_Control' );
			$wp_customize->register_control_type( 'Bam_Responsive_Number_Control' );
		}

		/**
		 * Control helpers.
		 */
		public function control_helpers() {

			require_once( BAM_DIR_PATH . '/inc/customizer/customizer-helpers.php' );
			require_once( BAM_DIR_PATH . '/inc/customizer/sanitization-callbacks.php' );

		}

		/**
		 * Main modules.
		 */
		public function customize_register( $wp_customize ) {

			$wp_customize->get_setting( 'blogname' )->transport         		= 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  		= 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport 		= 'postMessage';
			$wp_customize->get_control( 'background_color' )->active_callback 	= 'bam_is_wide_single_container_layout_active';
		
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial( 'blogname', array(
					'selector'        => '.site-title a',
					'render_callback' => 'bam_customize_partial_blogname',
				) );
				$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
					'selector'        => '.site-description',
					'render_callback' => 'bam_customize_partial_blogdescription',
				) );
			}

		}

		/**
		 * Register options.
		 */
		public function register_options() {

			$dir_path = BAM_DIR_PATH . '/inc/customizer/settings/'; 

			require_once( $dir_path . 'general.php' );
			require_once( $dir_path . 'colors.php' );
			require_once( $dir_path . 'header.php' );
			require_once( $dir_path . 'topbar.php' );
			require_once( $dir_path . 'blog.php' );
			require_once( $dir_path . 'pages.php' );
			require_once( $dir_path . 'typography.php' );
			require_once( $dir_path . 'social.php' );
			require_once( $dir_path . 'footer.php' );

		}

		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		public function customize_preview_js() {
			wp_enqueue_script( 'bam-customizer-preview', BAM_DIR_URI . '/inc/customizer/assets/js/customizer-preview.js', array( 'customize-preview' ), false, true );
		}

		/**
		 * Loads scripts for customizer.
		 */
		public function customize_custom_enqueue() {
			wp_enqueue_style( 'bam-customizer-css',  BAM_DIR_URI . '/inc/customizer/assets/css/customizer.css' );
			wp_enqueue_script( 'bam-customizer-controls', BAM_DIR_URI . '/inc/customizer/assets/js/customizer-controls.js', array( 'jquery', 'customize-base' ), false, true );
		}

	}

endif; 

return new Bam_Customizer();