<?php
/**
 * All of the custom Gutenberg blocks made by ACF
 *
 * @package mit-ir
 */
namespace MITIR;

/**
 * Load Blocks
 */
function load_custom_blocks() {
	register_block_type( get_template_directory() . '/blocks/ask-an-expert/block.json' );
	register_block_type( get_template_directory() . '/blocks/callout-block/block.json' );
	register_block_type( get_template_directory() . '/blocks/card-stack-vertical/block.json' );
	register_block_type( get_template_directory() . '/blocks/cards-3up/block.json' );
	register_block_type( get_template_directory() . '/blocks/cards-3up-alt/block.json' );
	register_block_type( get_template_directory() . '/blocks/content-66/block.json' );
	register_block_type( get_template_directory() . '/blocks/hero-content/block.json' );
	register_block_type( get_template_directory() . '/blocks/home-channels/block.json' );
	register_block_type( get_template_directory() . '/blocks/jump-links/block.json' );
	register_block_type( get_template_directory() . '/blocks/link-list/block.json' );
	register_block_type( get_template_directory() . '/blocks/logo-block/block.json' );
	register_block_type( get_template_directory() . '/blocks/page-header/block.json' );
	register_block_type( get_template_directory() . '/blocks/quote-block/block.json' );
	register_block_type( get_template_directory() . '/blocks/project-content/block.json' );
	register_block_type( get_template_directory() . '/blocks/project-quote-hero/block.json' );
	register_block_type( get_template_directory() . '/blocks/project-related-materials/block.json' );
	register_block_type( get_template_directory() . '/blocks/project-related-projects/block.json' );
	register_block_type( get_template_directory() . '/blocks/project-table/block.json' );
	register_block_type( get_template_directory() . '/blocks/search-and-filter/block.json' );
	register_block_type( get_template_directory() . '/blocks/team-overview/block.json' );
	register_block_type( get_template_directory() . '/blocks/team-selector/block.json' );
}
add_action( 'init', __NAMESPACE__ . '\load_custom_blocks' );

/**
 * Create custom block category for ACF blocks
 */
function custom_block_categories( $block_categories, $editor_context ) {
	if ( ! empty( $editor_context->post ) ) {
			array_push(
					$block_categories,
					array(
							'slug'  => 'ir_page_blocks',
							'title' => __( 'IR Page Blocks', 'mit-ir' ),
							'icon'  => 'text-page',
					),
					array(
							'slug'  => 'ir_resource_blocks',
							'title' => __( 'IR Resource Blocks', 'mit-ir' ),
							'icon'  => 'portfolio',
					),
					array(
							'slug'  => 'associate_IR_blocks',
							'title' => __( 'Associate IR Blocks', 'mit-ir' ),
							'icon'  => 'id',
					),
					array(
							'slug'  => 'ir_people_blocks',
							'title' => __( 'IR People Blocks', 'mit-ir' ),
							'icon'  => 'groups',
					),
					array(
							'slug'  => 'ir_home_page_blocks',
							'title' => __( 'IR Home Page Blocks', 'mit-ir' ),
							'icon'  => 'admin-home',
					),
					array(
							'slug'  => 'ir_requests_blocks',
							'title' => __( 'IR Requests Blocks', 'mit-ir' ),
							'icon'  => 'feedback',
					),
			);
	}
	return $block_categories;
}
add_filter( 'block_categories_all', __NAMESPACE__ . '\custom_block_categories', 10, 2 );
