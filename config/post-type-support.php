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

namespace Dkjensen\JesusFilmProject;

return array(
	'add'    => array(
		'excerpt'                       => array( 'page' ),
		'genesis-layouts'               => array( 'product' ),
		'genesis-seo'                   => array( 'product' ),
		'genesis-singular-images'       => array( 'page', 'post' ),
		'genesis-title-toggle'          => array( 'post', 'product' ),
		'genesis-adjacent-entry-nav'    => array( 'post', 'product' ),
		'hero-section'                  => array( 'mission-trip', 'news' ),
		'custom-fields'                 => array( 'page' ),
		'genesis-cpt-archives-settings' => array( 'post', 'tribe_events', 'news' ),
	),
	'remove' => array(
		'author' => array( 'post' ),
	),
);
