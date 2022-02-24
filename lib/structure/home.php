<?php
/**
 * Jesus Film Project.
 *
 * @package   Dkjensen\JesusFilmProject
 * @link      https://dkjensen.com
 * @author    David Jensen
 * @copyright Copyright © 2021 David Jensen
 * @license   GPL-3.0
 */

namespace Dkjensen\JesusFilmProject\Structure;

use function Dkjensen\JesusFilmProject\Functions\is_blog;

\add_action( 'genesis_meta', __NAMESPACE__ . '\post_archive_header', 5 );
/**
 * Only add hooks if were on the blog.
 *
 * @return void
 */
function post_archive_header() {
	if ( is_blog() ) {
		\remove_all_actions( 'genesis_before_loop' );

		\add_action( 'genesis_before_content', __NAMESPACE__ . '\post_archive_header_markup' );
	}
}

/**
 * Render the blog archive header.
 *
 * @return void
 */
function post_archive_header_markup() {
	global $wp_query;

	if ( 'page' === \get_option( 'show_on_front' ) && \get_option( 'page_for_posts' ) ) {
		$blog = \get_post( \get_option( 'page_for_posts' ) );

		if ( $blog && 'post' === ( $wp_query->query_vars['post_type'] ?: 'post' ) ) {
			\genesis_markup(
				array(
					'open'    => '<section class="post-archive-header">',
					'close'   => '</section>',
					'context' => 'post-archive-header',
					'content' => \apply_filters( 'the_content', $blog->post_content ),
				) 
			);
		}
	}
}

\add_filter( 'body_class', __NAMESPACE__ . '\front_page_body_class' );
/**
 * Add additional classes to the body element.
 *
 * @since  3.5.0
 *
 * @param  array $classes Body classes.
 *
 * @return array
 */
function front_page_body_class( $classes ) {
	if ( ! \is_front_page() ) {
		return $classes;
	}

	$classes   = \array_diff( $classes, array( 'no-hero-section' ) );
	$classes[] = 'front-page';

	return $classes;
}
