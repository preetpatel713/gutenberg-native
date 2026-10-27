<?php
/**
 * Block level snippets
 *
 * @package praxis
 */

/**
 * Register the block category.
 *
 * @param string $categories To register the block category.
 */
function praxis_register_category( $categories ) {
	array_unshift(
		$categories,
		array(
			'slug'  => 'praxis',
			'title' => 'Praxis Blocks',
		)
	);
	return $categories;
}

add_filter( 'block_categories_all', 'praxis_register_category' );

/**
 * Register the block category.
 */
function praxis_register_blocks() {
	foreach ( glob( get_theme_file_path( 'blocks-build/*/block.json' ) ) as $block_json ) {
		register_block_type( dirname( $block_json ) );
	}
}

add_action( 'init', 'praxis_register_blocks' );
