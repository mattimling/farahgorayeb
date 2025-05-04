<?php

add_action( 'init', function () {
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
			'rewrite' => array( 'slug' => 'project' ),
			'supports' => array( 'title', 'thumbnail', 'editor' ), // Added 'editor' support for content editing
			'show_in_rest' => true, // Enable the block editor (Gutenberg)
		)
	);

	// Register the custom taxonomy 'portfolio_category'
	register_taxonomy( 'portfolio_category', 'portfolio', array( // Corrected the post type slug to lowercase 'portfolio'
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
		'hierarchical' => true, // Set to true to make it behave like categories
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'projects/category' ),
		'show_in_rest' => true, // Enable the block editor (Gutenberg) for the taxonomy
	) );
} );
