<?php

// Remove Wp emoji.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Remove wp api link in the header.
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );


// Remove wp generator in the hader.
remove_action( 'wp_head', 'wp_generator' );

// Dequeue scripts.
add_action( 'wp_enqueue_scripts', function () {

	// Deregister / dequeue unnecessary files.
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );

	wp_dequeue_style( 'classic-theme-styles' );
	wp_dequeue_style( 'global-styles' );

	// Leave it for Admin bar functionality - it'll not be on frontend
	// wp_deregister_script( 'jquery' ); 
	// wp_register_script( 'jquery', '', array(), '', true );

} );

// Remove rsd and wlw links in the header.
add_action( 'init', function () {

	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );

} );