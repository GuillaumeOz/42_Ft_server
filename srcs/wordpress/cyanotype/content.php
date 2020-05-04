<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package Cyanotype
 * @since Cyanotype 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-date">
				<?php cyanotype_entry_date(); ?>
			</div><!-- .entry-date -->
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header>
	<?php
		if ( is_sticky() ) :
			cyanotype_post_thumbnail();
		endif;
	?>
</article><!-- #post-## -->
