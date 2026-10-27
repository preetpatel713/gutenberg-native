<?php
/**
 * Theme Prefix: Functions and Definitions
 *
 * @package   Praxis
 * @since     1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define the theme version if not already defined.
if ( ! defined( 'PRAXIS_THEME_VERSION' ) ) {
	define( 'PRAXIS_THEME_VERSION', '1.0' );
}
// Constants.
define( 'PRAXIS_URI', get_template_directory_uri() );
define( 'PRAXIS_DIR', get_template_directory() );

/**
 * Theme setup function.
 *
 * Sets up theme defaults and registers support for WordPress features.
 * Hooked into the 'after_setup_theme' action.
 *
 * @since 1.0.0
 * @return void
 */
function praxis_setup() {

	// Add default RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for <title> tag managed by WordPress.
	add_theme_support( 'title-tag' );

	// Enable support for post thumbnails (featured images).
	add_theme_support( 'post-thumbnails' );

	// Register navigation menus.
	register_nav_menus(
		array(
			'header-menu' => esc_html__( 'Header Menu', 'praxis' ),
			// Add new menu locations below if required.
		)
	);

	// Enable HTML5 markup support.
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

	// Enable selective refresh for widgets in Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Enable support for the custom logo feature.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Enable support for block editor styles.
	add_theme_support( 'wp-block-styles' );

	// Registers custom image sizes to use throughout the theme.
	add_image_size( 'custom-thumb', 400, 300, true );
	add_image_size( 'banner-full', 1600, 600, true );
}
add_action( 'after_setup_theme', 'praxis_setup' );

/**
 * Set the content width in pixels, based on the theme’s design.
 *
 * @since 1.0.0
 * @return void
 */
function praxis_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'praxis_content_width', 1400 );
}
add_action( 'after_setup_theme', 'praxis_content_width', 0 );

/**
 * Remove jQuery Migrate.
 *
 * @param object $scripts Array of script handles.
 */
function praxis_remove_jquery_migrate( $scripts ) {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$scripts->registered['jquery']->deps = array_diff(
			$scripts->registered['jquery']->deps,
			array( 'jquery-migrate' )
		);
	}
}
add_action( 'wp_default_scripts', 'praxis_remove_jquery_migrate' );

/**
 * Add preconnect resource hints for Google Fonts.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed for.
 */
function praxis_google_fonts_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.googleapis.com',
		);
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'praxis_google_fonts_resource_hints', 10, 2 );


/**
 * Include additional custom theme functions.
 */
$additional_files = array(
	'inc/additional-functions.php',
	'inc/security-enhancements.php',
	'inc/blocks.php',
);

foreach ( $additional_files as $file ) {
	$file_path = PRAXIS_DIR . '/' . $file;

	if ( file_exists( $file_path ) ) {
		require_once $file_path;
	}
}

