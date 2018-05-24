<?php
/**
 * Radcliffe 2 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Radcliffe 2
 */

if ( ! function_exists( 'radcliffe_2_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function radcliffe_2_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change 'radcliffe-2' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'radcliffe-2', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'radcliffe-post-image', 2000, 1500 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Header', 'radcliffe-2' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 1200,
		'height'      => 900,
		'flex-width'  => true,
		'flex-height' => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for Gutenberg.
	add_theme_support( 'gutenberg', array(
		// Theme supports wide images, galleries and videos.
		'wide-images' => true,
	
		// Make specific theme colors available in the editor.
		'colors' => array(
			'#ffffff',
			'#222222',
			'#666666',
			'#ca2017',
		),
	) );

}
endif;
add_action( 'after_setup_theme', 'radcliffe_2_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function radcliffe_2_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'radcliffe_2_content_width', 740 );
}
add_action( 'after_setup_theme', 'radcliffe_2_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function radcliffe_2_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'radcliffe-2' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'radcliffe-2' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'radcliffe-2' ),
		'id'            => 'sidebar-3',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'radcliffe_2_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function radcliffe_2_scripts() {
	wp_enqueue_style( 'radcliffe-2-style', get_stylesheet_uri() );

	wp_enqueue_script( 'radcliffe-2-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_localize_script( 'radcliffe-2-navigation', 'screenReaderText', array(
		'expand'      => esc_html__( 'Expand child menu', 'radcliffe-2' ),
		'collapse'    => esc_html__( 'Collapse child menu', 'radcliffe-2' ),
		'icon_expand' => radcliffe_2_get_svg( array( 'icon' => 'expand' ) ),
		'icon_zoom'   => radcliffe_2_get_svg( array( 'icon' => 'zoom' ) ),
	) );

	wp_enqueue_script( 'radcliffe-2-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'radcliffe-2', get_template_directory_uri() . '/assets/js/radcliffe-2.js', array( 'jquery' ), '20170629', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'radcliffe_2_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 */
function radcliffe_2_editor_styles() {
	wp_enqueue_style( 'radcliffe-2-editor-style', get_template_directory_uri() . '/assets/css/editor-style.css' );
}
add_action( 'enqueue_block_editor_assets', 'radcliffe_2_editor_styles' );


/**
 * Enqueue stylesheet inside the Customizer.
 */
function radcliffe_2_custom_customize_enqueue() {
	wp_enqueue_style( 'customizer-css', get_stylesheet_directory_uri() . '/assets/css/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'radcliffe_2_custom_customize_enqueue' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function radcliffe_2_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'radcliffe_2_pingback_header' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Style packs.
 */
require get_template_directory() . '/inc/style-packs-core.php';
require get_template_directory() . '/inc/style-packs.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Hero Area code.
 */
require get_template_directory() . '/hero-area/hero-area-functions.php';

/**
 * Load Contact Info code.
 */
require get_template_directory() . '/contact-info/contact-info-functions.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
