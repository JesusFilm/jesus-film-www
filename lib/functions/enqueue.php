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

// Genesis style trump.
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 99 );

\add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );
\add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\enqueue_assets' );
/**
 * Register and enqueue all scripts and styles.
 *
 * @since 3.5.0
 *
 * @return void
 */
function enqueue_assets() {
	$assets = \genesis_get_config( 'scripts-and-styles' )['add'];

	foreach ( $assets as $asset ) {
		$type      = false !== strpos( $asset['src'], '.js' ) ? 'script' : 'style';
		$handle    = $asset['handle'];
		$src       = isset( $asset['src'] ) ? $asset['src'] : '';
		$deps      = isset( $asset['deps'] ) ? $asset['deps'] : array();
		$ver       = isset( $asset['ver'] ) ? $asset['ver'] : \genesis_get_theme_version();
		$media     = isset( $asset['media'] ) ? $asset['media'] : 'all';
		$in_footer = isset( $asset['in_footer'] ) ? $asset['in_footer'] : true;
		$editor    = isset( $asset['editor'] ) ? $asset['editor'] : false;
		$condition = isset( $asset['condition'] ) ? $asset['condition'] : '__return_true';
		$localize  = isset( $asset['localize'] ) ? $asset['localize'] : array();
		$last_arg  = 'style' === $type ? $media : $in_footer;
		$register  = "wp_register_$type";
		$enqueue   = "wp_enqueue_$type";

		if ( \is_admin() && $editor || ! \is_admin() && ! $editor || 'both' === $editor ) {
			if ( is_callable( $condition ) && $condition() ) {
				$register( $handle, $src, $deps, $ver, $last_arg );
				$enqueue( $handle );

				if ( ! empty( $localize ) ) {
					\wp_localize_script( $handle, $localize['name'], $localize['data'] );
				}
			}
		}
	}
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\deregister_scripts' );
/**
 * Deregister scripts.
 *
 * @since 3.5.0
 *
 * @return void
 */
function deregister_scripts() {
	$assets = \genesis_get_config( 'scripts-and-styles' )['remove'];

	foreach ( $assets as $asset ) {
		\wp_deregister_script( $asset );
	}
}

/**
 * Redirect to URL if query parameter is provided.
 *
 * @return void
 */
function branded_checkout_redirect_callback() {
	?>

	<script>
		function brandedCheckoutRedirect() {
			const queryString = window.location.search;
			const urlParams = new URLSearchParams(queryString);
			const maybeRedirect = urlParams.get('thankYouRedirect');
			if (maybeRedirect && maybeRedirect.length > 0) {
				window.location = maybeRedirect;
			}
		}
		window.onOrderCompleted = function () { brandedCheckoutRedirect(); };
	</script>

	<?php
}
\add_action( 'wp_footer', __NAMESPACE__ . '\branded_checkout_redirect_callback' );
