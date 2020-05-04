<?php
/**
 * Cyanotype functions and definitions
 *
 * @package Cyanotype
 * @since Cyanotype 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 960;
}

/**
 * Cyanotype only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'cyanotype_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cyanotype_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Cyanotype, use a find and replace
	 * to change 'cyanotype' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cyanotype', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 960, 593, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'cyanotype' ),
		'social'  => __( 'Social Links Menu', 'cyanotype' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'cyanotype_custom_background_args', array(
		'default-color'    => '001f2c',
		'wp-head-callback' => 'cyanotype_custom_background_cb'
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'editor-style.css', 'genericons/genericons.css', cyanotype_fonts_url() ) );
}
endif; // cyanotype_setup
add_action( 'after_setup_theme', 'cyanotype_setup' );

if ( ! function_exists( 'cyanotype_custom_background_cb' ) ) :
/**
 * Add a wp-head callback to the custom background
 *
 * @since Cyanotype 1.0
 */
function cyanotype_custom_background_cb() {
	$image = get_background_image();
	$color = get_background_color();

	if ( empty ( $image ) && empty ( $color ) ) {
		return;

	} elseif ( ! empty ( $image ) ) {
		_custom_background_cb();
?>
		<style type="text/css" id="cyanotype-custom-background-css">
			.entry-content a,
			.entry-footer .author-bio a,
			.page-content a,
			.taxonomy-description a,
			.logged-in-as a,
			.comment-content a,
			.pingback .comment-body > a,
			.textwidget a,
			.aboutme_widget a,
			.widget_gravatar a,
			.widget-grofile a,
			.image-navigation a:hover,
			.comment-navigation a:hover,
			.post-navigation a:hover .post-title,
			.entry-date a:hover,
			.entry-footer a:hover,
			.site-title a:hover,
			.entry-title a:hover,
			.comment-author a:hover,
			.comment-metadata a:hover,
			.pingback .edit-link a:hover,
			.site-info a:hover,
			#infinite-footer .blog-credits a:hover {
				text-shadow: none;
			}
		</style>

<?php } elseif ( ! empty ( $color ) && '001f2c' != $color ) { ?>

		<style type="text/css" id="cyanotype-custom-background-css">
			body.custom-background,
			.site-header .sub-menu a,
			.widget_calendar tbody a:hover,
			.widget_calendar tbody a:focus,
			#infinite-footer .container {
				background-color: #<?php echo esc_attr( $color ); ?>;
			}
			mark,
			ins,
			button:hover,
			button:focus,
			button:active,
			input[type="button"]:hover,
			input[type="button"]:focus,
			input[type="button"]:active,
			input[type="reset"]:hover,
			input[type="reset"]:focus,
			input[type="reset"]:active,
			input[type="submit"]:hover,
			input[type="submit"]:focus,
			input[type="submit"]:active,
			.site-header .nav-menu a:hover,
			.site-header .nav-menu a:focus,
			.pagination .prev:hover,
			.pagination .prev:focus,
			.pagination .next:hover,
			.pagination .next:focus,
			.widget_calendar tbody a,
			.page-links a:hover,
			.page-links a:focus,
			.comment-reply-link:hover,
			.comment-reply-link:focus,
			#infinite-handle span:hover,
			#infinite-handle span:focus {
				color: #<?php echo esc_attr( $color ); ?>;
			}

			.highlander-dark .comments-area #respond p.form-submit input#comment-submit:hover,
			.highlander-dark .comments-area #respond p.form-submit input#comment-submit:focus {
				color: #<?php echo esc_attr( $color ); ?> !important;
			}

			@media screen and (min-width: 51.755em) {
				.post-navigation a:hover,
				.post-navigation a:focus {
					color: #<?php echo esc_attr( $color ); ?>;
				}
			}

			.entry-content a,
			.entry-footer .author-bio a,
			.page-content a,
			.taxonomy-description a,
			.logged-in-as a,
			.comment-content a,
			.pingback .comment-body > a,
			.textwidget a,
			.aboutme_widget a,
			.widget_gravatar a,
			.widget-grofile a,
			.image-navigation a:hover,
			.comment-navigation a:hover,
			.post-navigation a:hover .post-title,
			.entry-date a:hover,
			.entry-footer a:hover,
			.site-title a:hover,
			.entry-title a:hover,
			.comment-author a:hover,
			.comment-metadata a:hover,
			.pingback .edit-link a:hover,
			.site-info a:hover,
			#infinite-footer .blog-credits a:hover {
				text-shadow: 2px 0 0 #<?php echo esc_attr( $color ); ?>, -2px 0 0 #<?php echo esc_attr( $color ); ?>;
			}

			.entry-title a:hover {
				text-shadow: 2px 2px 0 #<?php echo esc_attr( $color ); ?>, -2px 2px 0 #<?php echo esc_attr( $color ); ?>;
			}
		</style>
<?php
	}
}
endif;

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function cyanotype_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'cyanotype' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your off-screen panel.', 'cyanotype' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'cyanotype_widgets_init' );

if ( ! function_exists( 'cyanotype_fonts_url' ) ) :
/**
 * Register Google fonts for Cyanotype.
 *
 * @since Cyanotype 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function cyanotype_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Karla, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Karla font: on or off', 'cyanotype' ) ) {
		$fonts[] = 'Karla:400,700,400italic,700italic';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'cyanotype' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Cyanotype 1.0
 */
function cyanotype_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'cyanotype_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Cyanotype 1.0
 */
function cyanotype_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'cyanotype-fonts', cyanotype_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3' );

	// Load our main stylesheet.
	wp_enqueue_style( 'cyanotype-style', get_stylesheet_uri() );

	wp_enqueue_script( 'cyanotype-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20150302', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'cyanotype-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20150302' );
	}

	wp_enqueue_script( 'cyanotype-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150302', true );

	wp_localize_script( 'cyanotype-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'cyanotype' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'cyanotype' ) . '</span>',
	) );

	wp_localize_script( 'cyanotype-script', 'toggleButtonText', array(
		'menu'    => __( 'Menu', 'cyanotype' ),
		'widgets' => __( 'Widgets', 'cyanotype' ),
		'both'    => __( 'Menu &amp; Widgets', 'cyanotype' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'cyanotype_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Cyanotype 1.0
 */
function cyanotype_admin_fonts() {
	wp_enqueue_style( 'cyanotype-fonts', cyanotype_fonts_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'cyanotype_admin_fonts' );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Cyanotype 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function cyanotype_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'cyanotype_search_form_modify' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cyanotype_body_classes( $classes ) {
	if ( is_singular() ) {
		$classes[] = 'single';
	}

	if ( has_nav_menu( 'primary' ) ) {
		$classes[] = 'primary-menu';
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-widgets';
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) && ! has_nav_menu( 'primary' ) && ! has_nav_menu( 'social' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'cyanotype_body_classes' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



