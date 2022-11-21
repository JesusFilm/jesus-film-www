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

namespace Dkjensen\JesusFilmProject\Shortcodes;

\add_shortcode( 'completed_languages', __NAMESPACE__ . '\completed_languages_shortcode' );
/**
 * Displays number of completed languages.
 *
 * @return string
 */
function completed_languages_shortcode() {
	if ( false === ( $completed_languages = get_transient( 'jf_completed_languages' ) ) ) {
		$token = '';

		if ( function_exists( 'vip_get_env_var' ) ) {
			$token = vip_get_env_var( 'JF_COMPLETED_LANGUAGES_TOKEN', '' );
		} elseif ( defined( 'JF_COMPLETED_LANGUAGES_TOKEN' ) ) {
			$token = constant( 'JF_COMPLETED_LANGUAGES_TOKEN' );
		}

		if ( $token ) {
			$response = wp_remote_get( 'https://www.mydigitalwork.space/QueryRunner/rest/QueryAPI/GetData?QueryId=381', array(
				'headers'	=> array(
					'token'		=> (string) $token
				)
			) );

			if ( is_array( $response ) && substr( wp_remote_retrieve_response_code( $response ), 0, 1 ) == 2 ) {
				try {
					$json = json_decode( $response['body'], true );

					if ( ! empty( $json[0]['Total'] ) ) {
						$completed_languages = $json[0]['Total'];

						set_transient( 'jf_completed_languages', $completed_languages, 12 * HOUR_IN_SECONDS );
					}
				} catch ( \Exception $e ) {
					// Do nothing
				}
			}
		}
	}

	if ( $completed_languages ) {
		return sprintf( '<span class="jf-completed-langs-var">%s</span>', number_format( $completed_languages ) );
	}

	return '';
}
