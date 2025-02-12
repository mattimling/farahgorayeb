<?php

// Disable default WP image sizes.
function disable_default_image_sizes( $sizes ) {
	unset( $sizes['thumbnail'] );       // Disable Thumbnail size
	// unset( $sizes['medium'] );          // Disable Medium size
	unset( $sizes['large'] );           // Disable Large size
	unset( $sizes['medium_large'] );    // Disable Medium Large size
	unset( $sizes['1536x1536'] );       // Disable 1536px size
	unset( $sizes['2048x2048'] );       // Disable 2048px size
	return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'disable_default_image_sizes', 9999 );

// Ensure default sizes are removed during theme setup.
function remove_default_image_sizes() {
	remove_image_size( 'thumbnail' );
	// remove_image_size( 'medium' );
	remove_image_size( 'large' );
	remove_image_size( 'medium_large' );
	remove_image_size( '1536x1024' );
	remove_image_size( '2048x1365' );
}
add_action( 'after_setup_theme', 'remove_default_image_sizes', 11 );

// Add custom image size 'xl' with a width of 2560px.
function add_custom_image_size() {
	add_image_size( 'xl', 2048, 0, false ); // Custom size with 2560px width, unlimited height, no crop.
	// add_image_size( 'md', 1280, 0, false ); // Custom size with 1280px width, unlimited height, no crop.
}
add_action( 'after_setup_theme', 'add_custom_image_size' );

// Disable WordPress scaled images.
add_filter( 'big_image_size_threshold', '__return_false' );

// Make 'xl' and 'large_1280' sizes selectable in the WordPress Media Library (optional).
function add_custom_image_size_to_media_selector( $sizes ) {
	$sizes['xl'] = __( 'Extra Large (2048px)', 'ferpoz' );
	// $sizes['md'] = __( 'Medium (1280px)', 'ferpoz' );
	return $sizes;
}
add_filter( 'image_size_names_choose', 'add_custom_image_size_to_media_selector' );
