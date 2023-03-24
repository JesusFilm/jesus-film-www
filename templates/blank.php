<?php
/**
 * Template Name: Blank
 * 
 * Template Post Type: post, page, news, development, messages, espanol, email, knowingjesus, passionpurpose
 *
 * @package   Dkjensen\JesusFilmProject
 * @link      https://dkjensen.com
 * @author    David Jensen
 * @copyright Copyright © 2021 David Jensen
 * @license   GPL-3.0
 */

namespace Dkjensen\JesusFilmProject;

\remove_all_actions( 'genesis_header' );
\remove_all_actions( 'genesis_footer' );
\remove_all_actions( 'genesis_before_loop' );
\remove_all_actions( 'genesis_entry_header' );
\remove_all_actions( 'genesis_entry_footer' );

// Runs the Genesis loop.
\genesis();
