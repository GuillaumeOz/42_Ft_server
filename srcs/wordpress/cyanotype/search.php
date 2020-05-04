<?php
/**
 * The template for displaying search results pages.
 *
 * @package Cyanotype
 * @since Cyanotype 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'cyanotype' ), get_search_query() ); ?></h1>
			</header><!-- .page-header -->

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				get_template_part( 'content', get_post_format() );

			// End the loop.
			endwhile;

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->
	<?php
		if ( have_posts() ) :
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'cyanotype' ),
				'next_text'          => __( 'Next page', 'cyanotype' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'cyanotype' ) . ' </span>',
			) );
		endif;
	?>
<?php get_footer(); ?>
