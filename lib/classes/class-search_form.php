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

namespace Dkjensen\JesusFilmProject;

/**
 * Search_Form class.
 */
class Search_Form extends \Genesis_Search_Form {

	/**
	 * Get submit button markup.
	 *
	 * @since 2.7.0
	 *
	 * @return string Submit button markup.
	 */
	protected function get_submit() {
		return $this->markup(
			array(
				'open'    => '<button %s>',
				'close'   => '</button>',
				'context' => 'search-form-submit',
				'content' => $this->strings['submit_value'],
			)
		);
	}
}
