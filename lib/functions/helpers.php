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
 * Returns the child theme directory.
 *
 * @since 3.5.0
 *
 * @return string
 */
function get_theme_dir() {
	static $dir = null;

	if ( \is_null( $dir ) ) {
		$dir = \trailingslashit( \get_stylesheet_directory() );
	}

	return $dir;
}

/**
 * Returns the child theme URL.
 *
 * @since 3.5.0
 *
 * @return string
 */
function get_theme_url() {
	static $url = null;

	if ( \is_null( $url ) ) {
		$url = \trailingslashit( \get_stylesheet_directory_uri() );
	}

	return $url;
}

/**
 * Check if were on any type of singular page.
 *
 * @since 3.5.0
 *
 * @return bool
 */
function is_type_single() {
	return \is_front_page() || \is_single() || \is_page() || \is_404() || \is_attachment() || \is_singular();
}

/**
 * Check if were on any type of archive page.
 *
 * @since 3.5.0
 *
 * @return bool
 */
function is_type_archive() {
	return \is_home() || \is_post_type_archive() || \is_category() || \is_tag() || \is_tax() || \is_author() || \is_date() || \is_year() || \is_month() || \is_day() || \is_time() || \is_archive() || \is_search();
}

/**
 * Check if we are on the blog.
 *
 * @return bool
 */
function is_blog() {
	global $wp_query;

	return ( \is_home() || \is_category() || \is_tag() || \is_tax() || \is_author() || \is_date() || \is_year() || \is_month() || \is_day() || \is_time() || \is_archive() ) && ( isset( $wp_query->query_vars['post_type'] ) && '' === $wp_query->query_vars['post_type'] || 'post' === $wp_query->query_vars['post_type'] );
}

/**
 * Checks if current page has the hero section enabled.
 *
 * @since 3.5.0
 *
 * @return bool
 */
function has_hero_section() {
	return \in_array( 'has-hero-section', \get_body_class(), true );
}

/**
 * Return list of nav menus
 *
 * @return array
 */
function get_nav_menus() {
	$menus = \wp_get_nav_menus( array( 'fields' => 'id=>name' ) );

	array_unshift( $menus, '' );

	return $menus;
}

add_action(
	'init',
	function() {
		register_meta(
			'post',
			'_jf_submenu',
			array(
				'type'          => 'string',
				'auth_callback' => '__return_true',
				'single'        => true,
				'show_in_rest'  => true,
			) 
		);
	} 
);
