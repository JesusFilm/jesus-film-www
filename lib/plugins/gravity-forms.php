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

namespace Dkjensen\JesusFilmProject\Plugins;

// Disable CSS output.
\add_filter( 'pre_option_rg_gforms_disable_css', '__return_true' );

\add_filter( 'gform_field_css_class', __NAMESPACE__ . '\gform_field_classes', 10, 2 );

function gform_field_classes( $classes, $field ) {
	switch ( $field->type ) {
		case 'text':
		case 'email':
		case 'phone':
		case 'textarea':
		case 'time':
		case 'number':
		case 'date':
			$classes .= ' gfield_label_placeholder';

			break;

		default:
	}

	return $classes;
}
