<?php
/**
 * Block level snippets
 *
 * @package praxis
 */

add_filter(
	'block_categories_all',
	function ( $categories ) {
		array_unshift(
			$categories,
			array(
				'slug'  => 'praxis',
				'title' => 'Praxis Blocks',
			)
		);
		return $categories;
	}
);

add_action(
	'init',
	function () {
		foreach ( glob( get_theme_file_path( 'blocks-build/*/block.json' ) ) as $block_json ) {
			register_block_type( dirname( $block_json ) );
		}
	}
);
