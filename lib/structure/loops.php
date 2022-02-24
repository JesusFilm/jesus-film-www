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

\remove_action( 'genesis_loop', 'genesis_do_loop' );

\add_action( 'genesis_loop', __NAMESPACE__ . '\do_loop' );
/**
 * Use a template part for main query loops if exists.
 *
 * @return void
 */
function do_loop() {
    global $wp_query;

    if ( \is_singular( 'page' ) && \genesis_get_custom_field( 'query_args' ) ) {

		$paged = \get_query_var( 'paged' ) ?: 1;

		/*
		 * Convert custom field string to args array.
		 */
		$query_args = \wp_parse_args(
			\genesis_get_custom_field( 'query_args' ),
			[
				'paged' => $paged,
			]
		);

		\genesis_custom_loop( $query_args );
	} else {
        $post_type = $wp_query->query_vars['post_type'] ?? false;

        if ( $wp_query->is_main_query() && $post_type && false !== (bool) \locate_template( 'template-parts/content-' . $post_type . '.php' ) ) {

            if ( \have_posts() ) {

                \do_action( 'genesis_before_while' );
        
                while ( \have_posts() ) {
                    \the_post();
        
                    \get_template_part( 'template-parts/content', \get_post_type() );
                }
        
                \do_action( 'genesis_after_endwhile' );
        
            } else {
                \do_action( 'genesis_loop_else' );
            }

        } else {
            \genesis_standard_loop();
        }

	}
}
