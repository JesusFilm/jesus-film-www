<?php
/**
 * Mission trip archive.
 *
 * @package   Dkjensen\JesusFilmProject
 * @link      https://dkjensen.com
 * @author    David Jensen
 * @copyright Copyright © 2021 David Jensen
 * @license   GPL-3.0
 */

namespace Dkjensen\JesusFilmProject;



\add_action( 'genesis_meta', __NAMESPACE__ . '\archive_mission_trip_hero_setup', 15 );

function archive_mission_trip_hero_setup() {
    \remove_action( 'genesis_archive_title_descriptions', __NAMESPACE__ . '\Structure\do_archive_headings_intro_text', 12 );
    \add_action( 'genesis_archive_title_descriptions', __NAMESPACE__ . '\archive_mission_trip_hero_description', 12, 3 );
}

function archive_mission_trip_hero_description( $heading = '', $intro_text = '', $context = '' ) {

	if ( $context && $intro_text ) {
		\genesis_markup(
			array(
				'open'    => '<h5 %s itemprop="description">',
				'close'   => '</h5>',
				'content' => $intro_text,
				'context' => 'hero-subtitle',
			)
		);
	}
}

\add_action( 'genesis_hero_section', __NAMESPACE__ . '\archive_mission_trip_hero_prefix', 8 );
/**
 * Before hero title
 *
 * @return void
 */
function archive_mission_trip_hero_prefix() {
    printf( '<h5><a href="%s">%s /</a></h5>', \esc_url( \get_permalink( \get_page_by_path( '/partners/mission-trips/' ) ) ), esc_html__( 'GO', 'jesus-film-project' ) );
}

\add_action( 'genesis_before_footer', __NAMESPACE__ . '\archive_mission_trip_footer' );

function archive_mission_trip_footer() {

	$background_image = \wp_get_attachment_image_url( \get_term_meta( \get_queried_object_id(), 'background_image', true ) ?: 0, 'full' );

	$copy = \get_term_meta( \get_queried_object_id(), 'copy', true ) ?: esc_html__( 'We offer trips from remote villages to urban settings, church planting to university ministry. Opportunities include open and discreet evangelism, one-to-one, small-group and large-group film showings, and you\'ll be trained on Jesus Film Project app tools.', 'jesus-film-project' );

	$form = \get_term_meta( \get_queried_object_id(), 'form', true );

	ob_start();
	?>

	<?php

	if ( $background_image ) {
		printf( '<style>.mission-trip-archive-footer { background-image: url("%s"); }</style>', \esc_url( $background_image ) );
	}

	?>

	<div class="mission-trip-archive-footer__content">
		<div class="one-half first">
			<h3 class="has-text-color has-white-color"><?php \single_term_title( esc_html__( 'About', 'jesus-film-project' ) . " " ); ?></h3>
			<div><?php echo apply_filters( 'comment_text', $copy ); ?></div>
		</div>
		<div class="one-third">
			<?php echo ( $form ) ? \do_shortcode( '[gravityform id=' . (int) $form . ' title="false" description="true" ajax="true"]' ) : ''; ?>
		</div>
	</div>

	<?php
	$content = ob_get_clean();

	\genesis_markup(
		array(
			'open'    => '<div %s><div class="wrap">',
			'close'   => '</div></div>',
			'content' => $content,
			'context' => 'mission-trip-archive-footer',
		)
	);
}

\genesis();
