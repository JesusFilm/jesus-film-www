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

\add_action( 'pre_get_posts', __NAMESPACE__ . '\mission_trip_query_args' );
/**
 * Mission trip taxonomies query mission-trip post type
 *
 * @return void
 */
function mission_trip_query_args( $query ) {
	if ( ! $query->is_main_query() || \is_admin() ) {
		return;
	}

	if ( \is_tax( 'region' ) || \is_tax( 'strategy' ) ) {
		$query->set( 'post_type', 'mission-trip' );
	}

	\flush_rewrite_rules();
}

\add_filter( 'posts_join', __NAMESPACE__ . '\post_author_join', 10, 2 );
/**
 * Join term_relationships table on author query.
 *
 * @param string   $join Default JOIN clause.
 * @param WP_Query $query WP_Query object.
 * @return string
 */
function post_author_join( $join, $query ) {
	global $wpdb;
	
	if ( ! \is_admin() && ! empty( $query->query_vars['author_name'] ) ) {
		$join .= " LEFT JOIN {$wpdb->term_relationships} AS tt99 ON ( {$wpdb->posts}.ID = tt99.object_id ) ";
	}

	return $join;
}

\add_filter( 'posts_where', __NAMESPACE__ . '\post_author_where', 10, 2 );
/**
 * Only shows posts associated with a given author from jf_author taxonomy.
 *
 * @param string   $where Default WHERE clause.
 * @param WP_Query $query WP_Query object.
 * @return string
 */
function post_author_where( $where, $query ) {
	global $wpdb;

	if ( ! \is_admin() && ! empty( $query->query_vars['author_name'] ) ) {
		$author = \get_term_by( 'slug', $query->query_vars['author_name'], 'jf_author' );

		if ( $author && ! \is_wp_error( $author ) ) {
			$where = \preg_replace( "/{$wpdb->posts}\.post_author([\s]+)=([\s]+)?([\d]+)([\s]+)?/", $wpdb->prepare( ' tt99.term_taxonomy_id IN (%d) ', $author->term_id ), $where, 1 );
		} else {
			$where .= ' AND 1 = 2 ';
		}
	}

	return $where;
}

\add_filter( 'posts_distinct', __NAMESPACE__ . '\post_author_distinct', 10, 2 );
/**
 * Force posts by author to be distinct
 *
 * @param string   $distinct Whether query should return distinct results.
 * @param WP_Query $query WP_Query object.
 * @return string
 */
function post_author_distinct( $distinct, $query ) {
	global $wpdb;

	if ( ! \is_admin() && ! empty( $query->query_vars['author_name'] ) ) {
		return 'DISTINCT';
	}

	return $distinct;
}
