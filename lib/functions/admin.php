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

namespace Dkjensen\JesusFilmProject\Functions;

\add_filter( 'manage_posts_columns', __NAMESPACE__ . '\remove_post_author_column' );
/**
 * Modify post columns in admin
 *
 * @param array $columns Default post columns.
 * @return array
 */
function remove_post_author_column( $columns ) {
	unset( $columns['author'] );

	return $columns;
}

\add_filter( 'map_meta_cap', __NAMESPACE__ . '\allow_unfiltered_html', 1, 3 );
/**
 * Allow unfiltered HTML for admins
 *
 * @param array  $capabilities Capabilities for user/role.
 * @param string $capability Capability to compare.
 * @param int    $user_id User ID.
 * @return array
 */
function allow_unfiltered_html( $capabilities, $capability, $user_id ) {
	if ( 'unfiltered_html' === $capability && \user_can( $user_id, 'manage_options' ) ) {
		$capabilities = array( 'unfiltered_html' );
	}

	return $capabilities;
}

/**
 * Allow ACF unfiltered HTML
 */
\add_filter( 'acf/allow_unfiltered_html', '__return_true' );
