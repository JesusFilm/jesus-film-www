<?php
/**
 * Mission trip archive.
 *
 * @package   Dkjensen\JesusFilmProject
 * @link      https://dkjensen.com
 * @author    David Jensen
 * @copyright Copyright © 2021 David Jensen
 * @license   GPL-3.0
 */

namespace Dkjensen\JesusFilmProject;

\remove_all_actions( 'genesis_after_content' );
\remove_all_actions( 'genesis_after_content_sidebar_wrap' );

// Remove default loop.
\remove_action( 'genesis_loop', __NAMESPACE__ . '\Structure\do_loop' );

\add_action( 'genesis_loop', __NAMESPACE__ . '\do_404' );
/**
 * This function outputs a 404 "Not Found" error message.
 *
 * @since 1.6
 */
function do_404() {

	\genesis_markup(
		array(
			'open'    => '<article class="entry">',
			'context' => 'entry-404',
		)
	);

	\genesis_markup(
		array(
			'open'    => '<h1 %s>',
			'close'   => '</h1>',
			'content' => \apply_filters( 'genesis_404_entry_title', __( 'Not found, error 404', 'genesis' ) ),
			'context' => 'entry-title',
		)
	);

	$genesis_404_content = sprintf(
		/* translators: %s: URL for current website. */
		__( 'The page you are looking for no longer exists. Perhaps you can return back to the <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it by using the search form below.', 'genesis' ),
		\esc_url( \trailingslashit( \home_url() ) )
	);

	$genesis_404_content = sprintf( '<p>%s</p>', $genesis_404_content );

	/**
	 * The 404 content (wrapped in paragraph tags).
	 *
	 * @since 2.2.0
	 *
	 * @param string $genesis_404_content The content.
	 */
	$genesis_404_content = \apply_filters( 'genesis_404_entry_content', $genesis_404_content );

	\genesis_markup(
		array(
			'open'    => '<div %s>',
			'close'   => '</div>',
			'content' => $genesis_404_content . \get_search_form( 0 ),
			'context' => 'entry-content',
		)
	);

	\genesis_markup(
		array(
			'close'   => '</article>',
			'context' => 'entry-404',
		)
	);

}

\genesis();
