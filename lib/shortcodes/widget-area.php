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

namespace Dkjensen\JesusFilmProject\Shortcodes;

\add_shortcode( 'widget_area', __NAMESPACE__ . '\widget_area_shortcode' );
/**
 * Displays a widget area.
 *
 * @since 3.5.0
 *
 * @param array $atts Shortcode arguments.
 *
 * @return mixed
 */
function widget_area_shortcode( $atts ) {
	if ( \is_admin() ) {
		return false;
	}

	$atts = \shortcode_atts(
		array(
			'id' => 'footer-credits',
		),
		$atts,
		'widget_area'
	);

	\ob_start();
	\genesis_widget_area(
		$atts['id'],
		array(
			'before' => '<div class="' . $atts['id'] . ' widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		)
	);

	return \ob_get_clean();
}
