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

namespace Dkjensen\JesusFilmProject\Structure;

\add_filter( 'genesis_markup_title-area_close', __NAMESPACE__ . '\title_area_hook', 10, 1 );
/**
 * Add custom hook after the title area.
 *
 * @since 3.5.0
 *
 * @param string $close_html Closing html markup.
 *
 * @return string
 */
function title_area_hook( $close_html ) {
	if ( $close_html ) {
		\ob_start();
		\do_action( 'genesis_after_title_area' );
		$close_html = $close_html . ob_get_clean();
	}

	return $close_html;
}

\add_action( 'genesis_before_header_wrap', __NAMESPACE__ . '\before_header_widget' );
/**
 * Displays the before header widget area.
 *
 * @since 3.5.0
 *
 * @return void
 */
function before_header_widget() {
	\genesis_widget_area(
		'before-header',
		array(
			'before' => '<div class="before-header"><div class="wrap">',
			'after'  => '</div></div>',
		)
	);
}

\add_filter( 'get_custom_logo', __NAMESPACE__ . '\custom_logo_size' );
/**
 * Add max-width style to custom logo.
 *
 * @since 3.5.0
 *
 * @param string $html Custom logo HTML output.
 *
 * @return string
 */
function custom_logo_size( $html ) {
	$svg_logo = file_get_contents( get_theme_file_path( 'assets/svg/jfp-logo-red.svg' ) );

	$html = \preg_replace( '/<img.+?(?=>)>/m', $svg_logo, $html );

	return \str_replace( '<svg ', '<span class="screen-reader-text">' . esc_html__( 'Home', 'jesus-film-project' ) . '</span><svg class="custom-logo" ', $html );
}

\add_filter( 'wp_nav_menu', __NAMESPACE__ . '\primary_menu_search', 10, 2 );
/**
 * Append search function to primary menu
 *
 * @param string $nav_menu Rendered HTML.
 * @param object $args Nav menu args.
 * @return string
 */
function primary_menu_search( $nav_menu, $args ) {
	if ( 'primary' === $args->theme_location ) {
		$nav_menu .= '<a href="#" class="header-search-toggle" id="header-search-toggle" data-header-search-toggle><i class="icon-search"></i></a>';
	}

	return $nav_menu;
}

\add_filter( 'wp_nav_menu', __NAMESPACE__ . '\primary_menu_responsive_widgets', 11, 2 );
/**
 * Append widgets to primary menu
 *
 * @param string $nav_menu Rendered HTML.
 * @param object $args Nav menu args.
 * @return string
 */
function primary_menu_responsive_widgets( $nav_menu, $args ) {
	if ( 'primary' === $args->theme_location ) {
		ob_start();
		?>

		<div class="nav-primary-responsive-widgets">
			<?php \dynamic_sidebar( 'primary-menu-responsive' ); ?>
		</div>

		<?php
		$nav_menu .= ob_get_clean();
	}

	return $nav_menu;
}

\add_action( 'genesis_after_title_area', __NAMESPACE__ . '\primary_menu_search_bar' );

/**
 * Render the search bar form
 *
 * @return void
 */
function primary_menu_search_bar() {
	?>

	<div class="header-search hidden" id="header-search" aria-expanded="false">
		<?php \get_search_form(); ?>
		<span class="header-search-close" data-header-search-toggle><span></span></span>
	</div>

	<?php
}

\add_action( 'genesis_after_title_area', __NAMESPACE__ . '\header_search_responsive', 15 );
/**
 * Render the responsive search toggle
 *
 * @return void
 */
function header_search_responsive() {
	?>

	<span class="header-search-responsive-toggle" data-header-search-toggle><i class="icon-search"></i></span>

	<?php
}
