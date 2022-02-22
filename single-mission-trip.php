<?php
/**
 * Single mission trip.
 *
 * @package   Dkjensen\JesusFilmProject
 * @link      https://dkjensen.com
 * @author    David Jensen
 * @copyright Copyright © 2021 David Jensen
 * @license   GPL-3.0
 */

namespace Dkjensen\JesusFilmProject;

\remove_all_actions( 'genesis_entry_footer' );

\remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_posts_nav' );
\remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_adjacent_entry_nav' );

\add_action( 'genesis_hero_before_title', __NAMESPACE__ . '\hero_prefix' );
/**
 * Before hero title
 *
 * @return void
 */
function hero_prefix() {
    printf( '<h5>%s /</h5>', esc_html__( 'GO', 'jesus-film-project' ) );
}

\add_action( 'genesis_hero_after_title', __NAMESPACE__ . '\hero_suffix' );
/**
 * After hero title
 *
 * @return void
 */
function hero_suffix() {
    $start_date = \DateTime::createFromFormat( 'Ymd', \get_post_meta( \get_the_ID(), 'date_start', true ) );
    $end_date = \DateTime::createFromFormat( 'Ymd', \get_post_meta( \get_the_ID(), 'date_end', true ) );

    if ( $start_date && $end_date ) {
        printf( '<h5>%s - %s</h5>', \esc_html( $start_date->format( 'F j, Y' ) ), \esc_html( $end_date->format( 'F j, Y' ) ) );
    } elseif ( $start_date && ! $end_date ) {
        printf( '<h5>%s %s</h5>', \esc_html__( 'Starting', 'jesus-film-project' ), \esc_html( $start_date->format( 'F j, Y' ) ) );
    } elseif ( ! $start_date && $end_date ) {
        printf( '<h5>%s %s</h5>', \esc_html__( 'Thru', 'jesus-film-project' ), \esc_html( $end_date->format( 'F j, Y' ) ) );
    }

    
}

\add_action( 'genesis_entry_content', __NAMESPACE__ . '\mission_trip_details', 5 );

function mission_trip_details() {
    $mission_trip_meta = \get_post_meta( \get_the_ID() );

    $details = '<dl class="mission-trip-specs">';

    foreach ( $mission_trip_meta as $key => $meta ) {
        switch ( $key ) {
            case 'region' :
                $regions = \get_the_terms( \get_the_ID(), 'region' );

                if ( $regions && ! \is_wp_error( $regions ) ) {
                    $details .= sprintf( "<dt data-meta=\"%s\">%s</dt>\n<dd>%s</dd>\n", \esc_attr( $key ), esc_html__( 'Region', 'jesus-film-project' ), esc_html( implode( ', ', \wp_list_pluck( $regions, 'name' ) ) ) );
                }
                break;
            case 'strategies' :
                $strategies = \get_the_terms( \get_the_ID(), 'strategy' );

                if ( $strategies && ! \is_wp_error( $strategies ) ) {
                    $details .= sprintf( "<dt data-meta=\"%s\">%s</dt>\n<dd>%s</dd>\n", \esc_attr( $key ), esc_html__( 'Strategies', 'jesus-film-project' ), esc_html( implode( ', ', \wp_list_pluck( $strategies, 'name' ) ) ) );
                }
                break;
            case 'location' :
                $details .= sprintf( "<dt data-meta=\"%s\">%s</dt>\n<dd>%s</dd>\n", \esc_attr( $key ), esc_html__( 'Location', 'jesus-film-project' ), esc_html( current( $meta ) ) );
                break;
            case 'cost' :
                $details .= sprintf( "<dt data-meta=\"%s\">%s</dt>\n<dd>%s</dd>\n", \esc_attr( $key ), esc_html__( 'Cost', 'jesus-film-project' ), esc_html( current( $meta ) ) );
                break;
            case 'status' :
                $details .= sprintf( "<dt data-meta=\"%1\$s\">%2\$s</dt>\n<dd data-status=\"%3\$s\">%3\$s</dd>\n", \esc_attr( $key ), esc_html__( 'Status', 'jesus-film-project' ), esc_html( ucfirst( current( $meta ) ) ) );
                break;
        }
    }

    $details .= '</dl>' . "\n";

    $details .= do_shortcode( '[share_post]' );

    \genesis_markup(
		array(
			'open'    => '<div %s>',
			'close'   => '</div>',
			'content' => $details,
			'context' => 'mission-trip-details',
		)
	);
}

\add_filter( 'genesis_site_layout', __NAMESPACE__ . '\mission_trip_site_layout' );
/**
 * Site layout.
 *
 * @param string $layout Default layout.
 * 
 * @return string
 */
function mission_trip_site_layout( $layout ) {
	return 'content-sidebar';
}


\genesis();
