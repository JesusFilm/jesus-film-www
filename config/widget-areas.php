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

$genesis_front_page_widgets = array();
$genesis_theme_supports     = genesis_get_config( 'theme-support' )['add'];

/* phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals */
for ( $i = 1; $i <= $genesis_theme_supports['front-page-widgets']; $i++ ) {
	$genesis_front_page_widgets[] = array(
		'id'          => 'front-page-' . $i,
		'name'        => __( 'Front Page ', 'jesus-film-project' ) . $i,
		/* translators: The front page widget area number. */
		'description' => \sprintf( __( 'The Front Page %s widget area.', 'jesus-film-project' ), $i ),
	);
}

return array(
	'add'    => \array_merge_recursive(
		array(
			array(
				'id'          => 'before-header',
				'name'        => __( 'Before Header', 'jesus-film-project' ),
				'description' => __( 'The Before Header widget area.', 'jesus-film-project' ),
			),
			array(
				'id'          => 'after-footer',
				'name'        => __( 'After Footer', 'jesus-film-project' ),
				'description' => __( 'The After Footer widget area.', 'jesus-film-project' ),
			),
			array(
				'id'          => 'primary-menu-responsive',
				'name'        => __( 'Responsive Primary Menu', 'jesus-film-project' ),
				'description' => __( 'Displays after the primary menu items on smaller devices.', 'jesus-film-project' ),
			),
		),
		$genesis_front_page_widgets
	),
	'remove' => array(
		'sidebar-alt',
	),
);
