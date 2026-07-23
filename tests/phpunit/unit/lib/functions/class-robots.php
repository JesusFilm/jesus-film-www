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

namespace Dkjensen\JesusFilmProject\Tests\Unit\Functions;

use Brain\Monkey\Functions as Monkey_Functions;
use Dkjensen\JesusFilmProject\Tests\Unit\Test_Case;

use const Dkjensen\JesusFilmProject\Functions\WATCH_SITEMAP_URL;
use function Dkjensen\JesusFilmProject\Functions\add_watch_sitemap_to_robots;
use function Dkjensen\JesusFilmProject\Functions\register_robots_filters;

require_once CHILD_THEME_LIB_DIR . 'functions/robots.php';

/**
 * Test root robots crawler discovery.
 */
class Robots extends Test_Case {

	/**
	 * The robots filter is registered after plugin-provided output filters.
	 *
	 * @return void
	 */
	public function test_registers_robots_filter() {
		Monkey_Functions\expect( 'add_filter' )
			->once()
			->with(
				'robots_txt',
				'Dkjensen\JesusFilmProject\Functions\add_watch_sitemap_to_robots',
				99,
				2
			);

		register_robots_filters();
		$this->addToAssertionCount( 1 );
	}

	/**
	 * Public robots output advertises the canonical Watch sitemap.
	 *
	 * @return void
	 */
	public function test_appends_watch_sitemap_to_public_robots_output() {
		$output = "User-agent: *\nDisallow: /private";

		$this->assertSame(
			"User-agent: *\nDisallow: /private\nSitemap: " . WATCH_SITEMAP_URL . "\n",
			add_watch_sitemap_to_robots( $output, true )
		);
	}

	/**
	 * Private robots output remains unchanged.
	 *
	 * @return void
	 */
	public function test_preserves_private_robots_output() {
		$output = "User-agent: *\nDisallow: /\n";

		$this->assertSame( $output, add_watch_sitemap_to_robots( $output, false ) );
	}

	/**
	 * Existing Watch directives are canonicalized to one line.
	 *
	 * @return void
	 */
	public function test_canonicalizes_duplicate_watch_sitemap_directives() {
		$output = "User-agent: *\n"
			. 'Sitemap: ' . WATCH_SITEMAP_URL . "\n"
			. "Disallow: /private\n"
			. '  sitemap:   ' . WATCH_SITEMAP_URL . "  \n";

		$result = add_watch_sitemap_to_robots( $output, true );

		$this->assertSame( 1, $this->count_watch_sitemap_directives( $result ) );
		$this->assertStringContainsString( "User-agent: *\n", $result );
		$this->assertStringContainsString( "Disallow: /private\n", $result );
		$this->assertStringEndsWith( 'Sitemap: ' . WATCH_SITEMAP_URL . "\n", $result );
	}

	/**
	 * Existing CRLF Watch directives are canonicalized to one line.
	 *
	 * @return void
	 */
	public function test_canonicalizes_crlf_watch_sitemap_directive() {
		$output = "User-agent: *\r\n"
			. 'Sitemap: ' . WATCH_SITEMAP_URL . "\r\n"
			. "Disallow: /private\r\n";

		$result = add_watch_sitemap_to_robots( $output, true );

		$this->assertSame( 1, $this->count_watch_sitemap_directives( $result ) );
		$this->assertStringContainsString( "User-agent: *\r\n", $result );
		$this->assertStringContainsString( "Disallow: /private\n", $result );
		$this->assertStringEndsWith( 'Sitemap: ' . WATCH_SITEMAP_URL . "\n", $result );
	}

	/**
	 * Incidental URL mentions do not suppress a valid directive.
	 *
	 * @return void
	 */
	public function test_ignores_incidental_and_malformed_url_mentions() {
		$output = '# Monitor ' . WATCH_SITEMAP_URL . "\n"
			. 'Sitemap ' . WATCH_SITEMAP_URL . "\n";

		$result = add_watch_sitemap_to_robots( $output, true );

		$this->assertStringContainsString( '# Monitor ' . WATCH_SITEMAP_URL, $result );
		$this->assertStringContainsString( 'Sitemap ' . WATCH_SITEMAP_URL, $result );
		$this->assertSame( 1, $this->count_watch_sitemap_directives( $result ) );
	}

	/**
	 * Repeated filtering remains exact-once and stable.
	 *
	 * @return void
	 */
	public function test_repeated_filtering_is_idempotent() {
		$output = add_watch_sitemap_to_robots( '', true );
		$result = add_watch_sitemap_to_robots( $output, true );

		$this->assertSame( $output, $result );
		$this->assertSame( 1, $this->count_watch_sitemap_directives( $result ) );
	}

	/**
	 * Count complete canonical Watch sitemap directives.
	 *
	 * @param string $output Robots output.
	 *
	 * @return int
	 */
	private function count_watch_sitemap_directives( $output ) {
		return preg_match_all(
			'/^[\t ]*Sitemap:[\t ]*'
				. preg_quote( WATCH_SITEMAP_URL, '/' )
				. '[\t ]*\r?$/mi',
			$output
		);
	}
}
