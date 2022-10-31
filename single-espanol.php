<?php
/**
 * Single Espanol.
 *
 * @package   Dkjensen\JesusFilmProject
 * @link      https://dkjensen.com
 * @author    David Jensen
 * @copyright Copyright © 2021 David Jensen
 * @license   GPL-3.0
 */

namespace Dkjensen\JesusFilmProject;

\remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
\remove_action( 'genesis_entry_header', 'Dkjensen\\JesusFilmProject\\Structure\\entry_meta' );
\remove_action( 'genesis_entry_footer', 'Dkjensen\\JesusFilmProject\\Structure\\entry_footer_post_meta' );

\genesis();
