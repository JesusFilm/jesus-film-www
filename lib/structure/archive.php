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

use function Dkjensen\JesusFilmProject\Functions\is_type_archive;

// Reposition entry image.
\remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
\add_action( 'genesis_entry_header', 'genesis_do_post_image', 1 );

\add_filter( 'post_class', __NAMESPACE__ . '\archive_post_class' );
/**
 * Add column class to archive posts.
 *
 * @since 3.5.0
 *
 * @param array $classes Array of post classes.
 *
 * @return array
 */
function archive_post_class( $classes ) {
	if ( ! is_type_archive() ) {
		return $classes;
	}

	if ( \class_exists( 'WooCommerce' ) && \is_woocommerce() ) {
		return $classes;
	}

	if ( \did_action( 'genesis_before_sidebar_widget_area' ) ) {
		return $classes;
	}

	if ( 'full-width-content' === \genesis_site_layout() ) {
		$classes[] = 'one-third';
		$count     = 3;

	} else {
		$classes[] = 'one-half';
		$count     = 2;
	}

	global $wp_query;

	if ( 0 === $wp_query->current_post || 0 === $wp_query->current_post % $count ) {
		$classes[] = 'first';
	}

	return $classes;
}

\add_filter( 'get_the_content_more_link', __NAMESPACE__ . '\read_more_link' );
\add_filter( 'the_content_more_link', __NAMESPACE__ . '\read_more_link' );
/**
 * Modify the content limit read more link
 *
 * @since 3.5.0
 *
 * @param string $more_link_text Default more link text.
 *
 * @return string
 */
function read_more_link( $more_link_text ) {
	return \str_replace( array( '[', ']', '...' ), '', $more_link_text );
}

\add_filter( 'genesis_author_box_gravatar_size', __NAMESPACE__ . '\author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 *
 * @return int Modified icon size.
 */
function author_box_gravatar( $size ) {
	return \genesis_get_config( 'genesis-settings' )['avatar_size'];
}

\add_action( 'genesis_entry_header', __NAMESPACE__ . '\entry_wrap_open', 4 );
/**
 * Outputs the opening entry wrap markup.
 *
 * @since 3.5.0
 *
 * @return void
 */
function entry_wrap_open() {
	if ( is_type_archive() ) {
		\genesis_markup(
			array(
				'open'    => '<div %s>',
				'context' => 'entry-wrap',
			)
		);
	}
}

\add_action( 'genesis_entry_footer', __NAMESPACE__ . '\entry_wrap_close', 15 );
/**
 * Outputs the closing entry wrap markup.
 *
 * @since 3.5.0
 *
 * @return void
 */
function entry_wrap_close() {
	if ( is_type_archive() ) {
		\genesis_markup(
			array(
				'close'   => '</div>',
				'context' => 'entry-wrap',
			)
		);
	}
}

\add_filter( 'genesis_markup_entry-header_open', __NAMESPACE__ . '\widget_entry_wrap_open', 10, 2 );
/**
 * Outputs the opening entry wrap markup in widgets.
 *
 * @since 3.5.0
 *
 * @param string $open Opening markup.
 * @param array  $args Markup args.
 *
 * @return string
 */
function widget_entry_wrap_open( $open, $args ) {
	if ( isset( $args['params']['is_widget'] ) && $args['params']['is_widget'] ) {
		$markup = \genesis_markup(
			array(
				'open'    => '<div %s>',
				'context' => 'entry-wrap',
				'echo'    => false,
			)
		);

		$open = $markup . $open;
	}

	return $open;
}

\add_filter( 'excerpt_length', __NAMESPACE__ . '\excerpt_length' );
/**
 * Excerpt length.
 *
 * @param integer $length Default excerpt length.
 * 
 * @return integer
 */
function excerpt_length( $length ) {
	return 22;
}

\add_filter( 'excerpt_more', __NAMESPACE__ . '\excerpt_more' );
/**
 * Excerpt more.
 *
 * @param string $length Default excerpt more.
 * 
 * @return string
 */
function excerpt_more( $length ) {
	return '&hellip;';
}
