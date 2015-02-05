<?php
/**
 * srh_framework functions and definitions
 *
 * @package srh_framework
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'srh_framework_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function srh_framework_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on srh_framework, use a find and replace
	 * to change 'srh_framework' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'srh_framework', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'srh_framework' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'srh_framework_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // srh_framework_setup
add_action( 'after_setup_theme', 'srh_framework_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function srh_framework_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'srh_framework' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'srh_framework_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function srh_framework_scripts() {
	wp_enqueue_style( 'srh_framework-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'srh_framework-gumby-style', get_template_directory_uri() . '/css/srh-framework-gumby/gumby.css' );
	
	wp_enqueue_style( 'srh_framework-gumby-custom-style', get_template_directory_uri() . '/css/srh-framework-gumby/gumby-custom.css' );

	wp_enqueue_script( 'srh_framework-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'srh_framework-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'srh_framework_scripts' );



/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/includes/custom-header.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';
/**
 * Integrate the Kiki framework extending the WP Customizer.
 */
include_once( dirname( __FILE__ ) . '/kirki/kirki.php' );
/**
 * Include Roles
 */
include_once( dirname( __FILE__ ) . '/includes/srh-framework-roles.php' );
/**
 * Include Customizer
 */
include_once( dirname( __FILE__ ) . '/includes/customizer.php' );
/**
 * Register Image Sizes
 */
require_once ( dirname( __FILE__ ) . '/includes/image-sizes.php');
/**
 * Filter Callback Functions
 */
require_once ( dirname( __FILE__ ) . '/includes/srh-framework-filters.php');
/**
 * Action Callback Functions
 */
require_once ( dirname( __FILE__ ) . '/includes/srh-framework-actions.php');
/**
 * Custom Functions
 */
require_once ( dirname( __FILE__ ) . '/includes/srh-framework-functions.php');










