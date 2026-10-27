<?php
/**
 * Theme Prefix Additional Functions and Definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Praxis
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Allow SVG file uploads.
 *
 * @param array $mimes Existing MIME types.
 * @return array Modified MIME types.
 */
function praxis_svg_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'praxis_svg_mime_types' );

/**
 * To enqueue the scripts
 */
function praxis_register_assets() {

	$footer_defer = array(
		'in_footer' => true,
		'strategy'  => 'defer',
	);

	wp_register_style(
		'praxis-font',
		'https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap',
		array(),
		null // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	);
	wp_register_style( 'praxis-swiper', PRAXIS_URI . '/assets/css/swiper-bundle.min.css', array(), PRAXIS_THEME_VERSION );
	wp_register_style(
		'praxis-style',
		PRAXIS_URI . '/assets/css/style.css',
		array( 'praxis-font' ),
		PRAXIS_THEME_VERSION
	);
	wp_register_style(
		'praxis-media',
		PRAXIS_URI . '/assets/css/media.css',
		array( 'praxis-style' ),
		PRAXIS_THEME_VERSION
	);

	wp_register_script(
		'praxis-swiper',
		PRAXIS_URI . '/assets/js/swiper-bundle.min.js',
		array(),
		PRAXIS_THEME_VERSION,
		$footer_defer
	);

	// Theme script.
	wp_register_script(
		'praxis-setting',
		PRAXIS_URI . '/assets/js/settings.js',
		array(),
		PRAXIS_THEME_VERSION,
		$footer_defer
	);
}

add_action( 'init', 'praxis_register_assets' );

/**
 * Enqueue the site wide scripts and styles.
 *
 * @return void
 */
function praxis_scripts() {
	wp_enqueue_style( 'praxis-media' );
	wp_enqueue_script( 'praxis-setting' );
}
add_action( 'wp_enqueue_scripts', 'praxis_scripts' );
