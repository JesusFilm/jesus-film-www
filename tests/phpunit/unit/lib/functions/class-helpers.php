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

use Brain\Monkey\Functions;
use function Dkjensen\JesusFilmProject\Functions\get_theme_url;
use function Dkjensen\JesusFilmProject\Functions\get_theme_dir;

/**
 * Class Tests_SampleTest
 *
 * @package KnowTheCode\StarterPlugin\Tests\PHP\Unit
 */
class Helpers extends Test_Case {

	/**
	 * Setup test case.
	 *
	 * @since 3.5.0
	 *
	 * @return void
	 */
	protected function setUp() {
		parent::setUp();

		require_once CHILD_THEME_LIB_DIR . 'functions/helpers.php';
	}
}
