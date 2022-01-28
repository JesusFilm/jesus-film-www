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
	'script' => array(
		'mainMenu'         => sprintf( '<span class="hamburger"> </span><span class="screen-reader-text">%s</span>', __( 'Menu', 'jesus-film-project' ) ),
		'menuIconClass'    => null,
		'subMenuIconClass' => null,
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
				'.nav-secondary',
			),
		),
		'menuAnimation'    => array(
			'effect'   => 'fadeToggle',
			'duration' => 'fast',
			'easing'   => 'swing',
		),
		'subMenuAnimation' => array(
			'effect'   => 'slideToggle',
			'duration' => 'fast',
			'easing'   => 'swing',
		),
	),
	'extras' => array(
		'media_query_width' => '896px',
	),
);
