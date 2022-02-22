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

/**
 * Register block and related scripts
 *
 * @return void
 */
function register_block() {
	\register_block_type_from_metadata( \trailingslashit( __DIR__ ) . '../blocks/template-part',
		array(
			'render_callback'   => __NAMESPACE__ . '\render_block_template_part',
			'skip_inner_blocks' => true,
		)
	);
}
\add_action( 'init', __NAMESPACE__ . '\register_block' );

/**
 * Renders the post template part on the server.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 * @return string  Returns the template part for the given post.
 */
function render_block_template_part( $attributes, $content, $block ) {
	if ( ! isset( $block->context['postId'] ) ) {
		return '';
	}

	$content = get_template_part( $block->context['postId'] );

	\wp_reset_postdata();

	return \apply_filters( 'wp_block_template_part_content', sprintf( '<div %1$s>%2$s</div>', \get_block_wrapper_attributes(), $content ), $block, $attributes );
}

/**
 * Helper function to get template part for a given post
 *
 * @param  int|WP_Post $post Post to get template part for.
 * @return string
 */
function get_template_part( $post ) {
	$content = '';
	$post    = \get_post( $post );

	ob_start();

	\get_template_part(
		\apply_filters( 'wp_block_template_part', 'template-parts/content-' . $post->post_type, $post ),
		\get_post_format( $post )
	);

	$has_template_part = ob_get_clean();

	if ( $has_template_part ) {
		$content = $has_template_part;
	}

	return $content;
}

/**
 * Register REST API fields
 *
 * @return void
 */
function rest_api_post_fields() {
	$post_types = \get_post_types( array( 'show_in_rest' => true ) );

	\register_rest_field(
		array_values( $post_types ),
		'template_part',
		array(
			'get_callback' => __NAMESPACE__ . '\rest_field_template_part',
			'schema'       => null,
		)
	);
}
\add_action( 'rest_api_init', __NAMESPACE__ . '\rest_api_post_fields' );

/**
 * `template_part` meta field callback
 *
 * @param array $object Post object.
 * @return string
 */
function rest_field_template_part( $object ) {
	return get_template_part( $object['id'] );
}

\add_filter( 'image_size_names_choose', __NAMESPACE__ . '\block_image_sizes' );
/**
 * Add custom image sizes to blocks.
 *
 * @param array $sizes Custom image sizes.
 * @return array
 */
function block_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'featured' => _x( 'Featured', 'Image size', 'jesus-film-project' ),
		'card'     => _x( 'Card', 'Image size', 'jesus-film-project' ),
    ) );
}
