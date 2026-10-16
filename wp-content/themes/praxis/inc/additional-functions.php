<?php
/**
 * Theme Prefix Additional Functions and Definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Theme_Name
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
function theme_prefix_svg_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'theme_prefix_svg_mime_types' );

/**
 * ---------------------------------------------------------------------------
 * TEMPORARY: staging / pre-launch search engine blocking.
 *
 * REMOVE THIS ENTIRE BLOCK AFTER GO LIVE, otherwise the live site will never
 * be indexed by search engines.
 *
 * Nothing here is written to the database, so deleting this block is enough to
 * restore normal indexing - no setting needs to be changed in wp-admin.
 * ---------------------------------------------------------------------------
 */

/**
 * Force the "Search engine visibility" option off without saving it.
 *
 * Also makes core output "Disallow: /" in robots.txt.
 *
 * @return string Always '0'.
 */
function theme_prefix_force_blog_not_public() {
	return '0';
}
add_filter( 'pre_option_blog_public', 'theme_prefix_force_blog_not_public' );

/**
 * Add noindex/nofollow to the robots meta tag.
 *
 * @param array $robots Robots directives.
 * @return array Modified robots directives.
 */
function theme_prefix_force_noindex( $robots ) {
	$robots['noindex']  = true;
	$robots['nofollow'] = true;

	unset( $robots['index'], $robots['follow'] );

	return $robots;
}
add_filter( 'wp_robots', 'theme_prefix_force_noindex', 999 );

/**
 * Send an X-Robots-Tag header so non-HTML responses (PDF, images) are covered too.
 */
function theme_prefix_force_noindex_header() {
	if ( ! headers_sent() ) {
		header( 'X-Robots-Tag: noindex, nofollow', true );
	}
}
add_action( 'send_headers', 'theme_prefix_force_noindex_header' );

/* --- END TEMPORARY PRE-LAUNCH BLOCK - REMOVE AFTER GO LIVE --- */
