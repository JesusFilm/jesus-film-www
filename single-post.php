<?php
/**
 * Single posts.
 *
 * @package   Dkjensen\JesusFilmProject
 * @link      https://dkjensen.com
 * @author    David Jensen
 * @copyright Copyright © 2021 David Jensen
 * @license   GPL-3.0
 */

namespace Dkjensen\JesusFilmProject;

\remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_posts_nav' );
\remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_adjacent_entry_nav' );

\add_filter( 'genesis_site_layout', __NAMESPACE__ . '\single_site_layout' );
/**
 * Site layout.
 *
 * @param string $layout Default layout.
 * 
 * @return string
 */
function single_site_layout( $layout ) {
	return 'narrow-content';
}

add_action( 'genesis_entry_header', __NAMESPACE__ . '\single_post_header_info', 9 );
/**
 * Echo the post meta.

 * @return void
 */
function single_post_header_info() {
	if ( ! \is_singular() || ! \is_main_query() ) {
		return;
	}

	ob_start();

	echo do_shortcode( '[post_author_box]' );
	echo do_shortcode( '[share_post]' );

	$content = ob_get_clean();

	\genesis_markup(
		array(
			'open'    => '<div %s>',
			'close'   => '</div>',
			'content' => \genesis_strip_p_tags( $content ),
			'context' => 'entry-post-header-info',
		)
	);

}

\genesis();
