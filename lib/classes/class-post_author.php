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
class Post_Author {

	/**
	 * Author display name
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * Avatar URL
	 *
	 * @var string
	 */
	protected $avatar_url = '';

	/**
	 * Author URL
	 *
	 * @var string
	 */
	protected $author_url = '';

	/**
	 * Author biography
	 *
	 * @var string
	 */
	protected $bio = '';

	/**
	 * Populate properties
	 *
	 * @param WP_User|WP_Term $author Author object used to populate properties.
	 * @return void
	 */
	public function __construct( $author ) {
		$this->set_avatar_url( \get_theme_file_uri( 'assets/img/avatar-jfp.png' ) );

		if ( is_a( $author, '\WP_User' ) ) {
			$this->set_name( $author->display_name );

			$avatar = \get_avatar_url( $author->ID );

			if ( $avatar ) {
				$this->set_avatar_url( $avatar );
			}

			$this->set_bio( $author->description );

			$this->set_author_url( \get_author_posts_url( $author->ID ) );

		} elseif ( is_a( $author, '\WP_Term' ) ) {
			$this->set_name( $author->name );

			$avatar = \get_term_meta( $author->term_id, 'avatar', true );

			if ( $avatar ) {
				$avatar = \wp_get_attachment_image_url( $avatar, 'thumbnail' );

				if ( $avatar ) {
					$this->set_avatar_url( $avatar );
				}
			}

			$this->set_bio( $author->description );

			$this->set_author_url( \get_author_posts_url( null, $author->slug ) );
		}
	}

	/**
	 * Set the author name
	 *
	 * @param string $name Author name.
	 * @return void
	 */
	public function set_name( $name ) {
		$this->name = $name;
	}

	/**
	 * Set the avatar URL
	 *
	 * @param string $url Author avatar URL.
	 * @return void
	 */
	public function set_avatar_url( $url ) {
		$this->avatar_url = $url;
	}

	/**
	 * Set the author posts URL
	 *
	 * @param string $url Author posts URL.
	 * @return void
	 */
	public function set_author_url( $url ) {
		$this->author_url = $url;
	}

	/**
	 * Set the author biography
	 *
	 * @param string $bio Author biography.
	 * @return void
	 */
	public function set_bio( $bio ) {
		$this->bio = $bio;
	}

	/**
	 * Return the author name
	 *
	 * @return string
	 */
	public function get_name() {
		return \esc_html( $this->name );
	}

	/**
	 * Return the avatar URL
	 *
	 * @return string
	 */
	public function get_avatar_url() {
		return \esc_url( $this->avatar_url );
	}

	/**
	 * Return the author posts URL
	 *
	 * @return string
	 */
	public function get_author_url() {
		return \esc_url( $this->author_url );
	}

	/**
	 * Return the author biography
	 *
	 * @return string
	 */
	public function get_bio() {
		return \apply_filters( 'comment_text', $this->bio );
	}

}
