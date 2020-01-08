<?php
/**
 * Layout functions
 *
 * @package Pierogi
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pierogi_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a layout class.
	$classes[] = pierogi_get_layout();

	// Add blog page layout type css class.
	$blog_layout = is_home() ? get_theme_mod( 'blog_layout' ) :
		( is_search() || is_archive() ? 'list' : false );

	if ( $blog_layout ) {
		$classes[] = "blog-layout-{$blog_layout}";
	}

	if ( ! has_custom_logo() && get_bloginfo( 'description' ) ) {
		$classes[] = 'site-header-large';
	}

	return $classes;
}
add_filter( 'body_class', 'pierogi_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function pierogi_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'pierogi_pingback_header' );

/**
 * Filter footer text.
 *
 * @param  string $text Footer text.
 * @return string
 */
function pierogi_footer_text_filter( $text ) {
	return str_ireplace( [
		'%year%',
		'BracketSpace',
		'WordPress',
	], [
		date( 'Y' ),
		sprintf( '<a href="%s">%s</a>', 'https://bracketspace.com?utm_source=theme&utm_medium=footer&utm_campaign=pierogi', 'BracketSpace' ),
		sprintf( '<a href="%s">%s</a>', 'https://wordpress.org', 'WordPress' ),
	], esc_html( $text ) );
}
add_action( 'pierogi_footer_text', 'pierogi_footer_text_filter', 1000 );

/**
 * Filter nav menu start element markup.
 *
 * @param  string $item_output Item output.
 * @param  object $item        Menu Item.
 * @param  int    $depth       Menu depth.
 * @param  string $args        Arguments.
 * @return string
 */
function pierogi_filter_nav_menu_start_el( $item_output, $item, $depth, $args ) {
	if ( isset( $args->mobile ) && $args->mobile && 0 === $depth ) {
		if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
			$item_output .= '<button class="mobile-submenu-button"></button>';
		}

		$item_output = sprintf( '<div class="item-wrap">%s</div>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'pierogi_filter_nav_menu_start_el', 10, 4 );

/**
 * Filter $content_width globals
 *
 * @param  int $width Content width.
 * @return int
 */
function pierogi_filter_content_width( $width ) {
	switch ( pierogi_get_layout() ) {
		case 'no-sidebar':
			$width = 896;
			break;
		case 'full-width':
			$width = 1640;
			break;
	}

	return $width;
}
add_action( 'pierogi_content_width', 'pierogi_filter_content_width', 1 );
