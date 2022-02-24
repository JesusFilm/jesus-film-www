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


\add_action( 'init', __NAMESPACE__ . '\mission_trip_rewrite_rules' );

function mission_trip_rewrite_rules() {
    $regions = \get_terms( array( 'taxonomy' => 'region', 'hide_empty' => false, 'fields' => 'slugs' ) );

    foreach ( $regions as $region ) {
        add_rewrite_rule( 'partners/mission-trips/(' . $region . ')/?$', 'index.php?region=$matches[1]&post_type=mission-trip', 'top' );
    }

    $strategies = \get_terms( array( 'taxonomy' => 'strategy', 'hide_empty' => false, 'fields' => 'slugs' ) );

    foreach ( $strategies as $strategy ) {
        add_rewrite_rule( 'partners/mission-trips/(' . $strategy . ')/?$', 'index.php?strategy=$matches[1]&post_type=mission-trip', 'top' );
    }

    \flush_rewrite_rules();
}
