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

use function Dkjensen\JesusFilmProject\Functions\get_nav_menus;

return array(
	'genesis' => array(
		'title'          => __( 'Theme Settings', 'jesus-film-project' ),
		'description'    => __( 'Customize the various theme settings.', 'jesus-film-project' ),
		'theme_supports' => 'genesis-customizer-theme-settings',
		'settings_field' => 'genesis-settings',
		'control_prefix' => 'genesis',
		'sections'       => array(
			'genesis_updates'      => array(
				'title'          => __( 'Updates', 'jesus-film-project' ),
				'panel'          => 'genesis',
				'theme_supports' => 'genesis-auto-updates',
				'controls'       => array(
					'update'               => array(
						'label'       => __( 'Check For Updates', 'jesus-film-project' ),
						/* translators: %s: Link to privacy policy */
						'description' => sprintf( __( 'By checking this box, you allow Genesis to periodically check for updates. Update requests send information about your site including software and theme data, as well as the site’s URL and locale. See the <a href="%s" target="_blank" rel="noopener noreferrer">privacy policy</a>.', 'jesus-film-project' ), 'https://www.studiopress.com/go/privacy-policy/' ),
						'section'     => 'genesis_updates',
						'type'        => 'checkbox',
						'settings'    => array(
							'default' => 1,
						),
					),
					'update_email_address' => array(
						'label'       => __( 'Email Address', 'jesus-film-project' ),
						'description' => __( 'If you provide an email address below, you will be notified via email when a new version of Genesis is available. Your email address is not sent to us.', 'jesus-film-project' ),
						'section'     => 'genesis_updates',
						'type'        => 'email',
						'input_attrs' => array(
							'placeholder' => __( 'Email Address', 'jesus-film-project' ),
						),
						'settings'    => array(
							'default' => '',
						),
					),

				),
			),
			'genesis_header'       => array(
				'active_callback' => 'genesis_show_header_customizer_callback',
				'title'           => __( 'Header', 'jesus-film-project' ),
				'panel'           => 'genesis',
				'controls'        => array(
					'blog_title' => array(
						'label'    => __( 'Use for site title/logo:', 'jesus-film-project' ),
						'section'  => 'genesis_header',
						'type'     => 'select',
						'choices'  => array(
							'text'  => __( 'Dynamic Text', 'jesus-film-project' ),
							'image' => __( 'Image logo', 'jesus-film-project' ),
						),
						'settings' => array(
							'default' => 'text',
						),
					),
				),
			),
			'genesis_color_scheme' => array(
				'active_callback' => 'genesis_has_color_schemes',
				'theme_supports'  => 'genesis-style-selector',
				'title'           => __( 'Color Scheme', 'jesus-film-project' ),
				'panel'           => 'genesis',
				'controls'        => array(
					'style_selection' => array(
						'label'    => __( 'Select Color Style', 'jesus-film-project' ),
						'section'  => 'genesis_color_scheme',
						'type'     => 'select',
						'choices'  => \genesis_get_color_schemes_for_customizer(),
						'settings' => array(
							'default' => '',
						),
					),
				),
			),
			'genesis_layout'       => array(
				'active_callback' => 'genesis_has_multiple_layouts',
				'title'           => __( 'Site Layout', 'jesus-film-project' ),
				'panel'           => 'genesis',
				'controls'        => array(
					'site_layout' => array(
						'label'    => __( 'Select Site Layout', 'jesus-film-project' ),
						'section'  => 'genesis_layout',
						'type'     => 'select',
						'choices'  => \genesis_get_layouts_for_customizer(),
						'settings' => array(
							'default' => '',
						),
					),
				),
			),
			'genesis_navigation'   => array(
				'title'    => __( 'Navigation', 'jesus-film-project' ),
				'panel'    => 'genesis',
				'controls' => array(
					'page_submenu' => array(
						'label'    => __( 'Select Default Page Submenu', 'jesus-film-project' ),
						'section'  => 'genesis_navigation',
						'type'     => 'select',
						'choices'  => get_nav_menus(),
						'settings' => array(
							'default' => '',
						),
					),
				),
			),
			'genesis_breadcrumbs'  => array(
				'theme_supports' => 'genesis-breadcrumbs',
				'title'          => __( 'Breadcrumbs', 'jesus-film-project' ),
				'description'    => __( 'Select the pages which should display breadcrumbs.', 'jesus-film-project' ),
				'panel'          => 'genesis',
				'controls'       => array(
					'breadcrumb_home'       => array(
						'active_callback' => 'genesis_posts_show_on_front',
						'label'           => __( 'Breadcrumbs on Homepage', 'jesus-film-project' ),
						'section'         => 'genesis_breadcrumbs',
						'type'            => 'checkbox',
						'settings'        => array(
							'default' => 0,
						),
					),
					'breadcrumb_front_page' => array(
						'active_callback' => 'genesis_page_show_on_front',
						'label'           => __( 'Breadcrumbs on Homepage', 'jesus-film-project' ),
						'section'         => 'genesis_breadcrumbs',
						'type'            => 'checkbox',
						'settings'        => array(
							'default' => 0,
						),
					),
					'breadcrumb_posts_page' => array(
						'active_callback' => 'genesis_page_show_on_front',
						'label'           => __( 'Breadcrumbs on Posts page', 'jesus-film-project' ),
						'section'         => 'genesis_breadcrumbs',
						'type'            => 'checkbox',
						'settings'        => array(
							'default' => 0,
						),
					),
					'breadcrumb_single'     => array(
						'label'    => __( 'Breadcrumbs on Single Posts', 'jesus-film-project' ),
						'section'  => 'genesis_breadcrumbs',
						'type'     => 'checkbox',
						'settings' => array(
							'default' => 0,
						),
					),
					'breadcrumb_page'       => array(
						'label'    => __( 'Breadcrumbs on Pages', 'jesus-film-project' ),
						'section'  => 'genesis_breadcrumbs',
						'type'     => 'checkbox',
						'settings' => array(
							'default' => 0,
						),
					),
					'breadcrumb_archive'    => array(
						'label'    => __( 'Breadcrumbs on Archives', 'jesus-film-project' ),
						'section'  => 'genesis_breadcrumbs',
						'type'     => 'checkbox',
						'settings' => array(
							'default' => 0,
						),
					),
					'breadcrumb_404'        => array(
						'label'    => __( 'Breadcrumbs on 404 page', 'jesus-film-project' ),
						'section'  => 'genesis_breadcrumbs',
						'type'     => 'checkbox',
						'settings' => array(
							'default' => 0,
						),
					),
					'breadcrumb_attachment' => array(
						'label'    => __( 'Breadcrumbs on Attachment/Media', 'jesus-film-project' ),
						'section'  => 'genesis_breadcrumbs',
						'type'     => 'checkbox',
						'settings' => array(
							'default' => 0,
						),
					),
				),
			),
			'genesis_comments'     => array(
				'title'    => __( 'Comments and Trackbacks', 'jesus-film-project' ),
				'panel'    => 'genesis',
				'controls' => array(
					'comments_posts'   => array(
						'label'    => __( 'Enable Comments on Posts', 'jesus-film-project' ),
						'section'  => 'genesis_comments',
						'type'     => 'checkbox',
						'settings' => array(
							'default' => 1,
						),
					),
					'comments_pages'   => array(
						'label'    => __( 'Enable Comments on Pages', 'jesus-film-project' ),
						'section'  => 'genesis_comments',
						'type'     => 'checkbox',
						'settings' => array(
							'default' => 1,
						),
					),
					'trackbacks_posts' => array(
						'label'    => __( 'Enable Trackbacks on Posts', 'jesus-film-project' ),
						'section'  => 'genesis_comments',
						'type'     => 'checkbox',
						'settings' => array(
							'default' => 0,
						),
					),
					'trackbacks_pages' => array(
						'label'    => __( 'Enable Trackbacks on Pages', 'jesus-film-project' ),
						'section'  => 'genesis_comments',
						'type'     => 'checkbox',
						'settings' => array(
							'default' => 0,
						),
					),
				),
			),
			'genesis_single'       => array(
				'title'       => __( 'Singular Content', 'jesus-film-project' ),
				'description' => __( 'Modify the settings for individual entries such as posts and pages.', 'jesus-film-project' ),
				'panel'       => 'genesis',
				'controls'    => array(
					'entry_meta_before_content' => array(
						'label'       => __( 'Entry Meta (above content)', 'jesus-film-project' ),
						/* translators: %s: Link to post shortcodes documentation */
						'description' => sprintf( __( 'The entry meta text that will appear above your entry content. Can include <a href="%s" target="_blank" rel="noopener noreferrer">post shortcodes</a>.', 'jesus-film-project' ), 'https://studiopress.github.io/genesis/basics/genesis-shortcodes/#post-shortcodes' ),
						'section'     => 'genesis_single',
						'type'        => 'textarea',
						'settings'    => array(
							'default' => '[post_date] ' . __( 'by', 'jesus-film-project' ) . ' [post_author_posts_link] [post_comments] [post_edit]',
						),
					),
					'entry_meta_after_content'  => array(
						'label'       => __( 'Entry Meta (below content)', 'jesus-film-project' ),
						/* translators: %s: Link to post shortcodes documentation */
						'description' => sprintf( __( 'The entry meta text that will appear below your entry content. Can include <a href="%s" target="_blank" rel="noopener noreferrer">post shortcodes</a>.', 'jesus-film-project' ), 'https://studiopress.github.io/genesis/basics/genesis-shortcodes/#post-shortcodes' ),
						'section'     => 'genesis_single',
						'type'        => 'textarea',
						'settings'    => array(
							'default' => '[post_categories] [post_tags]',
						),
					),
				),
			),
			'genesis_archives'     => array(
				'title'    => __( 'Content Archives', 'jesus-film-project' ),
				'panel'    => 'genesis',
				'controls' => array(
					'content_archive'           => array(
						'label'    => __( 'Select one of the following', 'jesus-film-project' ),
						'section'  => 'genesis_archives',
						'type'     => 'select',
						'choices'  => array(
							'full'     => __( 'Entry content', 'jesus-film-project' ),
							'excerpts' => __( 'Entry excerpts', 'jesus-film-project' ),
						),
						'settings' => array(
							'default' => 'full',
						),
					),
					'content_archive_limit'     => array(
						'label'    => __( 'Limit content to how many characters? (0 for no limit)', 'jesus-film-project' ),
						'section'  => 'genesis_archives',
						'type'     => 'number',
						'settings' => array(
							'default' => 0,
						),
					),
					'content_archive_thumbnail' => array(
						'label'    => __( 'Display the featured image?', 'jesus-film-project' ),
						'section'  => 'genesis_archives',
						'type'     => 'checkbox',
						'settings' => array(
							'default' => 0,
						),
					),
					'image_size'                => array(
						'label'    => __( 'Featured Image Size', 'jesus-film-project' ),
						'section'  => 'genesis_archives',
						'type'     => 'select',
						'choices'  => \genesis_get_image_sizes_for_customizer(),
						'settings' => array(
							'default' => '',
						),
					),
					'image_alignment'           => array(
						'label'    => __( 'Featured Image Alignment', 'jesus-film-project' ),
						'section'  => 'genesis_archives',
						'type'     => 'select',
						'choices'  => array(
							''            => __( 'None', 'jesus-film-project' ),
							'alignleft'   => __( 'Left', 'jesus-film-project' ),
							'alignright'  => __( 'Right', 'jesus-film-project' ),
							'aligncenter' => __( 'Center', 'jesus-film-project' ),
						),
						'settings' => array(
							'default' => 'alignleft',
						),
					),
					'posts_nav'                 => array(
						'label'    => __( 'Entry Pagination Type', 'jesus-film-project' ),
						'section'  => 'genesis_archives',
						'type'     => 'select',
						'choices'  => array(
							'prev-next' => __( 'Previous / Next', 'jesus-film-project' ),
							'numeric'   => __( 'Numeric', 'jesus-film-project' ),
						),
						'settings' => array(
							'default' => '',
						),
					),
				),
			),
			'genesis_footer'       => array(
				'active_callback' => function() {
					return is_null( apply_filters( 'genesis_footer_output', null, '', '' ) );
				},
				'title'           => __( 'Footer', 'jesus-film-project' ),
				'panel'           => 'genesis',
				'controls'        => array(
					'footer_text' => array(
						/* translators: %s: Link to footer shortcodes documentation */
						'description' => sprintf( __( 'The text that will appear in your site footer. Can include <a href="%s" target="_blank" rel="noopener noreferrer">footer shortcodes</a>.', 'jesus-film-project' ), 'https://studiopress.github.io/genesis/basics/genesis-shortcodes/#footer-shortcodes' ),
						'section'     => 'genesis_footer',
						'type'        => 'textarea',
						'settings'    => array(
							'default' => sprintf( '[footer_copyright before="%s "] · [footer_childtheme_link before="" after=" %s"] [footer_genesis_link url="https://www.studiopress.com/" before=""] · [footer_wordpress_link] · [footer_loginout]', __( 'Copyright', 'jesus-film-project' ), __( 'on', 'jesus-film-project' ) ),
						),
					),
				),
			),
			'genesis_scripts'      => array(
				'title'    => __( 'Header/Footer Scripts', 'jesus-film-project' ),
				'panel'    => 'genesis',
				'controls' => array(
					'header_scripts' => array(
						'label'       => __( 'Header Scripts', 'jesus-film-project' ),
						/* translators: %s: </element> */
						'description' => sprintf( __( 'This code will output immediately before the closing %s tag in the document source.', 'jesus-film-project' ), \genesis_code( esc_html( '</head>' ) ) ),
						'section'     => 'genesis_scripts',
						'type'        => 'textarea',
						'settings'    => array(
							'default' => '',
						),
					),
					'footer_scripts' => array(
						'label'       => __( 'Footer Scripts', 'jesus-film-project' ),
						/* translators: %s: </element> */
						'description' => sprintf( __( 'This code will output immediately before the closing %s tag in the document source.', 'jesus-film-project' ), \genesis_code( esc_html( '</body>' ) ) ),
						'section'     => 'genesis_scripts',
						'type'        => 'textarea',
						'settings'    => array(
							'default' => '',
						),
					),
				),
			),
		),
	),
);
