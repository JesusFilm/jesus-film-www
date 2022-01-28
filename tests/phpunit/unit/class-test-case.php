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

namespace Dkjensen\JesusFilmProject\Tests\Unit;

use Brain\Monkey;
use Brain\Monkey\Functions;
use PHPUnit\Framework\TestCase;

/**
 * Abstract Class Test_Case
 *
 * @package Dkjensen\JesusFilmProject\Tests\Unit
 */
abstract class Test_Case extends TestCase {

	/**
	 * Prepares the test environment before each test.
	 *
	 * @since 3.5.0
	 *
	 * @return void
	 */
	protected function setUp() {
		parent::setUp();
		Monkey\setUp();
	}

	/**
	 * Cleans up the test environment after each test.
	 *
	 * @since 3.5.0
	 *
	 * @return void
	 */
	protected function tearDown() {
		Monkey\tearDown();
		parent::tearDown();
	}

	/**
	 * Setup the stubs for the common WordPress escaping and internationalization functions.
	 *
	 * @since 3.5.0
	 *
	 * @return void
	 */
	protected function setup_common_wp_stubs() {

		// Common escaping functions.
		Functions\stubs(
			array(
				'esc_attr',
				'esc_html',
				'esc_textarea',
				'esc_url',
				'hello',
				'wp_kses_post',
			)
		);

		// Common internationalization functions.
		Functions\stubs(
			array(
				'__',
				'esc_html__',
				'esc_html_x',
				'esc_attr_x',
			)
		);

		foreach ( array( 'esc_attr_e', 'esc_html_e', '_e' ) as $wp_function ) {
			Functions\when( $wp_function )->echoArg();
		}
	}
}
