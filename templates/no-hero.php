<?php
/**
 * Template Name: No Hero
 *
 * Template Post Type: post, page, product, portfolio
 *
 * @package   Dkjensen\JesusFilmProject
 * @link      https://dkjensen.com
 * @author    David Jensen
 * @copyright Copyright © 2021 David Jensen
 * @license   GPL-3.0
 */

// Removes hero section.
\remove_theme_support( 'hero-section' );

// Runs the Genesis loop.
genesis();
