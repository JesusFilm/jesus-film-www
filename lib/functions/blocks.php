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

add_action( 'init', __NAMESPACE__ . '\gutenberg_unset_global_styles' );
/**
 * Lowering specificity of WordPress global styles.
 * 
 * @return void
 */
function gutenberg_unset_global_styles() {
	// WP5.9+ only.
	if ( ! function_exists( 'wp_get_global_stylesheet' ) ) {
		return;
	}

	// Dequeue original WP global styles.
	\remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );

	// Enqueue WP global styles early.
	\add_action(
		'wp_enqueue_scripts',
		function() {

			// Lower CSS code specificity.
			$stylesheet = str_replace( array( 'body', '!important' ), array( ':root', '' ), \wp_get_global_stylesheet() );

			if ( empty( $stylesheet ) ) {
				return;
			}

			\wp_register_style( 'wp-global-styles', false );
			\wp_add_inline_style( 'wp-global-styles', $stylesheet );
			\wp_enqueue_style( 'wp-global-styles' );
		},
		0 
	);

	// Treat also editor styles.
	\add_filter(
		'block_editor_settings_all',
		function( $editor_settings ) {

			// Lower CSS code specificity.
			$editor_settings['styles'] = array_map(
				function( $style ) {
					if ( ! empty( $style['css'] ) ) {
						$style['css'] = str_replace( array( 'body', '!important' ), array( ':root', '' ), $style['css'] );
					}
					return $style;
				},
				$editor_settings['styles'] 
			);

			return $editor_settings;
		} 
	);
}
