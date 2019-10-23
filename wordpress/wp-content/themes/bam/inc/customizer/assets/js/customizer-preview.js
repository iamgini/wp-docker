/**
 * File customizer-preview.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	var api = wp.customize;

	// Site title and description.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	api( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute',
					'display': 'none'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative',
					'display': 'block'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Container width.
	api( 'bam_container_width', function( value ) {
		value.bind( function( to ) {
			if( ( 'blank' !== to ) && ( to >= 700 ) && ( to <= 2000 )  ) {
				$( '.container' ).css( {
					'width': to + 'px'
				} );
			}
		} );
	} );

	// Boxed width.
	api( 'bam_boxed_width', function( value ) {
		value.bind( function( to ) {
			if( ( 'blank' !== to ) && ( to >= 700 ) && ( to <= 2000 ) ) {
				$( 'body.boxed-layout #page' ).css( {
					'max-width': to + 'px'
				} );
			}
		} );
	} );

	// Content width.
	api( 'bam_content_width', function( value ) {
		value.bind( function( to ) {
			if( ( 'blank' !== to ) && ( to >= 0 ) && ( to <= 100 ) ) {
				$( '#primary' ).css( 'width', to + '%' );
			}
		} );
	} );

	// Sidebar width.
	api( 'bam_sidebar_width', function( value ) {
		value.bind( function( to ) {
			if( ( 'blank' !== to ) && ( to >= 0 ) && ( to <= 100 ) ) {
				$( '#secondary' ).css( 'width', to + '%' );
			}
		} );
	} );

	// Horizontal Header height.
	api( 'bam_header_height', function( value ) {
		value.bind( function( to ) {
			if( 'blank' !== to ) {
				$( '.site-header.horizontal-style .main-navigation ul li a, .site-header.horizontal-style .bam-search-button-icon, .site-header.horizontal-style .main-navigation .menu-toggle' ).css( {
					'line-height': to + 'px',
				} );
				$( '.site-header.horizontal-style .main-navigation ul ul li a' ).css( {
					'line-height': '1.2',
				} );
				$( '.site-header.horizontal-style .site-branding-inner' ).css( {
					'height': to +'px',
				} );
			}
			
		} );
	} );

	// Menu height.
	api( 'bam_menu_height', function( value ) {
		value.bind( function( to ) {
			if( ( 'blank' !== to ) && ( to >= 20 ) && ( to <= 200 ) ) {
				$( '.site-header.default-style .main-navigation ul li a, .site-header.default-style .bam-search-button-icon, .site-header.default-style .main-navigation .menu-toggle' ).css( {
					'line-height': to + 'px',
				} );
				$( '.site-header.default-style .main-navigation ul ul li a' ).css( {
					'line-height': '1.2',
				} );
			}
		} );
	} ); 

	// Header Background color.
	api( 'bam_default_header_bg_color', function( value ) {
		value.bind( function( to ) {
			if( 'blank' !== to ) {
				$( '.site-header.default-style' ).css( 'background-color', to );
			}
		} );
	} );
	api( 'bam_horizontal_header_bg_color', function( value ) {
		value.bind( function( to ) {
			if( 'blank' !== to ) {
				$( '.site-header.horizontal-style #site-header-inner-wrap' ).css( 'background-color', to );
			}
		} );
	} );

	// Menu Background color.
	api( 'bam_default_menu_bg_color', function( value ) {
		value.bind( function( to ) {
			if( 'blank' !== to ) {
				$( '.site-header.default-style .main-navigation' ).css( 'background-color', to );
			}
		} );
	} );
	api( 'bam_horizontal_menu_bg_color', function( value ) {
		value.bind( function( to ) {
			if( 'blank' !== to ) {
				$( '.site-header.horizontal-style .main-navigation' ).css( 'background-color', to );
			}
		} );
	} );

	// Menu link color
	api( 'bam_menu_link_color', function( value ) {
		value.bind( function( to ) {
			if( 'blank' !== to ) {
				$( '.site-header.default-style .main-navigation ul li a' ).css( {
					'color': to,
				} );
			}
		} );
	} );
	api( 'bam_menu_link_color', function( value ) {
		value.bind( function( to ) {
			if( 'blank' !== to ) {
				$( '.site-header.horizontal-style .main-navigation ul li a' ).css( {
					'color': to,
				} );
			}
		} );
	} );

	// Menu link color: hover
	api( 'bam_menu_link_hover_color', function( value ) {
		value.bind( function( to ) {
			if( 'blank' !== to ) {
				$( '.site-header.default-style .main-navigation ul li a:hover' ).css( {
					'color': to,
				} );
			}
		} );
	} );
	api( 'bam_menu_link_hover_color', function( value ) {
		value.bind( function( to ) {
			if( 'blank' !== to ) {
				$( '.site-header.horizontal-style .main-navigation ul li a:hover' ).css( {
					'color': to,
				} );
			}
		} );
	} );

} )( jQuery );
