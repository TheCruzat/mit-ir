<?php
/**
 * Theme Functions
 * Gather all the functions and definitions together in one easy to locate file.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package mit-ir
 */

namespace MITIR;

//
//	we stand on the backs of giants
//

/**
 * The current version of the theme.
 */
if (!defined('MITIR_VERSION')) {
	// Replace the version number of the theme on each release
	define('MITIR_VERSION', '0.1');
}


if(! defined( 'MITIR_THEME_DIR_PATH' ) ) {
	define('MITIR_THEME_DIR_PATH', untrailingslashit( get_template_directory() ));
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if ( ! function_exists( 'theme_setup' ) ) :
function theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		*/
	load_theme_textdomain( 'mit-ir', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 9999, 9999 );

	// Support for more image sizes
	add_image_size( 'query-square', 524, 524, true );
	add_image_size( 'block-bg', 1600, 900, true);

	// This theme uses wp_nav_menu() in three locations
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Nav', 'mit-ir' ),
			'secondary' => esc_html__( 'Secondary Nav', 'mit-ir' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);


add_action( 'pre_get_posts', function ($query) {
	if ( ! is_admin() && $query->is_main_query() ) {
		if ( $query->is_search ) {
			$query->set( 'date_query', array(
				array(
					'after' => 'May 17, 2019',
				)
			) );
		}
	}
} );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );
	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );
	// Add support for block styles
	add_theme_support( 'wp-block-styles' );
	// Add support for editor styles.
	add_theme_support( 'editor-styles' );
	//	add_editor_style( 'tinymce.css' );
	// Add excerpts to pages
	add_post_type_support( 'page', 'excerpt' );

	// Editor color palette.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Primary', 'mit-ir' ),
				'slug'  => 'primary',
				'color' => '#ED009B',
			),
			array(
				'name'  => __( 'Secondary', 'mit-ir' ),
				'slug'  => 'secondary',
				'color' => '#000',
			),
			array(
				'name'  => __( 'Gray', 'mit-ir' ),
				'slug'  => 'gray',
				'color' => '#dddDDD',
			),
			array(
				'name'  => __( 'Dark Gray', 'mit-ir' ),
				'slug'  => 'dark-gray',
				'color' => '#595858',
			),
			array(
				'name'  => __( 'Medium Gray', 'mit-ir' ),
				'slug'  => 'medium-gray',
				'color' => '#ADADAD',
			),
			array(
				'name'  => __( 'White', 'mit-ir' ),
				'slug'  => 'white',
				'color' => '#FFF',
			),
			array(
				'name'  => __( 'Text Magenta', 'mit-ir' ),
				'slug'  => 'text-magenta',
				'color' => '#E10093',
			),
		)
	);

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => false
		)
	);
}
endif;
add_action( 'after_setup_theme', __NAMESPACE__ . '\theme_setup' );

// Trim down Gutenberg blocks to only what's needed
function allowed_block_types( $allowed_blocks ) {
  return array(
		// We are whitelisting the following:
		'core/paragraph',
		'core/heading',
		'core/list',
		'core/quote',
		'core/image',
		'core/gallery',
		'core/video',
		'core/table',
		'core/code',
		'core/freeform',
		'core/html',
		'core/preformatted',
		'core/pullquote',
		'core/text-columns',
		'core/media-text',
		'core/more',
		'core/separator',
		'core/spacer',
		'core/shortcode',
		'core/rss',
		'core/search',
		'core/embed',
		'core-embed/twitter',
		'core-embed/youtube',
		'core-embed/facebook',
		'core-embed/instagram',
		'core-embed/flickr',
		'core-embed/vimeo',
		'core-embed/scribd',
		'core-embed/slideshare',
		'gravityforms/form',
		'mit-ir/ask-an-expert',
		'mit-ir/callout-block',
		'mit-ir/card-stack-vertical',
		'mit-ir/cards-3up',
		'mit-ir/cards-3up-alt',
		'mit-ir/content-66',
		'mit-ir/hero-content',
		'mit-ir/home-channels',
		'mit-ir/jump-links',
		'mit-ir/link-list',
		'mit-ir/logo-block',
		'mit-ir/page-header',
		'mit-ir/project-content',
		'mit-ir/project-quote-hero',
		'mit-ir/project-related-materials',
		'mit-ir/project-related-projects',
		'mit-ir/project-table',
		'mit-ir/quote-block',
		'mit-ir/search-and-filter',
		'mit-ir/team-overview',
		'mit-ir/team-selector',


		// additional blocks here

  );
}
add_filter( 'allowed_block_types_all', __NAMESPACE__ . '\allowed_block_types' );

