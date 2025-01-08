<?php
/**
 * A technically WordPress-illegal file of custom post types and
 * custom taxonomies to add to this theme. Make sure to take this
 * with you if you're upgrading the theme in the future.
 *
 * @package mit-ir
 * @since 0.0.1
 */

namespace MITIR;


// Add Projects Post Type

function cpt_mit_projects() {
	$slug = 'projects';

	// Modify all the i18ized strings here.
	$labels = [
		'menu_name'          => __( 'Projects', 'mit-ir' ),
		'name'               => _x( 'Projects', 'post type general name', 'mit-ir' ),
		'singular_name'      => _x( 'Project', 'post type singular name', 'mit-ir' ),
		'name_admin_bar'     => _x( 'Projects', 'add new on admin bar', 'mit-ir' ),
		'add_new'            => _x( 'Add New', 'thing', 'mit-ir' ),
		'add_new_item'       => __( 'Add New Project', 'mit-ir' ),
		'new_item'           => __( 'New Project', 'mit-ir' ),
		'edit_item'          => __( 'Edit Project', 'mit-ir' ),
		'view_item'          => __( 'View Project', 'mit-ir' ),
		'all_items'          => __( 'All Projects', 'mit-ir' ),
		'search_items'       => __( 'Search Projects', 'mit-ir' ),
		'parent_item_colon'  => __( 'Parent Project:', 'mit-ir' ),
		'not_found'          => __( 'No projects found.', 'mit-ir' ),
		'not_found_in_trash' => __( 'No projects found in Trash.', 'mit-ir' ),
		'featured_image' => __( 'Featured Image', 'mit-ir' ),
		'set_featured_image' => __( 'Set Featured Image', 'mit-ir' ),
		'remove_featured_image' => __( 'Remove Featured Image', 'mit-ir' ),
		'use_featured_image' => __( 'Use as Project Image', 'mit-ir' ),
		'insert_into_item' => __( 'Insert into Project', 'mit-ir' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Project', 'mit-ir' ),
		'items_list' => __( 'Projects list', 'mit-ir' ),
		'items_list_navigation' => __( 'Projects list navigation', 'mit-ir' ),
		'filter_items_list' => __( 'Filter Projects list', 'mit-ir' ),
	];

	// Definition of the post type arguments. For full list see:
	// https://developer.wordpress.org/reference/functions/register_post_type/
	$args = [
		'labels'              => $labels,
		'description'         => 'The latest letters, news, and reports from around MIT.',
		'menu_icon'           => 'dashicons-media-document',
		'public'              => true,
		'publicly_queryable' 	=> true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => true,
		'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ],
		'taxonomies'          => [ 'mit_updates_cat' ],
	];

	register_post_type( $slug, $args );
}
add_action( 'init', __NAMESPACE__ . '\cpt_mit_projects', 0 );


// Add Team Post Type

function cpt_mit_team() {
	$slug = 'team';

	// Modify all the i18ized strings here.
	$labels = [
		'menu_name'          => __( 'Team', 'mit-ir' ),
		'name'               => _x( 'Team', 'post type general name', 'mit-ir' ),
		'singular_name'      => _x( 'Team', 'post type singular name', 'mit-ir' ),
		'name_admin_bar'     => _x( 'Team', 'add new on admin bar', 'mit-ir' ),
		'add_new'            => _x( 'Add New', 'thing', 'mit-ir' ),
		'add_new_item'       => __( 'Add New Team Member', 'mit-ir' ),
		'new_item'           => __( 'New Team Member', 'mit-ir' ),
		'edit_item'          => __( 'Edit Team Member', 'mit-ir' ),
		'view_item'          => __( 'View Team Member', 'mit-ir' ),
		'all_items'          => __( 'All Team Members', 'mit-ir' ),
		'search_items'       => __( 'Search Team Members', 'mit-ir' ),
		'parent_item_colon'  => __( 'Parent Team Members:', 'mit-ir' ),
		'not_found'          => __( 'No team members found.', 'mit-ir' ),
		'not_found_in_trash' => __( 'No team members found in Trash.', 'mit-ir' ),
		'featured_image' => __( 'Featured Image', 'mit-ir' ),
		'set_featured_image' => __( 'Set Featured Image', 'mit-ir' ),
		'remove_featured_image' => __( 'Remove Featured Image', 'mit-ir' ),
		'use_featured_image' => __( 'Use as Team Member\'s Image', 'mit-ir' ),
		'insert_into_item' => __( 'Insert into Team Member', 'mit-ir' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Team Member', 'mit-ir' ),
		'items_list' => __( 'Team Members list', 'mit-ir' ),
		'items_list_navigation' => __( 'Team Members list navigation', 'mit-ir' ),
		'filter_items_list' => __( 'Filter Team Members list', 'mit-ir' ),
	];

	// Definition of the post type arguments. For full list see:
	// https://developer.wordpress.org/reference/functions/register_post_type/
	$args = [
		'labels'              => $labels,
		'description'         => 'The latest letters, news, and reports from around MIT.',
		'menu_icon'           => 'dashicons-megaphone',
		'public'              => true,
		'publicly_queryable' 	=> false,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => true,
		'supports'            => [ 'title', 'editor', 'thumbnail', 'revisions' ],
		'taxonomies'          => [ 'mit_updates_cat' ],
	];

	register_post_type( $slug, $args );
}
add_action( 'init', __NAMESPACE__ . '\cpt_mit_team', 0 );


// Add Project Taxonomies

function tax_mit_project_category() {
	$slug = 'project-category';
	// Post types in which the taxonomy should be registered
	$post_types = ['projects'];

  // Taxonomy Labels
	$labels = [
		'name'                  => _x( 'Categories', 'Taxonomy plural name', 'mit-ir' ),
		'singular_name'         => _x( 'Category', 'Taxonomy singular name', 'mit-ir' ),
		'search_items'          => __( 'Search Categories (Projects)', 'mit-ir' ),
		'popular_items'         => __( 'Popular Categories (Projects)', 'mit-ir' ),
		'all_items'             => __( 'All Categories', 'mit-ir' ),
		'parent_item'           => __( 'Parent Category', 'mit-ir' ),
		'parent_item_colon'     => __( 'Parent Category', 'mit-ir' ),
		'edit_item'             => __( 'Edit Category (Projects)', 'mit-ir' ),
		'update_item'           => __( 'Update Category (Projects)', 'mit-ir' ),
		'add_new_item'          => __( 'Add New Category (Projects)', 'mit-ir' ),
		'new_item_name'         => __( 'New Category', 'mit-ir' ),
		'add_or_remove_items'   => __( 'Add or remove category', 'mit-ir' ),
		'choose_from_most_used' => __( 'Choose from most used categories', 'mit-ir' ),
		'menu_name'             => __( 'Categories', 'mit-ir' ),
	];

	// Taxonomy Arguments
	// https://developer.wordpress.org/reference/functions/register_taxonomy/
	$args = [
		'labels'            => $labels,
		'description'       => 'Categories for Projects.',
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'show_tagcloud'     => false,
		'show_ui'           => true,
		'show_in_rest'			=> true,
		'query_var'         => false,
		'rewrite'           => [
			'slug' => $slug,
		],
	];

  register_taxonomy( $slug, $post_types, $args );
}
add_action( 'init', __NAMESPACE__ . '\tax_mit_project_category', 0 );

function tax_mit_project_population() {
	$slug = 'project-population';
	// Post types in which the taxonomy should be registered
	$post_types = ['projects'];

  // Taxonomy Labels
	$labels = [
		'name'                  => _x( 'Populations', 'Taxonomy plural name', 'mit-ir' ),
		'singular_name'         => _x( 'Population', 'Taxonomy singular name', 'mit-ir' ),
		'search_items'          => __( 'Search Populations (Projects)', 'mit-ir' ),
		'popular_items'         => __( 'Popular Populations (Projects)', 'mit-ir' ),
		'all_items'             => __( 'All Populations', 'mit-ir' ),
		'parent_item'           => __( 'Parent Population', 'mit-ir' ),
		'parent_item_colon'     => __( 'Parent Population', 'mit-ir' ),
		'edit_item'             => __( 'Edit Population (Projects)', 'mit-ir' ),
		'update_item'           => __( 'Update Population (Projects)', 'mit-ir' ),
		'add_new_item'          => __( 'Add New Population (Projects)', 'mit-ir' ),
		'new_item_name'         => __( 'New Population', 'mit-ir' ),
		'add_or_remove_items'   => __( 'Add or remove Population', 'mit-ir' ),
		'choose_from_most_used' => __( 'Choose from most used Populations', 'mit-ir' ),
		'menu_name'             => __( 'Populations', 'mit-ir' ),
	];

	// Taxonomy Arguments
	// https://developer.wordpress.org/reference/functions/register_taxonomy/
	$args = [
		'labels'            => $labels,
		'description'       => 'Populations for Projects.',
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'show_tagcloud'     => false,
		'show_ui'           => true,
		'show_in_rest'			=> true,
		'query_var'         => false,
		'rewrite'           => [
			'slug' => $slug,
		],
	];

  register_taxonomy( $slug, $post_types, $args );
}
add_action( 'init', __NAMESPACE__ . '\tax_mit_project_population', 0 );

function tax_mit_project_topic() {
	$slug = 'project-topic';
	// Post types in which the taxonomy should be registered
	$post_types = ['projects'];

  // Taxonomy Labels
	$labels = [
		'name'                  => _x( 'Topics', 'Taxonomy plural name', 'mit-ir' ),
		'singular_name'         => _x( 'Topic', 'Taxonomy singular name', 'mit-ir' ),
		'search_items'          => __( 'Search Topics (Projects)', 'mit-ir' ),
		'popular_items'         => __( 'Popular Topics (Projects)', 'mit-ir' ),
		'all_items'             => __( 'All Topics', 'mit-ir' ),
		'parent_item'           => __( 'Parent Topic', 'mit-ir' ),
		'parent_item_colon'     => __( 'Parent Topic', 'mit-ir' ),
		'edit_item'             => __( 'Edit Topic (Projects)', 'mit-ir' ),
		'update_item'           => __( 'Update Topic (Projects)', 'mit-ir' ),
		'add_new_item'          => __( 'Add New Topic (Projects)', 'mit-ir' ),
		'new_item_name'         => __( 'New Topic', 'mit-ir' ),
		'add_or_remove_items'   => __( 'Add or remove Topic', 'mit-ir' ),
		'choose_from_most_used' => __( 'Choose from most used Topics', 'mit-ir' ),
		'menu_name'             => __( 'Topics', 'mit-ir' ),
	];

	// Taxonomy Arguments
	// https://developer.wordpress.org/reference/functions/register_taxonomy/
	$args = [
		'labels'            => $labels,
		'description'       => 'Topics for Projects.',
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'show_tagcloud'     => false,
		'show_ui'           => true,
		'show_in_rest'			=> true,
		'query_var'         => false,
		'rewrite'           => [
			'slug' => $slug,
		],
	];

  register_taxonomy( $slug, $post_types, $args );
}
add_action( 'init', __NAMESPACE__ . '\tax_mit_project_topic', 0 );
