<?php
/**
 * Search form.
 *
 * @package   Dkjensen\JesusFilmProject
 * @link      https://dkjensen.com
 * @author    David Jensen
 * @copyright Copyright © 2021 David Jensen
 * @license   GPL-3.0
 */

namespace Dkjensen\JesusFilmProject;

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- These aren't global variables

/** This filter is documented in wp-includes/general-template.php */
$search_query = apply_filters( 'the_search_query', get_search_query() ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Duplicated WordPress filter

/**
 * Search form text.
 *
 * A bit of text that describes the search form or provides instruction for use.
 * It might be used as the input placeholder, or the form label (if a11y is on, and no label is provided).
 *
 * @since 1.0.0
 *
 * @param string The search text.
 */
$search_text = apply_filters( 'genesis_search_text', __( 'Search this website', 'genesis' ) );

/**
 * Search form label.
 *
 * @since ???
 *
 * @param string The search form label.
 */
$search_label = apply_filters( 'genesis_search_form_label', '' );

/**
 * Search button text.
 *
 * The text used on the search form submit button.
 *
 * @since ???
 *
 * @param string The search button text.
 */
$search_button_text = apply_filters( 'genesis_search_button_text', esc_attr__( 'Search', 'genesis' ) );

$strings = array(
	'label'        => $search_label,
	'placeholder'  => empty( $search_query ) ? $search_text : '',
	'input_value'  => $search_query,
	'submit_value' => '<i class="icon-search"></i>',
);

if ( empty( $search_label ) && genesis_a11y( 'search-form' ) ) {
	$strings['label'] = $search_text;
}

$form = new Search_Form( $strings );

// Used for filter param 2.
$search_query_or_text = $search_query ?: $search_text;

/**
 * Allow the form output to be filtered.
 *
 * @since 1.0.0
 *
 * @param string The form markup.
 * @param string `$search_query`, if one exists. Otherwise `$search_text`.
 * @param string Submit button value.
 * @param string Form label value.
 */
$searchform = apply_filters( 'genesis_search_form', $form->get_form(), $search_query_or_text, $strings['submit_value'], $strings['label'] );

echo $searchform; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Need this to output raw html.
// phpcs:enable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
