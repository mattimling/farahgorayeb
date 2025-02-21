<?php

add_action( 'init', function () {
	// Register the 'showroom' custom post type
	register_post_type( 'showroom',
		array(
			'labels' => array(
				'name' => __( 'Showroom', 'fargor' ),
				'singular_name' => __( 'Showroom', 'fargor' ),
				'add_new' => __( 'Add New Showroom', 'fargor' ),
				'all_items' => __( 'All Showroom', 'fargor' ),
				'edit_item' => __( 'Edit Showroom', 'fargor' ),
				'new_item' => __( 'New Showroom', 'fargor' ),
				'view_item' => __( 'View Showroom', 'fargor' ),
				'search_items' => __( 'Search Showroom', 'fargor' ),
				'not_found' => __( 'No Showroom found', 'fargor' ),
				'not_found_in_trash' => __( 'No Showroom found in Trash', 'fargor' ),
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'product' ),
			'supports' => array( 'title', 'thumbnail', 'editor' ), // Added 'editor' support for content editing
			'show_in_rest' => true, // Enable the block editor (Gutenberg)
		)
	);

	// Register the custom taxonomy 'showroom_category'
	register_taxonomy( 'showroom_category', 'showroom', array( // Corrected the post type slug to lowercase 'showroom'
		'labels' => array(
			'name' => __( 'Showroom Categories', 'fargor' ),
			'singular_name' => __( 'Showroom Category', 'fargor' ),
			'search_items' => __( 'Search Showroom Categories', 'fargor' ),
			'all_items' => __( 'All Showroom Categories', 'fargor' ),
			'parent_item' => __( 'Parent Showroom Category', 'fargor' ),
			'parent_item_colon' => __( 'Parent Showroom Category:', 'fargor' ),
			'edit_item' => __( 'Edit Showroom Category', 'fargor' ),
			'update_item' => __( 'Update Showroom Category', 'fargor' ),
			'add_new_item' => __( 'Add New Showroom Category', 'fargor' ),
			'new_item_name' => __( 'New Showroom Category Name', 'fargor' ),
			'menu_name' => __( 'Showroom Categories', 'fargor' ),
		),
		'hierarchical' => true, // Set to true to make it behave like categories
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'showroom-category' ),
		'show_in_rest' => true, // Enable the block editor (Gutenberg) for the taxonomy
	) );
} );
?>