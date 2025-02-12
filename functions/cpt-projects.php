<?php

add_action( 'init', function () {
	// Register the 'projects' custom post type
	register_post_type( 'projects',
		array(
			'labels' => array(
				'name' => __( 'Projects', 'ferpoz' ),
				'singular_name' => __( 'Project', 'ferpoz' ),
				'add_new' => __( 'Add New Project', 'ferpoz' ),
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'project' ),
			'supports' => array( 'title', 'thumbnail' ),
		)
	);

	// Register the custom taxonomy 'project_category'
	register_taxonomy( 'project_category', 'projects', array(
		'labels' => array(
			'name' => __( 'Project Categories', 'ferpoz' ),
			'singular_name' => __( 'Project Category', 'ferpoz' ),
			'search_items' => __( 'Search Project Categories', 'ferpoz' ),
			'all_items' => __( 'All Project Categories', 'ferpoz' ),
			'parent_item' => __( 'Parent Project Category', 'ferpoz' ),
			'parent_item_colon' => __( 'Parent Project Category:', 'ferpoz' ),
			'edit_item' => __( 'Edit Project Category', 'ferpoz' ),
			'update_item' => __( 'Update Project Category', 'ferpoz' ),
			'add_new_item' => __( 'Add New Project Category', 'ferpoz' ),
			'new_item_name' => __( 'New Project Category Name', 'ferpoz' ),
			'menu_name' => __( 'Project Categories', 'ferpoz' ),
		),
		'hierarchical' => true, // Set to true to make it behave like categories
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'project-category' ),
	) );
} );
