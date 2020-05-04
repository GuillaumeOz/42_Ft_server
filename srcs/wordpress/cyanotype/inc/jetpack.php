<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Cyanotype
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function cyanotype_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'cyanotype_jetpack_setup' );

/**
 * Add support for the Site Logo
 *
 * @since Cyanotype 1.0
 */
function cyanotype_site_logo_init() {
	add_image_size( 'cyanotype-logo', 192, 192 );
	add_theme_support( 'site-logo', array( 'size' => 'cyanotype-logo' ) );
}
add_action( 'after_setup_theme', 'cyanotype_site_logo_init' );

/**
 * Return early if Site Logo is not available.
 *
 * @since Cyanotype 1.0
 */
function cyanotype_the_site_logo() {
	if ( ! function_exists( 'jetpack_the_site_logo' ) ) {
		return;
	} else {
		jetpack_the_site_logo();
	}
}

/**
 * Add theme support for Responsive Videos
 *
 * @since Cyanotype 1.0
 */
function cyanotype_responsive_videos_init() {
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'cyanotype_responsive_videos_init' );

/**
 * Overwritte default gallery widget content width.
 *
 * @since Cyanotype 1.0
 */
function cyanotype_gallery_widget_content_width( $width ) {
	return 704;
}
add_filter( 'gallery_widget_content_width', 'cyanotype_gallery_widget_content_width');
