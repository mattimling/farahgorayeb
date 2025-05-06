<?php

add_action( 'init', function () {

	// Register slugs as translatable strings (register only once)
	if ( function_exists( 'icl_register_string' ) ) {
		icl_register_string( 'Slug', 'portfolio_slug', 'project' );
		icl_register_string( 'Slug', 'portfolio_category_slug', 'projects/category' );
	}

	// Get translated slugs
	$portfolio_slug = function_exists( 'icl_t' ) ? icl_t( 'Slug', 'portfolio_slug', 'project' ) : 'project';
	$portfolio_category_slug = function_exists( 'icl_t' ) ? icl_t( 'Slug', 'portfolio_category_slug', 'projects/category' ) : 'projects/category';

	// Register the 'portfolio' custom post type
	register_post_type( 'portfolio',
		array(
			'labels' => array(
				'name' => __( 'Portfolio', 'fargor' ),
				'singular_name' => __( 'Portfolio', 'fargor' ),
				'add_new' => __( 'Add New Portfolio', 'fargor' ),
				'all_items' => __( 'All Portfolio', 'fargor' ),
				'edit_item' => __( 'Edit Portfolio', 'fargor' ),
				'new_item' => __( 'New Portfolio', 'fargor' ),
				'view_item' => __( 'View Portfolio', 'fargor' ),
				'search_items' => __( 'Search Portfolio', 'fargor' ),
				'not_found' => __( 'No Portfolio found', 'fargor' ),
				'not_found_in_trash' => __( 'No Portfolio found in Trash', 'fargor' ),
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => $portfolio_slug ),
			'supports' => array( 'title', 'thumbnail', 'editor' ),
			'show_in_rest' => true,
		)
	);

	// Register the custom taxonomy 'portfolio_category'
	register_taxonomy( 'portfolio_category', 'portfolio', array(
		'labels' => array(
			'name' => __( 'Portfolio Categories', 'fargor' ),
			'singular_name' => __( 'Portfolio Category', 'fargor' ),
			'search_items' => __( 'Search Portfolio Categories', 'fargor' ),
			'all_items' => __( 'All Portfolio Categories', 'fargor' ),
			'parent_item' => __( 'Parent Portfolio Category', 'fargor' ),
			'parent_item_colon' => __( 'Parent Portfolio Category:', 'fargor' ),
			'edit_item' => __( 'Edit Portfolio Category', 'fargor' ),
			'update_item' => __( 'Update Portfolio Category', 'fargor' ),
			'add_new_item' => __( 'Add New Portfolio Category', 'fargor' ),
			'new_item_name' => __( 'New Portfolio Category Name', 'fargor' ),
			'menu_name' => __( 'Portfolio Categories', 'fargor' ),
		),
		'hierarchical' => true,
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => $portfolio_category_slug ),
		'show_in_rest' => true,
	) );
} );
