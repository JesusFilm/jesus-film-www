<?php
/**
 * Search template part.
 *
 * @package   Dkjensen\JesusFilmProject
 * @link      https://dkjensen.com
 * @author    David Jensen
 * @copyright Copyright © 2021 David Jensen
 * @license   GPL-3.0
 */

$post_type = \get_post_type_object( \get_post_type() );
?>

<article <?php \post_class( 'search' ); ?> id="post-<?php \the_ID(); ?>">
	<?php \the_title( '<h4><a href="' . \esc_url( \get_permalink() ) . '" title="' . \esc_attr( \get_the_title() ) . '">', '</a></h4>' ); ?>
	<?php \the_excerpt(); ?>
	<?php echo $post_type ? sprintf( '<small><em>%s</em></small>', esc_html( $post_type->labels->singular_name ?? '' ) ) : ''; ?>
</article>
