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

\add_action( 'init', __NAMESPACE__ . '\register_blocks' );

function register_blocks() {
	if ( ! function_exists( '\register_block_type' ) ) {
		return;
	}

	\register_block_type(
		'jp/card',
		array() 
	); 
}
