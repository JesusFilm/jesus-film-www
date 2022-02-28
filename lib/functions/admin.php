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
	$columns['jf_author'] = esc_html__( 'Author', 'jesus-film-project' );

	return $columns;
}

\add_action( 'manage_posts_custom_column', __NAMESPACE__ . '\post_author_jf_column', 10, 2 );
/**
 * Custom author column output
 *
 * @param string $column_name Column name.
 * @param int    $post_id Post ID.
 * @return void
 */
function post_author_jf_column( $column_name, $post_id ) {
	$post = \get_post( $post_id );

	if ( 'jf_author' === $column_name ) {
		$author = current( (array) \wp_get_post_terms( $post->ID, 'jf_author', array( 'hide_empty' => false ) ) );

		if ( $author && isset( $author->term_id ) ) {
			printf( '<a href="%s">%s</a>', add_query_arg( array( 'jf_author' => $author->slug ), 'edit.php' ), esc_html( $author->name ) );
		}
	}

	\wp_reset_postdata();
}
