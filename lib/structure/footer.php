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

\add_action( 'genesis_footer', __NAMESPACE__ . '\after_footer_widget', 7 );
/**
 * Displays after footer widget area.
 *
 * @since 3.5.0
 *
 * @return void
 */
function after_footer_widget() {
	\genesis_widget_area(
		'after-footer',
		array(
			'before' => '<div class="after-footer"><div class="wrap">',
			'after'  => '</div></div>',
		)
	);
}

// Repositions the footer widgets.
\remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
\add_action( 'genesis_footer', 'genesis_footer_widget_areas', 6 );

// Remove default footer.
\remove_action( 'genesis_footer', 'genesis_do_footer' );
