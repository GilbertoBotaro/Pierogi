<?php
/**
 * The template for displaying home page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pierogi
 */

$blog_layout_type = get_theme_mod( 'pierogi_blog_layout' );

get_header();

?>
	<div class="container">
		<header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>

			<?php
			if ( function_exists( 'the_subtitle' ) ) {
				the_subtitle( '<p class="entry-subtitle featured">', '</p>' );
			}
			?>

		</header>
		<div id="primary" class="content-area <?php esc_html_e( $blog_layout_type ); ?>">
			<main id="main" class="site-main">

				<?php if ( have_posts() ) : ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/

						get_template_part( 'template-parts/post-list-item' );

					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>

<?php

if( 'sidebar_grid' === $blog_layout_type ) {
	get_sidebar();
}

get_footer();
