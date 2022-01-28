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

use function Dkjensen\JesusFilmProject\Functions\get_theme_url;

return array(
	'add'    => array(
		array(
			'id'    => 'narrow-content',
			'label' => __( 'Narrow Content', 'jesus-film-project' ),
			'img'   => get_theme_url() . 'assets/img/narrow-content.gif',
		),
	),
	'remove' => array(
		'content-sidebar-sidebar',
		'sidebar-sidebar-content',
		'sidebar-content-sidebar',
	),
);
