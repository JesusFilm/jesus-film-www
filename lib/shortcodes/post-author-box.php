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

use Dkjensen\JesusFilmProject\Post_Author;

\add_shortcode( 'post_author_box', __NAMESPACE__ . '\post_author_box_shortcode' );
/**
 * Displays a search form.
 *
 * @since 3.5.0
 *
 * @return string
 */
function post_author_box_shortcode( $atts, $content = '' ) {
	global $post, $wp_query;

	$atts = \shortcode_atts(
		array(
			'show_bio' => 0,
		),
		$atts,
		'post_author_box' 
	);

	$author = current( (array) \wp_get_post_terms( $post->ID, 'jf_author', array( 'hide_empty' => false ) ) );

	if ( ! $author || ! isset( $author->term_id ) ) {
		$author = \get_userdata( $post->post_author ?? 0 );
	}

	if ( ! $author ) {
		return '';
	}

	$author = new Post_Author( $author );

	ob_start();
	?>

	<div class="entry-author-box">
		<a href="<?php echo \esc_url( $author->get_author_url() ); ?>" class="entry-author-box-avatar" title="<?php echo sprintf( \esc_attr( 'Show posts by %s' ), $author->get_name() ); ?>">
			<img src="<?php echo \esc_url( $author->get_avatar_url() ); ?>" />
		</a>
		<a href="<?php echo \esc_url( $author->get_author_url() ); ?>" class="entry-author-box-name" title="<?php echo sprintf( \esc_attr( 'Show posts by %s' ), $author->get_name() ); ?>">
			<?php echo \esc_html( $author->get_name() ); ?>
		</a>

		<?php if ( $atts['show_bio'] && $author->get_bio() && $wp_query->is_singular ) : ?>

		<div class="entry-author-box-bio">
			<?php echo \apply_filters( 'comment_text', $author->get_bio() ); ?>
		</div>

		<?php endif; ?>
	</div>

	<?php
	$content = ob_get_clean();

	return $content;
}
