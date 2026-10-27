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

