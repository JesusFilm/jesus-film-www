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

\add_filter( 'get_avatar', __NAMESPACE__ . '\get_avatar', 10, 3 );

function get_avatar( $avatar, $user_id, $size ) {
    if ( ! is_numeric( $user_id ) ) {
        return $avatar;
    }

    $avatar_img = \get_user_meta( $user_id, 'avatar', true );

    if ( $avatar_img ) {
        return \wp_get_attachment_image( $avatar_img, $size );
    }

    return $avatar;
}
