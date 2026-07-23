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

namespace Dkjensen\JesusFilmProject\Functions;

/**
 * Canonical Watch sitemap index URL.
 */
const WATCH_SITEMAP_URL = 'https://www.jesusfilm.org/watch/sitemap.xml';

/**
 * Register root crawler-discovery filters.
 *
 * @return void
 */
function register_robots_filters() {
	// phpcs:ignore WordPressVIPMinimum.Hooks.RestrictedHooks.robots_txt -- Release verification includes a root robots cache purge.
	\add_filter( 'robots_txt', __NAMESPACE__ . '\add_watch_sitemap_to_robots', 99, 2 );
}

/**
 * Advertise the Watch sitemap index in the authoritative root robots file.
 *
 * @param string $output Current robots.txt output.
 * @param bool   $public Whether the site is public.
 *
 * @return string
 */
function add_watch_sitemap_to_robots( $output, $public ) {
	if ( ! $public ) {
		return $output;
	}

	$watch_sitemap_directive = 'Sitemap: ' . WATCH_SITEMAP_URL;
	$watch_sitemap_pattern   = '/^[\t ]*Sitemap:[\t ]*'
		. preg_quote( WATCH_SITEMAP_URL, '/' )
		. '[\t ]*\r?$/mi';
	$output_without_watch    = preg_replace( $watch_sitemap_pattern, '', $output );

	if ( null === $output_without_watch ) {
		$output_without_watch = $output;
	}

	$output_without_watch = rtrim( $output_without_watch );

	if ( '' !== $output_without_watch ) {
		$output_without_watch .= "\n";
	}

	return $output_without_watch . $watch_sitemap_directive . "\n";
}
