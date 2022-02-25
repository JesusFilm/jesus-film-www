<?php
/**
 * Search results.
 *
 * @package   Dkjensen\JesusFilmProject
 * @link      https://dkjensen.com
 * @author    David Jensen
 * @copyright Copyright © 2021 David Jensen
 * @license   GPL-3.0
 */

namespace Dkjensen\JesusFilmProject;

\remove_all_actions( 'genesis_loop' );

\remove_filter( 'post_class', __NAMESPACE__ . '\Structure\archive_post_class' );

\add_action( 'genesis_before_loop', __NAMESPACE__ . '\do_search_title' );
/**
 * Echo the title with the search term.
 *
 * @since 1.9.0
 */
function do_search_title() {

	$title = sprintf( '<div class="archive-description"><h1 class="archive-title">%s %s</h1></div>', \apply_filters( 'genesis_search_title_text', \__( 'Search Results for:', 'genesis' ) ), \get_search_query() );

	echo \apply_filters( 'genesis_search_title_output', $title ) . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

\add_action( 'genesis_loop', __NAMESPACE__ . '\do_search_results' );

function do_search_results() {
    if ( \have_posts() ) {

        \do_action( 'genesis_before_while' );

        while ( \have_posts() ) {
            \the_post();

            \get_template_part( 'template-parts/content', 'search' );
        }

        \do_action( 'genesis_after_endwhile' );

    } else {
        \do_action( 'genesis_loop_else' );
    }
}

\genesis();