/**
 * Enqueue scripts and styles.
 */
function enqueue_styles_and_scripts() {
	// Styles
	wp_enqueue_style( 'typekit-fonts', 'https://use.typekit.net/ryk0kfm.css', array(), MITIR_VERSION );
	//  wp_enqueue_style( 'mit-ir-style', get_stylesheet_directory_uri() . '/global.min.css', array(), MITIR_VERSION );
	wp_enqueue_style( 'mit-ir-style', get_stylesheet_directory_uri() . '/assets/css/main.min.css', array(), (rand(1,1000)/1000) );
	wp_style_add_data( 'mit-ir-style', 'rtl', 'replace' );

	// Scripts
	wp_enqueue_script( 'mit-ir-js', get_template_directory_uri() . '/assets/js/scripts.min.js', array(), (rand(1,1000)/1000), true );

	/*
	wp_register_script( 'mit-ir-ajax', '',);
	wp_enqueue_script( 'mit-ir-ajax' );
	wp_add_inline_script( 'mit-ir-ajax', 'const frontend_ajax_object = ' . json_encode( array(
			'adminAJAXURL' => admin_url( 'admin-ajax.php' ),
			'nonce' =>  wp_create_nonce( 'updates_ajax' ),
	) ), 'before' ); */
} // not yet...
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_styles_and_scripts' );

function custom_admin_styles() {
	wp_enqueue_style( 'typekit-fonts', 'https://use.typekit.net/ryk0kfm.css', array(), MITIR_VERSION );

	wp_register_style( 'mit_ir_wp_admin_css', get_template_directory_uri() . '/admin.css', false, MITIR_VERSION );
	wp_enqueue_style( 'mit_ir_wp_admin_css' );
} // not yet...
// add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\custom_admin_styles' );

function dequeue_styles_and_scripts() {
	// Remove Styles
	//wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'relevanssi-live-search' );
} // not yet...
// add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\dequeue_styles_and_scripts', 11 );


 /**
 * ALL OTHER THEME FUNCTIONALITY MUST BE BROKEN OUT INTO OTHER FILES
 * ADD A COMMENT TO EXPLAIN WHAT IT IS OR WHY IT EXISTS FOR FUTURE JOEY
 *
 * "Teddy Roosevelt gave an entire speech once with a bullet lodged in his chest.
 *  Some things are a matter of duty." - Corrado John Soprano, Jr.
 *
 * THEME FUNCTIONALITY INCLUDES AS FOLLOWS:
 */

foreach([

	// Include master file of custom fixes and upgrades and minor, non-specific fixes,
	// like adding a login logo or accessibility fixes
	'/inc/includes.php',

	// Nav Walkers for Main Menu and Social Menus
	// For Added Functionality/Accessibility
	'/inc/includes/nav-walker.php',

	// NON-BLOCK Advanced Custom Fields Code
	// For Settings, Etc.
	'/inc/includes/acf.php'
] as $file) {
	require get_theme_file_path($file);
}

/**
 * Custom Gutenberg blocks for the theme
 * from Advanced Custom Fields
 */
require get_template_directory() . '/blocks/blocks.php';

