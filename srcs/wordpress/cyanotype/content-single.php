<?php
/**
 * @package Cyanotype
 * @since Cyanotype 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-date">
			<?php cyanotype_entry_date(); ?>
		</div>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<?php cyanotype_post_thumbnail(); ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'cyanotype' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'cyanotype' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			if ( '' != get_the_author_meta( 'description' ) ) :
				get_template_part( 'author-bio' );
			endif;
		?>
		<?php cyanotype_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'cyanotype' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
