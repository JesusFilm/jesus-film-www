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

\add_shortcode( 'search_form', __NAMESPACE__ . '\search_form_shortcode' );
/**
 * Displays a search form.
 *
 * @since 3.5.0
 *
 * @return string
 */
function search_form_shortcode() {
	if ( \is_admin() ) {
		return false;
	}

	return \get_search_form( false );
}
