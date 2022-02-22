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

\add_shortcode( 'share_post', __NAMESPACE__ . '\share_post_shortcode' );
/**
 * Displays a search form.
 *
 * @since 3.5.0
 *
 * @return string
 */
function share_post_shortcode() {
	$twitter = \add_query_arg( array( 'text' => \get_option( 'blogname' ), 'url' => \get_permalink( \get_the_ID() ) ), 'https://twitter.com/intent/tweet/' );
	$facebook = \add_query_arg( array( 'u' => \get_permalink( \get_the_ID() ) ), 'https://facebook.com/sharer/sharer.php' );

	ob_start();
	?>

		<div class="entry-social-share">
          <a href="<?php echo esc_url( $twitter ); ?>" target="_blank">
            <button class="secondary small">
              <i class="icon-twitter-icon"></i>
            </button>
          </a>
          <a href="<?php echo esc_url( $facebook ); ?>" target="_blank">
            <button class="secondary small">
              <i class="icon-facebook-icon"></i>
            </button>
          </a>
        </div>

	<?php
	$content = ob_get_clean();

    return $content;
}
