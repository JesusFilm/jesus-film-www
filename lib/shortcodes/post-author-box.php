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

\add_shortcode( 'post_author_box', __NAMESPACE__ . '\post_author_box_shortcode' );
/**
 * Displays a search form.
 *
 * @since 3.5.0
 *
 * @return string
 */
function post_author_box_shortcode( $atts, $content = '' ) {
	global $post;

	$author = \get_userdata( $post->post_author ?? 0 );

	if ( ! $author ) {
		return '';
	}

	$show_avatars = \get_option( 'show_avatars' );

	ob_start();
	?>

	<div class="entry-author-box">
		<?php if ( $show_avatars ) : ?>

		<a href="<?php echo \esc_url( \get_author_posts_url( $author->ID ) ); ?>" class="entry-author-box-avatar" title="<?php echo sprintf( \esc_attr( 'Show posts by %s' ), $author->display_name ); ?>">
			<?php echo \get_avatar( $author->ID, 92 ); ?>
		</a>

		<?php endif; ?>

		<a href="<?php echo \esc_url( \get_author_posts_url( $author->ID ) ); ?>" class="entry-author-box-name" title="<?php echo sprintf( \esc_attr( 'Show posts by %s' ), $author->display_name ); ?>">
			<?php echo \esc_html( $author->display_name ); ?>
		</a>
	</div>

	<?php
	$content = ob_get_clean();

	return $content;
}
