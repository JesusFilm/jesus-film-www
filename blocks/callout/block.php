<?php

$callout_image = block_field( 'image', false );
$callout_title = block_field( 'title', false );
$callout_copy  = block_field( 'copy', false );
$callout_more  = block_field( 'more-text', false );
$callout_link  = block_field( 'link', false );

?>

<div class="wp-block-callout <?php block_field( 'className' ); ?>">
	<?php if ( ! empty( $callout_image ) ) : ?>

	<div class="wp-block-callout-top">
		<div class="wp-block-callout-image">
			<img src="<?php echo esc_url( wp_get_attachment_image_url( $callout_image, 'featured' ) ); ?>" />
		</div>
	</div>

	<?php endif; ?>

	<div class="wp-block-callout-bottom">

		<?php if ( ! empty( $callout_title ) ) : ?>

			<h4 class="wp-block-callout-title">

			<?php if ( ! empty( $callout_link ) ) : ?>

				<a href="<?php echo esc_url( $callout_link ); ?>"><?php echo esc_html( $callout_title ); ?></a>

			<?php else : ?>

				<?php echo esc_html( $callout_title ); ?>

			<?php endif; ?>

			</h4>
			
		<?php endif; ?>

		<?php if ( ! empty( $callout_copy ) ) : ?>

			<div class="wp-block-callout-copy">

				<?php echo apply_filters( 'comment_text', $callout_copy ); ?>

			</div>

		<?php endif; ?>

		<?php if ( ! empty( $callout_more ) && ! empty( $callout_link ) ) : ?>

			<p class="wp-block-callout-more">
				<a href="<?php echo esc_url( $callout_link ); ?>" class="more-text"><?php echo esc_html( $callout_more ); ?></a>
			</p>

		<?php endif; ?>

	</div>
</div>
