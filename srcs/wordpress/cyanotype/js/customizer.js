/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );

				$( '.site-title a, .site-description' ).css( {
					'color': to,
				} );
			}
		} );
	} );
	// Remove text shadow when there is a background image.
	wp.customize( 'background_image', function( value ) {
		value.bind( function( to ) {
			if ( null !== to ) {
				$( '.entry-content a, .entry-footer .author-bio a, .page-content a, .taxonomy-description a, .logged-in-as a, .comment-content a, .pingback .comment-body > a, .textwidget a, .aboutme_widget a, .widget_gravatar a, .widget-grofile a' ).css( 'textShadow', 'none' );

				$( '<style>.image-navigation a:hover, .comment-navigation a:hover, .post-navigation a:hover .post-title, .entry-date a:hover, .entry-footer a:hover, .site-title a:hover, .entry-title a:hover, .comment-author a:hover, .comment-metadata a:hover, .pingback .edit-link a:hover, .site-info a:hover, #infinite-footer .blog-credits a:hover { text-shadow: none; }</style>' ).appendTo( 'head' );
			}
		} );
	} );
} )( jQuery );
