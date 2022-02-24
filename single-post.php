<?php
/**
 * Single posts.
 *
 * @package   Dkjensen\JesusFilmProject
 * @link      https://dkjensen.com
 * @author    David Jensen
 * @copyright Copyright © 2021 David Jensen
 * @license   GPL-3.0
 */

namespace Dkjensen\JesusFilmProject;

\remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_posts_nav' );
\remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_adjacent_entry_nav' );

\add_filter( 'genesis_site_layout', __NAMESPACE__ . '\single_site_layout' );
/**
 * Site layout.
 *
 * @param string $layout Default layout.
 * 
 * @return string
 */
function single_site_layout( $layout ) {
	return 'narrow-content';
}

add_action( 'genesis_entry_header', __NAMESPACE__ . '\single_post_header_info', 9 );
/**
 * Echo the post meta.

 * @return void
 */
function single_post_header_info() {
	if ( ! \is_singular() || ! \is_main_query() ) {
		return;
	}

	ob_start();

	echo do_shortcode( '[post_author_box]' );
	echo do_shortcode( '[share_post]' );

	$content = ob_get_clean();

	\genesis_markup(
		array(
			'open'    => '<div %s>',
			'close'   => '</div>',
			'content' => \genesis_strip_p_tags( $content ),
			'context' => 'entry-post-header-info',
		)
	);

}

\add_action( 'genesis_after_content_sidebar_wrap', __NAMESPACE__ . '\single_related_posts', 12 );
/**
 * Display related posts after single post.
 *
 * @return void
 */
function single_related_posts() {
	$related_posts = new \WP_Query( array(
		'post_type'		=> 'post',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
		'post__not_in'	 => array( \get_queried_object_id() ?? 0 ),
	) );

	if ( ! $related_posts->have_posts() ) {
		return;
	}

	ob_start();
	?>

	<h2><?php esc_html_e( 'Other blog posts and stories', 'jesus-film-project' ); ?></h2>
	<div class="related-posts__content">
		<?php 
			while ( $related_posts->have_posts() ) {
				$related_posts->the_post();

				\get_template_part( 'template-parts/content-post', \get_post_type() );
			}

			\wp_reset_postdata();
		?>
	</div>
	<div class="related-posts__more">
		<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="button secondary fas fa-arrow-right icon-right"><?php esc_html_e( 'See More', 'jesus-film-project' ); ?></a>
	</div>

	<?php
	$content = ob_get_clean();

	\genesis_markup(
		array(
			'open'    => '<div %s><div class="wrap">',
			'close'   => '</div></div>',
			'content' => $content,
			'context' => 'related-posts',
		)
	);
}

\genesis();
