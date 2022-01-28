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

// Reposition featured image.
\remove_action( 'genesis_entry_content', 'genesis_do_singular_image', 8 );
\add_action( 'genesis_entry_header', 'genesis_do_singular_image' );

\add_action( 'after_setup_theme', __NAMESPACE__ . '\disable_edit_post_link' );
/**
 * Disables the post edit link.
 *
 * @since 3.5.0
 *
 * @return void
 */
function disable_edit_post_link() {
	\add_filter( 'edit_post_link', '__return_empty_string' );
}
