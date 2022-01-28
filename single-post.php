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

\genesis();
