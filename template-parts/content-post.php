<?php
/**
 * Post template part.
 *
 * @package   Dkjensen\JesusFilmProject
 * @link      https://dkjensen.com
 * @author    David Jensen
 * @copyright Copyright © 2021 David Jensen
 * @license   GPL-3.0
 */

?>

<article <?php \post_class( 'card' ); ?> id="post-<?php \the_ID(); ?>">
	<div class="card-top">
		<a href="<?php \the_permalink(); ?>" title="<?php echo \esc_attr( \get_the_title() ); ?>">
			<?php \the_post_thumbnail( 'featured' ); ?>
		</a>
	</div>
	<div class="card-bottom">
		<div class="card-copy">
			<div class="card-meta">
				<span><?php \the_date(); ?></span><span><?php \the_category( ', ' ); ?></span>
			</div>
			<?php \the_title( '<h4><a href="' . \esc_url( \get_permalink() ) . '" title="' . \esc_attr( \get_the_title() ) . '">', '</a></h4>' ); ?>
			<?php \the_excerpt(); ?>
			<?php echo do_shortcode( '[post_author_box]' ); ?>
		</div>
	</div>
</article>
