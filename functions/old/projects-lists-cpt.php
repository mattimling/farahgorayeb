<?php

add_action( 'init', function () {
	register_post_type( 'projects_list',
		array(
			'labels' => array(
				'name' => __( 'Projects List', 'moxey' ),
				'singular_name' => __( 'Project', 'moxey' ),
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'projects-list' ),
			'taxonomies' => array( 'category' ),
		)
	);
} );