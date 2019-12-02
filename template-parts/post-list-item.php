<?php
/**
 * Template part for displaying blog posts in list layout
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pierogi
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php

			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		?>

	</header><!-- .entry-header -->

	<?php the_post_thumbnail( 'post-list-thumb' ); ?>

	<div class="entry-meta">
		<?php
		pierogi_posted_on();
		pierogi_posted_by();
		?>
	</div><!-- .entry-meta -->

	<div class="entry-content">
		<?php
		the_excerpt(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'pierogi' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);

		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php pierogi_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
