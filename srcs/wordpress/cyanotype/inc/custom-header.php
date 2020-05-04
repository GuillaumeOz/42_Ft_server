<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * @package Cyanotype
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses cyanotype_header_style()
 * @uses cyanotype_admin_header_style()
 * @uses cyanotype_admin_header_image()
 */
function cyanotype_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'cyanotype_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 2000,
		'height'                 => 320,
		'flex-height'            => true,
		'wp-head-callback'       => 'cyanotype_header_style',
		'admin-head-callback'    => 'cyanotype_admin_header_style',
		'admin-preview-callback' => 'cyanotype_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'cyanotype_custom_header_setup' );

if ( ! function_exists( 'cyanotype_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see cyanotype_custom_header_setup().
 */
function cyanotype_header_style() {
	$header_text_color = get_header_textcolor();
	$header_image = get_header_image();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color && empty( $header_image ) ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-title a:hover,
		.site-title a:focus,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // cyanotype_header_style

if ( ! function_exists( 'cyanotype_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see cyanotype_custom_header_setup().
 */
function cyanotype_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}

		.displaying-header-wrapper {
			background-color: #001f2c;
			padding: 24px;
		}

		#headimg h1 {
			font-family: Karla, sans-serif;
		}

		#headimg h1 {
			font-size: 24px;
			font-weight: 700;
			line-height: 32px;
			margin: 0;
		}

		#headimg h1 a {
			color: #fff;
			text-decoration: none;
		}

		#headimg img {
			vertical-align: middle;
		}

		.displaying-header-image img {
			width: 100%;
			height: auto;
		}
	</style>
<?php
}
endif; // cyanotype_admin_header_style

if ( ! function_exists( 'cyanotype_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see cyanotype_custom_header_setup().
 */
function cyanotype_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<div class="displaying-header-image">
			<img src="<?php header_image(); ?>" alt="">
		</div>
		<?php endif; ?>
		<div class="displaying-header-wrapper">
			<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		</div>
	</div>
<?php
}
endif; // cyanotype_admin_header_image
