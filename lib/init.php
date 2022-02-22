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

/**
 * Autoload classes.
 *
 * @noinspection PhpUnhandledExceptionInspection
 */
\spl_autoload_register(
	function ( $class ) {
		if ( strpos( $class, __NAMESPACE__ ) === false ) {
			return;
		}

		$class_dir  = dirname( __DIR__ ) . '/lib/classes/';
		$class_name = strtolower( str_replace( __NAMESPACE__, '', $class ) );
		$class_file = str_replace( '\\', '-', $class_name );

		/* @noinspection PhpIncludeInspection */
		require_once "{$class_dir}class{$class_file}.php";
	}
);

/**
 * Autoload files.
 */
\array_map(
	function ( $file ) {
		$filename = __DIR__ . "/$file.php";

		if ( \is_readable( $filename ) ) {
			require_once $filename;
		}
	},
	array(
		// Composer.
		'../vendor/autoload',

		// Functions.
		'functions/blocks',
		'functions/helpers',
		'functions/setup',
		'functions/enqueue',
		'functions/markup',
		'functions/header',
		'functions/widgets',
		'functions/defaults',
		'functions/onboarding',
		'functions/user-meta',

		// Structure.
		'structure/archive',
		'structure/comments',
		'structure/footer',
		'structure/header',
		'structure/hero',
		'structure/home',
		'structure/menus',
		'structure/pagination',
		'structure/single',
		'structure/wrap',

		// Shortcodes.
		'shortcodes/hook',
		'shortcodes/search-form',
		'shortcodes/widget-area',
		'shortcodes/post-author-box',
		'shortcodes/share-post',

		// Plugins.
		'plugins/gravity-forms',
		'plugins/woocommerce',
	)
);
