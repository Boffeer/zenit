<?php

/**
 * zenit functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package zenit
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function zenit_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on zenit, use a find and replace
		* to change 'zenit' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('zenit', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'zenit'),
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'zenit_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

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
		)
	);
}
add_action('after_setup_theme', 'zenit_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zenit_content_width()
{
	$GLOBALS['content_width'] = apply_filters('zenit_content_width', 640);
}
add_action('after_setup_theme', 'zenit_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zenit_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'zenit'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'zenit'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'zenit_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function zenit_scripts()
{
	// wp_enqueue_style('likely', get_stylesheet_directory_uri() . '/css/likely.css', array(), _S_VERSION);
	wp_enqueue_style('zenit-style', get_stylesheet_directory_uri() . '/css/style.css', array(), _S_VERSION);

	wp_enqueue_script('zenit-lightgallery', get_stylesheet_directory_uri() . '/js/libs/lightGallary/lightgallery.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('zenit-swiper-scripts', get_stylesheet_directory_uri() . '/js/libs/swiper-bundle.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('zenit-mask', get_stylesheet_directory_uri() . '/js/libs/mask.js', array(), _S_VERSION, true);
	wp_enqueue_script('zenit-likely', get_stylesheet_directory_uri() . '/js/libs/likely.js', array(), _S_VERSION, true);
	wp_enqueue_script('zenit-main-scripts', get_stylesheet_directory_uri() . '/js/main.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'zenit_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Carbon Fields
 */
add_action('carbon_fields_register_fields', 'ast_register_custom_fields');
function ast_register_custom_fields()
{
	require get_template_directory() . '/inc/custom-fields-options/metabox.php';
	require get_template_directory() . '/inc/custom-fields-options/theme-options.php';
}

/**
 * Helpers
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Custom posts
 */
require get_template_directory() . '/inc/custom-posts.php';

/**
 * Custom search
 */
require_once get_template_directory() . '/inc/custom-search.php';

/**
 * Custom menu
 */
require_once get_template_directory() . '/inc/custom-menu.php';
