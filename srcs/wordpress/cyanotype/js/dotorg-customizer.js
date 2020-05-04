/**
 * Theme Customizer enhancements for a better user experience in the background option.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Background color.
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			$( 'body, .site-header .sub-menu a, #infinite-footer .container' ).css( {
					'background-color': to,
			} );

			$( 'mark, ins, .widget_calendar tbody a' ).css( {
					'color': to,
			} );

			$( '.entry-content a, .entry-footer .author-bio a, .page-content a, .taxonomy-description a, .logged-in-as a, .comment-content a, .pingback .comment-body > a, .textwidget a, .aboutme_widget a, .widget_gravatar a, .widget-grofile a' ).css( {
					'textShadow': '2px 0 0' + to + ', -2px 0 0' + to,
			} );

			$( '.entry-content .page-links a, .entry-content a.sd-button' ).css( {
					'textShadow': 'none',
			} );

			$( '<style>.site-header .sub-menu a:hover, .site-header .sub-menu a:focus { background-color: #fff !important; }</style>' ).appendTo( 'head' );

			$( '<style>.widget_calendar tbody a:hover, .widget_calendar tbody a:focus { background-color:' + to + '; color: #fff !important; }</style>' ).appendTo( 'head' );

			$( '<style>button:hover, button:focus, button:active, input[type="button"]:hover, input[type="button"]:focus, input[type="button"]:active, input[type="reset"]:hover, input[type="reset"]:focus, input[type="reset"]:active, input[type="submit"]:hover, input[type="submit"]:focus, input[type="submit"]:active, .site-header .nav-menu a:hover, .site-header .nav-menu a:focus, .pagination .prev:hover, .pagination .prev:focus, .pagination .next:hover, .pagination .next:focus, .page-links a:hover, .page-links a:focus, #infinite-handle span:hover, #infinite-handle span:focus, .comment-reply-link:hover, .comment-reply-link:focus { color:' + to + '; }</style>' ).appendTo( 'head' );

			$( '<style>.image-navigation a:hover, .comment-navigation a:hover, .post-navigation a:hover .post-title, .entry-date a:hover, .entry-footer a:hover, .site-title a:hover, .entry-title a:hover, .comment-author a:hover, .comment-metadata a:hover, .pingback .edit-link a:hover, .site-info a:hover, #infinite-footer .blog-credits a:hover { text-shadow: 2px 0 0' + to + ', -2px 0 0' + to + '; }</style>' ).appendTo( 'head' );

			$( '<style>.entry-title a:hover { text-shadow: 2px 2px 0' + to + ', -2px 2px 0' + to + '; }</style>' ).appendTo( 'head' );

			$( '<style>@media screen and (min-width: 51.755em) { .post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover { color:' + to + '; } }</style>' ).appendTo( 'head' );
		} );
	} );
} )( jQuery );
