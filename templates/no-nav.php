<?php
/**
 * Template Name: No Navigation
 *
 * Template Post Type: page, development, messages
 *
 * @package   Dkjensen\JesusFilmProject
 * @link      https://dkjensen.com
 * @author    David Jensen
 * @copyright Copyright © 2021 David Jensen
 * @license   GPL-3.0
 */

namespace Dkjensen\JesusFilmProject;

\remove_action( 'genesis_after_title_area', 'genesis_do_nav' );
\remove_action( 'genesis_before_header_wrap', 'Dkjensen\\JesusFilmProject\\Structure\\before_header_widget' );
\remove_action( 'genesis_after_title_area', 'Dkjensen\\JesusFilmProject\\Structure\\primary_menu_search_bar' );
\remove_action( 'genesis_after_title_area', 'Dkjensen\\JesusFilmProject\\Structure\\header_search_responsive', 15 );
\remove_action( 'genesis_after_header_wrap', 'Dkjensen\\JesusFilmProject\\Structure\\do_submenu' );

\add_action(
	'genesis_header',
	function() {
		global $wp_registered_sidebars;

		if ( isset( $wp_registered_sidebars['header-right'] ) ) {
			unset( $wp_registered_sidebars['header-right'] );
		}

	},
	0 
);

// Runs the Genesis loop.
\genesis();
