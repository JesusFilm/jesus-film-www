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
		'align-wide',
		'automatic-feed-links',
		'custom-header'            => array(
			'header-selector'  => '.hero-section',
			'default_image'    => get_theme_url() . 'assets/img/hero.jpg',
			'header-text'      => false,
			'width'            => 1280,
			'height'           => 720,
			'flex-height'      => true,
			'flex-width'       => true,
			'uploads'          => true,
			'video'            => true,
			'wp-head-callback' => __NAMESPACE__ . '\Functions\header',
		),
		'editor-styles',
		'front-page-widgets'       => 0,
		'genesis-accessibility'    => array(
			'404-page',
			'drop-down-menu',
			'headings',
			'rems',
			'search-form',
			'skip-links',
		),
		'genesis-after-entry-widget-area',
		'genesis-custom-logo'      => array(
			'height'      => 58,
			'width'       => 140,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array(
				'.site-title',
				'.site-description',
			),
		),
		'genesis-footer-widgets'   => 3,
		'genesis-menus'            => array(
			'primary' => __( 'Header Menu', 'jesus-film-project' ),
			'submenu' => __( 'Sub Menu', 'jesus-film-project' ),
		),
		'genesis-structural-wraps' => array(
			'header',
			'menu-secondary',
			'hero-section',
			'footer-widgets',
			'front-page-widgets',
		),
		'gutenberg'                => array(
			'wide-images' => true,
		),
		'hero-section',
		'html5'                    => array(
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'search-form',
		),
		'post-thumbnails',
		'responsive-embeds',
		// phpcs:ignore Squiz.PHP.CommentedOutCode.Found
		// 'sticky-header',
		// phpcs:ignore Squiz.PHP.CommentedOutCode.Found
		// 'transparent-header',
		'woocommerce',
		'wc-product-gallery-zoom',
		'wc-product-gallery-lightbox',
		'wc-product-gallery-slider',
		'wp-block-styles',
		'custom-spacing',
		'editor-color-palette'     => array(
			array(
				'name'  => esc_html__( 'Primary', 'jesus-film-project' ),
				'slug'  => 'primary',
				'color' => '#ef3340',
			),
			array(
				'name'  => esc_html__( 'Secondary', 'jesus-film-project' ),
				'slug'  => 'secondary',
				'color' => '#6c757d',
			),
			array(
				'name'  => esc_html__( 'Gray 100', 'jesus-film-project' ),
				'slug'  => 'gray-100',
				'color' => '#fcfbf9',
			),
			array(
				'name'  => esc_html__( 'White', 'jesus-film-project' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html__( 'Black', 'jesus-film-project' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
			array(
				'name'  => esc_html__( 'Tan', 'jesus-film-project' ),
				'slug'  => 'tan',
				'color' => '#f0ede3',
			),
		),
		'editor-font-sizes'        => array(
			array(
				'name' => esc_attr__( 'Small', 'jesus-film-project' ),
				'size' => 12,
				'slug' => 'small',
			),
			array(
				'name' => esc_attr__( 'Regular', 'jesus-film-project' ),
				'size' => 16,
				'slug' => 'regular',
			),
			array(
				'name' => esc_attr__( 'Medium', 'jesus-film-project' ),
				'size' => 18,
				'slug' => 'medium',
			),
			array(
				'name' => esc_attr__( 'Large', 'jesus-film-project' ),
				'size' => 30,
				'slug' => 'large',
			),
			array(
				'name' => esc_attr__( 'Huge', 'jesus-film-project' ),
				'size' => 50,
				'slug' => 'huge',
			),
			array(
				'name' => esc_attr__( 'Gigantic', 'jesus-film-project' ),
				'size' => 90,
				'slug' => 'gigantic',
			),
			array(
				'name' => esc_attr__( 'Enormous', 'jesus-film-project' ),
				'size' => 100,
				'slug' => 'enormous',
			),
		),
		'editor-gradient-presets'  => array(),
	),
	'remove' => array(
		'genesis-seo-settings-menu',
		'genesis-customizer-seo-settings',
	),
);
