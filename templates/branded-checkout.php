<?php
/**
 * Template Name: Branded Checkout
 *
 * Template Post Type: page, development, messages
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

\add_action(
	'genesis_header',
	function() {
		?>

		<div class="branded-checkout-header">
			<img src="<?php echo \get_theme_file_uri( 'assets/img/branded-checkout-logo.jpg' ); ?>" />
		</div>

		<?php
	},
	0 
);

// Runs the Genesis loop.
\genesis();
