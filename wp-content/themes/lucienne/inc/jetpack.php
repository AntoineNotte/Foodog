<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package Lucienne
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function Lucienne_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'main',
		'render'         => 'Lucienne_infinite_scroll_render',
		'footer'         => 'page',
		'footer_widgets' => array( 'footer-1', 'footer-2', 'footer-3' ),
	) );

	add_theme_support( 'jetpack-responsive-videos' );

	add_image_size( 'Lucienne-site-logo', '1000', '300' );

	add_theme_support( 'site-logo', array( 'size' => 'Lucienne-site-logo' ) );

} // end function Lucienne_jetpack_setup
add_action( 'after_setup_theme', 'Lucienne_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function Lucienne_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function Lucienne_infinite_scroll_render
